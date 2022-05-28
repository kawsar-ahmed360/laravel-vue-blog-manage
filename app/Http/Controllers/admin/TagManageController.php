<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositarys\TagLogic;
use App\TagGallery;
use Illuminate\Http\Request;
use Image;

class TagManageController extends Controller
{
    public $TagLogic;
    function __construct(TagLogic $TagLogic)
    {
        $this->TagLogic = $TagLogic;
    }

    public function TagStore(Request $request)
    {

     

        $request->validate([
            'tag_name' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);

        $this->TagLogic->Store($request);
    }

    public function TagAll()
    {

        $tag = $this->TagLogic->Index();

        return response()->json(['tag' => $tag]);
    }

    public function TagEdit($id)
    {

        $edit = $this->TagLogic->Edit($id);
        $gallery = $this->TagLogic->Gallery($id);
         

        return response()->json(['edit' => $edit,'gallery'=>$gallery]);
    }

    public function TagUpdate(Request $request)
    {

       
        $this->TagLogic->Update($request);
    }

    public function TagDelete($id)
    {

        $this->TagLogic->Delete($id);
    }

    public function TagMultiDelete(Request $request)
    {

        $this->TagLogic->MultiDelete($request);
    }

    public function TagMultiActive(Request $request)
    {

        $this->TagLogic->MultiActive($request);
    }

    public function TagMultiDeActive(Request $request)
    {

        $this->TagLogic->MultiDeActive($request);
    }
}
