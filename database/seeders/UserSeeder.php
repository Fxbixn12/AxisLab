<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 7, // Tu ID usado en el flujo de pruebas de Mercado Pago
                'name' => 'Jesús',
                'apellido' => 'Rocha',
                'email' => 'enriquerocha2345@gmail.com',
                'password' => Hash::make('password123'), // Contraseña encriptada segura
                'tipo_documento' => 'DNI',
                'numero_documento' => '12345678',
                'telefono' => '964174894',
                'fecha_nacimiento' => '1998-05-15',
                'id_rol' => 1, // Administrador
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}