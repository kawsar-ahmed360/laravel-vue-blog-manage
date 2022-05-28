<?php

namespace App\Http\Controllers;

use App\Category;
use App\ProductManage;
use App\repositarys\FontLogic;
use Illuminate\Http\Request;
use Whoops\Run;

class FontendController extends Controller
{

    public $FontLogic;
    function __construct(FontLogic $FontLogic)
    {
        $this->FontLogic = $FontLogic;
    }

    public function ShowACtiveCategory()
    {

        $cate = $this->FontLogic->ActiveCategory();
        return response()->json(['cat' => $cate]);
    }

    public function ShowACtiveBrand()
    {

        $cate = $this->FontLogic->ActiveBrand();
        return response()->json(['cat' => $cate]);
    }


    public function ShowAllPostClientSite()
    {
        // $post = ProductManage::with([''])
        $post =  $this->FontLogic->AllPost();

        return response()->json(['post' => $post]);
    }

    public function SinglePost($id)
    {
        $single = $this->FontLogic->SinglePost($id);
        $gallery = $this->FontLogic->multigallery($id);

        return response()->json(['single' => $single, 'gallery' => $gallery]);
    }

    public function CategoryWisePostView($id)
    {

        $post =  $this->FontLogic->CategoryWisePost($id);

        return response()->json(['post' => $post]);
    }  
    
    public function BrandWisePostView($id)
    {

        $post =  $this->FontLogic->BrandWisePost($id);

        return response()->json(['post' => $post]);
    }

    public function SearchMain(Request $request)
    {


        $search = $this->FontLogic->MainSearch($request);

        return response()->json(['sear' => $search]);
    }
}
