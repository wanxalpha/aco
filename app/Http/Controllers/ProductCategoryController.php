<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategories;
use App\ProductSubCategories;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProductCategoryController extends Controller
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
        return view('product_category.create');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product_categories = ProductCategories::whereNull('deleted_at')->get();

        return view('product_category/index', compact('product_categories'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);
    
        $product_category = new ProductCategories;
        $product_category->name = request('name');
        $product_category->description = request('description');
        $product_category->created_by = Auth::user()->id;
        $product_category->created_at = now();
        $product_category->save();

        return redirect()->route('setting.product.category.index')->with('success', 'Success create product category');
    }

    public function edit($id)
    {
        $product_category = ProductCategories::find($id);

        $product_subcategories = ProductSubCategories::where('category_id',$id)->whereNull('deleted_at')->paginate(5);

        return view('product_category/edit', compact('product_category','product_subcategories'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $product_category = ProductCategories::find($id);
        $product_category->name = request('name');
        $product_category->description = request('description');
        $product_category->updated_at = Auth::user()->id;
        $product_category->updated_at = now();
        $product_category->update();

        return redirect()->route('setting.product.category.index')->with('success', 'Success update product category');
    }

    public function delete($id)
    {
        $product_category = ProductCategories::find($id);
        $product_category->deleted_at = now();
        $product_category->update();

        return redirect()->route('setting.product.category.index')->with('success','Product category Deleted Successfully');
    }
}
