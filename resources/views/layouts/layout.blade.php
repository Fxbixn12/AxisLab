<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AxisLab')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- 3. RUTAS POR DEFECTO DEL FRAMEWORK / COMPILACIÓN DE ASSETS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-[#111827] antialiased">

<div class="max-w-[1200px] mx-auto px-5">
    
    <!-- 1. BARRA DE NAVEGACIÓN GLOBAL -->
    <nav class="flex justify-between items-center py-6 mb-5">
        <div class="flex items-center font-extrabold text-xl gap-2.5 cursor-pointer text-[#55575e]" onclick="window.location.href='{{ route('home') }}'">
            <i class="fa-solid fa-cube text-4xl text-[#55575e]"></i> AxisLab
        </div>
        <div class="flex items-center gap-10 font-semibold text-sm" id="nav-menu">
            
            <!-- ENLACES DE NAVEGACIÓN -->
            <!-- <-- Usamos request()->routeIs() para pintar de naranja si la ruta está activa -->
            <a href="{{ route('home') }}" class="transition duration-200 {{ request()->routeIs('home') ? 'text-[#f89a20]' : 'text-[#111827] hover:text-[#f89a20]' }}">Inicio</a>
            
            <a href="{{ route('catalogo') }}" class="transition duration-200 {{ request()->routeIs('catalogo') ? 'text-[#f89a20]' : 'text-[#111827] hover:text-[#f89a20]' }}">Catálogo</a>
            
            <a href="{{ route('contacto') }}" class="transition duration-200 {{ request()->routeIs('contacto') ? 'text-[#f89a20]' : 'text-[#111827] hover:text-[#f89a20]' }}">Contacto</a>
            
            <!-- Autenticación: Mostrar "Iniciar sesión" si el usuario es un invitado -->
            @guest
                <a href="{{ route('login') }}" class="transition duration-200 {{ request()->routeIs('login') ? 'text-[#f89a20]' : 'text-[#111827] hover:text-[#f89a20]' }}">Iniciar sesión</a>
            @endguest
            
            <a href="{{ route('carrito') }}" class="transition duration-200 {{ request()->routeIs('carrito') ? 'text-[#f89a20]' : 'text-[#111827] hover:text-[#f89a20]' }}">Carrito</a>

            <!-- Autenticación: Mostrar opciones de usuario logueado -->
            @auth
                @if(Auth::user()->id_rol == 1)
                    <!-- <-- Panel Admin también reacciona si está activo -->
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'text-[#f89a20] underline' : 'text-[#f89a20] hover:underline' }}">Panel Admin</a>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-red-600 hover:underline flex items-center gap-1 ml-4">
                    <i class="fa-solid fa-power-off"></i> Salir
                </a>
            @endauth
        </div>
    </nav>

    <!-- 2. CONTENIDO DINÁMICO DE LAS VISTAS HIJAS -->
    <main>
        @yield('contenido')
    </main>

    <!-- 3. FOOTER GENERAL DE AXISLAB -->
    <footer class="pt-12 pb-8 border-t border-gray-200 mt-10">
        <div class="flex justify-between flex-wrap gap-8 mb-12">
            <div class="flex flex-col gap-4">
                <h5 class="font-bold text-gray-500 text-sm tracking-wider uppercase">Información Adicional</h5>
                <div class="flex gap-5 text-2xl text-[#111827]">
                    <a href="#" class="hover:text-[#f89a20] hover:scale-110 transition-all"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="hover:text-[#f89a20] hover:scale-110 transition-all"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="hover:text-[#f89a20] hover:scale-110 transition-all"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class="hover:text-[#f89a20] hover:scale-110 transition-all"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="flex items-start gap-4">
                <div class="w-11 h-11 rounded-full bg-[#f89a20] flex items-center justify-center text-white text-lg shrink-0">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div>
                    <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Dirección</h5>
                    <p class="font-bold text-sm text-[#111827]">Enrique Segoviano, Tecsup</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-11 h-11 rounded-full bg-[#f89a20] flex items-center justify-center text-white text-lg shrink-0">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div>
                    <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Email</h5>
                    <p class="font-bold text-sm text-[#111827]">cliente@axislab.com</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-11 h-11 rounded-full bg-[#f89a20] flex items-center justify-center text-white text-lg shrink-0">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div>
                    <h5 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Teléfono</h5>
                    <p class="font-bold text-sm text-[#111827]">+51 123 456 789</p>
                </div>
            </div>
        </div>
        
        <div class="flex justify-between items-center border-t border-gray-200 pt-8">
            <div class="flex-1">
                <h5 class="font-bold text-sm text-[#111827]">Redes Sociales</h5>
            </div>
            <div class="flex flex-col text-right gap-1 flex-1 pr-5">
                <h5 class="font-bold text-sm text-[#111827]">Links</h5>
                <a href="#" class="text-sm text-gray-400 hover:text-[#f89a20] transition">Sobre Nosotros</a>
                <a href="#" class="text-sm text-gray-400 hover:text-[#f89a20] transition">F.A.Q</a>
            </div>
        </div>

        <div class="text-center text-xs text-gray-400 pt-6 border-t border-gray-100 mt-6">
            © AxisLab. Todos los derechos reservados. 2026.
        </div>
    </footer>
</div>

</body>
</html>