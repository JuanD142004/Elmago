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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('users_id')->index('fk_employees_users1_idx');
            $table->string('name', 45);
            $table->string('surname', 45);
            $table->integer('document_number');
            $table->string('gender', 45);
            $table->string('civil_status', 45);
            $table->string('eps', 45);
            $table->string('phone', 45);
            $table->string('children', 45);
            $table->string('home', 45);
            $table->integer('routes_id')->index('fk_employees_routes1_idx');
            $table->timestamps();
            $table->tinyInteger('enabled')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
