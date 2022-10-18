<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PartnerDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class PartnerController extends Controller
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
     * Show the merchant create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('partner/create');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $partners = User::where('role','=','2')->whereNull('deleted_at')->get();

        return view('partner/index', compact('partners'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'email' => 'email|required',
        ]);

        $password = request('name') . '123';
    
        $user = new User;
        $user->name = request('name');
        $user->email = request('email');
        $user->mobile_number = request('mobile_number');
        $user->phone_number = request('phone_number');
        $user->address = request('address');
        $user->role = '2'; //role 2 = partner
        $user->password = Hash::make($password);
        $user->created_by = Auth::user()->id;
        $user->created_at = now();
        $user->save();

        $partner_details = new PartnerDetails;
        $partner_details->user_id = $user->id;
        $partner_details->business_registration_no = request('business_registration_no');
        $partner_details->category_id = request('category_id');
        $partner_details->created_by = Auth::user()->id;
        $partner_details->created_at = now();
        $partner_details->save();

        return redirect()->route('partner.index')->with('success', 'Success create partner');
    }

    public function edit($id)
    {
        $partner = User::find($id);

        return view('partner/edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->mobile_number = $request->input('mobile_number');
        $user->phone_number = $request->input('phone_number');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->updated_by = Auth::user()->id;
        $user->updated_at = now();
        $user->update();

        $partner_details = PartnerDetails::where('user_id', $id)->first();
        $partner_details->business_registration_no = request('business_registration_no');
        $partner_details->category_id = request('category_id');
        $partner_details->updated_by = Auth::user()->id;
        $partner_details->updated_at = now();
        $partner_details->update();

        return redirect()->route('partner.index')->with('success', 'Success update partner');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->deleted_at = now();
        $user->update();

        return redirect()->route('partner.index')->with('status','Merchant Deleted Successfully');
    }
}
