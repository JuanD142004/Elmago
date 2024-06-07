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
        Schema::table('details_loads', function (Blueprint $table) {
            $table->foreign(['loads_id'], 'fk_details_loads_loads1')->references(['id'])->on('loads')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['products_id'], 'fk_details_loads_products1')->references(['id'])->on('products')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('details_loads', function (Blueprint $table) {
            $table->dropForeign('fk_details_loads_loads1');
            $table->dropForeign('fk_details_loads_products1');
        });
    }
};
