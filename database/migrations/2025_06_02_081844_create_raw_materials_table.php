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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); 
            $table->enum('size', ['small', 'medium', 'large'])->nullable(); // لحجم الزجاجة إذا النوع bottle
            $table->integer('quantity')->default(0);
            $table->enum('unit' , ['kg' , 'piece'])->default('kg');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
