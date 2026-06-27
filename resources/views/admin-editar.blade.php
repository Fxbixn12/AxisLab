@extends('layouts.layout')

@section('title', 'Editar Producto - AxisLab')

@section('contenido')
    <div class="max-w-[650px] mx-auto mt-10 mb-20 bg-white border border-[#e5e7eb] p-8 rounded-[28px] shadow-sm">
        <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
            <div>
                <h3 class="text-2xl font-[800] text-[#111827] tracking-tight">Editar Producto</h3>
                <p class="text-sm text-[#6b7280] mt-0.5">Modifica los campos necesarios del producto</p>
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

        <form action="{{ route('admin.productos.update', $producto->id_producto) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            @csrf
            @method('PUT')
            
            <div class="flex flex-col gap-1.5 sm:col-span-2">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="nombre">Nombre del Producto</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white focus:ring-4 focus:ring-[#f89a20]/10 transition font-medium" required>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="id_categoria">Categoría</label>
                <div class="relative">
                    <select id="id_categoria" name="id_categoria" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium appearance-none" required>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}" {{ old('id_categoria', $producto->id_categoria) == $categoria->id_categoria ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-[#6b7280] pointer-events-none text-xs"></i>
                </div>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="descripcion">Descripción / Tipo</label>
                <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion', $producto->descripcion) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" required>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="precio">Precio (S/.)</label>
                <input type="number" id="precio" name="precio" step="0.01" value="{{ old('precio', $producto->precio) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" required>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="stock">Stock</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" required>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="material">Material</label>
                <input type="text" id="material" name="material" value="{{ old('material', $producto->material) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="colores">Colores</label>
                <input type="text" id="colores" name="colores" value="{{ old('colores', $producto->colores) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="medida">Medida</label>
                <input type="text" id="medida" name="medida" value="{{ old('medida', $producto->medida) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="peso">Peso</label>
                <input type="text" id="peso" name="peso" value="{{ old('peso', $producto->peso) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="acabado">Acabado</label>
                <input type="text" id="acabado" name="acabado" value="{{ old('acabado', $producto->acabado) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="resistencia">Resistencia</label>
                <input type="text" id="resistencia" name="resistencia" value="{{ old('resistencia', $producto->resistencia) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium">
            </div>

            <div class="flex flex-col gap-1.5 sm:col-span-2">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="usos_posibles">POSIBLES USOS</label>
                <input type="text" id="usos_posibles" name="usos_posibles" value="{{ old('usos_posibles', $producto->usos_posibles) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="activo">Estado del Producto</label>
                <div class="relative">
                    <select id="activo" name="activo" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium appearance-none" required>
                        <option value="1" {{ old('activo', $producto->activo) == 1 ? 'selected' : '' }}>Activo (Visible)</option>
                        <option value="0" {{ old('activo', $producto->activo) == 0 ? 'selected' : '' }}>Desactivado (Oculto)</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-[#6b7280] pointer-events-none text-xs"></i>
                </div>
            </div>

            <div class="flex flex-col gap-1.5 sm:col-span-2 border-t border-gray-100 pt-4 mt-2">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide">Imagen del Producto</label>
                <div class="flex items-center gap-4 bg-[#f4f5f7] p-3 rounded-[12px] border border-[#e5e7eb]">
                    <div class="w-16 h-16 rounded-lg overflow-hidden border border-gray-200 bg-white flex-shrink-0">
                        <img src="{{ asset($producto->imagen) }}" alt="Actual" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 mb-1 font-medium">Subir una nueva foto para reemplazar la actual (Opcional):</p>
                        <input type="file" id="imagen" name="imagen" class="text-xs font-medium text-[#111827] file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-[#f89a20]/10 file:text-[#f89a20] hover:file:bg-[#f89a20]/20 cursor-pointer" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="mt-4 sm:col-span-2 border-t border-gray-100 pt-6">
                <button type="submit" class="w-full bg-[#f89a20] text-white py-4 rounded-[12px] font-bold text-base hover:bg-[#e0891b] hover:-translate-y-[2px] hover:shadow-lg hover:shadow-[#f89a20]/35 transition duration-200 cursor-pointer">
                    <i class="fa-solid fa-floppy-disk mr-1"></i> Actualizar Producto
                </button>
            </div>
        </form>
    </div>
@endsection