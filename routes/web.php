<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\AdminController;

// 1. RUTAS PÚBLICAS Y VISTAS ESTÁTICAS

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

// Proceso de Pago / Despacho (Vista)
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

// Confirmación de Compra Exitosa (Vista)
Route::get('/success', function () {
    return view('success');
})->name('success');

// Redirección de Contacto / WhatsApp (Vista)
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Rutas para el proceso de compra
Route::post('/checkout/procesar', [CheckoutController::class, 'procesar'])->name('checkout.process');
Route::get('/checkout/exito', [CheckoutController::class, 'exito'])->name('checkout.success');

// 2. RUTAS CONECTADAS A CONTROLADORES (LÓGICA BD Y CRUD)

// Catálogo: Carga los productos dinámicamente desde la base de datos
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');

// Autenticación: Procesar datos del formulario y cierre de sesión real
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Panel de Administración: Gestión CRUD de Inventario (Tabla 'productos')
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin-dashboard/productos', [AdminController::class, 'store'])->name('admin.productos.store');
Route::put('/admin-dashboard/productos/{id_producto}', [AdminController::class, 'update'])->name('admin.productos.update');
Route::delete('/admin-dashboard/productos/{id_producto}', [AdminController::class, 'destroy'])->name('admin.productos.destroy');

// 3. RUTAS POR DEFECTO DEL FRAMEWORK / LIVEWIRE VOLT

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';