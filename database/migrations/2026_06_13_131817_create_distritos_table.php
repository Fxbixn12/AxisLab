<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('distritos', function (Blueprint $table) {
            $table->id('id_distrito');
            $table->string('nombre', 100);
            $table->decimal('precio_envio', 10, 2);
            $table->string('zona_tipo', 50);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distritos');
    }
};
