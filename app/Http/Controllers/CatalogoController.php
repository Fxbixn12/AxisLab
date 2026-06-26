<?php
namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        // 1. Filtramos para cargar únicamente las categorías que tengan el estado activo (1)
        $categorias = Categoria::where('activo', 1)->get();
        $categoriasActivasIds = $categorias->pluck('id_categoria')->toArray();

        // 2. Cargamos productos activos cuyo ID de categoría pertenezca al grupo de categorías habilitadas
        $query = Producto::with('categoria')
            ->where('activo', 1)
            ->whereIn('id_categoria', $categoriasActivasIds);

        // Buscador por caja de texto
        if ($request->has('search') && $request->search != '') {
            $query->where('nombre', 'LIKE', '%' . $request->search . '%');
        }

        // Filtrado por los botones de las categorias
        if ($request->has('categoria') && $request->categoria != 'todos') {
            $query->where('id_categoria', $request->categoria);
        }

        $productos = $query->orderBy('nombre')->get();
        $carrito = Session::get('carrito', []);

        return view('catalogo', compact('productos', 'categorias', 'carrito'));
    }

    public function show($id_producto)
    {
        $producto = Producto::with('categoria')->where('id_producto', $id_producto)->firstOrFail();
        return view('producto-detalle', compact('producto'));
    }

    public function agregarAlCarrito(Request $request, $id_producto)
    {
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        // Bloqueamos que el administrador intente comprar
        if (Auth::check() && Auth::user()->id_rol == 1) {
            return back()->with('error', 'Acción no permitida: Los administradores no pueden realizar compras.');
        }
        $carrito = Session::get('carrito', []);
        $qtyInCart = isset($carrito[$id_producto]) ? $carrito[$id_producto]['qty'] : 0;
        if ($producto->stock <= 0) {
            return back()->with('error', 'Lo sentimos, el producto "' . $producto->nombre . '" se encuentra temporalmente agotado.');
        }
        if ($qtyInCart >= $producto->stock) {
            return back()->with('error', 'Lo sentimos, no hay suficiente stock disponible para "' . $producto->nombre . '". Stock máximo: ' . $producto->stock);
        }
        if (isset($carrito[$id_producto])) {
            $carrito[$id_producto]['qty']++;
        } else {
            $carrito[$id_producto] = [
                "id" => $producto->id_producto,
                "name" => $producto->nombre,
                "price" => $producto->precio,
                "img" => $producto->imagen,
                "qty" => 1
            ];
        }
        Session::put('carrito', $carrito);
        return back()->with('success', '"' . $producto->nombre . '" ha sido añadido a tu carrito de compras de manera exitosa.');
    }

    public function disminuirCantidad($id_producto)
    {
        $carrito = Session::get('carrito', []);
        if (isset($carrito[$id_producto])) {
            if ($carrito[$id_producto]['qty'] > 1) {
                $carrito[$id_producto]['qty']--;
            } else {
                unset($carrito[$id_producto]);
            }
            Session::put('carrito', $carrito);
        }
        return back();
    }

    public function incrementarCantidad($id_producto)
    {
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        $carrito = Session::get('carrito', []);
        if (isset($carrito[$id_producto])) {
            if ($carrito[$id_producto]['qty'] >= $producto->stock) {
                return back()->with('error', 'Lo sentimos, no hay más stock disponible para este producto.');
            }
            $carrito[$id_producto]['qty']++;
            Session::put('carrito', $carrito);
        }
        return back();
    }

    public function eliminarDelCarrito($id_producto)
    {
        $carrito = Session::get('carrito', []);
        if (isset($carrito[$id_producto])) {
            unset($carrito[$id_producto]);
            Session::put('carrito', $carrito);
        }
        return back();
    }
}