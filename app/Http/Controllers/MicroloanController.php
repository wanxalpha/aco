<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MicroLoans;
use App\MicroLoanDetails;
use Auth;
use App\Helpers\AppHelper;

class MicroloanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the merchant category dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $microloans = MicroLoans::whereNull('deleted_at')->get();

        return view('micro_loan.index', compact('microloans'));
    }

    /**
     * Show the merchant category create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('micro_loan.create');
    }

    public function store(Request $request)
    {
        $micro_loan = new MicroLoans;
        
        $micro_loan->package_name = request('package_name');
        $micro_loan->amount = request('amount');
        $micro_loan->processing_fee = request('processing_fee');
        $micro_loan->admin_fee = request('admin_fee');
        $micro_loan->description = request('description');
        $micro_loan->user_id = Auth::user()->id;
        $micro_loan->status = request('status');
        $micro_loan->created_by = Auth::user()->id;
        $micro_loan->created_at = now();

        if($request->hasFile('money_lender_license')) {
            $request->money_lender_license->store('money_lender', 'public');
            $micro_loan->money_lender_license = $request->money_lender_license->hashName();
        }

        if($request->hasFile('advertising_license')) {
            $request->advertising_license->store('money_lender', 'public');
            $micro_loan->advertising_license = $request->advertising_license->hashName();
        }

        if($request->hasFile('loan_agreement')) {
            $request->loan_agreement->store('money_lender', 'public');
            $micro_loan->loan_agreement = $request->loan_agreement->hashName();
        }

        $micro_loan->save();

        // return view('micro_loan/edit', compact('micro_loan'))->with('success', __('partner.success_create_micro_loan'));

        return redirect()->route('microloan.edit', $micro_loan->id)->with( ['micro_loan' => $micro_loan] );

    }

    public function edit($id)
    {
        $micro_loan = MicroLoans::find($id);
        $micro_loan_details = MicroLoanDetails::where('micro_loan_id',$id)->whereNull('deleted_at')->get();

        return view('micro_loan/edit', compact('micro_loan','micro_loan_details'));
    }

    public function update($id, Request $request){
       
        $request->validate([
            // 'image' => 'mimes:jpeg,bmp,png'
        ]);

        $micro_loan = MicroLoans::find($id);
        $micro_loan->package_name = request('package_name');
        $micro_loan->amount = request('amount');
        $micro_loan->processing_fee = request('processing_fee');
        $micro_loan->admin_fee = request('admin_fee');
        $micro_loan->description = request('description');
        $micro_loan->status = request('status');
        $micro_loan->updated_by = Auth::user()->id;
        $micro_loan->updated_at = now();

        if($request->hasFile('money_lender_license')) {
            $request->money_lender_license->store('money_lender', 'public');
            $micro_loan->money_lender_license = $request->money_lender_license->hashName();
        }

        if($request->hasFile('advertising_license')) {
            $request->advertising_license->store('money_lender', 'public');
            $micro_loan->advertising_license = $request->advertising_license->hashName();
        }

        if($request->hasFile('loan_agreement')) {
            $request->loan_agreement->store('money_lender', 'public');
            $micro_loan->loan_agreement = $request->loan_agreement->hashName();
        }

        $micro_loan->save();

        $micro_loan_details = MicroLoanDetails::where('micro_loan_id',$id)->whereNull('deleted_at')->get();

        foreach($micro_loan_details as $micro_loan_detail){

            $member_rate = $micro_loan->amount * ($micro_loan_detail->member_rate / 100);
            $member_monthly_payment = (($micro_loan->amount + $member_rate) / $micro_loan_detail->tenure_month);
            $member_first_month_payment = $member_monthly_payment + $micro_loan->processing_fee + $micro_loan->admin_fee;

            $non_member_rate = $micro_loan->amount * ($micro_loan_detail->non_member_rate / 100);
            $non_member_monthly_payment = (($micro_loan->amount + $non_member_rate) / $micro_loan_detail->tenure_month);
            $non_member_first_month_payment = $non_member_monthly_payment + $micro_loan->processing_fee + $micro_loan->admin_fee;

            $micro_loan_detail->member_monthly_payment = $member_monthly_payment;
            $micro_loan_detail->member_first_month_payment = $member_first_month_payment;
            $micro_loan_detail->non_member_monthly_payment = $non_member_monthly_payment;
            $micro_loan_detail->non_member_first_month_payment = $non_member_first_month_payment;
            $micro_loan_detail->updated_by = Auth::user()->id;
            $micro_loan_detail->updated_at = now();
            $micro_loan_detail->save();

        }

        return redirect()->route('microloan.index')->with('success', 'Micro loan Updated Successfully');
    }

    public function delete($id)
    {
        $micro_loan = MicroLoans::find($id);
        $micro_loan->deleted_by = Auth::user()->id;
        $micro_loan->deleted_at = now();
        $micro_loan->update();

        return redirect()->route('microloan.index')->with('success','Micro loan Deleted Successfully');
    }

    public function storeDetail(Request $request){
        
        $micro_loan_detail =  new MicroLoanDetails;
        $micro_loan_detail->micro_loan_id = $request->micro_loan_id;
        $micro_loan_detail->tenure_month = $request->tenure_month;
        $micro_loan_detail->member_rate = $request->member_rate;
        $micro_loan_detail->non_member_rate = $request->non_member_rate;
        $micro_loan_detail->member_monthly_payment = $request->member_monthly_payment;
        $micro_loan_detail->member_first_month_payment = $request->member_first_month_payment;
        $micro_loan_detail->non_member_monthly_payment = $request->non_member_monthly_payment;
        $micro_loan_detail->non_member_first_month_payment = $request->non_member_first_month_payment;
        $micro_loan_detail->created_by = Auth::user()->id;
        $micro_loan_detail->created_at = now();
        $micro_loan_detail->save();

        return redirect()->back()->with('success', __('success_create_micro_loan_details'));   
     }

    public function updateDetail(Request $request){

        $micro_loan_detail =  MicroLoanDetails::find($request->detail_id);
        $micro_loan_detail->tenure_month = $request->tenure_month;
        $micro_loan_detail->member_rate = $request->member_rate;
        $micro_loan_detail->non_member_rate = $request->non_member_rate;
        $micro_loan_detail->member_monthly_payment = $request->member_monthly_payment;
        $micro_loan_detail->non_member_monthly_payment = $request->non_member_monthly_payment;
        $micro_loan_detail->updated_by = Auth::user()->id;
        $micro_loan_detail->updated_at = now();
        $micro_loan_detail->save();
   
        return redirect()->back()->with('success', __('success_update_micro_loan_details'));  
    }


    public function deleteDetail($id)
    {
        $micro_loan_detail = MicroLoanDetails::find($id);
        $micro_loan_detail->deleted_by = Auth::user()->id;
        $micro_loan_detail->deleted_at = now();
        $micro_loan_detail->update();

        return redirect()->route('microloan.index')->with('success',__('partner.success_delete_micro_loan_details'));
    }
}
