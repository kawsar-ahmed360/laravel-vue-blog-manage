<?php
namespace App\interfaces;

use Illuminate\Http\Request;
use Whoops\Run;

interface CategoryInterface{

    public function Store(Request $request);
    public function Index();
    public function Deleted($id);
    public function MultiDeleted(Request $request);
    public function MultiActive(Request $request);
    public function MultiDeactive(Request $request);
    public function Edit($id);
    public function Update(Request $request);
}
