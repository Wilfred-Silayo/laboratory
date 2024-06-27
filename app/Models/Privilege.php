<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'view_reports',
        'create_report',
        'edit_report',
        'delete_report',
        'view_lab_reports',
        'create_lab_report',
        'edit_lab_report',
        'delete_lab_report',
        'view_patients',
        'add_patient',
        'edit_patient',
        'delete_patient',
        'view_patient_records',
        'add_patient_record',
        'edit_patient_record',
        'delete_patient_record',
        'view_accounts',
        'add_account',
        'edit_account',
        'delete_account',
        'view_consultations',
        'add_consultation',
        'edit_consultation',
        'delete_consultation',
        'view_systems',
        'add_system',
        'edit_system',
        'delete_system',
        'view_tests',
        'add_test',
        'edit_test',
        'delete_test',
        'view_privileges',
        'add_privilege',
        'edit_privilege',
        'delete_privilege',
    ];

    // Define relationships if necessary
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
