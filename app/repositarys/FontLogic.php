<?php

namespace App\repositarys;

use App\BrandManage;
use App\Category;
use App\interfaces\fontinterface;
use App\ProductGallery;
use App\ProductManage;
use Illuminate\Http\Request;

class FontLogic implements fontinterface
{

    public function ActiveCategory()
    {
       
        $cate = Category::where('status','1')->get();
        return $cate;
    }  
    
    public function ActiveBrand()
    {
       
        $cate = BrandManage::get();
        return $cate;
    }

    public function AllPost(){

        $post = ProductManage::with(['Category','Brand'])->paginate(10);
        return $post;
    }

    public function SinglePost($id){

        $single = ProductManage::with(['Category','Brand','gallery'])->where('id',$id)->first();
        return $single;
    }  
    
    public function multigallery($id){

        $gallery = ProductGallery::where('product_id',$id)->get();
        return $gallery;
    }

    public function CategoryWisePost($id)
    {
        $post = ProductManage::with(['Category','Brand'])->where('cat_id',$id)->get();
        return $post;  
    }    
    
    public function BrandWisePost($id)
    {
        $post = ProductManage::with(['Category','Brand'])->where('brand_id',$id)->get();
        return $post;  
    }

    public function MainSearch(Request $request){

        $serach = ProductManage::with(['Category','Brand'])->where('product_name','LIKE',"%{$request->data}%")->get();
        return $serach;
    }
}
