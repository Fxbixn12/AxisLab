@extends('layouts.layout')

@section('title', 'Panel de Administración - AxisLab')

@section('contenido')

    @if(session('success'))
        <div class="bg-emerald-100 text-emerald-800 p-4 rounded-xl text-center font-bold mb-5 border border-emerald-200">
            <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-rose-100 text-rose-800 p-4 rounded-xl text-center font-bold mb-5 border border-rose-200">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-10 mb-6 gap-4">
        <div>
            <h2 class="text-[2.2rem] font-[800] text-[#111827] leading-tight">Panel de Control</h2>
            <p class="text-[#6b7280] text-[0.95rem]">Gestiona el inventario global de tu plataforma AxisLab</p>
        </div>
        <div>
            <a href="{{ route('admin.productos.create') }}" class="bg-[#f89a20] text-white px-6 py-3 rounded-[10px] font-bold text-[0.95rem] hover:bg-[#e0891b] hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#f89a20]/35 transition duration-200 inline-flex items-center gap-2 no-underline">
                <i class="fa-solid fa-plus"></i> Añadir Producto
            </a>
        </div>
    </div>

    @php
        $totalProductos = $productos->count();
        $stockTotal = $productos->sum('stock');
        $stockBajo = $productos->where('stock', '<=', 4)->count();
        $totalCategorias = $categorias->count();
    @endphp
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
        <div class="bg-[#f4f5f7] p-5 rounded-[16px] flex items-center gap-4 border border-gray-100">
            <div class="w-12 h-12 bg-white rounded-[12px] flex items-center justify-center text-xl text-[#f89a20] shadow-sm"><i class="fa-solid fa-box"></i></div>
            <div><h5 class="text-[0.85rem] text-[#6b7280] font-bold uppercase tracking-wider">Productos</h5><p class="text-2xl font-[800]">{{ $totalProductos }}</p></div>
        </div>
        <div class="bg-[#f4f5f7] p-5 rounded-[16px] flex items-center gap-4 border border-gray-100">
            <div class="w-12 h-12 bg-white rounded-[12px] flex items-center justify-center text-xl text-[#f89a20] shadow-sm"><i class="fa-solid fa-boxes-stacked"></i></div>
            <div><h5 class="text-[0.85rem] text-[#6b7280] font-bold uppercase tracking-wider">Stock Total</h5><p class="text-2xl font-[800]">{{ $stockTotal }} u.</p></div>
        </div>
        <div class="bg-[#f4f5f7] p-5 rounded-[16px] flex items-center gap-4 border border-gray-100">
            <div class="w-12 h-12 bg-white rounded-[12px] flex items-center justify-center text-xl text-[#f89a20] shadow-sm"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div><h5 class="text-[0.85rem] text-[#6b7280] font-bold uppercase tracking-wider">Stock Bajo</h5><p class="text-2xl font-[800] text-rose-600">{{ $stockBajo }}</p></div>
        </div>
        <div class="bg-[#f4f5f7] p-5 rounded-[16px] flex items-center gap-4 border border-gray-100">
            <div class="w-12 h-12 bg-white rounded-[12px] flex items-center justify-center text-xl text-[#f89a20] shadow-sm"><i class="fa-solid fa-tags"></i></div>
            <div><h5 class="text-[0.85rem] text-[#6b7280] font-bold uppercase tracking-wider">Categorías</h5><p class="text-2xl font-[800]">{{ $totalCategorias }}</p></div>
        </div>
    </div>

    <div class="bg-white border border-[#e5e7eb] rounded-[24px] overflow-x-auto shadow-[0_10px_30px_rgba(0,0,0,0.02)] mb-14">
        <table class="w-full border-collapse text-left whitespace-nowrap">
            <thead>
                <tr class="bg-[#f4f5f7] border-b border-[#e5e7eb]">
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Imagen</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Nombre</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Categoría</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Precio</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Stock</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider">Descripción</th>
                    <th class="p-[18px_24px] font-bold text-[0.9rem] text-[#111827] uppercase tracking-wider text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                    <tr class="border-b border-[#e5e7eb] last:border-none hover:bg-gray-50/50 transition">
                        <td class="p-4 px-6"><img src="{{ asset($producto->imagen) }}" class="w-[55px] h-[55px] rounded-[10px] object-cover bg-[#f4f5f7]" alt="{{ $producto->nombre }}"></td>
                        <td class="p-4 px-6 font-bold text-[#111827]">{{ $producto->nombre }}</td>
                        <td class="p-4 px-6"><span class="bg-[#f4f5f7] px-3 py-1 rounded-full text-xs font-semibold text-[#55575e]">{{ $producto->categoria->nombre ?? 'Sin Categoría' }}</span></td>
                        <td class="p-4 px-6 font-semibold text-[#111827]">S/. {{ number_format($producto->precio, 2) }}</td>
                        <td class="p-4 px-6"><span class="font-bold text-[0.95rem] {{ $producto->stock <= 4 ? 'text-rose-600' : 'text-emerald-600' }}">{{ $producto->stock }} u.</span></td>
                        <td class="p-4 px-6 text-[#6b7280] text-sm">{{ Str::limit($producto->descripcion, 40) }}</td>
                        <td class="p-4 px-6 text-center">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('admin.productos.edit', $producto->id_producto) }}" class="w-9 h-9 bg-[#fef3c7] text-[#d97706] rounded-lg flex items-center justify-center hover:bg-[#fde68a] transition duration-150 no-underline">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-9 h-9 bg-[#fee2e2] text-rose-600 rounded-lg flex items-center justify-center hover:bg-[#fca5a5] transition duration-150 cursor-pointer border-none">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-8 text-[#6b7280]">
                            <i class="fa-solid fa-box-open text-2xl mb-2 text-[#f89a20] block"></i>
                            No hay productos en la base de datos relacional.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection