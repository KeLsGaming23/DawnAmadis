<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StudentBasicInformation;
use Illuminate\Http\Request;

class StudentDetailsController extends Controller
{
    public function show($id){
        $student = StudentBasicInformation::with('child.parent')->findOrFail($id);
        $payment = Payment::all();
        return view('studentInformation', compact('student', 'payment'));
    }
}
