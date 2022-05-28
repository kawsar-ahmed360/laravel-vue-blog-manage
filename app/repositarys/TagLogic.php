<?php

namespace App\repositarys;

use App\interfaces\TagInterface;
use App\TagGallery;
use App\TagManage;
use Illuminate\Http\Request;
use Image;

class TagLogic implements TagInterface
{

    public function Store(Request $request)
    {

        $store = new TagManage();
        if ($request->image) {
            $strpos = strpos($request->image, ';');
            $substr = substr($request->image, 0, $strpos);
            $exp = explode('/', $substr)[1];
            $fullname = time() . '.' . $exp;
            Image::make($request->image)->resize(100, 100)->save('upload/Tag/' . $fullname);
            $store->image = $fullname;
            $store->save();
        }
        $store->tag_name = $request->tag_name;
        $store->status = $request->status;
        $store->save();

        
        if($request->gallery){

       
            foreach($request->gallery as $key=>$gall){

                 $exp = explode(';',$gall);
                 $exp1 = explode('/',$exp[0]);
                 $fullnamerd = uniqid().$key.time().'.'.$exp1[1];
               
                 Image::make($gall)->resize(100,100)->save('upload/tag_gallery/'.$fullnamerd);
                $gal = new TagGallery();
                $gal->tag_id = $store->id;
                $gal->gallery = $fullnamerd;
                $gal->save();
            }

        }
    }

    public function Update(Request $request)
    {

        $update = TagManage::where('id', $request->id)->first();
        $update->tag_name = $request->tag_name;
        $update->status = $request->status;
        $update->save();

        if ($request->Updateimage) {
            $first_exp = explode(';', $request->Updateimage);
            $second_exp = explode('/', $first_exp[0]);
            $exp = $second_exp[1];
            $fullname = time() . '.' . $exp;
            Image::make($request->Updateimage)->resize(100, 100)->save('upload/Tag/' . $fullname);
            $update->image = $fullname;
            $update->save();
        } else {
            $update->image = $request->image;
            $update->save();
        }


        if($request->UpdateGallery){

            $all = TagGallery::where('tag_id',$request->id)->get();
            foreach($all as $key=>$allgallery){
                @unlink('upload/tag_gallery/'.$allgallery->gallery);
                $allgallery->delete();
            }

            
            foreach($request->UpdateGallery as $key=>$gall){

                $exp = explode(';',$gall);
                $exp1 = explode('/',$exp[0]);
                $fullnamerd = uniqid().$key.time().'.'.$exp1[1];
              
                Image::make($gall)->resize(100,100)->save('upload/tag_gallery/'.$fullnamerd);
               $gal = new TagGallery();
               $gal->tag_id =$request->id;
               $gal->gallery = $fullnamerd;
               $gal->save();
           }


        }


        return $update;
    }

    public function Index()
    {
        $tag = TagManage::with(['GalleryTag'])->get();
        return $tag;
    }  
    
 


    public function MultiDelete(Request $request)
    {

        $alltag = TagManage::whereIn('id', $request->data)->get();

        foreach ($alltag as $key => $all) {

            @unlink('upload/Tag/' . $all->image);

            $all->delete();
        }

        return $alltag;
    }
    public function MultiActive(Request $request)
    {
        $all = TagManage::whereIn('id', $request->data)->get();
        foreach ($all as $key => $a) {
            $a->status = 1;
            $a->save();
        }

        return $all;
    }
    public function MultiDeActive(Request $request)
    {

        $all = TagManage::whereIn('id', $request->data)->get();
        foreach ($all as $key => $al) {

            $al->status = 0;
            $al->save();
        }

        return $all;
    }
    public function Delete($id)
    {

        $first = TagManage::where('id', $id)->first();
        if ($first) {
            @unlink('upload/Tag/' . $first->image);
            TagManage::where('id', $id)->delete();
        }

        return $first;
    }
    public function Edit($id)
    {

        $edit = TagManage::where('id', $id)->first();
        return $edit;
   
    }

    public function Gallery($id){
        $gallery = TagGallery::where('tag_id', $id)->get();
        return $gallery;
    }
}
