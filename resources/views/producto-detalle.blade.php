@extends('layouts.layout')

@section('title', $producto->nombre . ' - AxisLab')

@section('contenido')

<div class="mt-5 mb-10">
    
    <a href="{{ route('catalogo') }}" class="text-[#111827] font-bold text-[0.95rem] hover:text-[#f89a20] transition duration-200 inline-flex items-center gap-2">
        <i class="fa-solid fa-arrow-left"></i> Regresar al Catálogo
    </a>

    <div class="bg-white rounded-[24px] p-[40px] max-w-[900px] mx-auto mt-[30px] shadow-[0_15px_35px_rgba(0,0,0,0.06)] flex flex-col md:flex-row gap-[40px] items-center border border-[#e5e7eb]">
        
        <div class="w-full md:flex-1 h-[350px] rounded-[16px] overflow-hidden bg-[#f4f5f7] flex items-center justify-center border border-[#e5e7eb]">
            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        </div>

        <div class="w-full md:flex-1 flex flex-col gap-[20px]">
            
            <div>
                <span class="text-[#6b7280] text-[0.95rem] font-semibold uppercase tracking-wider">
                    {{ $producto->categoria->nombre ?? 'Sin Categoría' }}
                </span>
                <h2 class="text-[2.2rem] font-[800] text-[#111827] mt-[5px] leading-tight">
                    {{ $producto->nombre }}
                </h2>
                <div class="text-[1.8rem] font-[800] text-[#f89a20] mt-[10px]">
                    S/. {{ number_format($producto->precio, 2) }}
                </div>
            </div>

            <p class="text-[#111827] text-[1rem] leading-[1.6]">
                {{ $producto->descripcion ?? 'Este modelo exclusivo de AxisLab cuenta con acabados profesionales ideales para coleccionistas, diseñado y fabricado con la máxima precisión técnica en impresión 3D.' }}
            </p>

            <div class="grid grid-cols-2 gap-[15px] text-[0.9rem] text-[#111827] bg-[#f4f5f7] p-[20px] rounded-[16px]">
                <div><strong><i class="fa-solid fa-palette"></i> Colores:</strong> Estándar</div>
                <div><strong><i class="fa-solid fa-ruler"></i> Medida:</strong> M</div>
                <div><strong><i class="fa-solid fa-boxes-stacked"></i> Stock disponible:</strong> {{ $producto->stock }} u.</div>
                <div><strong><i class="fa-solid fa-gear"></i> Tipo:</strong> Personalizado</div>
            </div>

            @php
                $carrito = session()->get('carrito', []);
                $qtyInCart = isset($carrito[$producto->id_producto]) ? $carrito[$producto->id_producto]['qty'] : 0;
                $isAgotado = ($producto->stock - $qtyInCart) <= 0;
                $isAdmin = auth()->check() && auth()->user()->id_rol == 1;
            @endphp

            <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST" class="w-full mt-2">
                @csrf
                <button type="submit" 
                        class="w-full py-[14px] font-[700] rounded-[10px] text-[1rem] transition duration-200 
                               {{ $isAdmin ? 'bg-[#55575e] text-white cursor-not-allowed' : 'bg-[#f89a20] text-white hover:bg-[#e0891b] hover:-translate-y-[2px] hover:shadow-[0_5px_15px_rgba(248,154,32,0.35)] disabled:bg-[#d1d5db] disabled:text-[#9ca3af] disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none' }}" 
                        {{ ($isAgotado || $isAdmin) ? 'disabled' : '' }}>
                    {{ $isAdmin ? 'Modo Admin: Compra deshabilitada' : ($isAgotado ? 'Agotado temporalmente' : 'Agregar al carrito') }}
                </button>
            </form>
            
        </div>
    </div>
</div>

@endsection