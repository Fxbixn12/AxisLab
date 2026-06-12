@extends('layouts.layout')

@section('title', 'Acceso - AxisLab')

@section('contenido')

    <div class="flex justify-center items-center mt-10 mb-20">
        
        <section class="bg-[#55575e] rounded-[32px] p-10 w-full max-w-[550px] shadow-xl">
            
            <div class="bg-white rounded-[24px] p-10 flex flex-col transition-all duration-300" id="login-card">
                <h3 class="text-[1.8rem] font-[800] text-center mb-[30px] text-[#111827] tracking-tight">Iniciar Sesión</h3>
                
                @if ($errors->has('login_error'))
                    <div class="text-[#dc2626] bg-[#fef2f2] border border-[#fee2e2] p-3 rounded-[10px] text-sm font-medium mb-[15px] flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('login_error') }}
                    </div>
                @endif
                
                <form action="{{ route('login.post') }}" method="POST" id="login-form">
                    @csrf
                    <div class="relative mb-3.5">
                        <input type="email" id="login-email" name="email" class="w-full p-[12px_40px_12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white focus:ring-4 focus:ring-[#f89a20]/10 transition font-medium" placeholder="Correo electrónico" required value="{{ old('email') }}">
                    </div>
                    <div class="relative mb-6">
                        <input type="password" id="login-password" name="password" class="w-full p-[12px_40px_12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white focus:ring-4 focus:ring-[#f89a20]/10 transition font-medium" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="w-full bg-[#f89a20] text-white py-3.5 rounded-[10px] font-bold text-base hover:bg-[#e0891b] hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#f89a20]/35 transition duration-200 cursor-pointer">
                        Enviar
                    </button>
                    <p class="text-center mt-5 text-sm text-[#6b7280]">¿No tienes una cuenta? <a href="#" id="link-to-register" class="text-[#f89a20] font-bold hover:underline">Regístrate aquí</a></p>
                </form>
            </div>

            <div class="bg-white rounded-[24px] p-10 flex flex-col transition-all duration-300 hidden" id="register-card">
                <h3 class="text-[1.8rem] font-[800] text-center mb-[30px] text-[#111827] tracking-tight">Regístrate</h3>
                
                @if ($errors->any() && !$errors->has('login_error'))
                    <div class="text-[#dc2626] bg-[#fef2f2] border border-[#fee2e2] p-3 rounded-[10px] text-sm font-medium mb-[15px] flex flex-col gap-1 items-start">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center gap-2"><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                
                <form action="{{ route('registro.post') }}" method="POST" id="register-form">
                    @csrf
                    <div class="relative mb-3.5">
                        <input type="text" name="name" class="w-full p-[12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" id="reg-name" placeholder="Nombre completo" required value="{{ old('name') }}">
                    </div>
                    <div class="relative mb-3.5">
                        <select name="tipo_documento" class="w-full p-[12px_40px_12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none appearance-none focus:border-[#f89a20] focus:bg-white transition font-medium" id="reg-doc-type" required>
                            <option value="" disabled selected hidden>Tipo de Documento</option>
                            <option value="DNI" {{ old('tipo_documento') == 'DNI' ? 'selected' : '' }}>DNI</option>
                            <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>Carnet de Extranjería</option>
                            <option value="Pasaporte" {{ old('tipo_documento') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-[#9ca3af] pointer-events-none text-xs"></i>
                    </div>
                    <div class="relative mb-3.5">
                        <input type="text" name="numero_documento" class="w-full p-[12px_40px_12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" id="reg-doc" placeholder="Número de documento" required maxlength="12" value="{{ old('numero_documento') }}">
                        <i class="fa-solid fa-id-card absolute right-5 top-1/2 -translate-y-1/2 text-[#9ca3af] pointer-events-none text-sm"></i>
                    </div>
                    <div class="relative mb-3.5">
                        <input type="text" name="telefono" class="w-full p-[12px_40px_12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" id="reg-phone" placeholder="Número de teléfono" required maxlength="9" value="{{ old('telefono') }}">
                        <i class="fa-solid fa-phone absolute right-5 top-1/2 -translate-y-1/2 text-[#9ca3af] pointer-events-none text-sm"></i>
                    </div>
                    <div class="relative mb-3.5">
                        <input type="date" name="fecha_nacimiento" class="w-full p-[12px_40px_12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" id="reg-birth" required value="{{ old('fecha_nacimiento') }}">
                        <i class="fa-solid fa-calendar absolute right-5 top-1/2 -translate-y-1/2 text-[#9ca3af] pointer-events-none text-sm hidden"></i>
                    </div>
                    <div class="relative mb-3.5">
                        <input type="email" name="email" class="w-full p-[12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" id="reg-email" placeholder="Correo electrónico" required value="{{ old('email') }}">
                    </div>
                    <div class="relative mb-3.5">
                        <input type="password" name="password" class="w-full p-[12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" id="reg-pass" placeholder="Contraseña" required minlength="8">
                    </div>
                    <div class="relative mb-5">
                        <input type="password" name="password_confirmation" class="w-full p-[12px_16px] border border-[#e5e7eb] rounded-[10px] text-[0.95rem] bg-[#f9fafb] text-[#111827] outline-none focus:border-[#f89a20] focus:bg-white transition font-medium" id="reg-pass-confirm" placeholder="Repite la contraseña" required minlength="8">
                    </div>
                    <button type="submit" class="w-full bg-[#f89a20] text-white py-3.5 rounded-[10px] font-bold text-base hover:bg-[#e0891b] hover:-translate-y-0.5 hover:shadow-lg hover:shadow-[#f89a20]/35 transition duration-200 cursor-pointer">
                        Crear Cuenta
                    </button>
                    <p class="text-center mt-5 text-sm text-[#6b7280]">¿Ya tienes una cuenta? <a href="#" id="link-to-login" class="text-[#f89a20] font-bold hover:underline">Inicia sesión aquí</a></p>
                </form>
            </div>

        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loginCard = document.getElementById('login-card');
            const registerCard = document.getElementById('register-card');

            // Mantener la tarjeta de registro abierta si hay errores de validación de registro
            @if($errors->any() && !$errors->has('login_error'))
                loginCard.classList.add('hidden');
                registerCard.classList.remove('hidden');
            @endif

            // Animación de cambio de tarjetas (Login / Registro)
            const linkToRegister = document.getElementById('link-to-register');
            if (linkToRegister) {
                linkToRegister.addEventListener('click', (e) => { 
                    e.preventDefault(); 
                    loginCard.classList.add('hidden'); 
                    registerCard.classList.remove('hidden'); 
                });
            }

            const linkToLogin = document.getElementById('link-to-login');
            if (linkToLogin) {
                linkToLogin.addEventListener('click', (e) => { 
                    e.preventDefault(); 
                    registerCard.classList.add('hidden'); 
                    loginCard.classList.remove('hidden'); 
                });
            }

            // Filtros de entrada para restringir caracteres inválidos
            const regName = document.getElementById('reg-name');
            if (regName) {
                regName.addEventListener('input', function() { 
                    this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, ''); 
                });
            }
            
            const regDocType = document.getElementById('reg-doc-type');
            const regDoc = document.getElementById('reg-doc');
            
            if (regDocType && regDoc) {
                regDocType.addEventListener('change', function() {
                    regDoc.value = ''; // Limpiamos la caja al alternar tipos
                    if (this.value === 'DNI') {
                        regDoc.setAttribute('maxlength', '8');
                        regDoc.setAttribute('placeholder', 'Número de DNI (8 dígitos)');
                    } else if (this.value === 'CE') {
                        regDoc.setAttribute('maxlength', '9');
                        regDoc.setAttribute('placeholder', 'Carnet de Extranjería');
                    } else {
                        regDoc.setAttribute('maxlength', '12');
                        regDoc.setAttribute('placeholder', 'Número de Pasaporte');
                    }
                });

                regDoc.addEventListener('input', function() {
                    if (regDocType.value === 'DNI') {
                        this.value = this.value.replace(/[^0-9]/g, ''); // Solo números para DNI
                    } else {
                        this.value = this.value.replace(/[^a-zA-Z0-9]/g, ''); // Alfanumérico para pasaporte/CE
                    }
                });
            }

            const regPhone = document.getElementById('reg-phone');
            if (regPhone) {
                regPhone.addEventListener('input', function() { 
                    this.value = this.value.replace(/[^0-9]/g, ''); 
                });
            }
        });
    </script>

@endsection