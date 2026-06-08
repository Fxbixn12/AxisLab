<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index()
    {
        // Trae todos los productos de la tabla 'productos' usando Eloquent
        $productos = Producto::all();

        // Envía los productos directo a la vista 'catalogo.blade.php'
        return view('catalogo', compact('productos'));
    }
}