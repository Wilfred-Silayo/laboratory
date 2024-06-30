<!-- resources/views/edit-privileges.blade.php -->
@extends('layouts.app')

@section('title', 'Users Privilege')

@section('content')
<div class="container-fluid">
    <div class="card col bg-white">
        <x-auth-session-status :status="session('status')" :type="session('type')" />

        <h5 class="mb-2">Edit User Privileges</h5>
        <p class="fw-bold text-primary pb-2 border-bottom"><span class="fw-bold">For: </span> {{ $privilege->user->name }} : {{ $privilege->user->email }}</p>
        <form method="POST" action="{{ route('privileges.update', $privilege->user->id) }}">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-12 col-sm-3 card ">
                    <p class="fw-bold">Reports</p>
                    <x-input-check name="view_reports" label="View Reports" :checked="$privilege->view_reports==1" />
                    <x-input-check name="create_report" label="Create Report" :checked="$privilege->create_report==1" />
                    <x-input-check name="edit_report" label="Edit Report" :checked="$privilege->edit_report==1" />
                    <x-input-check name="delete_report" label="Delete Report" :checked="$privilege->delete_report==1" />
                </div>
                <div class="col-12 col-sm-3 card ">
                    <p class="fw-bold">Laboratory</p>
                    <x-input-check name="view_lab_reports" label="View Lab Reports" :checked="$privilege->view_lab_reports==1" />
                    <x-input-check name="create_lab_report" label="Create Lab Report" :checked="$privilege->create_lab_report==1" />
                    <x-input-check name="edit_lab_report" label="Edit Lab Report" :checked="$privilege->edit_lab_report==1" />
                    <x-input-check name="delete_lab_report" label="Delete Lab Report" :checked="$privilege->delete_lab_report==1" />

                </div>
                <div class="col-12 col-sm-3 card">
                    <p class="fw-bold">Patients</p>
                    <x-input-check name="view_patients" label="View Patients" :checked="$privilege->view_patients==1" />
                    <x-input-check name="add_patient" label="Add Patient" :checked="$privilege->add_patient==1" />
                    <x-input-check name="edit_patient" label="Edit Patient" :checked="$privilege->edit_patient==1" />
                    <x-input-check name="delete_patient" label="Delete Patient" :checked="$privilege->delete_patient==1" />

                </div>
                <div class="col-12 col-sm-3 card">
                    <p class="fw-bold">Patients Records</p>
                    <x-input-check name="view_patient_records" label="View Patient Records" :checked="$privilege->view_patient_records==1" />
                    <x-input-check name="add_patient_record" label="Add Patient Record" :checked="$privilege->add_patient_record==1" />
                    <x-input-check name="edit_patient_record" label="Edit Patient Record" :checked="$privilege->edit_patient_record==1" />
                    <x-input-check name="delete_patient_record" label="Delete Patient Record" :checked="$privilege->delete_patient_record==1" />

                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12 col-sm-3 card">
                    <p class="fw-bold">Accounts</p>
                    <x-input-check name="view_accounts" label="View Accounts" :checked="$privilege->view_accounts==1" />
                    <x-input-check name="add_account" label="Add Account" :checked="$privilege->add_account==1" />
                    <x-input-check name="edit_account" label="Edit Account" :checked="$privilege->edit_account==1" />
                    <x-input-check name="delete_account" label="Delete Account" :checked="$privilege->delete_account==1" />
                </div>
                <div class="col-12 col-sm-3 card">
                    <p class="fw-bold">Consultations</p>
                    <x-input-check name="view_consultations" label="View Consultations" :checked="$privilege->view_consultations==1" />
                    <x-input-check name="add_consultation" label="Add Consultation" :checked="$privilege->add_consultation==1" />
                    <x-input-check name="edit_consultation" label="Edit Consultation" :checked="$privilege->edit_consultation==1" />
                    <x-input-check name="delete_consultation" label="Delete Consultation" :checked="$privilege->delete_consultation==1" />
                </div>
                <div class="col-12 col-sm-3 card">
                    <p class="fw-bold">System users</p>
                    <x-input-check name="view_systems" label="View Systems" :checked="$privilege->view_systems==1" />
                    <x-input-check name="add_system" label="Add System" :checked="$privilege->add_system==1" />
                    <x-input-check name="edit_system" label="Edit System" :checked="$privilege->edit_system==1" />
                    <x-input-check name="delete_system" label="Delete System" :checked="$privilege->delete_system==1" />
                </div>
                <div class="col-12 col-sm-3 card ">
                    <p class="fw-bold">Test and Prices</p>
                    <x-input-check name="view_tests" label="View Tests" :checked="$privilege->view_tests==1" />
                    <x-input-check name="add_test" label="Add Test" :checked="$privilege->add_test==1" />
                    <x-input-check name="edit_test" label="Edit Test" :checked="$privilege->edit_test==1" />
                    <x-input-check name="delete_test" label="Delete Test" :checked="$privilege->delete_test==1" />
                </div>
            </div>
            <div class=" mb-4">
                <div class="col-12 col-sm-3 card mb-1">
                    <p class="fw-bold">Privileges</p>
                    <x-input-check name="view_privileges" label="View Privileges" :checked="$privilege->view_privileges==1" />
                    <x-input-check name="add_privilege" label="Add Privilege" :checked="$privilege->add_privilege==1" />
                    <x-input-check name="edit_privilege" label="Edit Privilege" :checked="$privilege->edit_privilege==1" />
                    <x-input-check name="delete_privilege" label="Delete Privilege" :checked="$privilege->delete_privilege==1" />
                </div>

            </div>
            <button type="submit" class="btn btn-primary mb-2">Update</button>
        </form>
    </div>
</div>
@endsection