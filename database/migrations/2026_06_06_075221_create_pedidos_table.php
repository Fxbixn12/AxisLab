<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id_pedido'); // bigint(20) UNSIGNED AUTO_INCREMENT
            $table->string('codigo', 20)->nullable(); // varchar(20) Sí Nulo
            $table->unsignedBigInteger('id_usuario'); // bigint(20) UNSIGNED
            $table->decimal('monto_total', 10, 2); // decimal(10,2)
            $table->integer('estado_pedido'); // int(11)
            $table->string('nombre', 255); // varchar(255)
            $table->unsignedBigInteger('id_distrito'); // bigint(20) UNSIGNED
            $table->string('direccion', 255); // varchar(255)
            $table->string('correo', 255); // varchar(255)
            $table->string('telefono', 255); // varchar(255)
            $table->timestamps(); // created_at y updated_at (timestamps Sí Nulos)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};