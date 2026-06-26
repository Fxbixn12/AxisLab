@extends('layouts.layout')

@section('title', 'Control de Pedidos - AxisLab')

@section('contenido')
<div class="container mx-auto mt-10 px-4 mb-20">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-[2.2rem] font-[800] text-[#111827] leading-tight">Línea de Producción y Pedidos</h2>
            <p class="text-[#6b7280] text-[0.95rem] mt-1">Monitorea el progreso de fabricación en 3D y despachos globales.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-white text-gray-700 border border-gray-300 px-5 py-3 rounded-[10px] font-bold text-[0.9rem] hover:bg-gray-50 hover:text-[#f89a20] transition duration-200 inline-flex items-center gap-2 no-underline shadow-sm">
            <i class="fa-solid fa-arrow-left-long"></i> Volver al Panel
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-800 p-4 rounded-xl font-bold mb-6 border border-emerald-200 shadow-sm">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-[#e5e7eb] rounded-[24px] overflow-x-auto shadow-[0_10px_30px_rgba(0,0,0,0.02)]">
        <table class="w-full border-collapse text-left whitespace-nowrap">
            <thead>
                <tr class="bg-[#f4f5f7] border-b border-[#e5e7eb]">
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Código</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Cliente / Contacto</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Destino logístico</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Total Facturado</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Estado Operativo</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedidos as $pedido)
                    <tr class="border-b border-[#e5e7eb] last:border-none hover:bg-gray-50/50 transition">
                        <!-- Muestra el string del código generado por la base de datos -->
                        <td class="p-4 px-6 font-bold text-gray-500">{{ $pedido->codigo }}</td>
                        
                        <td class="p-4 px-6">
                            <div class="flex flex-col">
                                <span class="font-bold text-[#111827]">{{ $pedido->nombre }}</span>
                                <span class="text-xs text-[#6b7280] font-medium">{{ $pedido->correo }} | {{ $pedido->telefono }}</span>
                            </div>
                        </td>
                        
                        <td class="p-4 px-6">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-800">{{ $pedido->distrito->nombre ?? 'No especificado' }}</span>
                                <span class="text-xs text-gray-500 max-w-[200px] truncate" title="{{ $pedido->direccion }}">{{ $pedido->direccion }}</span>
                            </div>
                        </td>
                        
                        <td class="p-4 px-6 font-bold text-[#111827]">S/. {{ number_format($pedido->monto_total, 2) }}</td>
                        
                        <!-- Solo lectura del estado para obligar a editar desde el detalle -->
                        <td class="p-4 px-6">
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold uppercase tracking-wider">
                                {{ $pedido->estado_texto }}
                            </span>
                        </td>
                        
                        <td class="p-4 px-6 text-center">
                            <a href="{{ route('admin.pedidos.show', $pedido->id_pedido) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold hover:bg-blue-100 transition no-underline shadow-sm" title="Ver artículos del pedido">
                                <i class="fa-solid fa-magnifying-glass-plus"></i> Ver Detalle y Editar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-12 text-[#6b7280]">
                            <i class="fa-solid fa-receipt text-3xl mb-2 text-[#f89a20] block"></i>
                            Aún no se han registrado transacciones ni pedidos en el sistema.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection