@extends('layouts.layout')

@section('title', 'Agregar Distrito - AxisLab')

@section('contenido')
<div class="container mx-auto mt-10 px-4 max-w-2xl mb-20">
    <div class="mb-8">
        <a href="{{ route('admin.distritos.index') }}" class="text-[#6b7280] hover:text-[#f89a20] font-bold text-sm flex items-center gap-2 no-underline transition">
            <i class="fa-solid fa-arrow-left"></i> Volver a la lista
        </a>
        <h2 class="text-[2.2rem] font-[800] text-[#111827] mt-3">Agregar Nuevo Distrito</h2>
    </div>

    <form action="{{ route('admin.distritos.store') }}" method="POST" class="bg-[#e9eaec] rounded-[28px] p-[35px_40px]">
        @csrf

        <div class="mb-5">
            <label class="block text-sm font-bold text-[#111827] mb-2">Nombre del Distrito / Provincia</label>
            <input type="text" name="nombre" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" placeholder="Ej: Miraflores o Cañete" required>
        </div>

        <div class="mb-5">
            <label class="block text-sm font-bold text-[#111827] mb-2">Zona Logística</label>
            <select name="zona_tipo" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" required>
                <option value="Metropolitana">Lima Metropolitana (Local)</option>
                <option value="Provincia">Lima Provincia (Agencia)</option>
            </select>
        </div>

        <div class="mb-8">
            <label class="block text-sm font-bold text-[#111827] mb-2">Costo de Envío (S/.)</label>
            <input type="number" name="precio_envio" step="0.01" min="0" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" placeholder="0.00" required>
        </div>

        <button type="submit" class="w-full bg-[#f89a20] text-white p-4 rounded-[14px] font-bold text-[1.1rem] text-center hover:bg-[#e0891b] transition duration-200 shadow-md">
            Guardar Distrito <i class="fa-solid fa-save ml-1"></i>
        </button>
    </form>
</div>
@endsection