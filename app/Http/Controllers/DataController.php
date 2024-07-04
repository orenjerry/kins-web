<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function view()
    {
        // Define the $page variable
        $page = (object)[
            'language' => 'en',
            'description' => 'This is the dashboard page description',
            'title' => 'Dashboard',
            'getUrl' => url('/admin/dashboard'),
        ];

        // Pass the $page variable to the view
        return view('dashboard', compact('page'));
    }
}
