@extends('layouts.layout')
@section('title', 'Catálogo - AxisLab')
@section('contenido')
    @if(session('success')) 
        <div class="bg-[#d1e7dd] text-[#0f5132] p-4 rounded-xl text-center font-bold mb-5">{{ session('success') }}</div> 
    @endif
    @if(session('error')) 
        <div class="bg-[#f8d7da] text-[#842029] p-4 rounded-xl text-center font-bold mb-5">{{ session('error') }}</div> 
    @endif
    <section class="mt-5 mb-10">
        <div class="flex flex-col items-center gap-6 mb-10">
            <div class="flex gap-3 flex-wrap justify-center">
                <a href="{{ route('catalogo', ['categoria' => 'todos', 'search' => request('search')]) }}" 
                   class="px-[22px] py-[10px] rounded-[25px] font-semibold text-[0.9rem] flex items-center gap-2 transition duration-200 {{ request('categoria', 'todos') == 'todos' ? 'bg-[#f89a20] text-white' : 'bg-[#f4f5f7] text-[#111827] hover:bg-[#e5e7eb]' }}">
                    <i class="fa-solid fa-border-all text-[0.95rem]"></i> Todos los productos
                </a>
                @foreach($categorias as $cat)
                    <a href="{{ route('catalogo', ['categoria' => $cat->id_categoria, 'search' => request('search')]) }}" 
                       class="px-[22px] py-[10px] rounded-[25px] font-semibold text-[0.9rem] transition duration-200 {{ request('categoria') == $cat->id_categoria ? 'bg-[#f89a20] text-white' : 'bg-[#f4f5f7] text-[#111827] hover:bg-[#e5e7eb]' }}">
                        {{ $cat->nombre }}
                    </a>
                @endforeach
            </div>
            <form action="{{ route('catalogo') }}" method="GET" class="relative w-full max-w-[480px]">
                @if(request('categoria')) <input type="hidden" name="categoria" value="{{ request('categoria') }}"> @endif
                <i class="fa-solid fa-magnifying-glass absolute left-[18px] top-1/2 -translate-y-1/2 text-[#6b7280]"></i>
                <input type="text" name="search" class="w-full py-[14px] pr-[20px] pl-[48px] border border-[#e5e7eb] rounded-[30px] text-[0.95rem] outline-none text-[#111827] shadow-[0_2px_6px_rgba(0,0,0,0.02)] transition duration-200 focus:border-[#f89a20] focus:shadow-[0_0_0_3px_rgba(248,154,32,0.15)]" placeholder="Buscar productos..." value="{{ request('search') }}">
            </form>
        </div>
        <div class="text-center mb-10">
            <h2 class="text-[3rem] font-[800]">Catálogo</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-[30px] mb-[60px]">
            @forelse($productos as $producto)
                @php
                    $qtyInCart = isset($carrito[$producto->id_producto]) ? $carrito[$producto->id_producto]['qty'] : 0;
                    $availableStock = $producto->stock - $qtyInCart;
                    $isAgotado = $producto->stock <= 0 || $availableStock <= 0;
                    $isAdmin = auth()->check() && auth()->user()->id_rol == 1;
                @endphp
                <div class="bg-[#f4f5f7] rounded-[24px] p-[24px] flex flex-col h-full border border-transparent transition-all duration-300 group hover:-translate-y-2 hover:bg-white hover:border-[rgba(0,0,0,0.05)] hover:shadow-[0_15px_35px_rgba(0,0,0,0.06)]">
                    <div class="w-full h-[240px] rounded-[16px] overflow-hidden mb-[20px] bg-white flex items-center justify-center">
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-104" loading="lazy">
                    </div>
                    <div class="flex justify-between items-baseline mb-1">
                        <span class="font-[800] text-[1.25rem]">{{ $producto->nombre }}</span>
                        <span class="text-[#f89a20] font-[800] text-[1.25rem] whitespace-nowrap">S/. {{ number_format($producto->precio, 2) }}</span>
                    </div>
                    <div class="text-[#6b7280] text-[0.9rem] mb-[20px]">{{ $producto->categoria->nombre ?? 'Sin Categoría' }}</div>
                    <div class="flex gap-[12px] text-[0.8rem] text-[#6b7280] mb-[25px] flex-wrap">
                        <span class="flex items-center gap-[5px]"><i class="fa-solid fa-palette"></i> Colores: {{ $producto->colores ?? '---' }}</span>
                        <span class="flex items-center gap-[5px]"><i class="fa-solid fa-ruler"></i> Medida: {{ $producto->medida ? $producto->medida . ' cm' : '---' }}</span>
                        <span class="flex items-center gap-[5px]"><i class="fa-solid fa-boxes-stacked"></i> Stock: {{ $availableStock }} u.</span>
                    </div>
                    <div class="mt-auto flex flex-col gap-[10px]">
                        <a href="{{ route('catalogo', ['modal_id' => $producto->id_producto, 'categoria' => request('categoria'), 'search' => request('search')]) }}#modal-detalles" 
                           class="w-full py-[12px] bg-[#55575e] text-white font-[700] rounded-[10px] text-center text-[0.95rem] hover:bg-gray-700 transition duration-200 no-underline">
                            Ver Detalles
                        </a>
                        
                        <!-- Condicional: El botón de agregar al carrito solo aparece si NO es administrador -->
                        @if(!$isAdmin)
                            <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full py-[12px] bg-[#f89a20] text-white font-[700] rounded-[10px] text-[0.95rem] hover:bg-[#e0891b] transition duration-200 hover:-translate-y-[2px] hover:shadow-[0_5px_15px_rgba(248,154,32,0.35)] disabled:bg-[#d1d5db] disabled:text-[#9ca3af] disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none" {{ $isAgotado ? 'disabled' : '' }}>
                                    {{ $isAgotado ? 'Agotado' : 'Agregar al carrito' }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-[60px] text-[#6b7280] text-[1.1rem]">
                    <i class="fa-solid fa-magnifying-glass text-[2rem] mb-[10px] block"></i> 
                    No se encontraron productos que coincidan con los filtros aplicados.
                </div>
            @endforelse
        </div>
        <div class="text-center my-[60px] pt-[20px] flex flex-col items-center gap-[15px]">
            <h3 class="text-[#f89a20] text-[1.6rem] font-[800] tracking-[0.5px]">¿TIENES UN DISEÑO PROPIO? SOLICÍTALO AQUÍ</h3>
            <a href="https://wa.me/51964174894" target="_blank" class="flex items-center justify-center bg-[#00ff66] text-white w-[60px] h-[60px] rounded-full text-[2.2rem] shadow-[0_4px_14px_rgba(0,255,102,0.35)] transition-all duration-200 hover:scale-[1.1] hover:shadow-[0_6px_20px_rgba(0,255,102,0.5)]">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
        </div>
    </section>

    @if(request()->has('modal_id'))
        @php
            $modalProducto = $productos->firstWhere('id_producto', request('modal_id'));
        @endphp
        @if($modalProducto)
            @php
                $modalQty = isset($carrito[$modalProducto->id_producto]) ? $carrito[$modalProducto->id_producto]['qty'] : 0;
                $modalStock = max(0, $modalProducto->stock - $modalQty);
                $modalAgotado = $modalStock <= 0;
                $modalIsAdmin = auth()->check() && auth()->user()->id_rol == 1;
            @endphp
            <div id="modal-detalles" class="fixed inset-0 bg-black/40 backdrop-blur-[2px] flex items-center justify-center z-[2000] p-4">
                <div class="bg-white rounded-[24px] p-10 max-w-[1000px] w-full relative shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] flex flex-col md:flex-row gap-8 items-stretch text-left">
                    <a href="{{ route('catalogo', ['categoria' => request('categoria'), 'search' => request('search')]) }}" class="absolute top-4 right-5 text-[1.6rem] text-gray-400 cursor-pointer transition duration-200 hover:text-[#f89a20] no-underline">&times;</a>
                    <div class="w-full md:w-[50%] h-[520px] rounded-[16px] overflow-hidden bg-white shrink-0">
                        <img src="{{ asset($modalProducto->imagen) }}" alt="{{ $modalProducto->nombre }}" class="w-full h-full object-cover border border-gray-100 rounded-[16px]">
                    </div>
                    <div class="w-full md:w-[50%] flex flex-col justify-between min-h-[520px]">
                        <div class="flex flex-col gap-4">
                            <div>
                                <h3 class="text-3xl font-[800] text-[#111827] tracking-tight leading-tight mb-1">{{ $modalProducto->nombre }}</h3>
                                <span class="text-2xl font-[800] text-[#f89a20]">S/. {{ number_format($modalProducto->precio, 2) }}</span>
                            </div>
                            @if($modalProducto->descripcion)
                                <p class="text-gray-600 text-[0.95rem] leading-relaxed">{{ $modalProducto->descripcion }}</p>
                            @endif
                            <div>
                                <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-2.5">DETALLES TÉCNICOS</h4>
                                <div class="grid grid-cols-3 gap-3 bg-[#f4f5f7] p-4 rounded-[16px]">
                                    <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                                        <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-cube text-gray-400 text-[0.75rem] mr-0.5"></i> Material</span>
                                        <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $modalProducto->material ?? '---' }}</span>
                                    </div>
                                    <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                                        <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-palette text-gray-400 text-[0.75rem] mr-0.5"></i> Colores</span>
                                        <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $modalProducto->colores ?? '---' }}</span>
                                    </div>
                                    <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                                        <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-ruler text-gray-400 text-[0.75rem] mr-0.5"></i> Medida</span>
                                        <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $modalProducto->medida ? $modalProducto->medida . ' cm' : '---' }}</span>
                                    </div>
                                    <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                                        <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-weight-hanging text-gray-400 text-[0.75rem] mr-0.5"></i> Peso</span>
                                        <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $modalProducto->peso ?? '---' }}</span>
                                    </div>
                                    <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                                        <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-fill-drip text-gray-400 text-[0.75rem] mr-0.5"></i> Acabado</span>
                                        <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $modalProducto->acabado ?? '---' }}</span>
                                    </div>
                                    <div class="bg-white p-4 rounded-xl flex flex-col justify-center min-h-[75px] pl-4 border border-transparent shadow-sm">
                                        <span class="text-gray-400 text-[0.7rem] font-bold uppercase block leading-tight"><i class="fa-solid fa-shield-halved text-gray-400 text-[0.75rem] mr-0.5"></i> Resistencia</span>
                                        <span class="text-[#111827] font-extrabold text-base mt-1 leading-none">{{ $modalProducto->resistencia ?? '---' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 w-full mt-auto">
                            <!-- Condicional: El botón de agregar al carrito solo aparece en el modal si NO es administrador -->
                            @if(!$modalIsAdmin)
                                <form action="{{ route('carrito.agregar', $modalProducto->id_producto) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full py-4 bg-[#f89a20] text-white hover:bg-[#e0891b] hover:-translate-y-[2px] hover:shadow-[0_5px_15px_rgba(248,154,32,0.35)] disabled:bg-[#d1d5db] disabled:text-[#9ca3af] disabled:cursor-not-allowed transition duration-200 font-bold rounded-[12px] text-[1rem]" {{ $modalAgotado ? 'disabled' : '' }}>
                                        {{ $modalAgotado ? 'Agotado' : 'Agregar al carrito' }}
                                    </button>
                                </form>
                            @endif
                            @if($modalProducto->usos_posibles)
                                <div>
                                    <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-1.5">POSIBLES USOS</h4>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-4 py-1.5 bg-white border border-gray-200 rounded-full text-xs font-bold text-gray-600 shadow-sm">
                                            {{ $modalProducto->usos_posibles }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection