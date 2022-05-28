<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductManage extends Model
{
    public function gallery(){
        return $this->hasMany(ProductGallery::class,'product_id','id');
    }

    public function Category(){
        return $this->belongsTo(Category::class,'cat_id','id');
    }

    public function Brand(){
        return $this->belongsTo(BrandManage::class,'brand_id','id');
    }
}
