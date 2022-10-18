<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MerchantProduct;
use App\ProductCategories;
use App\ProductSubCategories;
use Auth;

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
        $products = MerchantProduct::whereNull('deleted_at')->get();

        return view('insurance.index', compact('products'));
    }

    /**
     * Show the merchant category create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $product_categories = ProductCategories::whereNull('deleted_at')->get();

        return view('insurance.create', compact('product_categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $merchant_product = new MerchantProduct;
        
        $merchant_product->name = request('name');
        $merchant_product->description = request('description');
        $merchant_product->merchant_id = Auth::user()->id;
        $merchant_product->type_id = request('type_id');
        $merchant_product->category_id = request('category_id');
        $merchant_product->sub_category_id = request('sub_category_id');
        $merchant_product->available_quantity = request('available_quantity');
        $merchant_product->status = request('status');
        $merchant_product->member_price = request('member_price');
        $merchant_product->non_member_price = request('non_member_price');
        $merchant_product->created_by = Auth::user()->id;
        $merchant_product->created_at = now();
        $merchant_product->save();

        return redirect()->route('merchant.product.index')->with('success', 'Succes create product');
    }

    public function edit($id)
    {
        $merchant_product = MerchantProduct::find($id);
        $product_categories = ProductCategories::whereNull('deleted_at')->get();

        return view('merchant_product/edit', compact('merchant_product','product_categories'));
    }

    public function delete($id)
    {
        $product_category = MerchantProduct::find($id);
        $product_category->deleted_by = Auth::user()->id;
        $product_category->deleted_at = now();
        $product_category->update();

        return redirect()->route('merchant.product.index')->with('status','Product Deleted Successfully');
    }

    public function find_subcategory(Request $request){
        $data =  ProductSubCategories::where('category_id', $request->id)->get();
   
       return response()->json($data);
   
     }
}
