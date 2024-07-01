<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiseasesTestController;
use App\Http\Controllers\LabReportController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientRecordController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Dashboard route
 */
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth.verified']);

/**
 * Profile routes
 */
Route::middleware(['auth.verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Users
     */
    Route::get('/users', [UserController::class, 'getData'])->name('users.data')->middleware('check.privilege:view_systems');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('check.privilege:add_system');
    Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('check.privilege:add_system');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('check.privilege:view_systems');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('check.privilege:edit_system');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('check.privilege:edit_system');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('check.privilege:delete_system');

    /**
     * Reports
     */
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index')->middleware('check.privilege:view_reports');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create')->middleware('check.privilege:create_report');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store')->middleware('check.privilege:create_report');
    Route::get('/reports/{month}', [ReportController::class, 'show'])->name('reports.show')->middleware('check.privilege:view_reports');
    Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit')->middleware('check.privilege:edit_report');
    Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update')->middleware('check.privilege:edit_report');
    Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy')->middleware('check.privilege:delete_report');

    /**
     * Lab Reports
     */
    Route::get('/labreports', [LabReportController::class, 'index'])->name('labreports.index')->middleware('check.privilege:view_lab_reports');
    Route::get('/labreports/create', [LabReportController::class, 'create'])->name('labreports.create')->middleware('check.privilege:create_lab_report');
    Route::post('/labreports', [LabReportController::class, 'store'])->name('labreports.store')->middleware('check.privilege:create_lab_report');
    Route::get('/labreports/{labreport}', [LabReportController::class, 'show'])->name('labreports.show')->middleware('check.privilege:view_lab_report');
    Route::get('/labreports/{labreport}/edit', [LabReportController::class, 'edit'])->name('labreports.edit')->middleware('check.privilege:edit_lab_report');
    Route::put('/labreports/{labreport}', [LabReportController::class, 'update'])->name('labreports.update')->middleware('check.privilege:edit_lab_report');
    Route::delete('/labreports/{labreport}', [LabReportController::class, 'destroy'])->name('labreports.destroy')->middleware('check.privilege:delete_lab_report');

    /**
     * Patients
     */
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index')->middleware('check.privilege:view_patients');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create')->middleware('check.privilege:add_patient');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store')->middleware('check.privilege:add_patient');
    Route::post('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show')->middleware('check.privilege:view_patients');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit')->middleware('check.privilege:edit_patient');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update')->middleware('check.privilege:edit_patient');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy')->middleware('check.privilege:delete_patient');

    /**
     * Patient Records
     */
    Route::get('/patientsrecords', [PatientRecordController::class, 'index'])->name('patientsrecords.index')->middleware('check.privilege:view_patient_records');
    Route::get('/patientsrecords/create', [PatientRecordController::class, 'create'])->name('patientsrecords.create')->middleware('check.privilege:add_patient_record');
    Route::post('/patientsrecords', [PatientRecordController::class, 'store'])->name('patientsrecords.store')->middleware('check.privilege:add_patient_record');
    Route::get('/patientsrecords/{patientsrecord}', [PatientRecordController::class, 'show'])->name('patientsrecords.show')->middleware('check.privilege:view_patient_records');
    Route::get('/patientsrecords/{patientsrecord}/edit', [PatientRecordController::class, 'edit'])->name('patientsrecords.edit')->middleware('check.privilege:edit_patient_record');
    Route::put('/patientsrecords/{patientsrecord}', [PatientRecordController::class, 'update'])->name('patientsrecords.update')->middleware('check.privilege:edit_patient_record');
    Route::delete('/patientsrecords/{patientsrecord}', [PatientRecordController::class, 'destroy'])->name('patientsrecords.destroy')->middleware('check.privilege:delete_patient_record');

    /**
     * Accounts
     */
    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index')->middleware('check.privilege:view_accounts');
    Route::get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create')->middleware('check.privilege:add_account');
    Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store')->middleware('check.privilege:add_account');
    Route::get('/accounts/{account}', [AccountController::class, 'show'])->name('accounts.show')->middleware('check.privilege:view_accounts');
    Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit')->middleware('check.privilege:edit_account');
    Route::put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update')->middleware('check.privilege:edit_account');
    Route::delete('/accounts/{account}', [AccountController::class, 'destroy'])->name('accounts.destroy')->middleware('check.privilege:delete_account');

    /**
     * Consultations
     */
    Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultations.index')->middleware('check.privilege:view_consultations');
    Route::get('/consultations/create', [ConsultationController::class, 'create'])->name('consultations.create')->middleware('check.privilege:add_consultation');
    Route::post('/consultations', [ConsultationController::class, 'store'])->name('consultations.store')->middleware('check.privilege:add_consultation');
    Route::get('/consultations/{consultation}', [ConsultationController::class, 'show'])->name('consultations.show')->middleware('check.privilege:view_consultations');
    Route::get('/consultations/{consultation}/edit', [ConsultationController::class, 'edit'])->name('consultations.edit')->middleware('check.privilege:edit_consultation');
    Route::put('/consultations/{consultation}', [ConsultationController::class, 'update'])->name('consultations.update')->middleware('check.privilege:edit_consultation');
    Route::delete('/consultations/{consultation}', [ConsultationController::class, 'destroy'])->name('consultations.destroy')->middleware('check.privilege:delete_consultation');

    Route::post('/consultations/{consultation}/save-result', [ConsultationController::class, 'saveResult'])
    ->name('consultations.saveResult');

    Route::get('/patients/consultations/{patient}', [ConsultationController::class, 'history'])->name('patients.consultations.history')->middleware('check.privilege:view_consultations');
    
    Route::get('/consultations/{consultation}/print', [ConsultationController::class, 'print'])->name('consultations.print')->middleware('check.privilege:view_consultations');

    Route::post('/orders/create', [OrderController::class, 'create'])->name('orders.create')->middleware('check.privilege:add_consultation');

    /**
     * System
     */
    Route::get('/system', [SystemController::class, 'index'])->name('system.index')->middleware('check.privilege:view_systems');
    Route::get('/system/create', [SystemController::class, 'create'])->name('system.create')->middleware('check.privilege:add_system');
    Route::post('/system', [SystemController::class, 'store'])->name('system.store')->middleware('check.privilege:add_system');
    //Route::get('/system/{system}', [SystemController::class, 'show'])->name('system.show')->middleware('check.privilege:view_systems');
    Route::get('/system/{system}/edit', [SystemController::class, 'edit'])->name('system.edit')->middleware('check.privilege:edit_system');
    Route::put('/system/{system}', [SystemController::class, 'update'])->name('system.update')->middleware('check.privilege:edit_system');
    Route::delete('/system/{system}', [SystemController::class, 'destroy'])->name('system.destroy')->middleware('check.privilege:delete_system');

    /**
     * Privileges
     */
    Route::get('/privileges', [PrivilegeController::class, 'index'])->name('privileges.index')->middleware('check.privilege:view_privileges');
    Route::get('/privileges/create', [PrivilegeController::class, 'create'])->name('privileges.create')->middleware('check.privilege:add_privilege');
    Route::post('/privileges', [PrivilegeController::class, 'store'])->name('privileges.store')->middleware('check.privilege:add_privilege');
    Route::get('/privileges/{privilege}', [PrivilegeController::class, 'show'])->name('privileges.show')->middleware('check.privilege:view_privileges');
    Route::get('/privileges/{privilege}/edit', [PrivilegeController::class, 'edit'])->name('privileges.edit')->middleware('check.privilege:edit_privilege');
    Route::put('/privileges/{privilege}', [PrivilegeController::class, 'update'])->name('privileges.update')->middleware('check.privilege:edit_privilege');
    Route::delete('/privileges/{privilege}', [PrivilegeController::class, 'destroy'])->name('privileges.destroy')->middleware('check.privilege:delete_privilege');

    /**
     * Test Prices
     */

    Route::get('/tests', [DiseasesTestController::class, 'index'])->name('tests.index')->middleware('check.privilege:view_tests');
    Route::get('/tests/create', [DiseasesTestController::class, 'create'])->name('tests.create')->middleware('check.privilege:add_test');
    Route::post('/tests', [DiseasesTestController::class, 'store'])->name('tests.store')->middleware('check.privilege:add_test');
    Route::get('/tests/{test}', [DiseasesTestController::class, 'show'])->name('tests.show')->middleware('check.privilege:view_tests');
    Route::get('/tests/{test}/edit', [DiseasesTestController::class, 'edit'])->name('tests.edit')->middleware('check.privilege:edit_test');
    Route::put('/tests/{test}', [DiseasesTestController::class, 'update'])->name('tests.update')->middleware('check.privilege:edit_test');
    Route::delete('/tests/{test}', [DiseasesTestController::class, 'destroy'])->name('tests.destroy')->middleware('check.privilege:delete_test');
});

require __DIR__ . '/auth.php';
