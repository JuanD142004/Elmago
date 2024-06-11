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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', true)->unique('id_unique');
            $table->string('product_name', 45);
            $table->string('brand', 45);
            $table->string('price_unit', 45);
            $table->string('unit_of_measurement', 45);
            $table->integer('stock')->default(0); // Agregar valor predeterminado de 0            $table->integer('suppliers_id')->index('fk_products_suppliers1_idx');
            $table->string('created_at', 45)->nullable();
            $table->string('updated_at', 45)->nullable();
            $table->tinyInteger('enabled')->nullable();

            // $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
