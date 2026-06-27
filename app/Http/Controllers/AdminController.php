<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Jalamos productos con su categoria para evitar la sobrecarga N+1 en la base de datos relacional
        $productos = Producto::with('categoria')->orderBy('nombre', 'asc')->get();
        $categorias = Categoria::all();
        return view('admin', compact('productos', 'categorias'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin-crear', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Validamos rigurosamente que las entradas coincidan con las restricciones de la tabla y el formato del archivo físico
        $request->validate([
            'id_categoria'  => 'required|exists:categorias,id_categoria',
            'nombre'        => 'required|max:100',
            'precio'        => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'imagen'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Validación estricta del archivo binario
            'descripcion'   => 'required',
            'material'      => 'nullable|string|max:50',
            'colores'       => 'nullable|string|max:50',
            'medida'        => 'nullable|string|max:50',
            'peso'          => 'nullable|string|max:30',
            'acabado'       => 'nullable|string|max:50',
            'resistencia'   => 'nullable|string|max:50',
            'usos_posibles' => 'nullable|string',
        ]);

        $datos = $request->all();
        $datos['activo'] = 1; // Forzamos a que el registro nazca activo en stock

        // Lógica de procesamiento y guardado físico del archivo de imagen examinado
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            
            // Creamos un identificador único basado en tiempo de UNIX para que no se dupliquen nombres de archivos
            $nombreImagen = time() . '.' . $archivo->getClientOriginalExtension();
            
            // Almacenamos el archivo físico dentro de la carpeta correspondiente en el public
            $archivo->move(public_path('img/productos'), $nombreImagen);
            
            // Sobrescribimos el campo del array con la ruta relativa que se enviará como String a la base de datos
            $datos['imagen'] = 'img/productos/' . $nombreImagen;
        }

        Producto::create($datos);
        return redirect()->route('admin.dashboard')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($id_producto)
    {
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        $categorias = Categoria::all();   
        return view('admin-editar', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id_producto)
    {
        // Validamos de forma idéntica, pero permitimos que la imagen sea opcional (nullable) al editar
        $request->validate([
            'id_categoria'  => 'required|exists:categorias,id_categoria',
            'nombre'        => 'required|max:100',
            'precio'        => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'imagen'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Archivo físico opcional al actualizar
            'descripcion'   => 'required',
            'material'      => 'nullable|string|max:50',
            'colores'       => 'nullable|string|max:50',
            'medida'        => 'nullable|string|max:50',
            'peso'          => 'nullable|string|max:30',
            'acabado'       => 'nullable|string|max:50',
            'resistencia'   => 'nullable|string|max:50',
            'usos_posibles' => 'nullable|string',
            'activo'        => 'required|boolean',
        ]);

        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        $datos = $request->all();

        // Lógica para procesar la nueva imagen si decidiste examinar y subir una nueva desde tu PC
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            
            // Generamos un identificador único basado en tiempo
            $nombreImagen = time() . '.' . $archivo->getClientOriginalExtension();
            
            // Guardamos el archivo físico en el servidor de la app
            $archivo->move(public_path('img/productos'), $nombreImagen);
            
            // Seteamos la nueva ruta local que se actualizará en la base de datos
            $datos['imagen'] = 'img/productos/' . $nombreImagen;
        } else {
            // Si no seleccionaste ningún archivo nuevo, conservamos estrictamente la ruta de la imagen que ya tenía
            $datos['imagen'] = $producto->imagen;
        }

        $producto->update($datos);
        return redirect()->route('admin.dashboard')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id_producto)
    {
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        // Aplicamos borrado lógico para mantener la integridad referencial con la tabla de ventas
        $producto->update(['activo' => 0]);
        return redirect()->route('admin.dashboard')->with('success', 'Producto desactivado exitosamente.');
    }

    // Control de categorías
    public function createCategoria()
    {
        return view('admin-categories-crear');
    }

    public function storeCategoria(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:categorias,nombre',
        ]);
        Categoria::create([
            'nombre' => $request->nombre,
            'activo' => 1
        ]);
        return redirect()->route('admin.categorias.edit')->with('success', 'Categoría creada exitosamente.');
    }

    public function editCategoria()
    {
        $categorias = Categoria::all();
        return view('admin-categorias-editar', compact('categorias'));
    }

    public function updateCategoria(Request $request, $id_categoria)
    {
        $categoria = Categoria::where('id_categoria', $id_categoria)->firstOrFail();

        if ($request->has('toggle_status')) {
            $categoria->update([
                'activo' => $request->activo
            ]);
            $mensaje = $request->activo ? 'Categoría habilitada en el catálogo.' : 'Categoría oculta del catálogo.';
            return redirect()->route('admin.categorias.edit')->with('success', $mensaje);
        }

        $request->validate([
            'nombre' => 'required|max:100|unique:categorias,nombre,' . $id_categoria . ',id_categoria',
        ]);

        $categoria->update([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('admin.categorias.edit')->with('success', 'Nombre de categoría actualizado con éxito.');
    }
}