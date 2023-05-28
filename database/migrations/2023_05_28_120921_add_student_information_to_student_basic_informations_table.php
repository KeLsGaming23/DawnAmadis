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
        Schema::table('student_basic_informations', function (Blueprint $table) {
            $table->string('old_student');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('place_of_birth');
            $table->enum('grade',[
                'Kinder', 'Prep', 'Grade 1',
                'Grade 2', 'Grade 3','Grade 4',
                'Grade 5', 'Grade 6', 'Grade 7',
                'Grade 8', 'Grade 9', 'Grade 10']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_basic_informations', function (Blueprint $table) {
            $table->dropColumn('old_student');
            $table->dropColumn('gender');
            $table->dropColumn('birth_date');
            $table->dropColumn('place_of_birth');
            $table->dropColumn('grade');
        });
    }
};
