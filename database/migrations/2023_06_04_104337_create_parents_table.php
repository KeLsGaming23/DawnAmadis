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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string("fathers_name")->nullable();
            $table->string("fathers_occupation")->nullable();
            $table->string("mothers_name")->nullable();
            $table->string("mothers_occupation")->nullable();
            $table->string("guardian_name")->nullable();
            $table->string("guardian_contact_no")->nullable();
            $table->string("address")->nullable();
            $table->string("contact_no")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
