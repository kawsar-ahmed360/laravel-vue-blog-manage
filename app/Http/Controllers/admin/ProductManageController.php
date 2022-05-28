<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\repositarys\ProductLogin;
use Illuminate\Http\Request;
use Whoops\Run;

class ProductManageController extends Controller
{
    public $ProductLogin;
     function __construct(ProductLogin $ProductLogin)
    {
        $this->ProductLogin = $ProductLogin;   
    }

    public function ProductAllData(){

       $category =  $this->ProductLogin->AllCategory();
       $color =  $this->ProductLogin->AllColor();
       $tag =  $this->ProductLogin->AllTag();
       $size =  $this->ProductLogin->AllSize();
       $brand =  $this->ProductLogin->AllBrand();

       return response()->json(['category'=>$category,'color'=>$color,'tag'=>$tag,'size'=>$size,'brand'=>$brand]);
    }

    public function ProductStore(Request $request){

        $this->ProductLogin->Store($request);

        return response()->json();
    }

    public function ProductAll(){

        $all_item = $this->ProductLogin->Index();
        return response()->json(['product'=>$all_item]);
    }

    public function ProductDelete($id){

        $this->ProductLogin->Delete($id);

        return response()->json('ok');
    }

    public function ProductEdit($id){

        $edit = $this->ProductLogin->Edit($id);
        $gall = $this->ProductLogin->Gallery($id);
        return response()->json(['edit'=>$edit,'gall'=>$gall]);
    }

    public function ProductUpdate(Request $request){

        $this->ProductLogin->Update($request);
    }

    public function ProductMultiActive(Request $request){
           
        $this->ProductLogin->MultiActive($request);

    }

    public function ProductMultiDeActive(Request $request){
        $this->ProductLogin->MultiDeActive($request);
    }

    public function ProductMultiDelete(Request $request){

        $this->ProductLogin->MultiDelete($request);
    }
}
