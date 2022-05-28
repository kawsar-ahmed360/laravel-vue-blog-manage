<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\repositarys\BrandLogic;
use Illuminate\Http\Request;
use Image;
use Whoops\Run;

class BrandManageController extends Controller
{

    public $brandLogic;
    public function __construct(BrandLogic $brandLogic)
    {
        $this->brandLogic = $brandLogic;
    }
    public function BrandStore(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'status' => 'required'
        ]);

        $this->brandLogic->Store($request);
    }

    public function BrandAll()
    {
        $brand =  $this->brandLogic->AllBrand();

        return response()->json(['brand' => $brand]);
    }

    public function BrandDelete($id)
    {

        $this->brandLogic->BrandDelete($id);
    }

    public function BrandEdit($EditId)
    {

        $edite = $this->brandLogic->BrandEdit($EditId);
        return response()->json(['edit' => $edite]);
    }

    public function BrandUpdate(Request $request)
    {


        $this->brandLogic->Update($request);
    }

    public function BrandMultiDelete(Request $request)
    {
        $this->brandLogic->MultiDelete($request);
    }
}
