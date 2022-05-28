<?php
namespace App\repositarys;

use App\BrandManage;
use App\Category;
use App\ColorManage;
use App\interfaces\ProductInterface;
use App\ProductGallery;
use App\ProductManage;
use App\SizeManage;
use App\TagManage;
use Illuminate\Http\Request;
use Image;
Class ProductLogin implements ProductInterface{

    public function Store(Request $request){

        $store = new ProductManage();
        $store->cat_id = $request->cat_id;
        $store->tag_id = $request->tag_id;
        $store->color_id = $request->color_id;
        $store->brand_id = $request->brand_id;
        $store->size_id = $request->size_id;
        $store->product_name = $request->product_name;
        $store->description = $request->description;
        $store->status = $request->status;
        $store->short_summary = $request->short_summary;
        $store->save();

        if($request->image){
            $exp = explode(';',$request->image);
            $exp1 = explode('/',$exp[0]);
            $fullname = time().'.'.$exp1[1];
            Image::make($request->image)->resize(1100,800)->save('upload/product/'.$fullname);
            $store->image = $fullname;
            $store->save();
        }

        if($request->gallery){

            foreach($request->gallery as $key=>$gall){
                $exp_gall = explode(';',$gall);
                $exp1_gall = explode('/',$exp_gall[0]);
                $fullname_gallery = $key.uniqid().time().'.'.$exp1_gall[1];
                Image::make($gall)->resize(100,100)->save('upload/product_gallery/'.$fullname_gallery);
                $gallery = new ProductGallery();
                $gallery->product_id = $store->id;
                $gallery->gallery = $fullname_gallery;
                $gallery->save();
            }
        }

    }

    public function AllCategory(){

        $category = Category::get();
        return $category;
    }    
    
    
    public function AllColor(){

        $color = ColorManage::get();
        return $color;
    }
    
    public function AllTag(){

        $tag = TagManage::get();
        return $tag;
    }   
    
    public function AllSize(){

        $size = SizeManage::get();
        return $size;
    }

    public function AllBrand(){

        $brand = BrandManage::get();
        return $brand;
    }

    public function Update(Request $request){
        $update = ProductManage::where('id',$request->id)->first();
        $update->cat_id = $request->cat_id;
        $update->tag_id = $request->tag_id;
        $update->color_id = $request->color_id;
        $update->brand_id = $request->brand_id;
        $update->size_id = $request->size_id;
        $update->product_name = $request->product_name;
        $update->description = $request->description;
        $update->status = $request->status;
        $update->short_summary = $request->short_summary;
        $update->save();

        if($request->Updateimage){
            $exp = explode(';',$request->Updateimage);
            $exp1 = explode('/',$exp[0]);
            $fullname = time().'.'.$exp1[1];
            @unlink('upload/product/'.$update->image);
            Image::make($request->Updateimage)->resize(1100,800)->save('upload/product/'.$fullname);
            $update->image = $fullname;
            $update->save();
        }else{
            $update->image = $request->image;
            $update->save();
        }

        if($request->UpdateGallery){

            $del = ProductGallery::where('product_id',$request->id)->get();
            foreach($del as $key=>$de){
                @unlink('upload/product_gallery/'.$de->gallery);
                $de->delete();
            }

            foreach($request->UpdateGallery as $key=>$gall){
                $exp_gall = explode(';',$gall);
                $exp1_gall = explode('/',$exp_gall[0]);
                $fullname_gallery = $key.uniqid().time().'.'.$exp1_gall[1];
                Image::make($gall)->resize(100,100)->save('upload/product_gallery/'.$fullname_gallery);
                $gallery = new ProductGallery();
                $gallery->product_id =$request->id;
                $gallery->gallery = $fullname_gallery;
                $gallery->save();
            }

        }


    }
    public function Index(){

        $prdouct = ProductManage::with(['gallery','Category','Brand'])->get();
        return $prdouct;
    }
    public function Gallery($id){
        $gall = ProductGallery::where('product_id',$id)->get();

        return $gall;
    }
    public function MultiDelete(Request $request){

        $selec = ProductManage::whereIn('id',$request->data)->get();
        foreach($selec as $key=>$se){
            @unlink('upload/product/'.$se->image);
            $se->delete();

            $image = ProductGallery::whereIn('product_id',$request->data)->get();
            foreach($image as $key=>$img){
                @unlink('upload/product_gallery/'.$img->gallery);
                $img->delete();
            }
        }
    }

    public function MultiActive(Request $request){
        $selec = ProductManage::whereIn('id',$request->data)->get();
        foreach($selec as $key=>$se){
            $se->status = 1;
            $se->save();

            $image = ProductGallery::whereIn('product_id',$request->data)->get();
            foreach($image as $key=>$img){
                $img->status = 2;
                $img->save();
            }
        }
    }

    public function MultiDeActive(Request $request){

        $selec = ProductManage::whereIn('id',$request->data)->get();
        foreach($selec as $key=>$se){
            $se->status = 0;
            $se->save();

            $image = ProductGallery::whereIn('product_id',$request->data)->get();
            foreach($image as $key=>$img){
                $img->status = 1;
                $img->save();
            }
        }
    }
    public function Delete($id){

         $del = ProductManage::where('id',$id)->first();
         if($del){
             @unlink('upload/product/'.$del->image);
             ProductManage::where('id',$id)->delete();
         }

         $gall = ProductGallery::where('product_id',$id)->get();
         foreach($gall as $key=>$gal){
             @unlink('upload/product_gallery/'.$gal->gallery);
             $gal->delete();
         }
    }
    public function Edit($id){

        $all = ProductManage::where('id',$id)->first();

        return $all;
    }
}