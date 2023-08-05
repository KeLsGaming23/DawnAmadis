<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class ParentController extends Controller
{
    public function store(Request $request)
    {
        $randomToken = Str::random(6);
        // Check if the generated token already exists, and regenerate if necessary
        while (User::where('random_token', $randomToken)->exists()) {
            $randomToken = Str::random(6);
        }
        
        // Create a new parent record
        $parent = Parents::create([
            'fathers_name' => $request->input('fathers_name'),
            'fathers_occupation' => $request->input('fathers_occupation'),
            'mothers_name' => $request->input('mothers_name'),
            'mothers_occupation' => $request->input('mothers_occupation'),
            'guardian_name' => $request->input('guardian_name'),
            'guardian_contact_no' => $request->input('guardian_contact_no'),
            'address' => $request->input('address'),
            'contact_no' => $request->input('contact_no'),
        ]);
        $user = User::create([
            'name' => $request->input('fathers_name') . ' And ' . $request->input('mothers_name'),
            'role' => 'Parent',
            'random_token' => $randomToken,
            'created_at' => Carbon::now()
        ]);
        // Retrieve the child data from the request
        $childData = $request->input('checkbox');

        // Loop through the child data and create child records
        foreach ($childData as $studentId) {
            // Create a new child record
            $child = Child::create([
                'parent_id' => $parent->id,
                'student_id' => $studentId,
            ]);
            Payment::create([
                'child_id' => $child->child_id,
                'parent_id' => $parent->id,
                'student_id' => $studentId,
            ]);
        }

        // Redirect or perform any additional actions after saving the data

        return redirect()->back()->with('success', 'User created successfully.');
    }

}
