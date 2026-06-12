@extends('layouts.layout')

@section('title', 'AxisLab - Diseños 3D')

@section('contenido')

    @if ($errors->any())
        <div class="max-w-[1200px] mx-auto mt-4 bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-xl text-sm font-medium flex flex-col gap-1 shadow-sm">
            @foreach ($errors->all() as $error)
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-rose-600"></i> {{ $error }}
                </div>
            @endforeach
        </div>
    @endif

    <section class="bg-[#55575e] rounded-[30px] p-[50px_60px] flex flex-col lg:flex-row justify-between items-center text-white relative overflow-hidden mt-6 mb-20 gap-10">
        <div class="max-w-full lg:max-w-[50%] z-10">
            <h1 class="text-[3.5rem] font-[800] line-height-[1.1] mb-6 tracking-tight leading-tight">Diseños 3D al alcance de todos</h1>
            <p class="text-[#d1d5db] text-base mb-8 max-w-[90%]">En AxisLab, nos preocupamos del alcance y la importancia de la impresión 3D en la vida cotidiana de las personas del hoy.</p>
            <a href="{{ route('catalogo') }}" class="bg-[#f89a20] text-white no-underline px-8 py-3.5 rounded-[10px] font-bold text-base hover:bg-[#e0891b] hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#f89a20]/35 transition duration-200 inline-block">
                Ver Productos
            </a>
        </div>

        <div class="bg-white rounded-[24px] p-9 w-full max-w-[440px] z-10 text-[#111827] shadow-xl">
            @auth
                <div class="text-center py-5">
                    <i class="fa-solid fa-user-check text-6xl text-[#f89a20] mb-5 block"></i>
                    <h2 class="text-2xl font-[800] mb-2">¡Hola, {{ Auth::user()->name }}!</h2>
                    <p class="text-[#6b7280] text-sm mb-6">Qué bueno tenerte de vuelta en AxisLab. Continúa explorando nuestro catálogo técnico.</p>
                    <a href="{{ route('catalogo') }}" class="w-full bg-[#f89a20] text-white no-underline py-3.5 rounded-[10px] font-bold text-center block hover:bg-[#e0891b] transition">
                        Ir al Catálogo
                    </a>
                </div>
            @endguest

            @guest
                <h2 class="text-center text-[1.6rem] font-[800] mb-5">Regístrate</h2>
                <form action="{{ route('registro.post') }}" method="POST" id="hero-register-form" class="flex flex-col gap-3.5">
                    @csrf
                    <div class="relative">
                        <input type="text" name="name" class="w-full p-[12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Nombre completo" required value="{{ old('name') }}">
                    </div>
                    <div class="relative">
                        <select name="tipo_documento" class="w-full p-[12px_40px_12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none appearance-none focus:border-[#f89a20] focus:bg-white transition font-medium" required>
                            <option value="" disabled selected hidden>Tipo de Documento</option>
                            <option value="DNI">DNI</option>
                            <option value="CE">Carnet de Extranjería</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-[#9ca3af] pointer-events-none text-xs"></i>
                    </div>
                    <div class="relative">
                        <input type="text" name="numero_documento" class="w-full p-[12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Número de documento" required maxlength="12" value="{{ old('numero_documento') }}">
                    </div>
                    <div class="relative">
                        <input type="text" name="telefono" class="w-full p-[12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Número de teléfono" required maxlength="9" value="{{ old('telefono') }}">
                    </div>
                    <div class="relative">
                        <input type="date" name="fecha_nacimiento" class="w-full p-[12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" required value="{{ old('fecha_nacimiento') }}">
                    </div>
                    <div class="relative">
                        <input type="email" name="email" class="w-full p-[12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Correo electrónico" required value="{{ old('email') }}">
                    </div>
                    <div class="relative mb-1">
                        <input type="password" name="password" class="w-full p-[12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Contraseña" required>
                    </div>
                    <input type="hidden" name="password_confirmation" id="hero-confirm-mirror">
                    
                    <button type="submit" class="w-full bg-[#f89a20] text-white py-3.5 rounded-[10px] font-bold text-base hover:bg-[#e0891b] transition cursor-pointer" onclick="document.getElementById('hero-confirm-mirror').value = this.form.password.value">
                        Enviar
                    </button>
                </form>
            @endguest
        </div>
    </section>

    <section class="bg-[#f4f5f7] rounded-[30px] p-[50px_40px] flex flex-col md:flex-row justify-around text-center mb-24 gap-10 shadow-sm">
        <div class="flex-1 transition duration-300 hover:-translate-y-1">
            <div class="text-[3.2rem] mb-4 text-[#111827]"><i class="fa-solid fa-location-dot"></i></div>
            <h3 class="text-[1.3rem] font-bold mb-3">Disponibilidad</h3>
            <p class="text-[#6b7280] text-[0.95rem] px-4">Contamos además de un entorno físico con un entorno virtual, accesible para el alcance de nuestros clientes.</p>
        </div>
        <div class="flex-1 transition duration-300 hover:-translate-y-1">
            <div class="text-[3.2rem] mb-4 text-[#111827]"><i class="fa-solid fa-car"></i></div>
            <h3 class="text-[1.3rem] font-bold mb-3">Comodidad</h3>
            <p class="text-[#6b7280] text-[0.95rem] px-4">Nuestro sistema de envío garantiza el viaje del producto al destino de forma segura y con tracking.</p>
        </div>
        <div class="flex-1 transition duration-300 hover:-translate-y-1">
            <div class="text-[3.2rem] mb-4 text-[#111827]"><i class="fa-solid fa-wallet"></i></div>
            <h3 class="text-[1.3rem] font-bold mb-3">Mejores precios</h3>
            <p class="text-[#6b7280] text-[0.95rem] px-4">Precios accesibles con descuentos disponibles para todos.</p>
        </div>
    </section>

    <section class="flex flex-col lg:flex-row items-center gap-[60px] mb-24">
        <div class="flex-1 rounded-[24px] overflow-hidden shadow-md">
            <img src="https://img.kwcdn.com/product/fancy/60fd348e-fa40-4763-9b39-e91a3a7083c5.jpg?imageMogr2/auto-orient%7CimageView2/2/w/800/q/70/format/webp" class="w-full h-auto block" alt="Figura 3D AxisLab">
        </div>
        <div class="flex-1 flex flex-col gap-7">
            <div class="flex gap-5 items-start">
                <div class="bg-[#f89a20] text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0 text-[0.95rem]">1</div>
                <div>
                    <h4 class="text-[1.15rem] font-bold mb-2">Exploración de Catálogo Técnico</h4>
                    <p class="text-[#6b7280] text-[0.95rem]">Navega por nuestra selección de diseños y productos especializados, filtrando por categorías y materiales de alta precisión.</p>
                </div>
            </div>
            <div class="flex gap-5 items-start">
                <div class="bg-[#f89a20] text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0 text-[0.95rem]">2</div>
                <div>
                    <h4 class="text-[1.15rem] font-bold mb-2">Configuración Personalizada</h4>
                    <p class="text-[#6b7280] text-[0.95rem]">Selecciona las especificaciones técnicas de tu pieza, incluyendo el tipo de polímero o resina y el acabado superficial requerido para tu proyecto.</p>
                </div>
            </div>
            <div class="flex gap-5 items-start">
                <div class="bg-[#f89a20] text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0 text-[0.95rem]">3</div>
                <div>
                    <h4 class="text-[1.15rem] font-bold mb-2">Gestión de Pedidos y Facturación</h4>
                    <p class="text-[#6b7280] text-[0.95rem]">Registra tu compra de forma segura y centralizada; el sistema genera automáticamente tu comprobante y procesa la orden de manufactura.</p>
                </div>
            </div>
            <div class="flex gap-5 items-start">
                <div class="bg-[#f89a20] text-white w-8 h-8 rounded-full flex items-center justify-center font-bold flex-shrink-0 text-[0.95rem]">4</div>
                <div>
                    <h4 class="text-[1.15rem] font-bold mb-2">Control y Seguimiento de Producción</h4>
                    <p class="text-[#6b7280] text-[0.95rem]">Monitorea el estado de fabricación de tus piezas en tiempo real y recibe actualizaciones hasta el momento del despacho final.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-24">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-[2.8rem] font-[800] tracking-tight">Catálogo</h2>
            <a href="{{ route('catalogo') }}" class="text-[#111827] font-bold no-underline flex items-center gap-2 hover:text-[#f89a20] transition">
                Ver Todo El Inventario Real <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        
        <div class="bg-[#f4f5f7] border border-gray-200 rounded-[24px] p-12 text-center max-w-3xl mx-auto">
            <i class="fa-solid fa-cubes text-5xl text-[#f89a20] mb-4 block"></i>
            <h4 class="text-xl font-bold mb-2 text-[#111827]">Sincronización Completa del Inventario</h4>
            <p class="text-[#6b7280] mb-6 text-sm">Nuestros artículos y stock disponibles se actualizan dinámicamente en nuestro panel central operado por el controlador en el servidor de Laravel.</p>
            <a href="{{ route('catalogo') }}" class="bg-[#55575e] text-white no-underline px-6 py-3 rounded-lg text-sm font-bold hover:bg-[#111827] transition inline-block">
                Explorar Modelos Disponibles
            </a>
        </div>
    </section>

    <section class="bg-[#55575e] rounded-[30px] p-14 text-center text-white mb-20">
        <h2 class="text-[2.8rem] font-[800] mb-4 tracking-tight">AxisLab En El Mercado</h2>
        <p class="text-[#d1d5db] mb-12 text-base max-w-xl mx-auto">Como empresa fundadora, AxisLab cumple con el rol de satisfacción y estándar de calidad para con sus clientes.</p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white rounded-[24px] p-6 flex items-center gap-4 text-[#111827] transition duration-300 hover:scale-104 shadow-md">
                <div class="bg-[#f89a20] text-white w-[54px] h-[54px] rounded-[14px] flex items-center justify-center text-2xl flex-shrink-0"><i class="fa-solid fa-car-side"></i></div>
                <div><h4 class="text-[1.45rem] font-[800] text-left leading-none mb-1">+1k</h4><span class="text-xs text-[#6b7280] font-semibold block text-left">Envíos Realizados</span></div>
            </div>
            <div class="bg-white rounded-[24px] p-6 flex items-center gap-4 text-[#111827] transition duration-300 hover:scale-104 shadow-md">
                <div class="bg-[#f89a20] text-white w-[54px] h-[54px] rounded-[14px] flex items-center justify-center text-2xl flex-shrink-0"><i class="fa-solid fa-user-check"></i></div>
                <div><h4 class="text-[1.45rem] font-[800] text-left leading-none mb-1">+1k</h4><span class="text-xs text-[#6b7280] font-semibold block text-left">Reseñas Positivas</span></div>
            </div>
            <div class="bg-white rounded-[24px] p-6 flex items-center gap-4 text-[#111827] transition duration-300 hover:scale-104 shadow-md">
                <div class="bg-[#f89a20] text-white w-[54px] h-[54px] rounded-[14px] flex items-center justify-center text-2xl flex-shrink-0"><i class="fa-solid fa-calendar-check"></i></div>
                <div><h4 class="text-[1.45rem] font-[800] text-left leading-none mb-1">+2</h4><span class="text-xs text-[#6b7280] font-semibold block text-left">Años Vigentes</span></div>
            </div>
            <div class="bg-white rounded-[24px] p-6 flex items-center gap-4 text-[#111827] transition duration-300 hover:scale-104 shadow-md">
                <div class="bg-[#f89a20] text-white w-[54px] h-[54px] rounded-[14px] flex items-center justify-center text-2xl flex-shrink-0"><i class="fa-solid fa-gauge-high"></i></div>
                <div><h4 class="text-[1.45rem] font-[800] text-left leading-none mb-1">Máxima</h4><span class="text-xs text-[#6b7280] font-semibold block text-left">Confianza 100%</span></div>
            </div>
        </div>
    </section>

@endsection