<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class MerchantController extends Controller
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
        return view('merchant/create');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $merchants = User::where('role','=','1')->whereNull('deleted_at')->get();

        return view('merchant/index', compact('merchants'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'integer|required|max:255',
            'email' => 'email|required',
        ]);

        $password = request('name') . '123';
    
        $user = new User;
        $user->name = request('name');
        $user->email = request('email');
        $user->mobile_number = request('mobile_number');
        $user->phone_number = request('phone_number');
        $user->address = request('address');
        $user->role = '1'; //role 1 = merchant
        $user->password = Hash::make($password);
        $user->created_by = Auth::user()->id;
        $user->created_at = now();
        $user->save();

        return redirect()->route('merchant.index')->with('success', 'Success create merchant');
    }

    public function edit($id)
    {
        $merchant = User::find($id);
        return view('merchant/edit', compact('merchant'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'integer|required|max:255',
            'email' => 'email|required',
        ]);
        
        $user = User::find($id);
        $user->name = $request->input('name');
        // $user->email = $request->input('email');
        $user->mobile_number = $request->input('mobile_number');
        $user->phone_number = $request->input('phone_number');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->updated_by = Auth::user()->id;
        $user->updated_at = now();
        $user->update();

        return redirect()->route('merchant.index')->with('success', 'Success update merchant');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->deleted_at = now();
        $user->update();

        return redirect()->route('merchant.index')->with('status','Merchant Deleted Successfully');
    }
}
