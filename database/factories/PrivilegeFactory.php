<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Privilege>
 */
class PrivilegeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'view_reports' => $this->faker->boolean,
            'create_report' => $this->faker->boolean,
            'edit_report' => $this->faker->boolean,
            'delete_report' => $this->faker->boolean,
            'view_lab_reports' => $this->faker->boolean,
            'create_lab_report' => $this->faker->boolean,
            'edit_lab_report' => $this->faker->boolean,
            'delete_lab_report' => $this->faker->boolean,
            'view_patients' => $this->faker->boolean,
            'add_patient' => $this->faker->boolean,
            'edit_patient' => $this->faker->boolean,
            'delete_patient' => $this->faker->boolean,
            'view_patient_records' => $this->faker->boolean,
            'add_patient_record' => $this->faker->boolean,
            'edit_patient_record' => $this->faker->boolean,
            'delete_patient_record' => $this->faker->boolean,
            'view_accounts' => $this->faker->boolean,
            'add_account' => $this->faker->boolean,
            'edit_account' => $this->faker->boolean,
            'delete_account' => $this->faker->boolean,
            'view_consultations' => $this->faker->boolean,
            'add_consultation' => $this->faker->boolean,
            'edit_consultation' => $this->faker->boolean,
            'delete_consultation' => $this->faker->boolean,
            'view_systems' => $this->faker->boolean,
            'add_system' => $this->faker->boolean,
            'edit_system' => $this->faker->boolean,
            'delete_system' => $this->faker->boolean,
            'view_tests' => $this->faker->boolean,
            'add_test' => $this->faker->boolean,
            'edit_test' => $this->faker->boolean,
            'delete_test' => $this->faker->boolean,
            'view_privileges' => $this->faker->boolean,
            'add_privilege' => $this->faker->boolean,
            'edit_privilege' => $this->faker->boolean,
            'delete_privilege' => $this->faker->boolean,
        ];

    }
}
