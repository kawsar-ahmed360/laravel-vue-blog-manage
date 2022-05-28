<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\repositarys\CategoryLoginRepo;
use Illuminate\Http\Request;
use Whoops\Run;

class CategoryManageController extends Controller
{
    private $categoryLoginRepo;
    public function __construct(CategoryLoginRepo $categoryLoginRepo)
    {
        $this->categoryLoginRepo = $categoryLoginRepo;
    }
    public function CategoryStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $this->categoryLoginRepo->Store($request);

        return response()->json(['success' => 'done']);
    }

    public function CategoryIndex()
    {

        $category = $this->categoryLoginRepo->Index();

        return response()->json(['cat' => $category]);
    }

    public function CategoryDelete($id)
    {
        $category = $this->categoryLoginRepo->Deleted($id);
    }

    public function CategoryEdit($id)
    {

        $edit = $this->categoryLoginRepo->Edit($id);
        return response()->json(['edit' => $edit]);
    }

    public function CategoryUpdate(Request $request)
    {

        $this->categoryLoginRepo->Update($request);
    }

    public function CategoryMultiDelete(Request $request)
    {


        $category = $this->categoryLoginRepo->MultiDeleted($request);
    }

    public function CategoryMultiActive(Request $request)
    {

        $this->categoryLoginRepo->MultiActive($request);
    }

    public function CategoryMultiDeactive(Request $request)
    {

        $this->categoryLoginRepo->MultiDeactive($request);
    }
}
