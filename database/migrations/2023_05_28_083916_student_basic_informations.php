<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_basic_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('school_years_id');
            // Other columns for student basic information
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('school_years_id')->references('id')->on('school_years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_basic_information');
    }
};
