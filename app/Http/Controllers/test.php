<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class test extends Controller
{
    public function test (Request $request)
    {
        $auth = session()->all();
        return response()->json($auth);
    }
}
