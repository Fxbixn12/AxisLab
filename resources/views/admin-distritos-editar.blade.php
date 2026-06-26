@extends('layouts.layout')

@section('title', 'Editar Distrito - AxisLab')

@section('contenido')
<div class="container mx-auto mt-10 px-4 max-w-2xl mb-20">
    <div class="mb-8">
        <a href="{{ route('admin.distritos.index') }}" class="text-[#6b7280] hover:text-[#f89a20] font-bold text-sm flex items-center gap-2 no-underline transition">
            <i class="fa-solid fa-arrow-left"></i> Volver a la lista
        </a>
        <h2 class="text-[2.2rem] font-[800] text-[#111827] mt-3">Editar Distrito: {{ $distrito->nombre }}</h2>
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

    <form action="{{ route('admin.distritos.update', $distrito->nombre) }}" method="POST" class="bg-[#e9eaec] rounded-[28px] p-[35px_40px]">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block text-sm font-bold text-[#111827] mb-2">Nombre del Distrito</label>
            <input type="text" name="nombre" value="{{ old('nombre', $distrito->nombre) }}" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" required>
        </div>

        <div class="mb-5">
            <label class="block text-sm font-bold text-[#111827] mb-2">Zona Logística</label>
            <select name="zona_tipo" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" required>
                <option value="Lima Metropolitana" {{ old('zona_tipo', $distrito->zona_tipo) == 'Lima Metropolitana' ? 'selected' : '' }}>Lima Metropolitana (Local)</option>
                <option value="Provincia" {{ old('zona_tipo', $distrito->zona_tipo) == 'Provincia' ? 'selected' : '' }}>Provincia (Agencia)</option>
            </select>
        </div>

        <div class="mb-5">
            <label class="block text-sm font-bold text-[#111827] mb-2">Costo de Envío (S/.)</label>
            <input type="number" name="precio_envio" value="{{ old('precio_envio', $distrito->precio_envio) }}" step="0.01" min="0" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" required>
        </div>

        <div class="mb-8">
            <label class="block text-sm font-bold text-[#111827] mb-2">Disponibilidad de Entrega</label>
            <select name="activo" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" required>
                <option value="1" {{ old('activo', $distrito->activo) == 1 ? 'selected' : '' }}>Habilitado (Mostrar en Checkout)</option>
                <option value="0" {{ old('activo', $distrito->activo) == 0 ? 'selected' : '' }}>Deshabilitado (Ocultar)</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-[#f89a20] text-white p-4 rounded-[14px] font-bold text-[1.1rem] text-center hover:bg-[#e0891b] transition duration-200 shadow-md border-none cursor-pointer">
            Actualizar Cambios <i class="fa-solid fa-rotate ml-1"></i>
        </button>
    </form>
</div>
@endsection