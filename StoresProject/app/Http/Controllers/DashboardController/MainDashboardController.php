<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainDashboardController extends Controller
{
    public function index()
    {
        return view('DashboardViews.MainDashboardViews.index');
    }
}
