@extends('layouts.layout')
@section('title', 'Crear Categoría - AxisLab')
@section('contenido')
    <div class="max-w-[650px] mx-auto mt-10 mb-20 bg-white border border-[#e5e7eb] p-8 rounded-[28px] shadow-sm">
        <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
            <div>
                <h3 class="text-2xl font-[800] text-[#111827] tracking-tight">Añadir Nueva Categoría</h3>
                <p class="text-sm text-[#6b7280] mt-0.5">Ingresa el nombre para registrar la agrupación en la base de datos</p>
            </div>
            <a href="{{ route('admin.categorias.edit') }}" class="text-sm font-bold text-[#6b7280] hover:text-[#f89a20] transition no-underline flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left-long"></i> Volver a Gestión
            </a>
        </div>
        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-xl text-sm font-medium mb-6 flex flex-col gap-1">
                @foreach ($errors->all() as $error)
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation text-rose-600"></i> {{ $error }}
                    </div>
                @endforeach
            </div>
        @endif
        <form action="{{ route('admin.categorias.store') }}" method="POST" class="flex flex-col gap-5">
            @csrf
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="nombre">Nombre de la Categoría</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white focus:ring-4 focus:ring-[#f89a20]/10 transition font-medium" required placeholder="Ej. Robótica, Moldes, Accesorios">
            </div>
            <div class="mt-4 border-t border-gray-100 pt-6">
                <button type="submit" class="w-full bg-[#f89a20] text-white py-4 rounded-[12px] font-bold text-base hover:bg-[#e0891b] hover:-translate-y-[2px] hover:shadow-lg hover:shadow-[#f89a20]/35 transition duration-200 cursor-pointer">
                    <i class="fa-solid fa-folder-plus mr-1"></i> Guardar Nueva Categoría
                </button>
            </div>
        </form>
    </div>
@endsection