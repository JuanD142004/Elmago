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
        Schema::create('truck_types', function (Blueprint $table) {
            $table->integer('id', true)->unique('id_unique');
            $table->string('truck_brand', 45);
            $table->string('plate', 10);
            $table->string('ability', 45);
            $table->timestamps();
            $table->tinyInteger('enabled')->nullable();

            // $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truck_types');
    }
};
