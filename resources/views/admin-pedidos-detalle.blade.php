@extends('layouts.layout')

@section('title', 'Detalle del Pedido - AxisLab')

@section('contenido')
<div class="container mx-auto mt-10 px-4 mb-20 max-w-4xl">
    
    <div class="mb-8">
        <a href="{{ route('admin.pedidos.index') }}" class="text-[#6b7280] hover:text-[#f89a20] font-bold text-sm flex items-center gap-2 no-underline transition">
            <i class="fa-solid fa-arrow-left"></i> Volver a la lista de producción
        </a>
        <!-- Muestra el código alfanumérico en la cabecera -->
        <h2 class="text-[2.2rem] font-[800] text-[#111827] mt-3">Pedido {{ $pedido->codigo }}</h2>
        <p class="text-sm text-gray-500 font-semibold mt-1">
            Cliente: <span class="text-gray-800">{{ $pedido->nombre }}</span> | Registrado el: {{ $pedido->created_at->format('d/m/Y H:i') }}
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="md:col-span-2 flex flex-col gap-6">
            
            <div class="bg-white border border-[#e5e7eb] rounded-[24px] p-6 shadow-sm">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-cubes text-[#f89a20]"></i> Modelos y Artículos
                </h3>
                
                <div class="flex flex-col gap-4">
                    @foreach($pedido->detalles as $detalle)
                        <div class="flex items-center justify-between border-b border-gray-100 pb-4 last:border-none last:pb-0">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset($detalle->producto->imagen ?? 'img/productos/default.jpg') }}" class="w-16 h-16 rounded-xl object-cover bg-gray-50 border">
                                <div class="flex flex-col">
                                    <span class="font-bold text-[#111827]">{{ $detalle->producto->nombre ?? 'Producto Removido' }}</span>
                                    <span class="text-xs text-gray-500">Precio unitario: S/. {{ number_format($detalle->precio_unitario ?? $detalle->producto->precio, 2) }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="font-bold text-gray-800 block">x{{ $detalle->cantidad }}</span>
                                <span class="text-sm font-semibold text-[#f89a20]">S/. {{ number_format(($detalle->precio_unitario ?? $detalle->producto->precio) * $detalle->cantidad, 2) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t border-gray-100 mt-6 pt-4 flex justify-between items-center font-bold text-lg text-[#111827]">
                    <span>Total Facturado:</span>
                    <span class="text-2xl font-[800]">S/. {{ number_format($pedido->monto_total, 2) }}</span>
                </div>
            </div>

            <div class="bg-white border border-[#e5e7eb] rounded-[24px] p-6 shadow-sm">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-map-location-dot text-[#f89a20]"></i> Información de Entrega
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm font-medium">
                    <div>
                        <span class="text-xs text-gray-400 block uppercase">Dirección Completa</span>
                        <span class="text-gray-800 block mt-0.5">{{ $pedido->direccion }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 block uppercase">Zonificación / Distrito</span>
                        <span class="text-gray-800 block mt-0.5">{{ $pedido->distrito->nombre ?? 'No especificado' }} ({{ $pedido->distrito->zona_tipo ?? 'N/A' }})</span>
                    </div>
                    <div class="sm:col-span-2 border-t border-gray-50 pt-3 mt-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <span class="text-xs text-gray-400 block uppercase">Teléfono de Contacto</span>
                            <span class="text-gray-800 block mt-0.5"><i class="fa-solid fa-phone text-xs text-gray-400 mr-1"></i> {{ $pedido->telefono }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 block uppercase">Correo Electrónico</span>
                            <span class="text-gray-800 block mt-0.5"><i class="fa-solid fa-envelope text-xs text-gray-400 mr-1"></i> {{ $pedido->correo }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Panel lateral derecho donde se centraliza la edición del estado (Sin emojis) -->
        <div class="md:col-span-1">
            <div class="bg-[#e9eaec] rounded-[24px] p-6 sticky top-6">
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-gray-700"></i> Estado del Envío
                </h3>

                <form action="{{ route('admin.pedidos.updateEstado', $pedido->id_pedido) }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold text-gray-600 uppercase" for="estado_pedido">Fase actual</label>
                        <select name="estado_pedido" id="estado_pedido" class="w-full p-3 bg-white border border-transparent rounded-xl text-xs font-bold text-gray-700 outline-none focus:border-[#f89a20] transition cursor-pointer">
                            <option value="1" {{ $pedido->estado_pedido == 1 ? 'selected' : '' }}>Preparación de materiales</option>
                            <option value="2" {{ $pedido->estado_pedido == 2 ? 'selected' : '' }}>Imprimiendo</option>
                            <option value="3" {{ $pedido->estado_pedido == 3 ? 'selected' : '' }}>Pedido ya impreso</option>
                            <option value="4" {{ $pedido->estado_pedido == 4 ? 'selected' : '' }}>Pedido en camino</option>
                            <option value="5" {{ $pedido->estado_pedido == 5 ? 'selected' : '' }}>Pedido entregado</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-[#f89a20] text-white p-3.5 rounded-xl font-bold text-sm text-center hover:bg-[#e0891b] transition duration-200 shadow-sm border-none cursor-pointer">
                        Actualizar Fase <i class="fa-solid fa-rotate ml-1 text-xs"></i>
                    </button>
                </form>

                <div class="mt-6 border-t border-gray-300/60 pt-4 text-[11px] text-gray-500 font-medium flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle text-orange-400 text-[8px]"></i> Estado público actual:
                    </div>
                    <div class="bg-white/80 p-2.5 rounded-lg border border-gray-300/40 text-center font-bold text-gray-700 text-xs">
                        {{ $pedido->estado_texto }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection