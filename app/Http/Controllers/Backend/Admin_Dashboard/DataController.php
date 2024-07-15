<?php

namespace App\Http\Controllers\Backend\Admin_Dashboard;

use App\Http\Controllers\Controller;
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
        return view('content.admin_dashboard.index', compact('page'));
    }

    public function retrieve(Request $request)
    {

    }
}
