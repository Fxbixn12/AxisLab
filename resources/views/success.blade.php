@extends('layouts.layout')

@section('title', 'Transacción Exitosa - AxisLab')

@section('contenido')

    <div class="mt-10 mb-4">
        <a href="{{ route('catalogo') }}" class="inline-flex items-center gap-3 text-[#111827] hover:text-[#f89a20] font-[800] text-2xl no-underline transition duration-150">
            <i class="fa-solid fa-arrow-left"></i> Ir Al Catálogo
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

        <h2 class="text-[3.5rem] font-[800] text-[#111827] mb-[15px] tracking-tight leading-none">¡Transacción exitosa!</h2>
        
        <p class="text-[1.1rem] text-[#6b7280] font-medium max-w-[600px] mb-6">
            Hemos enviado a su correo la información de su compra.
        </p>

        <div class="bg-[#f3f4f6] rounded-[18px] p-5 w-full max-w-[360px] text-center mb-8 border border-gray-100 flex flex-col gap-1 shadow-sm">
            <span class="text-gray-500 font-bold text-sm">
                Número de pedido: 
                <span class="text-[#f89a20]">
                    @if(session('success_code'))
                        {{ session('success_code') }}
                    @else
                        {{ request()->query('external_reference') ?? 'AXIS-028438' }}
                    @endif
                </span>
            </span>
            <span class="text-gray-500 font-bold text-sm">
                Total pagado: 
                <span class="text-[#f89a20]">
                    S/. @if(session('success_total'))
                        {{ number_format(session('success_total'), 2) }}
                    @else
                        {{ number_format(request()->query('total_paid') ?? 40.00, 2) }}
                    @endif
                </span>
            </span>
        </div>

        @if(session('tipo_envio') === 'lima_prov')
            <div class="bg-[#fff8e1] border-2 border-dashed border-[#ffe082] rounded-[18px] p-[25px_35px] max-w-[620px] shadow-sm mb-10">
                <h5 class="text-[#b78103] text-[1.15rem] font-bold mb-2 flex items-center justify-center gap-2.5">
                    <i class="fa-solid fa-triangle-exclamation"></i> ACCIÓN REQUERIDA DE COORDINACIÓN
                </h5>
                <p class="text-[#5d4037] text-[1rem] font-semibold leading-relaxed">
                    Due a la selección de envío interprovincial, recuerde ponerse en contacto de inmediato con nuestra central de soporte de AxisLab para validar la agencia de transportes externa y realizar el seguimiento de su encomienda.
                </p>
            </div>
        @endif
    </div>

@endsection