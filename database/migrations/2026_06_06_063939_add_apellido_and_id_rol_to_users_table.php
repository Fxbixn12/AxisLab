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
        Schema::table('users', function (Blueprint $table) {
            // Quitamos la creación de apellido e id_rol porque ya existen en la migración principal.
            // Solo dejamos la relación de la llave foránea:
            $table->foreign('id_rol')->references('id_rol')->on('roles');      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_rol']);
            // Quitamos el dropColumn porque las columnas ahora pertenecen a la migración principal
        });
    }
};