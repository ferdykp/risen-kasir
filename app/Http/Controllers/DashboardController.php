<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        /*$notes = Maintenance::where('status', 'belum selesai')->get();*/
        return view('dashboard.index');
    }
}
