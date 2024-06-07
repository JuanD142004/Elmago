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
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign(['routes_id'], 'fk_employees_routes1')->references(['id'])->on('routes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['users_id'], 'fk_employees_users1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('fk_employees_routes1');
            $table->dropForeign('fk_employees_users1');
        });
    }
};
