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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('student_id');
            $table->enum('payment_option', ['Cash', 'Monthly']);
            $table->decimal('total_tuition_fee', 8, 2);
            $table->decimal('down_payment', 8, 2)->nullable();
            $table->decimal('cash_receive', 8, 2)->nullable();
            $table->decimal('payment_1st_month', 8, 2)->nullable();
            $table->decimal('payment_2nd_month', 8, 2)->nullable();
            $table->decimal('payment_3rd_month', 8, 2)->nullable();
            $table->decimal('payment_4th_month', 8, 2)->nullable();
            $table->decimal('payment_5th_month', 8, 2)->nullable();
            $table->decimal('payment_6th_month', 8, 2)->nullable();
            $table->decimal('payment_7th_month', 8, 2)->nullable();
            $table->decimal('payment_8th_month', 8, 2)->nullable();
            $table->decimal('payment_9th_month', 8, 2)->nullable();
            $table->decimal('payment_10th_month', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('child_id')->references('child_id')->on('children')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('student_basic_informations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
