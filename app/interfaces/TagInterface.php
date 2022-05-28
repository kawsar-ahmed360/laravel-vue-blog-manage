<?php
namespace App\interfaces;

use Illuminate\Http\Request;

interface TagInterface{

    public function Store(Request $request);
    public function Update(Request $request);
    public function Index();
    public function Gallery($id);
    public function MultiDelete(Request $request);
    public function MultiActive(Request $request);
    public function MultiDeActive(Request $request);
    public function Delete($id);
    public function Edit($id);

}