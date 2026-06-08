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
        // Trae los productos junto con su categoría asignada (Siguiendo id_categoria)
        $productos = Producto::with('categoria')->get();
        $categorias = Categoria::all();

        return view('admin', compact('productos', 'categorias'));
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

        $producto = Producto::findOrFail($id_producto);
        $producto->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Elimina un producto de la base de datos
     */
    public function destroy($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $producto->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Producto eliminado exitosamente.');
    }
}