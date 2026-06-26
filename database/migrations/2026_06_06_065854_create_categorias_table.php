<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id('id_categoria'); // bigint(20) UNSIGNED
            $table->string('nombre', 100);
            $table->timestamps(); // created_at y updated_at asignables como nulos
            $table->tinyInteger('activo')->default(1)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};