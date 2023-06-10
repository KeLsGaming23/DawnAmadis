<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('parentdboard', compact('user'));
    }
}
