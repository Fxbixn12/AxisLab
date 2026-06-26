<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['id_categoria' => 1, 'nombre' => 'Heroes', 'activo' => 1, 'created_at' => '2026-06-12 01:55:51', 'updated_at' => '2026-06-25 06:55:58'],
            ['id_categoria' => 2, 'nombre' => 'Animales', 'activo' => 1, 'created_at' => '2026-06-12 01:55:51', 'updated_at' => '2026-06-12 01:55:51'],
            ['id_categoria' => 3, 'nombre' => 'Decoracion', 'activo' => 1, 'created_at' => '2026-06-12 01:55:51', 'updated_at' => '2026-06-25 06:11:25'],
            ['id_categoria' => 4, 'nombre' => 'Videojuegos', 'activo' => 1, 'created_at' => '2026-06-12 01:55:51', 'updated_at' => '2026-06-12 01:55:51'],
            ['id_categoria' => 5, 'nombre' => 'Carros', 'activo' => 1, 'created_at' => '2026-06-12 01:55:51', 'updated_at' => '2026-06-12 01:55:51'],
        ]);
    }
}