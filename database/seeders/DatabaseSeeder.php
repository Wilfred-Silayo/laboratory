<?php

namespace Database\Seeders;

use App\Models\Privilege;
use App\Models\SystemSetting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Wilfred Silayo',
            'email' => 'wilfredsilayo99@gmail.com',
            'title' => 'Mr',
            'phone' => '0683415683',
        ]);

         // Create admin privileges
         Privilege::factory()->create([
            'user_id' => $user->id,
            'view_reports' => true,
            'create_report' => true,
            'edit_report' => true,
            'delete_report' => true,
            'view_lab_reports' => true,
            'create_lab_report' => true,
            'edit_lab_report' => true,
            'delete_lab_report' => true,
            'view_patients' => true,
            'add_patient' => true,
            'edit_patient' => true,
            'delete_patient' => true,
            'view_patient_records' => true,
            'add_patient_record' => true,
            'edit_patient_record' => true,
            'delete_patient_record' => true,
            'view_accounts' => true,
            'add_account' => true,
            'edit_account' => true,
            'delete_account' => true,
            'view_consultations' => true,
            'add_consultation' => true,
            'edit_consultation' => true,
            'delete_consultation' => true,
            'view_systems' => true,
            'add_system' => true,
            'edit_system' => true,
            'delete_system' => true,
            'view_tests' => true,
            'add_test' => true,
            'edit_test' => true,
            'delete_test' => true,
            'view_privileges' => true,
            'add_privilege' => true,
            'edit_privilege' => true,
            'delete_privilege' => true,
        ]);

        SystemSetting::factory(1)->create();
    }
}


       


