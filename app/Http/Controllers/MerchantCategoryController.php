<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MerchantCategory;
use Auth;

class MerchantCategoryController extends Controller
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
        $categories = MerchantCategory::get();

        return view('merchant_category/index', compact('categories'));
    }

    /**
     * Show the merchant category create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('merchant_category/create');
    }

    public function store(Request $request)
    {
        $merchant_category = new MerchantCategory;
        
        $merchant_category->name = request('name');
        $merchant_category->description = request('description');
        $merchant_category->created_by = Auth::user()->id;
        $merchant_category->created_at = now();
        $merchant_category->save();

        return redirect()->route('setting.merchant.category.index')->with('success', 'Succes create category');
    }
}
