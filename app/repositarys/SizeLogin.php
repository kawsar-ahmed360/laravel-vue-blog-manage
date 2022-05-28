<?php

namespace App\repositarys;

use App\BrandManage;
use App\interfaces\SizeInterface;
use App\SizeManage;
use Illuminate\Http\Request;
use Image;

class SizeLogin implements SizeInterface
{

    public function Store(Request $request)
    {

        $store = new SizeManage();
        $store->size = $request->size;
        $store->status = $request->status;
        $store->save();

        if ($request->image) {
            $post = strpos($request->image, ';');
            $subst = substr($request->image, 0, $post);
            $exp = explode('/', $subst)[1];
            $fullname = time() . '.' . $exp;
            Image::make($request->image)->resize(100, 100)->save('upload/size/' . $fullname);
            $store->image = $fullname;
            $store->save();
        }
    }
    public function Index()
    {

        $size = SizeManage::get();
        return $size;
    }

    public function Delete($id)
    {
        $ba = SizeManage::where('id', $id)->first();

        if ($ba) {
            @unlink('upload/size/' . $ba->image);
            SizeManage::where('id', $id)->delete();
        }
    }

    public function Edit($id)
    {
        $edit = SizeManage::where('id', $id)->first();
        return $edit;
    }

    public function Update(Request $request)
    {
        $update = SizeManage::where('id', $request->id)->first();
        $update->size = $request->size;
        $update->status = $request->status;
        $update->save();

        if ($request->newImage) {
            $pos = strpos($request->newImage, ';');
            $sub = substr($request->newImage, 0, $pos);
            $exp = explode('/', $sub)[1];
            $fullname = time() . '.' . $exp;
            Image::make($request->newImage)->resize(100, 100)->save('upload/size/' . $fullname);
            $update->image = $fullname;
            $update->save();
        } else {
            $update->image = $request->image;
            $update->save();
        }
    }

    public function MultiDelete(Request $request)
    {

        $all = SizeManage::whereIn('id', $request->data)->get();
        foreach ($all as $key => $idall) {

            @unlink('upload/size/' . $idall->image);
            $idall->delete();
        }

        return $all;
    }

    public function MultiActive(Request $request)
    {

        $active = SizeManage::whereIn('id', $request->data)->get();

        foreach ($active as $key => $acti) {
            $acti->status = 1;
            $acti->save();
        }

        return $active;
    }

    public function MultiDeActive(Request $request)
    {

        $deactive = SizeManage::whereIn('id', $request->data)->get();
        foreach ($deactive as $key => $dea) {
            $dea->status = 0;
            $dea->save();
        }

        return $deactive;
    }
}
