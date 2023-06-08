<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SchoolYearController extends Controller
{
    public function store(Request $request){

        $validateData = $request->validate([
            'school_year' => 'required',
        ]);
        SchoolYear::insert([
            'school_year' => $request->school_year,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'School Year Created successfully');
    }
    public function show(SchoolYear $schoolYear)
    {
        $students = $schoolYear->studentBasicInformations;

        return view('schoolyeararchive', compact('schoolYear', 'students'));
    }
}
