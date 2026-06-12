<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra el panel principal con el listado de todos los productos
     */
    public function index()
    {
        // Trae los productos junto con su categoría asignada (Siguiendo id_categoria) ordenados por nombre
        $productos = Producto::with('categoria')->orderBy('nombre')->get();
        $categorias = Categoria::all();

        return view('admin', compact('productos', 'categorias'));
    }

    /**
     * --- NUEVO MÉTODO: RENDERIZA LA PÁGINA PARA CREAR UN NUEVO PRODUCTO ---
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin-crear', compact('categorias'));
    }

    /**
     * Guarda un producto nuevo en la base de datos
     */
    public function store(Request $request)
    {
        // Validar estrictamente según los tipos de datos de tu archivo .sql
        $request->validate([
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'nombre'       => 'required|max:100',
            'precio'       => 'required|numeric',
            'stock'        => 'required|integer',
            'imagen'       => 'required|max:255',
            'descripcion'  => 'required',
        ]);

        // Insertar en la tabla 'productos'
        Producto::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * --- NUEVO MÉTODO: RENDERIZA LA PÁGINA DE EDICIÓN CARGANDO EL ID ESPECÍFICO ---
     */
    public function edit($id_producto)
    {
        // Usa tu clave primaria id_producto de forma explícita para evitar fallos de indexación
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        $categorias = Categoria::all();
        
        return view('admin-editar', compact('producto', 'categorias'));
    }

    /**
     * Actualiza un producto existente
     */
    public function update(Request $request, $id_producto)
    {
        $request->validate([
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'nombre'       => 'required|max:100',
            'precio'       => 'required|numeric',
            'stock'        => 'required|integer',
            'imagen'       => 'required|max:255',
            'descripcion'  => 'required',
        ]);

        // Busqueda robusta respetando tu clave primaria id_producto
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        $producto->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Elimina un producto de la base de datos
     */
    public function destroy($id_producto)
    {
        // Busqueda robusta respetando tu clave primaria id_producto
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        $producto->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Producto eliminado exitosamente.');
    }
}