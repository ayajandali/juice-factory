<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('import_invoice_items', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->after('unit');
            $table->decimal('subtotal', 10, 2)->after('price');
        });
    }

    public function down()
    {
        Schema::table('import_invoice_items', function (Blueprint $table) {
            $table->dropColumn(['price', 'subtotal']);
        });
    }
};
