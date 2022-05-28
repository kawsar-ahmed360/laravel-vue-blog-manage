<?php

namespace App\repositarys;

use App\ColorManage;
use App\interfaces\ColorInterface;
use Illuminate\Http\Request;
use Image;

class ColorLogin implements ColorInterface
{

    function Store(Request $request)
    {

        $store = new ColorManage();
        if ($request->image) {
            $str_pos = strpos($request->image, ';');
            $substr = substr($request->image, 0, $str_pos);
            $exp = explode('/', $substr)[1];
            $fullname = time() . '.' . $exp;
            Image::make($request->image)->resize(100, 100)->save('upload/color/' . $fullname);
            $store->image = $fullname;
            $store->save();
        }
        $store->color_name = $request->color_name;
        $store->status = $request->status;
        $store->save();
    }
    function All()
    {
        $color = ColorManage::get();

        return $color;
    }
    function Edit($id)
    {
        $edit = ColorManage::where('id', $id)->first();
        return $edit;
    }
    function Update(Request $request)
    {
        $update = ColorManage::where('id', $request->id)->first();
        $update->color_name = $request->color_name;
        $update->status = $request->status;
        $update->save();



        if ($request->Updateimage) {

            $strpos = strpos($request->Updateimage, ';');
            $substr = substr($request->Updateimage, 0, $strpos);
            $exp = explode('/', $substr)[1];
            $fullname = time() . '.' . $exp;
            @unlink('upload/color/' . $update->image);
            Image::make($request->Updateimage)->resize(100, 100)->save('upload/color/' . $fullname);
            $update->image = $fullname;
            $update->save();
        } else {
            $update->image = $request->image;
            $update->save();
        }
    }
    function Delete($id)
    {
        $dele = ColorManage::where('id', $id)->first();
        if ($dele) {
            @unlink('upload/color/' . $dele->image);
            ColorManage::where('id', $id)->delete();
        }

        return $dele;
    }
    function MultiDelete(Request $request)
    {

        $color = ColorManage::whereIn('id', $request->data)->get();

        foreach ($color as $key => $col) {
            @unlink('upload/color/' . $col->image);
            $col->delete();
        }

        return $color;
    }
    function MultiActive(Request $request)
    {

        $color = ColorManage::whereIn('id', $request->data)->get();

        foreach ($color as $key => $colo) {
            $colo->status = 1;
            $colo->save();
        }

        return $color;
    }
    function MultiDeactive(Request $request)
    {

        $color = ColorManage::whereIn('id', $request->data)->get();

        foreach ($color as $key => $colo) {
            $colo->status = 0;
            $colo->save();
        }

        return $color;
    }
}
