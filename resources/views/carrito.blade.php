@extends('layouts.layout')

@section('title', 'Carrito de Compras - AxisLab')

@section('contenido')

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded-xl text-center font-bold mb-5">{{ session('error') }}</div>
    @endif

    <div class="mt-10 mb-5">
        <a href="{{ route('catalogo') }}" class="flex items-center gap-4 text-[#111827] font-[800] text-[1.8rem] no-underline">
            <i class="fa-solid fa-arrow-left"></i> Carrito De Compras
        </a>
        @php
            $carrito = session()->get('carrito', []);
            $totalItems = collect($carrito)->sum('qty');
            $subtotal = collect($carrito)->sum(function($item) { return $item['price'] * $item['qty']; });
        @endphp
        <div class="text-[#6b7280] text-[0.95rem] font-semibold ml-11 mt-1">
            {{ $totalItems }} {{ $totalItems == 1 ? 'Producto' : 'Productos' }} En Tu Carrito
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-[50px] mb-20 items-start">
        
        @if(count($carrito) == 0)
            <div class="text-center w-full py-16">
                <i class="fa-solid fa-basket-shopping text-[4.5rem] text-gray-300 mb-5 block"></i>
                <h4 class="text-2xl font-bold text-[#111827] mb-2">Tu carrito está vacío</h4>
                <p class="text-[#6b7280] mb-8">No has agregado ningún artículo a tu lista todavía.</p>
                <a href="{{ route('catalogo') }}" class="bg-[#f89a20] text-white px-9 py-3.5 rounded-[10px] font-bold inline-block hover:bg-[#e0891b] transition shadow-md shadow-[#f89a20]/25">Explorar Catálogo</a>
            </div>
        @else
            <div class="flex-[1.4] w-full flex flex-col gap-[30px]">
                @foreach($carrito as $id => $item)
                    <div class="flex items-center justify-between pb-5 border-b border-[#e5e7eb]">
                        
                        <div class="w-[140px] h-[140px] rounded-[20px] bg-cover bg-center" style="background-image: url('{{ asset($item['img']) }}');"></div>
                        
                        <div class="flex-1 px-6">
                            <h4 class="text-2xl font-bold text-[#111827] mb-1">{{ $item['name'] }}</h4>
                            <p class="text-[#6b7280] text-[0.95rem] font-medium">Accesorio / Impresión 3D</p>
                            
                            <div class="flex items-center gap-4 mt-4">
                                <div class="flex items-center bg-[#f4f5f7] px-3 py-1.5 rounded-full gap-4">
                                    <form action="{{ route('carrito.disminuir', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="font-semibold text-lg cursor-pointer bg-transparent border-none px-1">-</button>
                                    </form>
                                    <span class="font-bold text-[0.95rem] min-w-[15px] text-center">{{ $item['qty'] }}</span>
                                    <form action="{{ route('carrito.incrementar', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="font-semibold text-lg cursor-pointer bg-transparent border-none px-1">+</button>
                                    </form>
                                </div>
                                
                                <form action="{{ route('carrito.eliminar', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-[#6b7280] hover:text-red-500 transition duration-200 ml-2 cursor-pointer bg-transparent border-none text-base">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="text-right min-w-[100px] text-[1.5rem] font-bold text-[#f89a20]">
                            S/. {{ number_format($item['price'] * $item['qty'], 2) }}
                            <span class="block text-xs text-[#6b7280] font-medium mt-1">S/. {{ number_format($item['price'], 2) }} C/Unidad</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex-[0.8] w-full bg-white p-3 rounded-[24px]">
                <h3 class="text-[1.8rem] font-[800] mb-6">Resumen Del Pedido</h3>
                
                <div class="flex justify-between text-[1.3rem] font-medium mb-5 text-[#6b7280]">
                    <span>Subtotal</span>
                    <span>S/. {{ number_format($subtotal, 2) }}</span>
                </div>
                
                <div class="flex justify-between text-[2.2rem] font-[800] text-[#111827] mt-10 mb-7 border-t border-gray-100 pt-4">
                    <span>Total</span>
                    <span class="text-[#f89a20]">S/. {{ number_format($subtotal, 2) }}</span>
                </div>
                
                @guest
                    <div class="bg-[#fffbeb] border border-[#fef3c7] p-3.5 rounded-z-[12px] mb-5 text-[0.9rem] text-[#b45309] flex items-center gap-2.5 line-height-[1.4]">
                        <i class="fa-solid fa-circle-info text-lg text-[#d97706] shrink-0"></i>
                        <span>Debes iniciar sesión o registrarte en la plataforma para poder procesar la compra de tus artículos.</span>
                    </div>
                    
                    <a href="{{ route('login') }}" class="w-full bg-[#f89a20] text-white py-4 rounded-[14px] font-bold text-[1.1rem] text-center block hover:bg-[#e0891b] transition duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#f89a20]/35 no-underline">
                        Inicia Sesión para Comprar
                    </a>
                @endguest
                
                @auth
                    <a href="{{ route('checkout') }}" class="w-full bg-[#f89a20] text-white py-4 rounded-[14px] font-bold text-[1.1rem] text-center block hover:bg-[#e0891b] transition duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#f89a20]/35 no-underline">
                        Comprar
                    </a>
                @endauth
                
                <a href="{{ route('catalogo') }}" class="block text-center mt-5 text-[#6b7280] font-semibold text-[0.95rem] no-underline hover:underline">Continuar Comprando</a>
            </div>
        @endif
    </div>

@endsection