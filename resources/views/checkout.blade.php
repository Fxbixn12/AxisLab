@extends('layouts.layout')

@section('title', 'Despacho y Pago - AxisLab')

@section('contenido')

    @php
        $carrito = session()->get('carrito', []);
        $totalItems = collect($carrito)->sum('qty');
        $subtotal = collect($carrito)->sum(function($item) { return $item['price'] * $item['qty']; });
        
        // Recuperamos el costo de envío si ya se seleccionó un distrito en la recarga
        $costoEnvio = session()->get('checkout_costo_envio', 0);
        $totalFinal = $subtotal + $costoEnvio;
    @endphp

    @if(session('error'))
        <div class="bg-rose-100 text-rose-800 p-4 rounded-xl text-center font-bold mb-5 border border-rose-200">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="mt-10 mb-5">
        <a href="{{ route('carrito') }}" class="flex items-center gap-4 text-[#111827] font-[800] text-[1.8rem] no-underline hover:text-[#f89a20] transition">
            <i class="fa-solid fa-arrow-left"></i> Volver Al Carrito De Compras
        </a>
        <div class="text-[#6b7280] text-[0.95rem] font-semibold ml-11 mt-1">
            {{ $totalItems }} {{ $totalItems == 1 ? 'Producto' : 'Productos' }} En Tu Carrito
        </div>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST" class="flex flex-col lg:flex-row gap-[60px] mb-20 items-start">
        @csrf

        <div class="flex-[1.2] w-full bg-[#e9eaec] rounded-[28px] p-[35px_40px]">
            
            <h4 class="text-[1.5rem] font-[800] mb-[25px] text-[#111827]">Dirección de Despacho</h4>
            
            <div class="relative mb-[18px]">
                <input type="text" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" name="nombre" placeholder="Nombre completo del destinatario" required value="{{ old('nombre', Auth::user()->name ?? '') }}">
            </div>
            
            <div class="relative mb-[18px]">
                <select name="id_distrito" onchange="this.form.action='{{ route('checkout.update_tarifa') }}'; this.form.submit();" class="w-full p-[14px_40px_14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium appearance-none focus:border-[#f89a20] transition" required>
                    <option value="" disabled {{ !old('id_distrito') && !session('checkout_id_distrito') ? 'selected' : '' }} hidden>Seleccione la zona de destino...</option>
                    
                    <optgroup label="LIMA METROPOLITANA">
                        @foreach($distritos_metro as $distrito)
                            <option value="{{ $distrito->id_distrito }}" {{ old('id_distrito', session('checkout_id_distrito')) == $distrito->id_distrito ? 'selected' : '' }}>
                                {{ $distrito->nombre }} (S/. {{ number_format($distrito->precio_envio, 2) }})
                            </option>
                        @endforeach
                    </optgroup>
                    
                    <optgroup label="LIMA PROVINCIAS">
                        @foreach($distritos_prov as $distrito)
                            <option value="{{ $distrito->id_distrito }}" {{ old('id_distrito', session('checkout_id_distrito')) == $distrito->id_distrito ? 'selected' : '' }}>
                                {{ $distrito->nombre }} (S/. {{ number_format($distrito->precio_envio, 2) }})
                            </option>
                        @endforeach
                    </optgroup>
                </select>
                <i class="fa-solid fa-chevron-down absolute right-[20px] top-1/2 -translate-y-1/2 text-[#111827] pointer-events-none text-[0.9rem]"></i>
            </div>
            
            <div class="relative mb-[18px]">
                <input type="text" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" name="direccion" placeholder="Dirección exacta de entrega" required value="{{ old('direccion', session('checkout_direccion', '')) }}">
            </div>
            
            <div class="relative mb-[18px]">
                <input type="email" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" name="correo" placeholder="Dirección de correo electrónico" required value="{{ old('correo', Auth::user()->email ?? '') }}">
            </div>
            
            <div class="relative mb-[35px]">
                <input type="text" class="w-full p-[14px_20px] bg-white border border-transparent rounded-[12px] text-[0.95rem] text-[#111827] outline-none font-medium focus:border-[#f89a20] transition" name="telefono" placeholder="Teléfono de contacto" required maxlength="9" value="{{ old('telefono', session('checkout_telefono', '')) }}">
            </div>

            <h4 class="text-[1.5rem] font-[800] mb-[25px] text-[#111827]">Garantía de Pago</h4>
            <div class="bg-white p-4 rounded-xl border border-gray-200 flex items-center gap-3 text-sm font-semibold text-gray-700 shadow-sm">
                <i class="fa-solid fa-shield-halved text-xl text-[#f89a20]"></i>
                <span>La pasarela oficial se cargará en la siguiente pantalla mediante Mercado Pago.</span>
            </div>
        </div>

        <div class="flex-1 w-full pt-2.5">
            <h3 class="text-[2rem] font-[800] mb-[30px]">Resumen Del Pedido</h3>
            
            <div class="mb-[35px] max-h-[240px] overflow-y-auto pr-1.5">
                @forelse($carrito as $item)
                    <div class="flex justify-between text-[1.15rem] font-semibold text-[#6b7280] mb-[12px]">
                        <span>{{ $item['qty'] }}x {{ $item['name'] }}</span>
                        <span class="text-black font-[700]">S/. {{ number_format($item['price'] * $item['qty'], 2) }}</span>
                    </div>
                @empty
                    <div class="text-[#6b7280] font-semibold">El carrito se encuentra vacío en el servidor</div>
                @endforelse
            </div>
            
            <div class="border-t border-[#e5e7eb] pt-[25px] mb-[35px]">
                <div class="flex justify-between text-[1.4rem] font-medium text-[#6b7280] mb-[15px]">
                    <span>Subtotal Artículos</span>
                    <span class="text-black font-[700]">S/. {{ number_format($subtotal, 2) }}</span>
                </div>
                
                <div class="flex justify-between text-sm font-medium text-[#6b7280] bg-gray-50 p-3 rounded-lg border border-dashed border-gray-200 mb-[15px]">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-calculator text-[#f89a20]"></i> Costo de envío:</span>
                    <span class="text-black font-bold">S/. {{ number_format($costoEnvio, 2) }}</span>
                </div>

                <div class="flex justify-between text-[1.6rem] font-[800] text-[#111827] pt-[15px] border-t border-solid border-[#e5e7eb]">
                    <span>Total Final</span>
                    <span class="text-[#f89a20]">S/. {{ number_format($totalFinal, 2) }}</span>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-[#f89a20] text-white p-4 rounded-[14px] font-bold text-[1.1rem] text-center hover:bg-[#e0891b] transition duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#f89a20]/35 cursor-pointer" {{ count($carrito) == 0 ? 'disabled' : '' }}>
                Continuar a Mercado Pago <i class="fa-solid fa-chevron-right text-xs ml-1"></i>
            </button>
        </div>
    </form>
@endsection