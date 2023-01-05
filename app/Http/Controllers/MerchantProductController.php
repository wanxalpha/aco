<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MerchantProduct;
use App\ProductCategories;
use App\ProductSubCategories;
use App\MerchantProductAttachment;
use Auth;

class MerchantProductController extends Controller
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

        return view('merchant_product.index', compact('products'));
    }

    /**
     * Show the merchant category create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $product_categories = ProductCategories::whereNull('deleted_at')->get();

        return view('merchant_product.create', compact('product_categories'));
    }

    public function store(Request $request)
    {
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

        foreach(request('attachment_list') as $attachment){
            $attachment['attachment']->store('products', 'public');

            $product_atachment = new MerchantProductAttachment;
            $product_atachment->merchant_product_id = $merchant_product->id;
            $product_atachment->path = __('merchant.storage_path');
            $product_atachment->filename = $attachment['attachment']->hashName();
            $product_atachment->created_by = Auth::user()->id;
            $product_atachment->created_at = now();
            $product_atachment->save();
        }

        return redirect()->route('merchant.product.index')->with('success', 'Succes create product');
    }

    public function edit($id)
    {
        $merchant_product = MerchantProduct::find($id);
        $product_categories = ProductCategories::whereNull('deleted_at')->get();
        $product_atachments = MerchantProductAttachment::where('merchant_product_id',$id)->whereNull('deleted_at')->get();

        return view('merchant_product/edit', compact('merchant_product','product_categories','product_atachments'));
    }

    public function update($id, Request $request){

        $request->validate([
            'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
        ]);

        $merchant_product = MerchantProduct::find($id);
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
        $merchant_product->updated_by = Auth::user()->id;
        $merchant_product->updated_at = now();
        $merchant_product->update();

        foreach(request('attachment_list') as $attachment){
            $attachment['attachment']->store('products', 'public');

            $product_atachment = new MerchantProductAttachment;
            $product_atachment->merchant_product_id = $merchant_product->id;
            $product_atachment->path = __('merchant.storage_path');
            $product_atachment->filename = $attachment['attachment']->getClientOriginalName();
            $product_atachment->hashname = $attachment['attachment']->hashName();
            $product_atachment->created_by = Auth::user()->id;
            $product_atachment->created_at = now();
            $product_atachment->save();
        }

        return redirect()->route('merchant.product.index')->with('success', 'Product Updated Successfully');
    }
    
    public function delete($id)
    {
        $product = MerchantProduct::find($id);
        $product->deleted_by = Auth::user()->id;
        $product->deleted_at = now();
        $product->update();

        return redirect()->route('merchant.product.index')->with('status','Product Deleted Successfully');
    }

    public function deleteAttachment($id)
    {
        $product_attachment = MerchantProductAttachment::find($id);
        $product_attachment->deleted_by = Auth::user()->id;
        $product_attachment->deleted_at = now();
        $product_attachment->update();

        return redirect()->back()->with('status','Product Attachment Deleted Successfully');
    }

    public function findSubcategory(Request $request){
        $data =  ProductSubCategories::where('category_id', $request->id)->get();
   
       return response()->json($data);
   
     }
}
