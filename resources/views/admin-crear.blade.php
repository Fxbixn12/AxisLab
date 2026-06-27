@extends('layouts.layout')

@section('title', 'Añadir Producto - AxisLab')

@section('contenido')
    <div class="max-w-[650px] mx-auto mt-10 mb-20 bg-white border border-[#e5e7eb] p-8 rounded-[28px] shadow-sm">
        <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
            <div>
                <h3 class="text-2xl font-[800] text-[#111827] tracking-tight">Añadir Nuevo Producto</h3>
                <p class="text-sm text-[#6b7280] mt-0.5">Ingresa los datos para registrarlo en la base de datos</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-[#6b7280] hover:text-[#f89a20] transition no-underline flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left-long"></i> Volver al Panel
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

        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            @csrf
            
            <div class="flex flex-col gap-1.5 sm:col-span-2">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="nombre">Nombre del Producto</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white focus:ring-4 focus:ring-[#f89a20]/10 transition font-medium" required placeholder="Ej. Kit de Engranajes V3">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="id_categoria">Categoría</label>
                <div class="relative">
                    <select id="id_categoria" name="id_categoria" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium appearance-none" required>
                        <option value="" disabled selected hidden>Seleccione...</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}" {{ old('id_categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-[#6b7280] pointer-events-none text-xs"></i>
                </div>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="descripcion">Descripción / Tipo</label>
                <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" required placeholder="Ej. Resina de alta resistencia">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="precio">Precio (S/.)</label>
                <input type="number" id="precio" name="precio" step="0.01" value="{{ old('precio') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" required placeholder="0.00">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="stock">Stock Inicial</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" required placeholder="0">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="material">Material</label>
                <input type="text" id="material" name="material" value="{{ old('material') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Ej: PLA, ABS, Resina">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="colores">Colores</label>
                <input type="text" id="colores" name="colores" value="{{ old('colores') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Ej: Rojo, Negro, Estándar">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="medida">Medida</label>
                <input type="text" id="medida" name="medida" value="{{ old('medida') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Ej: 15 o 20x10 (sin poner 'cm')">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="peso">Peso</label>
                <input type="text" id="peso" name="peso" value="{{ old('peso') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Ej: 20g, 150g">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="acabado">Acabado</label>
                <input type="text" id="acabado" name="acabado" value="{{ old('acabado') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Ej: Mate, Brillante">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="resistencia">Resistencia</label>
                <input type="text" id="resistencia" name="resistencia" value="{{ old('resistencia') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Ej: Alta, Media">
            </div>

            <div class="flex flex-col gap-1.5 sm:col-span-2">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="usos_posibles">POSIBLES USOS</label>
                <input type="text" id="usos_posibles" name="usos_posibles" value="{{ old('usos_posibles') }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" placeholder="Ej: Alimentación de animales, Decoración">
            </div>

            <div class="flex flex-col gap-1.5 sm:col-span-2">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="imagen">Imagen del Producto</label>
                <input type="file" id="imagen" name="imagen" class="w-full p-3 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-[#f89a20]/10 file:text-[#f89a20] hover:file:bg-[#f89a20]/20 cursor-pointer" accept="image/*" required>
            </div>

            <div class="mt-4 sm:col-span-2 border-t border-gray-100 pt-6">
                <button type="submit" class="w-full bg-[#f89a20] text-white py-4 rounded-[12px] font-bold text-base hover:bg-[#e0891b] hover:-translate-y-[2px] hover:shadow-lg hover:shadow-[#f89a20]/35 transition duration-200 cursor-pointer">
                    <i class="fa-solid fa-cloud-arrow-up mr-1"></i> Guardar Nuevo Producto
                </button>
            </div>
        </form>
    </div>
@endsection