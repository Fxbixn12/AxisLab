<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MercadoPagoController;

// 1. VISTAS PÚBLICAS GENERALES

// Página de Inicio
Route::get('/', function () {
    return view('index');
})->name('home');

// Formulario de Inicio de Sesión (Vista)
Route::get('/iniciarsesion', function () {
    return view('iniciarsesion');
})->name('login');

// Carrito de Compras (Vista)
Route::get('/carrito', function () {
    return view('carrito');
})->name('carrito');

// Redirección de Contacto / WhatsApp (Vista)
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Catálogo: Carga los productos dinámicamente desde la base de datos
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');

// Detalle del producto en una vista limpia del servidor (Reemplaza la modal de JS)
Route::get('/catalogo/producto/{id_producto}', [CatalogoController::class, 'show'])->name('catalogo.show'); // <-- ¡AÑADIDO PARA EL NUEVO DISEÑO PHP PURO!


// 2. RUTAS CONECTADAS A CONTROLADORES (LÓGICA BD Y CRUD)

// Autenticación: Registro, Login y Logout
Route::post('/registro-interno', [AuthController::class, 'register'])->name('registro.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Acción de agregar al carrito procesada por PHP puro usando sesiones en el servidor
Route::post('/carrito/agregar/{id_producto}', [CatalogoController::class, 'agregarAlCarrito'])->name('carrito.agregar');

// Acciones operativas del carrito controladas en caliente por PHP puro
Route::post('/carrito/disminuir/{id_producto}', [CatalogoController::class, 'disminuirCantidad'])->name('carrito.disminuir'); // <-- ¡AÑADIDO PARA EL CONTROL DEL CARRITO!
Route::post('/carrito/incrementar/{id_producto}', [CatalogoController::class, 'incrementarCantidad'])->name('carrito.incrementar'); // <-- ¡AÑADIDO PARA EL CONTROL DEL CARRITO!
Route::post('/carrito/eliminar/{id_producto}', [CatalogoController::class, 'eliminarDelCarrito'])->name('carrito.eliminar'); // <-- ¡AÑADIDO PARA EL CONTROL DEL CARRITO!


// 3. RUTAS PROTEGIDAS BAJO MIDDLEWARE (ZONAS CON RESTRICCIÓN DE ACCESO)

// Filtro de Seguridad: Protege el proceso de pago y la gestión del Administrador
Route::middleware(['auth'])->group(function () {

    // Proceso de Compra (Checkout)
    Route::get('/checkout', function () { return view('checkout'); })->name('checkout');
    Route::get('/success', function () { return view('success'); })->name('success');
    Route::post('/checkout/procesar', [CheckoutController::class, 'procesar'])->name('checkout.process');
    Route::get('/checkout/exito', [CheckoutController::class, 'exito'])->name('checkout.success');
    Route::get('/pagar/{id_pedido}', [MercadoPagoController::class, 'crearPago'])->name('mercadopago.pagar');
    Route::get('/mercadopago/success', [MercadoPagoController::class, 'success'])->name('mercadopago.success');
    Route::get('/mercadopago/failure', [MercadoPagoController::class, 'failure'])->name('mercadopago.failure');
    Route::get('/mercadopago/pending', [MercadoPagoController::class, 'pending'])->name('mercadopago.pending');

    // Panel de Administración: Gestión CRUD de Inventario (Tabla 'productos')
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin-dashboard/productos/crear', [AdminController::class, 'create'])->name('admin.productos.create'); // <-- ¡AÑADIDO PARA EL FORMULARIO PHP DE CREACIÓN!
    Route::get('/admin-dashboard/productos/{id_producto}/editar', [AdminController::class, 'edit'])->name('admin.productos.edit'); // <-- ¡AÑADIDO PARA EL FORMULARIO PHP DE EDICIÓN!
    Route::post('/admin-dashboard/productos', [AdminController::class, 'store'])->name('admin.productos.store');
    Route::put('/admin-dashboard/productos/{id_producto}', [AdminController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin-dashboard/productos/{id_producto}', [AdminController::class, 'destroy'])->name('admin.productos.destroy');
    
    // Configuraciones por Defecto de los Componentes Livewire Volt
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';