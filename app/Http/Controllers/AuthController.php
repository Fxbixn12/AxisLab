<?php

namespace App\Http\Controllers;

use App\Models\User; // <-- Importante para poder crear usuarios
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // <-- Importante para encriptar contraseñas

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar campos de entrada
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar contra la base de datos
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Validar el rol del usuario utilizando directamente el id_rol de la base de datos
            // Si en tu base de datos el administrador tiene id_rol 1:
            if ($user->id_rol == 1) {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Si es un cliente regular, directo al catálogo por URL limpia
            // <-- CORREGIDO: Redirección directa por ruta web fija para evitar fallos 404
            return redirect()->intended('/catalogo');
        }

        // Si falla, regresa con error
        return back()->withErrors([
            'login_error' => 'El correo o la contraseña son incorrectos.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // <-- CORREGIDO: Redirección directa para evitar fallos lógicos
        return redirect('/iniciarsesion');
    }

    // --- NUEVA FUNCIÓN DE REGISTRO INTEGRADA Y ADAPTADA A TU VISTA ---
    public function register(Request $request)
    {
        // 1. Definimos las reglas generales (las que aplican para todos)
        $reglas = [
            'name' => ['required', 'string', 'max:255', 'regex:/^\s*([^\s]+\s+[^\s]+)\s*$/'], 
            'tipo_documento' => 'required|string|in:DNI,CE,Pasaporte',
            'telefono' => 'required|string|max:9|unique:users,telefono', 
            'fecha_nacimiento' => 'required|date|before:-18 years', 
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];

        // 2. Inyectamos la regla estricta según el documento elegido
        if ($request->tipo_documento === 'DNI') {
            // El DNI DEBE tener exactamente 8 números ('digits:8')
            $reglas['numero_documento'] = 'required|digits:8|unique:users,numero_documento';
        } elseif ($request->tipo_documento === 'CE') {
            // El CE suele tener 9 caracteres alfanuméricos
            $reglas['numero_documento'] = 'required|string|max:9|unique:users,numero_documento';
        } else {
            // El Pasaporte es libre hasta 12 caracteres alfanuméricos
            $reglas['numero_documento'] = 'required|string|max:12|unique:users,numero_documento';
        }

        // 3. Ejecutamos la validación con los mensajes en español
        $request->validate($reglas, [
            'name.regex' => 'Por favor, ingresa tu nombre y apellido completos.',
            'fecha_nacimiento.before' => 'Debes ser mayor de 18 años para registrarte.',
            'numero_documento.unique' => 'Este número de documento ya está registrado.',
            'numero_documento.digits' => 'El DNI debe tener exactamente 8 números.',
            'telefono.unique' => 'Este número de teléfono ya está registrado.',
            'email.unique' => 'Este correo electrónico ya está en uso.'
        ]);
        
        // 2. Separar el Nombre del Apellido
        $fullName = explode(' ', trim($request->name)); 
        $name = $fullName[0]; 
        array_shift($fullName); 
        $apellido = implode(' ', $fullName); 

        // 3. Crear el usuario enviando TODAS las variables
        $user = User::create([
            'name' => $name, 
            'apellido' => $apellido, 
            'tipo_documento' => $request->tipo_documento,     // <-- Capturado
            'numero_documento' => $request->numero_documento, // <-- Capturado
            'telefono' => $request->telefono,                 // <-- Capturado
            'fecha_nacimiento' => $request->fecha_nacimiento, // <-- Capturado
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_rol' => 2, // Rol de cliente por defecto
        ]);

        // 4. Loguear y redirigir de forma segura en caliente
        Auth::login($user);
        $request->session()->regenerate();
        
        // <-- CORREGIDO: Redirección directa por URL para eliminar de raíz el bug Not Found (404)
        return redirect('/catalogo');
    }
}