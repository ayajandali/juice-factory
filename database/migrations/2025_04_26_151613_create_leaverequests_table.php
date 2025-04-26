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
        Schema::create('leaverequests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('leave_type', [
                'Sick leave', 
                'Maternity leave', 
                'Paternity leave', 
                'Emergency leave', 
                'Marriage leave'
            ])->notNullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('is_paid', ['paid', 'not_paid'])->default('paid');
            $table->enum('status', ['pending', 'accepted', 'refused'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaverequests');
    }
};
