<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('configuraciones')->insert([
            ['clave' => 'minimo_lima', 'valor' => 5.00, 'created_at' => '2026-06-25 08:25:20', 'updated_at' => '2026-06-25 08:30:27'],
            ['clave' => 'minimo_provincia', 'valor' => 15.00, 'created_at' => '2026-06-25 08:25:21', 'updated_at' => '2026-06-25 08:30:27'],
        ]);
    }
}