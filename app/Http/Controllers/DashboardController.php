<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    //
    public function __invoke()
    {
        return inertia()->render('Dashboard');
    }
}
