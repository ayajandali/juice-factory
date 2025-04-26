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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->enum('role', ['HR', 'Manager', 'Employee', 'Accountant' , 'super-employee'])->default('Employee');
            $table->string('phone');
            $table->string('address', 200);
            $table->float('salary');
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->timestamps();

            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
