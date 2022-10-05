<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// Merchant
Route::get('/merchant', 'MerchantController@index')->name('merchant.index');
Route::get('/merchant/create', 'MerchantController@create')->name('merchant.create');
Route::post('/merchant/store', 'MerchantController@store')->name('merchant.store');
Route::get('/merchant/edit/{id}', 'MerchantController@edit')->name('merchant.edit');
Route::post('/merchant/update/{id}', 'MerchantController@update')->name('merchant.update');
Route::get('/merchant/delete/{id}', 'MerchantController@delete')->name('merchant.delete');

//merchant product
Route::get('/merchant_product', 'MerchantProductController@index')->name('merchant.product.index');
Route::get('/merchant_product/create', 'MerchantProductController@create')->name('merchant.product.create');
Route::post('/merchant_product/store', 'MerchantProductController@store')->name('merchant.product.store');
Route::get('/merchant_product/edit/{id}', 'MerchantProductController@edit')->name('merchant.product.edit');
Route::post('/merchant_product/update/{id}', 'MerchantProductController@update')->name('merchant.product.update');
Route::get('/merchant_product/delete/{id}', 'MerchantProductController@delete')->name('merchant.product.delete');

Route::group(['prefix'=>'settings','as'=>'setting.'], function(){
    // Merchant category
    Route::get('/merchant_category', 'MerchantCategoryController@index')->name('merchant.category.index');
    Route::get('/merchant_category/create', 'MerchantCategoryController@create')->name('merchant.category.create');
    Route::post('/merchant_category/store', 'MerchantCategoryController@store')->name('merchant.category.store');
    
    // Product category
    Route::get('/product_category/index', 'ProductCategoryController@index')->name('product.category.index');
    Route::get('/product_category/create', 'ProductCategoryController@create')->name('product_category.create');
    Route::post('/product_category/store', 'ProductCategoryController@store')->name('product.category.store');
    Route::get('/product_category/edit/{id}', 'ProductCategoryController@edit')->name('product.category.edit');
    Route::post('/product_category/update/{id}', 'ProductCategoryController@update')->name('product.category.update');
    Route::get('/product_category/delete/{id}', 'ProductCategoryController@delete')->name('product.category.delete');

    // Product subcategory
    Route::post('/product_subcategory/store', 'ProductSubCategoryController@store')->name('product.subcategory.store');
    Route::get('/product_subcategory/edit/{id}', 'ProductSubCategoryController@edit')->name('product.subcategory.edit');
    Route::post('/product_subcategory/update/{id}', 'ProductSubCategoryController@update')->name('product.subcategory.update');
    Route::get('/product_subcategory/delete/{id}', 'ProductSubCategoryController@delete')->name('product.subcategory.delete');

});
