@extends('layouts.layout')
@section('title', 'Gestión de Categorías - AxisLab')
@section('contenido')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-10 mb-6 gap-4">
        <div>
            <h2 class="text-[2.2rem] font-[800] text-[#111827] leading-tight">Gestión de Categorías</h2>
            <p class="text-[#6b7280] text-[0.95rem]">Modifica nombres de agrupación en las cajas o altera su visibilidad en tiempo real</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.categorias.create') }}" class="bg-[#f89a20] text-white px-5 py-3 rounded-[10px] font-bold text-[0.9rem] hover:bg-[#e0891b] hover:-translate-y-0.5 transition duration-200 inline-flex items-center gap-2 no-underline shadow-sm">
                <i class="fa-solid fa-plus"></i> Añadir Nueva Categoría
            </a>
            <a href="{{ route('admin.dashboard') }}" class="bg-white text-gray-700 border border-gray-300 px-6 py-3 rounded-[10px] font-bold text-[0.95rem] hover:bg-gray-50 transition duration-200 inline-flex items-center gap-2 no-underline shadow-sm">
                <i class="fa-solid fa-arrow-left-long"></i> Volver al Panel
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-800 p-4 rounded-xl text-center font-bold mb-5 border border-emerald-200">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="max-w-[750px] bg-white border border-[#e5e7eb] rounded-[24px] overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.02)] mb-20">
        <table class="w-full border-collapse text-left whitespace-nowrap">
            <thead>
                <tr class="bg-[#f4f5f7] border-b border-[#e5e7eb]">
                    <th class="p-[16px_24px] font-bold text-[0.85rem] text-[#111827] uppercase tracking-wider">Nombre de Agrupación</th>
                    <th class="p-[16px_24px] font-bold text-[0.85rem] text-[#111827] uppercase tracking-wider">Estado Actual</th>
                    <th class="p-[16px_24px] font-bold text-[0.85rem] text-[#111827] uppercase tracking-wider text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr class="border-b border-[#e5e7eb] last:border-none hover:bg-gray-50/50 transition">
                        <form action="{{ route('admin.categorias.update', $categoria->id_categoria) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td class="p-4 px-6">
                                <div class="flex items-center gap-2">
                                    <input type="text" name="nombre" value="{{ $categoria->nombre }}" required class="border border-gray-300 px-3 py-2 rounded-lg text-sm text-[#111827] font-semibold bg-gray-50 focus:bg-white focus:border-[#f89a20] focus:outline-none w-[240px]">
                                    <button type="submit" class="w-9 h-9 bg-[#e0f2fe] text-[#0369a1] rounded-lg flex items-center justify-center hover:bg-[#bae6fd] transition duration-150 border-none cursor-pointer" title="Guardar cambios de nombre">
                                        <i class="fa-solid fa-floppy-disk text-sm"></i>
                                    </button>
                                </div>
                            </td>
                        </form>

                        <td class="p-4 px-6">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold {{ $categoria->activo ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $categoria->activo ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                {{ $categoria->activo ? 'Habilitado' : 'Oculto' }}
                            </span>
                        </td>

                        <td class="p-4 px-6 text-center">
                            <form action="{{ route('admin.categorias.update', $categoria->id_categoria) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="toggle_status" value="1">
                                <input type="hidden" name="activo" value="{{ $categoria->activo ? 0 : 1 }}">
                                @if($categoria->activo)
                                    <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-600 rounded-lg text-xs font-bold hover:bg-rose-100 transition cursor-pointer border-none" title="Desactivar categoría">
                                        <i class="fa-solid fa-eye-slash mr-1"></i> Desactivar
                                    </button>
                                @else
                                    <button type="submit" class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-lg text-xs font-bold hover:bg-emerald-100 transition cursor-pointer border-none" title="Activar categoría">
                                        <i class="fa-solid fa-eye mr-1"></i> Activar
                                    </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection