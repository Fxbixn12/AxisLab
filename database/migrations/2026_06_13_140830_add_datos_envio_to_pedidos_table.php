<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('nombre')->after('estado_pedido');
            $table->unsignedBigInteger('id_distrito')->after('nombre');
            $table->string('direccion')->after('id_distrito');
            $table->string('correo')->after('direccion');
            $table->string('telefono')->after('correo');

            $table->foreign('id_distrito')
                  ->references('id_distrito')
                  ->on('distritos');
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['id_distrito']);

            $table->dropColumn([
                'nombre',
                'id_distrito',
                'direccion',
                'correo',
                'telefono'
            ]);
        });
    }
};