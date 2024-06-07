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
        Schema::create('municipalities', function (Blueprint $table) {
            $table->integer('id', true)->unique('id_unique');
            $table->string('name', 45);
            $table->timestamp('created_at')->nullable();
            $table->integer('departaments_id')->index('fk_municipalities_departaments1_idx');
            $table->timestamp('updated_at')->nullable();
            $table->tinyInteger('enabled')->nullable();

            // $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipalities');
    }
};
