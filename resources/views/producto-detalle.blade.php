@extends('layouts.layout')
@section('title', $producto->nombre . ' - AxisLab')
@section('contenido')
<div class="mt-5 mb-10">
    <a href="{{ route('catalogo') }}" class="text-[#111827] font-bold text-[0.95rem] hover:text-[#f89a20] transition duration-200 inline-flex items-center gap-2">
        <i class="fa-solid fa-arrow-left"></i> Regresar al Catálogo
    </a>
    <div class="bg-white rounded-[24px] p-10 max-w-[950px] mx-auto mt-[30px] shadow-[0_20px_40px_rgba(0,0,0,0.15)] flex flex-col md:flex-row gap-8 items-stretch text-left border border-[#e5e7eb]">
        <div class="w-full md:w-[50%] h-[520px] rounded-[16px] overflow-hidden bg-white shrink-0">
            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover border border-gray-100 rounded-[16px]">
        </div>
        <div class="w-full md:w-[50%] flex flex-col justify-between min-h-[520px]">
            <div class="flex flex-col gap-4">
                <div>
                    <h2 class="text-3xl font-[800] text-[#111827] tracking-tight leading-tight mb-1">{{ $producto->nombre }}</h2>
                    <div class="text-[1.4rem] font-[800] text-[#f89a20] mt-1">
                        S/. {{ number_format($producto->precio, 2) }}
                    </div>
                </div>
                @if($producto->descripcion)
                    <p class="text-gray-600 text-[0.95rem] leading-relaxed">{{ $producto->descripcion }}</p>
                @endif
                <div>
                    <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-2.5">DETALLES TÉCNICOS</h4>
                    <div class="grid grid-cols-3 gap-3 bg-[#f4f5f7] p-4 rounded-[16px]">
                        <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                            <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-cube text-gray-400 text-[0.75rem] mr-0.5"></i> Material</span>
                            <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $producto->material ?? '---' }}</span>
                        </div>
                        <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                            <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-palette text-gray-400 text-[0.75rem] mr-0.5"></i> Colores</span>
                            <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $producto->colores ?? '---' }}</span>
                        </div>
                        <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                            <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-ruler text-gray-400 text-[0.75rem] mr-0.5"></i> Medida</span>
                            <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $producto->medida ? $producto->medida . ' cm' : '---' }}</span>
                        </div>
                        <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                            <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-weight-hanging text-gray-400 text-[0.75rem] mr-0.5"></i> Peso</span>
                            <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $producto->peso ?? '---' }}</span>
                        </div>
                        <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                            <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-fill-drip text-gray-400 text-[0.75rem] mr-0.5"></i> Acabado</span>
                            <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $producto->acabado ?? '---' }}</span>
                        </div>
                        <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                            <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-shield-halved text-gray-400 text-[0.75rem] mr-0.5"></i> Resistencia</span>
                            <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $producto->resistencia ?? '---' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-4 w-full mt-auto">
                @php
                    $carrito = session()->get('carrito', []);
                    $qtyInCart = isset($carrito[$producto->id_producto]) ? $carrito[$producto->id_producto]['qty'] : 0;
                    $isAgotado = ($producto->stock - $qtyInCart) <= 0;
                    $isAdmin = auth()->check() && auth()->user()->id_rol == 1;
                @endphp
                <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST" class="w-full">
                    @csrf
                    @if($isAdmin)
                        <button type="button" class="w-full py-4 bg-[#cbd5e1] text-gray-500 font-bold rounded-[12px] text-[1rem] cursor-not-allowed border-none text-center block tracking-wide">
                            Modo Admin
                        </button>
                    @else
                        <button type="submit" class="w-full py-4 bg-[#f89a20] text-white hover:bg-[#e0891b] hover:-translate-y-[2px] hover:shadow-[0_5px_15px_rgba(248,154,32,0.35)] disabled:bg-[#d1d5db] disabled:text-[#9ca3af] disabled:cursor-not-allowed transition duration-200 font-bold rounded-[12px] text-[1rem]" {{ $isAgotado ? 'disabled' : '' }}>
                            {{ $isAgotado ? 'Agotado' : 'Agregar al carrito' }}
                        </button>
                    @endif
                </form>
                @if($producto->usos_posibles)
                    <div>
                        <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">POSIBLES USOS</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-4 py-1.5 bg-white border border-gray-200 rounded-full text-xs font-bold text-gray-600 shadow-sm">
                                {{ $producto->usos_posibles }}
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection