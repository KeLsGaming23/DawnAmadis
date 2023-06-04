<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Parents;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function store(Request $request)
    {
        // Create a new parent record
        $parent = new Parents;
        $parent->fathers_name = $request->input('fathers_name');
        $parent->fathers_occupation = $request->input('fathers_occupation');
        $parent->mothers_name = $request->input('mothers_name');
        $parent->mothers_occupation = $request->input('mothers_occupation');
        $parent->guardian_name = $request->input('guardian_name');
        $parent->guardian_contact_no = $request->input('guardian_contact_no');
        $parent->address = $request->input('address');
        $parent->contact_no = $request->input('contact_no');
        $parent->save();

        // Get the IDs of the children from the request
        $childIds = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'inputField') === 0) {
                $childIds[] = $value;
            }
        }

        // Create child-parent relationships
        foreach ($childIds as $childId) {
            $child = new Child;
            $child->parent_id = $parent->id;
            $child->student_id = $childId;
            $child->save();
        }

        // Redirect or return a response
        return redirect()->back()->with('success', 'Parent and children information successfully saved.');
    }
}
