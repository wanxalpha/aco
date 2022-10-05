<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductSubCategories;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProductSubCategoryController extends Controller
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => 'required|max:255',
        ]);
    
        $product_subcategory = new ProductSubCategories;
        $product_subcategory->name = request('subcategory_name');
        $product_subcategory->category_id = request('category_id');
        $product_subcategory->created_by = Auth::user()->id;
        $product_subcategory->created_at = now();
        $product_subcategory->save();

        return redirect()->back()->with('success', 'Subcategory Created Successfully');
    }

    public function edit($id)
    {
        $product_category = ProductCategories::find($id);
        return view('product_category/edit', compact('product_category'));
    }

    public function update(Request $request, $id)
    {
        $product_subcategory = ProductSubCategories::find($id);
        $product_subcategory->name = $request->input('name');
        $product_subcategory->updated_by = Auth::user()->id;
        $product_subcategory->updated_at = now();
        $product_subcategory->update();

        return redirect()->back()->with('success', 'Subcategory Updated Successfully');
    }

    public function delete($id)
    {
        $product_subcategory = ProductSubCategories::find($id);
        $product_subcategory->deleted_at = now();
        $product_subcategory->update();

        return redirect()->back()->with('success','Subcategory Deleted Successfully');
    }
}
