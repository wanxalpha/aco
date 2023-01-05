<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insurances;
use App\InsuranceQuestionaire;
use Auth;
use App\Helpers\AppHelper;

class InsuranceController extends Controller
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
        $insurances = Insurances::whereNull('deleted_at')->get();

        return view('insurance.index', compact('insurances'));
    }

    /**
     * Show the merchant category create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('insurance.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $insurance = new Insurances;
        
        $insurance->name = request('name');
        $insurance->description = request('description');
        $insurance->user_id = Auth::user()->id;
        $insurance->status = request('status');
        $insurance->created_by = Auth::user()->id;
        $insurance->created_at = now();

        if($request->hasFile('epolicy')) {
// dd($request->epolicy);
            $request->epolicy->store('insurance', 'public');
            $insurance->epolicy = $request->epolicy->hashName();
        }

        if($request->hasFile('ecertificate')) {

            $request->ecertificate->store('insurance', 'public');
            $insurance->ecertificate = $request->ecertificate->hashName();
        }

        if($request->hasFile('important_notice')) {

            $request->important_notice->store('insurance', 'public');
            $insurance->important_notice = $request->important_notice->hashName();
        }

        if($request->hasFile('insurance_plan')) {

            $request->insurance_plan->store('insurance', 'public');
            $insurance->insurance_plan = $request->insurance_plan->hashName();
        }


        $insurance->save();

        $questionaire = $request->value;

        foreach ($questionaire as $question) {
            $insurance_questionaire = new InsuranceQuestionaire;
            $insurance_questionaire->insurance_id = $insurance->id;
            $insurance_questionaire->question = $question;
            $insurance_questionaire->created_by = Auth::user()->id;
            $insurance_questionaire->created_at = now();
            $insurance_questionaire->save();
        }

        return redirect()->route('insurance.index')->with('success', 'Succes create insurance');
    }

    public function edit($id)
    {
        $insurance = Insurances::find($id);
        $insurance_questionaire = InsuranceQuestionaire::where('insurance_id',$id)->whereNull('deleted_at')->get();
        return view('insurance/edit', compact('insurance','insurance_questionaire'));
    }

    public function update($id, Request $request){
       
        $request->validate([
            // 'image' => 'mimes:jpeg,bmp,png'
        ]);

        $question_id = [];

        $insurance = Insurances::find($id);
        $insurance->name = request('name');
        $insurance->description = request('description');
        $insurance->user_id = Auth::user()->id;
        $insurance->status = request('status');
        $insurance->updated_by = Auth::user()->id;
        $insurance->updated_at = now();

        $questionaire_list = InsuranceQuestionaire::where('insurance_id',$id)->get();


        if($request->has('question')){
            foreach($request->question as $key => $question){
                $insurance_questionaire = InsuranceQuestionaire::find($key);
                $insurance_questionaire->question = $question;
                $insurance_questionaire->updated_by = Auth::user()->id;
                $insurance_questionaire->updated_at = now();
                $insurance_questionaire->update();

                array_push($question_id, $key);
            }
        }

        foreach($questionaire_list as $question){
            if (!in_array($question->id, $question_id)) {
                $question->deleted_by = Auth::user()->id;
                $question->deleted_at = now();
                $question->update();

            }
        }

        if($request->has('new')){
            foreach($request->new as $new){
                $insurance_questionaire = new InsuranceQuestionaire;
                $insurance_questionaire->insurance_id = $id;
                $insurance_questionaire->question = $new;
                $insurance_questionaire->created_by = Auth::user()->id;
                $insurance_questionaire->created_at = now();
                $insurance_questionaire->save();
            }
        }

        if($request->hasFile('epolicy')) {

            $request->epolicy->store('insurance', 'public');
            $insurance->epolicy = $request->epolicy->hashName();
        }

        if($request->hasFile('ecertificate')) {

            $request->ecertificate->store('insurance', 'public');
            $insurance->ecertificate = $request->ecertificate->hashName();
        }

        if($request->hasFile('important_notice')) {

            $request->important_notice->store('insurance', 'public');
            $insurance->important_notice = $request->important_notice->hashName();
        }

        if($request->hasFile('insurance_plan')) {

            $request->insurance_plan->store('insurance', 'public');
            $insurance->insurance_plan = $request->insurance_plan->hashName();
        }
        $insurance->update();

        return redirect()->route('insurance.index')->with('success', 'Insurance Updated Successfully');
    }

    public function delete($id)
    {
        $insurance = Insurances::find($id);
        $insurance->deleted_by = Auth::user()->id;
        $insurance->deleted_at = now();
        $insurance->update();

        // $insurance_questionaire = InsuranceQuestionaire::where('insurance_id',$id)->get();

        // foreach($insurance_questionaire as $question){

        // }

        return redirect()->route('insurance.index')->with('status','Insurance Deleted Successfully');
    }

    public function find_subcategory(Request $request){
        $data =  ProductSubCategories::where('category_id', $request->id)->get();
   
       return response()->json($data);
   
     }
}
