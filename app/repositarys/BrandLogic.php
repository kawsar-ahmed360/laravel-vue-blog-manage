<?php

namespace App\repositarys;

use App\BrandManage;
use App\interfaces\BrandInterface;
use Illuminate\Http\Request;
use Image;

class BrandLogic implements BrandInterface
{

    public function Store(Request $request)
    {

        $store = new BrandManage();
        if ($request->image) {
            $pos = strpos($request->image, ';');
            $sub = substr($request->image, 0, $pos);
            $exp = explode('/', $sub)[1];
            $fullname = time() . '.' . $exp;
            Image::make($request->image)->resize(100, 100)->save('upload/brand/' . $fullname);
            $store->image = $fullname;
            $store->save();
        }
        $store->name = $request->name;
        $store->status = $request->status;
        $store->save();
    }

    public function AllBrand()
    {
        $brand = BrandManage::get();
        return $brand;
    }

    public function BrandDelete($id)
    {
        $br = BrandManage::where('id', $id)->first();
        if ($br) {
            @unlink('upload/brand/' . $br->image);
            BrandManage::where('id', $id)->delete();
        }
    }

    public function BrandEdit($id)
    {
        $brand = BrandManage::where('id', $id)->first();
        return $brand;
    }

    public function Update(Request $request)
    {
        $update = BrandManage::where('id', $request->id)->first();

        if ($request->Newimage) {
            $pos = strpos($request->Newimage, ';');
            $str = substr($request->Newimage, 0, $pos);
            $exp = explode('/', $str)[1];
            $fullname = time() . '.' . $exp;
            @unlink('upload/brand/' . $update->image);
            Image::make($request->Newimage)->resize(100, 100)->save('upload/brand/' . $fullname);
            $update->image = $fullname;
            $update->save();
        } else {
            $update->image = $request->image;
        }

        $update->name = $request->name;
        $update->status = $request->status;
        $update->save();
    }

    public function MultiDelete($request)
    {

        foreach ($request->data as $key => $br) {
            $brand = BrandManage::where('id', $br)->first();
            @unlink('upload/brand/' . $brand->image);
            BrandManage::where('id', $br)->delete();
        }
    }
}
