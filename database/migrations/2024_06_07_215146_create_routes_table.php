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
        Schema::create('routes', function (Blueprint $table) {
            $table->integer('id', true)->unique('id_unique');
            $table->string('route_name', 45);
            $table->integer('departament_id')->index('fk_routes_departament1_idx');
            $table->text('municipalities');
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
        Schema::dropIfExists('routes');
    }
};
