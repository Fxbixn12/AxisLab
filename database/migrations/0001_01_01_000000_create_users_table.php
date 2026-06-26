<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // bigint(20) UNSIGNED id
            $table->string('name', 255);
            $table->string('apellido', 255);
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->string('tipo_documento', 255)->nullable();
            $table->string('numero_documento', 255)->nullable();
            $table->string('telefono', 255)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->unsignedBigInteger('id_rol')->default(2); 
            $table->rememberToken();
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};