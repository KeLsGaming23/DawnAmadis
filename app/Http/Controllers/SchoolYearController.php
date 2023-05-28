<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    public function store(Request $request){
        $validateData = $request->validate([
            'school_year' => 'require|string',
        ]);
        $schoolYear = SchoolYear::create([
            'school_year' => $request->input('school_year'),
        ]);

        return response()->json(['message' => 'School year created successfully'], 201);
    }
}
