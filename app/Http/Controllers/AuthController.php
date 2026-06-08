<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            // Cargar la relación con el rol para validar el nombre
            // Si en tu base de datos el administrador se llama 'admin' o tiene id_rol 1:
            if ($user->rol->nombre === 'admin' || $user->id_rol == 1) {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Si es un cliente regular, directo al catálogo
            return redirect()->intended(route('catalogo'));
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

        return redirect()->route('login');
    }
}