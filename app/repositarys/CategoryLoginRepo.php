<?php

namespace App\repositarys;

use App\Category;
use App\interfaces\CategoryInterface;
use Illuminate\Http\Request;

class CategoryLoginRepo implements CategoryInterface
{

    public function Store(Request $request)
    {
        $store = new Category();
        $store->name = $request->name;
        $store->status = $request->status;
        $store->save();

        return $store;
    }

    public function Index()
    {
        $all = Category::get();
        return $all;
    }

    public function Deleted($id)
    {
        Category::where('id', $id)->delete();
    }

    public function Edit($id)
    {
        $edit = Category::where('id', $id)->first();

        return $edit;
    }

    public function Update(Request $request)
    {
        $update = Category::where('id', $request->id)->first();
        $update->name = $request->name;
        $update->status = $request->status;
        $update->save();
    }

    public function MultiDeleted(Request $request)
    {

        foreach ($request->data as $key => $id) {
            Category::where('id', $id)->delete();
        }
    }

    public function MultiActive(Request $request)
    {
        foreach ($request->data as $key => $mul) {

            $update = Category::where('id', $mul)->first();
            $update->status = 1;
            $update->save();
        }
    }

    public function MultiDeactive(Request $request)
    {
        foreach ($request->data as $key => $mul) {

            $update = Category::where('id', $mul)->first();
            $update->status = 0;
            $update->save();
        }
    }
}
