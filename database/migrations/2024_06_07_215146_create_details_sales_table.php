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
        Schema::create('details_sales', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('products_id')->index('fk_details_sale_products1_idx');
            $table->string('price_unit', 45);
            $table->integer('amount');
            $table->string('discount', 45);
            $table->unsignedInteger('sales_id')->index('fk_details_sale_sales1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_sales');
    }
};
