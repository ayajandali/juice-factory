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
    Schema::create('export_invoice_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('export_invoice_id')->constrained('export_invoice')->onDelete('cascade');
        $table->foreignId('available_product_id')->constrained('available_products')->onDelete('cascade');
        $table->integer('quantity');
        $table->decimal('price', 10, 2); // سعر المنتج لحظة البيع
        $table->decimal('subtotal', 10, 2); // الكمية × السعر
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_invoice_items');
    }
};
