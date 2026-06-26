<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\AdminDistritoController;
use App\Http\Controllers\AdminPedidoController;

// Rutas públicas de la plataforma
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/iniciarsesion', function () {
    return view('iniciarsesion');
})->name('login');

Route::get('/carrito', function () {
    return view('carrito');
})->name('carrito');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');
Route::get('/catalogo/producto/{id_producto}', [CatalogoController::class, 'show'])->name('catalogo.show');

// Autenticación y gestión del carrito de compras
Route::post('/registro-interno', [AuthController::class, 'register'])->name('registro.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/carrito/agregar/{id_producto}', [CatalogoController::class, 'agregarAlCarrito'])->name('carrito.agregar');
Route::post('/carrito/disminuir/{id_producto}', [CatalogoController::class, 'disminuirCantidad'])->name('carrito.disminuir');
Route::post('/carrito/incrementar/{id_producto}', [CatalogoController::class, 'incrementarCantidad'])->name('carrito.incrementar');
Route::post('/carrito/eliminar/{id_producto}', [CatalogoController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');

// Rutas protegidas por inicio de sesión
Route::middleware(['auth'])->group(function () {
    
    // Seguimiento y estado del pedido para el cliente
    Route::get('/mis-pedidos', [AdminPedidoController::class, 'misPedidos'])->name('pedidos.mis-pedidos');

    // Pasos y procesamiento de la orden de compra
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/success', function () { return view('success'); })->name('success');
    Route::post('/checkout/procesar', [CheckoutController::class, 'procesar'])->name('checkout.process');
    Route::get('/checkout/exito', [CheckoutController::class, 'exito'])->name('checkout.success');
    
    // Retornos e integración con la API de Mercado Pago
    Route::get('/pagar/{id_pedido}', [MercadoPagoController::class, 'crearPago'])->name('mercadopago.pagar');
    Route::get('/mercadopago/success', [MercadoPagoController::class, 'success'])->name('mercadopago.success');
    Route::get('/mercadopago/failure', [MercadoPagoController::class, 'failure'])->name('mercadopago.failure');
    Route::get('/mercadopago/pending', [MercadoPagoController::class, 'pending'])->name('mercadopago.pending');

    // Panel Administrativo: CRUD de catálogo de productos
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin-dashboard/productos/crear', [AdminController::class, 'create'])->name('admin.productos.create');
    Route::get('/admin-dashboard/productos/{id_producto}/editar', [AdminController::class, 'edit'])->name('admin.productos.edit');
    Route::post('/admin-dashboard/productos', [AdminController::class, 'store'])->name('admin.productos.store');
    Route::put('/admin-dashboard/productos/{id_producto}', [AdminController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin-dashboard/productos/{id_producto}', [AdminController::class, 'destroy'])->name('admin.productos.destroy');
    
    // Panel Administrativo: Tarifas de envío basadas en el nombre del distrito
    Route::get('/admin-dashboard/distritos', [AdminDistritoController::class, 'index'])->name('admin.distritos.index');
    Route::get('/admin-dashboard/distritos/crear', [AdminDistritoController::class, 'create'])->name('admin.distritos.create');
    Route::post('/admin-dashboard/distritos', [AdminDistritoController::class, 'store'])->name('admin.distritos.store');
    Route::get('/admin-dashboard/distritos/{nombre}/editar', [AdminDistritoController::class, 'edit'])->name('admin.distritos.edit');
    Route::put('/admin-dashboard/distritos/{nombre_original}', [AdminDistritoController::class, 'update'])->name('admin.distritos.update');
    Route::delete('/admin-dashboard/distritos/{nombre}', [AdminDistritoController::class, 'destroy'])->name('admin.distritos.destroy');
    Route::post('/checkout/update-tarifa', [CheckoutController::class, 'updateTarifa'])->name('checkout.update_tarifa');

    // Panel Administrativo: Mantenimiento de categorías
    Route::get('/admin-dashboard/categorias/gestion', [AdminController::class, 'editCategoria'])->name('admin.categorias.edit');
    Route::get('/admin-dashboard/categorias/crear', [AdminController::class, 'createCategoria'])->name('admin.categorias.create');
    Route::post('/admin-dashboard/categorias', [AdminController::class, 'storeCategoria'])->name('admin.categorias.store');
    Route::put('/admin-dashboard/categorias/{id_categoria}', [AdminController::class, 'updateCategoria'])->name('admin.categorias.update');

    // Rutas de componentes internos de Livewire Volt
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Panel Administrativo: Monitoreo logístico y control de los 5 estados
    Route::get('/admin-dashboard/pedidos', [AdminPedidoController::class, 'index'])->name('admin.pedidos.index');
    Route::get('/admin-dashboard/pedidos/{id_pedido}', [AdminPedidoController::class, 'show'])->name('admin.pedidos.show');
    Route::put('/admin-dashboard/pedidos/{id_pedido}/estado', [AdminPedidoController::class, 'updateEstado'])->name('admin.pedidos.updateEstado');
});

require __DIR__.'/auth.php';