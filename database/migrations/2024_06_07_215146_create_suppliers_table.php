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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->integer('id', true)->unique('id_unique');
            $table->string('nit', 45)->unique('nit_unique');
            $table->string('supplier_name', 45);
            $table->bigInteger('cell_phone')->unique('cell_phone_unique');
            $table->string('mail', 45)->nullable()->unique('mail_unique');
            $table->string('address', 45)->nullable();
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
        Schema::dropIfExists('suppliers');
    }
};
