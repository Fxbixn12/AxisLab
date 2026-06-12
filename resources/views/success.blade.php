@extends('layouts.layout')

@section('title', 'Transacción Exitosa - AxisLab')

@section('contenido')

    <div class="mt-10 mb-4">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-[#111827] hover:text-[#f89a20] font-[800] text-2xl no-underline transition duration-150">
            <i class="fa-solid fa-arrow-left"></i> Ir Al Inicio
        </a>
    </div>

    <div class="flex flex-col items-center justify-center text-center mt-10 mb-24 px-4">
        
        <div class="relative mb-8 flex justify-center items-center">
            <div class="absolute w-3 h-9 bg-[#f7ff00] rounded-full -top-4 left-11 -rotate-[25deg]"></div>
            <div class="absolute w-3 h-9 bg-[#f7ff00] rounded-full -top-4 right-11 rotate-[25deg]"></div>
            <div class="absolute w-9 h-3 bg-[#f7ff00] rounded-full top-11 -left-6 -rotate-[15deg]"></div>
            <div class="absolute w-9 h-3 bg-[#f7ff00] rounded-full top-9 -right-6 rotate-[15deg]"></div>
            
            <div class="w-[180px] h-[180px] bg-[#5ccda1] rounded-full flex items-center justify-center text-white text-7xl shadow-[0_10px_25px_rgba(92,205,161,0.3)]">
                <i class="fa-solid fa-check"></i>
            </div>
        </div>

        <h2 class="text-[3.5rem] font-[800] text-[#111827] mb-5 tracking-tight leading-none">¡Transacción exitosa!</h2>
        
        <p class="text-[1.25rem] text-[#111827] font-medium max-w-[600px] mb-6">
            @if(session('success_order'))
                {{ session('success_order') }}
            @else
                Tu pedido ha sido procesado de forma correcta en nuestro almacén técnico.
            @endif
        </p>
        <p class="text-[#6b7280] text-base max-w-[500px] mb-8">
            Hemos enviado a su dirección de correo electrónico el comprobante de pago electrónico junto con el detalle detallado de manufactura de sus piezas 3D.
        </p>

        {{-- Si la orden requiere un flete especial de provincia, Blade renderiza la alerta directamente --}}
        @if(session('tipo_envio') === 'lima_prov' || request()->query('status') === 'approved')
            <div class="bg-[#fff8e1] border-2 border-dashed border-[#ffe082] rounded-[18px] p-[25px_35px] max-w-[620px] shadow-sm animate-fade-in">
                <h5 class="text-[#b78103] text-[1.15rem] font-bold mb-2 flex items-center justify-center gap-2.5">
                    <i class="fa-solid fa-triangle-exclamation"></i> ACCIÓN REQUERIDA DE COORDINACIÓN
                </h5>
                <p class="text-[#5d4037] text-[1rem] font-semibold Skinner leading-relaxed">
                    Debido a la selección de envío interprovincial, recuerde ponerse en contacto de inmediato con nuestra central de soporte de AxisLab para validar la agencia de transportes externa y realizar el seguimiento de su encomienda.
                </p>
            </div>
        @endif
        
        <div class="mt-10">
            <a href="{{ route('catalogo') }}" class="bg-[#f89a20] text-white no-underline px-8 py-4 rounded-[12px] font-bold text-base hover:bg-[#e0891b] hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#f89a20]/35 transition duration-200 inline-block">
                <i class="fa-solid fa-cubes mr-2"></i> Seguir Explorando el Catálogo
            </a>
        </div>
    </div>

@endsection