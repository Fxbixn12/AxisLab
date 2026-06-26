<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'id_producto' => 1,
                'id_categoria' => 1,
                'nombre' => 'Modelo 1',
                'precio' => 20.00,
                'stock' => 6,
                'imagen' => 'https://images.cults3d.com/H1anxZP7uQpThmQVadnHAZL...',
                'descripcion' => 'Impresión de alta resolución en resina del hombre ...',
                'material' => null,
                'colores' => null,
                'medida' => null,
                'peso' => null,
                'acabado' => null,
                'resistencia' => null,
                'usos_posibles' => 'Colección',
                'activo' => 1,
                'created_at' => '2026-06-12 01:55:51',
                'updated_at' => '2026-06-25 06:56:53'
            ],
            [
                'id_producto' => 2,
                'id_categoria' => 2,
                'nombre' => 'Modelo 2',
                'precio' => 25.00,
                'stock' => 1,
                'imagen' => 'https://tiendakrear3d.com/wp-content/uploads/2024/...',
                'descripcion' => 'Figura completamente articulada impresa en filamen...',
                'material' => null,
                'colores' => null,
                'medida' => null,
                'peso' => null,
                'acabado' => null,
                'resistencia' => null,
                'usos_posibles' => null,
                'activo' => 1,
                'created_at' => '2026-06-12 01:55:51',
                'updated_at' => '2026-06-12 19:34:45'
            ],
            [
                'id_producto' => 3,
                'id_categoria' => 3,
                'nombre' => 'Modelo 3',
                'precio' => 5.00,
                'stock' => 11,
                'imagen' => 'https://i.pinimg.com/originals/89/e4/a2/89e4a21663...',
                'descripcion' => 'Pequeña maceta de diseño poliédrico perfecta para ...',
                'material' => null,
                'colores' => null,
                'medida' => null,
                'peso' => null,
                'acabado' => null,
                'resistencia' => null,
                'usos_posibles' => null,
                'activo' => 1,
                'created_at' => '2026-06-12 01:55:51',
                'updated_at' => '2026-06-26 16:14:36'
            ],
            [
                'id_producto' => 4,
                'id_categoria' => 4,
                'nombre' => 'Modelo 4',
                'precio' => 15.00,
                'stock' => 10,
                'imagen' => 'https://www.impresoras3d.com/wp-content/uploads/20...',
                'descripcion' => 'Grip ergonómico avanzado para mandos Joy-Con. Mejo...',
                'material' => null,
                'colores' => null,
                'medida' => null,
                'peso' => null,
                'acabado' => null,
                'resistencia' => null,
                'usos_posibles' => null,
                'activo' => 1,
                'created_at' => '2026-06-12 01:55:51',
                'updated_at' => '2026-06-12 19:56:26'
            ],
            [
                'id_producto' => 5,
                'id_categoria' => 5,
                'nombre' => 'Modelo 5',
                'precio' => 25.00,
                'stock' => 6,
                'imagen' => 'https://images.cults3d.com/urXY-927nla5lDmYGbSkpnB...',
                'descripcion' => 'Modelo a escala detallado para entusiastas del aut...',
                'material' => null,
                'colores' => null,
                'medida' => null,
                'peso' => null,
                'acabado' => null,
                'resistencia' => null,
                'usos_posibles' => null,
                'activo' => 1,
                'created_at' => '2026-06-12 01:55:51',
                'updated_at' => '2026-06-12 15:12:22'
            ]
        ]);
    }
}