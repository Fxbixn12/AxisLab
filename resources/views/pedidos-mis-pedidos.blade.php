@extends('layouts.layout')

@section('title', 'Mis Pedidos - AxisLab')

@section('contenido')
<div class="container mx-auto mt-10 px-4 mb-20 max-w-5xl">
    <div class="mb-8">
        <h2 class="text-[2.2rem] font-[800] text-[#111827] leading-tight">Mis Pedidos</h2>
        <p class="text-[#6b7280] text-[0.95rem] mt-1">Aquí puedes ver el estado y seguimiento de todos tus pedidos realizados en AxisLab.</p>
    </div>

    @forelse($pedidos as $pedido)
        <div class="bg-[#f9fafb] border border-[#e5e7eb] rounded-[24px] p-8 mb-8 shadow-sm">
            
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h3 class="text-xl font-[800] text-[#f89a20] tracking-tight">{{ $pedido->codigo }}</h3>
                    <p class="text-xs text-gray-400 font-semibold mt-1">
                        <i class="fa-regular fa-calendar mr-1"></i> {{ $pedido->created_at->format('d \d\e F \d\e Y \a \l\a\s H:i') }}
                    </p>
                </div>
                <div class="flex items-center gap-6">
                    <span class="bg-[#fef3c7] text-[#d97706] px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                        {{ $pedido->estado_texto }}
                    </span>
                    <span class="text-lg font-[800] text-[#111827]">Total: S/. {{ number_format($pedido->monto_total, 2) }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-6 flex flex-col gap-5">
                    <div>
                        <h4 class="text-xs font-[800] text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                            <i class="fa-solid fa-boxes-stacked"></i> Productos
                        </h4>
                        
                        @foreach($pedido->detalles as $detalle)
                            <div class="flex items-center justify-between border border-gray-100 rounded-xl p-4 bg-white mb-3">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset($detalle->producto->imagen ?? 'img/productos/default.jpg') }}" class="w-14 h-14 rounded-lg object-cover bg-gray-50 border">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-[#111827] text-sm">{{ $detalle->producto->nombre ?? 'Producto Removido' }}</span>
                                        <span class="text-xs text-gray-400 font-semibold">S/. {{ number_format($detalle->precio_unitario ?? $detalle->producto->precio, 2) }} c/u</span>
                                    </div>
                                </div>
                                <span class="font-bold text-gray-700 text-sm bg-gray-50 px-2.5 py-1 rounded-md">x{{ $detalle->cantidad }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border border-gray-100 rounded-xl p-5 bg-white flex flex-col gap-2">
                        <h4 class="text-xs font-[800] text-gray-400 uppercase tracking-wider mb-1 flex items-center gap-1.5">
                            <i class="fa-solid fa-truck"></i> Dirección de Envío
                        </h4>
                        <div class="text-sm text-gray-700 font-semibold flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-[#f89a20] mt-0.5"></i>
                            <div class="flex flex-col">
                                <span>{{ $pedido->direccion }}</span>
                                <span class="text-xs text-gray-500 font-medium mt-0.5">{{ $pedido->distrito->nombre ?? 'No definido' }}</span>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600 font-semibold flex items-center gap-2 mt-1">
                            <i class="fa-solid fa-phone text-[#f89a20] text-xs"></i> {{ $pedido->telefono }}
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 lg:pl-8">
                    <h4 class="text-xs font-[800] text-gray-400 uppercase tracking-wider mb-5 flex items-center gap-1.5">
                        <i class="fa-solid fa-list-check"></i> Seguimiento
                    </h4>

                    @php
                        $pasos = [
                            1 => ['titulo' => 'Preparación de materiales', 'sub' => 'En espera o preparación'],
                            2 => ['titulo' => 'Imprimiendo', 'sub' => 'Proyecto en cola o en máquina 3D'],
                            3 => ['titulo' => 'Pedido ya impreso', 'sub' => 'Control de calidad y acabado'],
                            4 => ['titulo' => 'Pedido en camino', 'sub' => 'Asignado al repartidor logístico'],
                            5 => ['titulo' => 'Pedido entregado', 'sub' => 'Recibido conforme en destino']
                        ];
                    @endphp

                    <div class="relative flex flex-col gap-6 pl-2">
                        <div class="absolute left-[17px] top-3 bottom-3 w-[2px] bg-gray-200 z-0"></div>

                        @foreach($pasos as $num => $paso)
                            @php
                                $esActual = $pedido->estado_pedido == $num;
                                $esCompletado = $pedido->estado_pedido > $num;
                            @endphp

                            <div class="flex items-start gap-4 relative z-10">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center font-bold text-xs transition-all duration-300 
                                    {{ $esActual ? 'bg-[#f89a20] text-white ring-4 ring-[#f89a20]/20' : '' }}
                                    {{ $esCompletado ? 'bg-emerald-500 text-white' : '' }}
                                    {{ !$esActual && !$esCompletado ? 'bg-gray-200 text-gray-400' : '' }}">
                                    @if($esCompletado)
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    @else
                                        {{ $num }}
                                    @endif
                                </div>

                                <div class="flex flex-col">
                                    <span class="text-sm font-bold 
                                        {{ $esActual ? 'text-[#f89a20]' : '' }}
                                        {{ $esCompletado ? 'text-gray-800' : '' }}
                                        {{ !$esActual && !$esCompletado ? 'text-gray-400' : '' }}">
                                        {{ $paso['titulo'] }}
                                    </span>
                                    <span class="text-xs font-medium mt-0.5 text-gray-400">
                                        {{ $esActual ? 'En progreso' : ($esCompletado ? 'Completado' : 'Pendiente') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    @empty
        <div class="bg-white border border-gray-100 rounded-[24px] p-16 text-center text-gray-400 shadow-sm">
            <i class="fa-solid fa-box-open text-4xl text-[#f89a20] block mb-3"></i>
            Aún no has realizado ninguna compra en AxisLab. ¡Visita nuestro catálogo!
        </div>
    @endforelse
</div>
@endsection