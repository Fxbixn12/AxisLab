<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. OBLIGATORIO: Sembramos los roles primero para que existan en el sistema
        $this->call([
            RoleSeeder::class,
        ]);

        // 2. Creamos TU cuenta de Administrador Maestro para Axis Lab
        User::factory()->create([
            'name' => 'Admin',
            'apellido' => 'AxisLab',
            'email' => 'admin@axislab.com',
            'password' => bcrypt('admin1234'), // Contraseña conocida para que puedas entrar
            'tipo_documento' => 'DNI',
            'numero_documento' => '00000000',
            'telefono' => '999999999',
            'fecha_nacimiento' => '1990-01-01',
            'id_rol' => 1, // LA LLAVE MAESTRA: Le damos el poder de Administrador
        ]);

        // 3. (Opcional) Clientes de prueba
        // User::factory(10)->create(); 
    }
}