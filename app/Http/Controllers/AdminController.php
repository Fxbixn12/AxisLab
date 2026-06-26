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
        $productos = Producto::with('categoria')->orderBy('nombre')->get();
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
        // Validamos rigurosamente que las entradas de texto coincidan con las restricciones de la tabla
        $request->validate([
            'id_categoria'  => 'required|exists:categorias,id_categoria',
            'nombre'        => 'required|max:100',
            'precio'        => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'imagen'        => 'required|max:255',
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
        $request->validate([
            'id_categoria'  => 'required|exists:categorias,id_categoria',
            'nombre'        => 'required|max:100',
            'precio'        => 'required|numeric',
            'stock'         => 'required|integer',
            'imagen'        => 'required|max:255',
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
        $producto->update($request->all());
        return redirect()->route('admin.dashboard')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id_producto)
    {
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        // Aplicamos borrado logico para mantener la integridad referencial con la tabla de ventas
        $producto->update(['activo' => 0]);
        return redirect()->route('admin.dashboard')->with('success', 'Producto desactivado exitosamente.');
    }

    // Control de categorías
    public function createCategoria()
    {
        return view('admin-categorias-crear');
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
        // Redirige directamente de vuelta a la tabla de gestión de categorías
        return redirect()->route('admin.categorias.edit')->with('success', 'Categoría creada exitosamente.');
    }

    // Carga la vista dedicada de Gestión de Categorías
    public function editCategoria()
    {
        $categorias = Categoria::all();
        return view('admin-categorias-editar', compact('categorias'));
    }

    // Actualiza por ID discriminando el cambio de estado o texto de forma independiente
    public function updateCategoria(Request $request, $id_categoria)
    {
        $categoria = Categoria::where('id_categoria', $id_categoria)->firstOrFail();

        // Caso 1: Alternar visibilidad (Desactivar/Activar) sin requerir validación de nombre
        if ($request->has('toggle_status')) {
            $categoria->update([
                'activo' => $request->activo
            ]);
            $mensaje = $request->activo ? 'Categoría habilitada en el catálogo.' : 'Categoría oculta del catálogo.';
            return redirect()->route('admin.categorias.edit')->with('success', $mensaje);
        }

        // Caso 2: Sobrescribir texto del nombre
        $request->validate([
            'nombre' => 'required|max:100|unique:categorias,nombre,' . $id_categoria . ',id_categoria',
        ]);

        $categoria->update([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('admin.categorias.edit')->with('success', 'Nombre de categoría actualizado con éxito.');
    }
}