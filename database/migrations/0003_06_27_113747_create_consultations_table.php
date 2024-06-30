<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->constrained()->onDelete('cascade');;
            $table->date('visit_date')->default(DB::raw('CURRENT_DATE'));
            $table->text('clinical_comment')->nullable();
            $table->text('lab_comment')->nullable();
            $table->text('result_comment')->nullable();
            $table->text('symptoms')->nullable();
            $table->boolean('order_status')->default(false);
            $table->boolean('completed')->default(false);
            $table->boolean('lab_status')->default(false);
            $table->boolean('account_status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
