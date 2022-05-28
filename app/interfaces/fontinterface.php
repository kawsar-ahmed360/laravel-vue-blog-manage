<?php
namespace App\interfaces;

use Illuminate\Http\Request;

interface fontinterface
{
   public function ActiveCategory();
   public function ActiveBrand();
   public function MainSearch(Request $request);
   public function AllPost();
   public function SinglePost($id);
   public function multigallery($id);
   public function CategoryWisePost($id);
   public function BrandWisePost($id);
}