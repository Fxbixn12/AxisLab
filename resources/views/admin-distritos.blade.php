@extends('layouts.layout')

@section('title', 'Gestión de Envíos - AxisLab')

@section('contenido')
<div class="container mx-auto mt-10 px-4 mb-20">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h2 class="text-[2.2rem] font-[800] text-[#111827] leading-tight">Gestión de Tarifas de Envío</h2>
            <p class="text-[#6b7280] text-[0.95rem] mt-1">Control de distritos, cobertura y costos logísticos de la plataforma.</p>
        </div>
        <div>
            <a href="{{ route('admin.distritos.create') }}" class="bg-[#f89a20] text-white px-6 py-3 rounded-[10px] font-bold text-[0.95rem] hover:bg-[#e0891b] hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#f89a20]/35 transition duration-200 inline-flex items-center gap-2 no-underline">
                <i class="fa-solid fa-plus"></i> Agregar Distrito
            </a>
        </div>
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
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Distrito / Provincia</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Zona Logística</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Costo de Envío</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Estado</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($distritos as $distrito)
                    <tr class="border-b border-[#e5e7eb] last:border-none hover:bg-gray-50/50 transition">
                        <td class="p-4 px-6 font-bold text-[#111827]">{{ $distrito->nombre }}</td>
                        
                        <td class="p-4 px-6">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $distrito->zona_tipo === 'Lima Metropolitana' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                                {{ $distrito->zona_tipo }}
                            </span>
                        </td>
                        
                        <td class="p-4 px-6 font-semibold text-[#111827]">S/. {{ number_format($distrito->precio_envio, 2) }}</td>
                        
                        <td class="p-4 px-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold {{ $distrito->activo ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $distrito->activo ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                {{ $distrito->activo ? 'Habilitado' : 'Oculto' }}
                            </span>
                        </td>
                        
                        <td class="p-4 px-6 text-center">
                            <div class="flex gap-2 justify-center items-center">
                                <a href="{{ route('admin.distritos.edit', $distrito->nombre) }}" class="w-9 h-9 bg-[#fef3c7] text-[#d97706] rounded-lg flex items-center justify-center hover:bg-[#fde68a] transition duration-150 no-underline" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                
                                <form action="{{ route('admin.distritos.destroy', $distrito->nombre) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas ocultar este distrito del catálogo público?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-9 h-9 bg-[#fee2e2] text-rose-600 rounded-lg flex items-center justify-center hover:bg-[#fca5a5] transition duration-150 cursor-pointer border-none" title="Ocultar distrito">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-8 text-[#6b7280]">
                            <i class="fa-solid fa-truck-ramp-box text-2xl mb-2 text-[#f89a20] block"></i>
                            No hay zonas logísticas configuradas en la base de datos.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection