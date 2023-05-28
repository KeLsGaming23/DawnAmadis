<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPortal;
use App\Models\StudentBasicInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
class UserPortalController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(15);
        return view('userstable', compact('users'));
    }
    public function selectRole(){
        $roleselects = User::all();
        return view('addusertable', compact('roleselects'));
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'role' => 'required',
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $firstName = $request->first_name;
        $lastName = $request->last_name;
        $name = $firstName . " " . $lastName;
        $randomToken = Str::random(6);

        // Check if the generated token already exists, and regenerate if necessary
        while (User::where('random_token', $randomToken)->exists()) {
            $randomToken = Str::random(6);
        }

        $user = User::create([
            'name' => $name,
            'role' => $request->role,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'random_token' => $randomToken,
            'created_at' => Carbon::now()
        ]);

        if ($request->role === 'Student') {
            $studentInfo = StudentBasicInformation::create([
                'users_id' => $user->id,
                'school_years_id' => '3', // You may need to update this value based on your requirements
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name
            ]);
        }

        return Redirect()->back()->with('success', 'User created successfully.');
    }
}
