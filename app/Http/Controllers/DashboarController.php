<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboarController extends Controller
{
    //

    public function dashboardView()
    {
        return view('pages.dashboard');
    }
}
