<?php

namespace App\interfaces;

use Illuminate\Http\Request;

interface ColorInterface
{
    function Store(Request $request);
    function All();
    function Edit($id);
    function Update(Request $request);
    function Delete($id);
    function MultiDelete(Request $request);
    function MultiActive(Request $request);
    function MultiDeactive(Request $request);
}
