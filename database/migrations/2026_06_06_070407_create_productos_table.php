<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto'); // bigint(20) UNSIGNED
            $table->unsignedBigInteger('id_categoria');
            $table->string('nombre', 100);
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->string('imagen', 255);
            $table->text('descripcion');
            $table->string('material', 50)->nullable();
            $table->string('colores', 50)->nullable();
            $table->string('medida', 50)->nullable();
            $table->string('peso', 30)->nullable();
            $table->string('acabado', 50)->nullable();
            $table->string('resistencia', 50)->nullable();
            $table->text('usos_posibles')->nullable();
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};