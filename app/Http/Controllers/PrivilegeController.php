<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Privilege;

class PrivilegeController extends Controller
{

    public function index(Request $request)
    {
        $userIds = $request->user_ids; // Assuming user_ids are passed in the request

        // Fetch privileges for the given user IDs
        $privileges = Privilege::whereIn('user_id', $userIds)->get();

        // Group privileges by user_id for easier handling in JavaScript
        $groupedPrivileges = $privileges->groupBy('user_id');

        return response()->json(['privileges' => $groupedPrivileges]);
    }


    public function store(Request $request)
    {
        $privilege = Privilege::create($request->all());
        return response()->json($privilege, 201);
    }

    public function edit($id)
    {
        $privilege = Privilege::where('user_id', $id)->first();
        return view('users.user-privilege', ['privilege' => $privilege]);
    }

    public function update(Request $request, $userId)
    {
        $privilege = Privilege::where('user_id', $userId)->firstOrFail();

        $updatedPrivileges = [];

        $privilegeFields = [
            'view_reports', 'create_report', 'edit_report', 'delete_report',
            'view_lab_reports', 'create_lab_report', 'edit_lab_report', 'delete_lab_report',
            'view_patients', 'add_patient', 'edit_patient', 'delete_patient',
            'view_patient_records', 'add_patient_record', 'edit_patient_record', 'delete_patient_record',
            'view_accounts', 'add_account', 'edit_account', 'delete_account',
            'view_consultations', 'add_consultation', 'edit_consultation', 'delete_consultation',
            'view_systems', 'add_system', 'edit_system', 'delete_system',
            'view_tests', 'add_test', 'edit_test', 'delete_test',
            'view_privileges', 'add_privilege', 'edit_privilege', 'delete_privilege',
        ];

        // Loop through each privilege field and cast checkbox input to boolean
        foreach ($privilegeFields as $field) {
            $updatedPrivileges[$field] = (bool) $request->input($field, false); // Default to false if not checked
        }

        // Update the privilege record with the boolean values
        $privilege->update($updatedPrivileges);


        return redirect()->back()->with('status', 'Privileges updated successfully.');
    }

    public function destroy($id)
    {
        Privilege::destroy($id);
        return response()->json(null, 204);
    }
}
