<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\repositarys\SizeLogin;
use Illuminate\Http\Request;
use Image;
use Whoops\Run;

class SizeManageController extends Controller
{

    public $SizeLogin;
    public function __construct(SizeLogin $SizeLogin)
    {
        $this->SizeLogin = $SizeLogin;
    }

    public function SizeStore(Request $request)
    {

        $request->validate([
            'size' => 'required',
            'image' => 'required',
            'status' => 'required'
        ]);

        $this->SizeLogin->Store($request);
    }

    public function SizeAll()
    {

        $size = $this->SizeLogin->Index();

        //    return $size;
        return response()->json(['size' => $size]);
    }

    public function SizeDelete($id)
    {

        $this->SizeLogin->Delete($id);
    }

    public function SizeEdit($id){

       $edit=$this->SizeLogin->Edit($id);

       return response()->json(['edit'=>$edit]);
    }

    public function SizeUpdate(Request $request){

        $this->SizeLogin->Update($request);
    }

    public function SizeMultiDelete(Request $request){

    

        $this->SizeLogin->MultiDelete($request);
    }

    public function SizeMultiActive(Request $request){

        $this->SizeLogin->MultiActive($request);
    }

    public function SizeMultiDeActive(Request $request){

        $this->SizeLogin->MultiDeActive($request);
    }
}
