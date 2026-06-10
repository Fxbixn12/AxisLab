<?php

// Ya no necesitamos importar Volt porque ahora usas tu propio AuthController
test('registration screen can be rendered', function () {
    // Cambiamos '/register' por tu ruta real donde vive el formulario
    $response = $this->get('/iniciarsesion');

    $response->assertStatus(200);
});

test('new users can register', function () {
    // Hacemos una petición POST real a tu controlador con TODOS los datos exigidos
    $response = $this->post('/registro-interno', [
        'name' => 'Test User', // Tu AuthController lo dividirá en 'Test' (nombre) y 'User' (apellido)
        'tipo_documento' => 'DNI',
        'numero_documento' => '12345678',
        'telefono' => '987654321',
        'fecha_nacimiento' => '2000-01-01', // Fecha válida (mayor de 18)
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    // Verificamos que no haya errores de validación
    $response->assertSessionHasNoErrors();

    // Verificamos que el sistema sí haya logueado al usuario
    $this->assertAuthenticated();

    // Verificamos que redirija al catálogo, no al dashboard de Laravel
    $response->assertRedirect(route('catalogo'));
});