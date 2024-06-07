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
        Schema::create('loads', function (Blueprint $table) {
            $table->integer('id', true)->unique('id_unique');
            $table->date('date');
            $table->integer('routes_id')->index('fk_load_routes1_idx');
            $table->integer('truck_types_id')->index('fk_load_truck_types1_idx');
            $table->timestamps();
            $table->tinyInteger('enabled')->nullable();
            $table->timestamp('disabled_at')->nullable();

            // $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loads');
    }
};
