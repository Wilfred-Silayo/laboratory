<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('view_reports')->default(false);
            $table->boolean('create_report')->default(false);
            $table->boolean('edit_report')->default(false);
            $table->boolean('delete_report')->default(false);
            $table->boolean('view_lab_reports')->default(false);
            $table->boolean('create_lab_report')->default(false);
            $table->boolean('edit_lab_report')->default(false);
            $table->boolean('delete_lab_report')->default(false);
            $table->boolean('view_patients')->default(false);
            $table->boolean('add_patient')->default(false);
            $table->boolean('edit_patient')->default(false);
            $table->boolean('delete_patient')->default(false);
            $table->boolean('view_patient_records')->default(false);
            $table->boolean('add_patient_record')->default(false);
            $table->boolean('edit_patient_record')->default(false);
            $table->boolean('delete_patient_record')->default(false);
            $table->boolean('view_accounts')->default(false);
            $table->boolean('add_account')->default(false);
            $table->boolean('edit_account')->default(false);
            $table->boolean('delete_account')->default(false);
            $table->boolean('view_consultations')->default(false);
            $table->boolean('add_consultation')->default(false);
            $table->boolean('edit_consultation')->default(false);
            $table->boolean('delete_consultation')->default(false);
            $table->boolean('view_systems')->default(false);
            $table->boolean('add_system')->default(false);
            $table->boolean('edit_system')->default(false);
            $table->boolean('delete_system')->default(false);
            $table->boolean('view_tests')->default(false);
            $table->boolean('add_test')->default(false);
            $table->boolean('edit_test')->default(false);
            $table->boolean('delete_test')->default(false);
            $table->boolean('view_privileges')->default(false);
            $table->boolean('add_privilege')->default(false);
            $table->boolean('edit_privilege')->default(false);
            $table->boolean('delete_privilege')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privileges');
    }
};
