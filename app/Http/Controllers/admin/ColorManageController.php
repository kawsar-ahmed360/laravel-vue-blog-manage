<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositarys\ColorLogin;
use Illuminate\Http\Request;

class ColorManageController extends Controller
{
    public $ColorLogin;
    function __construct(ColorLogin $ColorLogin)
    {
        $this->ColorLogin = $ColorLogin;
    }

    public function ColorStore(Request $request){

        $request->validate([
            'color_name'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]);
        $this->ColorLogin->Store($request);
    }

    public function ColorUpdate(Request $request){


        $this->ColorLogin->Update($request);
    }

    public function ColorAll(){
        $color = $this->ColorLogin->All();

        return response()->json(['color'=>$color]);
    }

    public function ColorEdit($id){

        $edit = $this->ColorLogin->Edit($id);
        return response()->json(['color'=>$edit]);
    }   
    
    public function ColorDelete($id){

        $this->ColorLogin->Delete($id);
    }

    public function ColorMultiDelete(Request $request){
        $this->ColorLogin->MultiDelete($request);
    }

    public function ColorMultiActive(Request $request){
        $this->ColorLogin->MultiActive($request);
    }

    public function ColorMultiDeActive(Request $request){
        $this->ColorLogin->MultiDeactive($request);
    }
}
