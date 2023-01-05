<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductCategories;
use App\ProductSubCategories;

class MerchantProduct extends Model
{
    public function category()
    {
        return $this->hasOne(ProductCategories::class,'id','category_id');
    }

    public function subcategory()
    {
        return $this->hasOne(ProductSubCategories::class,'id','sub_category_id');
    }
}
