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
        Schema::create('purchases', function (Blueprint $table) {
            $table->integer('id', true)->unique('id_unique');
            $table->integer('suppliers_id')->index('fk_purchases_suppliers1_idx');
            $table->date('date');
            $table->string('total_value', 45);
            $table->string('num_bill', 45);
            $table->timestamps();
            $table->tinyInteger('enabled')->nullable();
            $table->tinyInteger('disable')->nullable();

            // $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
