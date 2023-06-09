<?php

namespace App\Http\Controllers;

use App\Models\StudentBasicInformation;
use Illuminate\Http\Request;

class StudentDetailsController extends Controller
{
    public function show($id){
        $student = StudentBasicInformation::with('parent')->findOrFail($id);
        return view('studentInformation', compact('student'));
    }
}
