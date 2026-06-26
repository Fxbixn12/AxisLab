<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Reemplaza 'nombre_de_esta_tabla' por el nombre real de esta entidad en tu BD (ej. configuraciones o variables)
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->string('clave', 50)->primary(); // varchar(50) clave Primaria
            $table->decimal('valor', 10, 2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configuraciones');
    }
};