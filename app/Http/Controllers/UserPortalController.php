<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
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
        $schoolYears = SchoolYear::all();
        $studentInformation = StudentBasicInformation::all();
        return view('userstable', compact('users', 'schoolYears', 'studentInformation'));
    }
    public function selectRole(){
        $roleselects = User::all();
        $schoolYears = SchoolYear::all();
        return view('addusertable', compact('roleselects', 'schoolYears'));
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'role' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'old_student' => 'required',
            'profile_picture' => 'required',
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
            $profile_picture = $request->file('profile_picture');
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($profile_picture->getClientOriginalExtension());
            $image_name = $name_gen . "." . $img_ext;
            $up_location = 'public/image/student-profile/';
            $last_img = 'https://dawnamadis.com/' . $up_location . $image_name;
            $profile_picture->move($up_location, $image_name);
            $studentInfo = StudentBasicInformation::create([
                'users_id' => $user->id,
                'school_years_id' => $request->school_years_id, 
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'old_student' => $request->old_student,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'place_of_birth' => $request->place_of_birth,
                'grade' => $request->grade,
                'profile_picture' => $last_img,
            ]);
            
        }

        return Redirect()->back()->with('success', 'User created successfully.');
    }
    /**
     * Soft delete a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sDeletes($id){
        $user = User::findOrFail($id);
        $user->delete();

        return Redirect()->back()->with('success', 'Users deleted successfully.');
    }
    public function getUserDetails($userId)
    {
        $studentBasicInformation = StudentBasicInformation::findOrFail($userId);

        // Modify the student basic information data as per your requirements
        $userDetails = [
            'last_name' => $studentBasicInformation->last_name,
            'first_name' => $studentBasicInformation->first_name,
            'middle_name' => $studentBasicInformation->middle_name,
            'users_id' => $studentBasicInformation->users_id,
            'school_years_id' => $studentBasicInformation->school_years_id,
            'old_student' => $studentBasicInformation->old_student,
            'gender' => $studentBasicInformation->gender,
            'birth_date' => $studentBasicInformation->birth_date,
            'place_of_birth' => $studentBasicInformation->place_of_birth,
            'grade' => $studentBasicInformation->grade,
            'profile_picture' => $studentBasicInformation->profile_picture,
        ];

        return response()->json($userDetails);
    }
}
