<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $parent = $user->parent()->with('children.payments.studentBasicInformation')->first();
        return view('parentdboard', compact('parent'));
    }
}
