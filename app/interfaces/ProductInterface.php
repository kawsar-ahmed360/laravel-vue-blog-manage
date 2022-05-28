<?php
namespace App\interfaces;
use Illuminate\Http\Request;

interface ProductInterface{

    public function Store(Request $request);
    public function Update(Request $request);
    public function AllCategory();
    public function AllColor();
    public function AllTag();
    public function AllSize();
    public function AllBrand();
    public function Index();
    public function Gallery($id);
    public function MultiDelete(Request $request);
    public function MultiActive(Request $request);
    public function MultiDeActive(Request $request);
    public function Delete($id);
    public function Edit($id);
}