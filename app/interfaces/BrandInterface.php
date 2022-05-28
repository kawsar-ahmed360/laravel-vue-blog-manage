<?php
namespace App\interfaces;

use Illuminate\Http\Request;

interface BrandInterface{

    public function Store(Request $request);
    public function Update(Request $request);
    public function AllBrand();
    public function MultiDelete($request);
    public function BrandDelete($id);
    public function BrandEdit($id);
}
