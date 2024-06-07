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
        Schema::table('details_purchases', function (Blueprint $table) {
            $table->foreign(['products_id'], 'fk_details_purchases_products1')->references(['id'])->on('products')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['purchases_id'], 'fk_details_purchases_purchases1')->references(['id'])->on('purchases')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('details_purchases', function (Blueprint $table) {
            $table->dropForeign('fk_details_purchases_products1');
            $table->dropForeign('fk_details_purchases_purchases1');
        });
    }
};
