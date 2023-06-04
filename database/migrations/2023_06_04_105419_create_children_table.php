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
        Schema::create('children', function (Blueprint $table) {
            $table->id('child_id');
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('parent_id')->references('parent_id')->on('parent_information')->onDelete('cascade');
            $table->foreign('student_id')->references('student_id')->on('student_basic_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
