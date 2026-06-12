@extends('layouts.layout')

@section('title', 'Editar Producto - AxisLab')

@section('contenido')

    <div class="max-w-[650px] mx-auto mt-10 mb-20 bg-white border border-[#e5e7eb] p-8 rounded-[28px] shadow-sm">
        
        <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
            <div>
                <h3 class="text-2xl font-[800] text-[#111827] tracking-tight">Editar Atributos</h3>
                <p class="text-sm text-[#6b7280] mt-0.5">Modificando el producto: <span class="text-[#f89a20] font-bold">#{{ $producto->id_producto }}</span></p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-[#6b7280] hover:text-[#f89a20] transition no-underline flex items-center gap-1.5">
                <i class="fa-solid fa-xmark"></i> Cancelar
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
        
        <form action="{{ route('admin.productos.update', $producto->id_producto) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-5">
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
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="stock">Stock Disponible</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" required>
            </div>

            <div class="flex flex-col gap-1.5 sm:col-span-2">
                <label class="text-xs font-bold text-[#55575e] uppercase tracking-wide" for="imagen">Ruta o URL de la Imagen</label>
                <input type="text" id="imagen" name="imagen" value="{{ old('imagen', $producto->imagen) }}" class="w-full p-3.5 bg-[#f4f5f7] border border-[#e5e7eb] rounded-[12px] text-[0.95rem] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" required>
            </div>

            <div class="mt-4 sm:col-span-2 border-t border-gray-100 pt-6">
                <button type="submit" class="w-full bg-[#10b981] text-white py-4 rounded-[12px] font-bold text-base hover:bg-[#059669] hover:-translate-y-0.5 hover:shadow-lg hover:shadow-emerald-500/25 transition duration-200 cursor-pointer">
                    <i class="fa-solid fa-circle-check mr-1"></i> Actualizar Cambios en Almacén
                </button>
            </div>
        </form>
    </div>

@endsection