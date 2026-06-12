<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // <-- Importante para gestionar el carrito en el servidor
use Illuminate\Support\Facades\Auth;    // <-- Importante para validar el rol del usuario logueado

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        // Carga los productos junto con su categoría asignada (Siguiendo id_categoria)
        $query = Producto::with('categoria');

        // BUSCADOR: Filtrado reactivo por texto directo en la base de datos
        if ($request->has('search') && $request->search != '') {
            $query->where('nombre', 'LIKE', '%' . $request->search . '%');
        }

        // FILTRADO DINÁMICO: Cláusula condicional basada en los tags de categorías reales
        if ($request->has('categoria') && $request->categoria != 'todos') {
            $query->where('id_categoria', $request->categoria);
        }

        $productos = $query->orderBy('nombre')->get();
        $categorias = Categoria::all();

        // Lectura del carrito modificado en la sesión activa del servidor
        $carrito = Session::get('carrito', []);

        // Envía los productos directo a la vista 'catalogo.blade.php' con soporte de filtros
        return view('catalogo', compact('productos', 'categorias', 'carrito'));
    }

    // --- NUEVA FUNCIÓN PARA RENDERIZAR LA VISTA DE DETALLES EN PHP PURO ---
    public function show($id_producto)
    {
        // Busca el producto específico o arroja un error si no se encuentra
        $producto = Producto::with('categoria')->where('id_producto', $id_producto)->firstOrFail();
        
        return view('producto-detalle', compact('producto'));
    }

    public function agregarAlCarrito(Request $request, $id_producto)
    {
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();

        // --- DEFENSA FINAL: Bloqueo de compra para Admin ---
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

        // Guardar el estado actualizado en la sesión del servidor
        Session::put('carrito', $carrito);

        return back()->with('success', '"' . $producto->nombre . '" ha sido añadido a tu carrito de compras de manera exitosa.');
    }

    // --- NUEVO MÉTODO PARA DISMINUIR CANTIDAD DESDE EL CARRITO ---
    public function disminuirCantidad($id_producto)
    {
        $carrito = Session::get('carrito', []);
        
        if (isset($carrito[$id_producto])) {
            if ($carrito[$id_producto]['qty'] > 1) {
                $carrito[$id_producto]['qty']--;
            } else {
                unset($carrito[$id_producto]); // <-- Si la cantidad baja de 1, se remueve el producto por completo
            }
            Session::put('carrito', $carrito);
        }
        return back();
    }

    // --- NUEVO MÉTODO PARA INCREMENTAR CANTIDAD CON VALIDACIÓN DE STOCK ---
    public function incrementarCantidad($id_producto)
    {
        $producto = Producto::where('id_producto', $id_producto)->firstOrFail();
        $carrito = Session::get('carrito', []);

        if (isset($carrito[$id_producto])) {
            // <-- Validación estricta contra el stock real de la tabla 'productos'
            if ($carrito[$id_producto]['qty'] >= $producto->stock) {
                return back()->with('error', 'Lo sentimos, no hay más stock disponible para este producto.');
            }
            $carrito[$id_producto]['qty']++;
            Session::put('carrito', $carrito);
        }
        return back();
    }

    // --- NUEVO MÉTODO PARA ELIMINAR UNA FILA DEL CARRITO ---
    public function eliminarDelCarrito($id_producto)
    {
        $carrito = Session::get('carrito', []);
        
        if (isset($carrito[$id_producto])) {
            unset($carrito[$id_producto]); // <-- Remueve el índice de la sesión del servidor
            Session::put('carrito', $carrito);
        }
        return back();
    }
}