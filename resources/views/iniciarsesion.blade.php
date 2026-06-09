<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso - AxisLab</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-orange: #f89a20; --primary-orange-hover: #e0891b; --dark-gray: #55575e; --text-dark: #111827; --text-muted: #6b7280; --bg-light: #f4f5f7; --purple-accent: var(--primary-orange); --border-color: #e5e7eb; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #ffffff; color: var(--text-dark); line-height: 1.5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        nav { display: flex; justify-content: space-between; align-items: center; padding: 25px 0; margin-bottom: 20px; }
        .logo { display: flex; align-items: center; font-weight: 800; font-size: 1.3rem; gap: 10px; cursor: pointer; }
        .logo i { font-size: 2.2rem; color: var(--dark-gray); }
        .nav-links { display: flex; gap: 40px; align-items: center; }
        .nav-links a { text-decoration: none; color: var(--text-dark); font-weight: 600; font-size: 0.95rem; transition: color 0.2s ease; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary-orange); }
        .auth-wrapper { display: flex; justify-content: center; align-items: center; margin: 40px 0 80px; }
        .auth-container { background-color: var(--dark-gray); border-radius: 32px; padding: 40px; width: 100%; max-width: 550px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .auth-card { background-color: #ffffff; border-radius: 24px; padding: 40px 35px; display: flex; flex-direction: column; }
        .auth-card h3 { font-size: 1.8rem; font-weight: 800; text-align: center; margin-bottom: 30px; color: var(--text-dark); letter-spacing: -0.5px; }
        .form-group { position: relative; margin-bottom: 14px; }
        .form-control { width: 100%; padding: 12px 40px 12px 16px; border: 1px solid var(--border-color); border-radius: 10px; font-size: 0.95rem; background-color: #f9fafb; color: var(--text-dark); outline: none; transition: all 0.2s ease; appearance: none; }
        .form-control:focus { border-color: var(--primary-orange); background-color: #ffffff; box-shadow: 0 0 0 3px rgba(248, 154, 32, 0.12); }
        .form-group i.input-icon { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); color: #9ca3af; pointer-events: none; font-size: 0.9rem; }
        .form-control:focus ~ i.input-icon { color: var(--primary-orange); }
        .btn-orange { background-color: var(--primary-orange); color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.2s ease; width: 100%; margin-top: 10px; }
        .btn-orange:hover { background-color: var(--primary-orange-hover); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(248, 154, 32, 0.35); }
        .toggle-form-text { text-align: center; margin-top: 20px; font-size: 0.95rem; color: var(--text-muted); }
        .toggle-form-text a { color: var(--primary-orange); font-weight: 700; text-decoration: none; }
        .toggle-form-text a:hover { text-decoration: underline; }
        .hidden { display: none !important; }
        .error-box { color: #dc2626; background-color: #fef2f2; border: 1px solid #fee2e2; padding: 12px; border-radius: 10px; font-size: 0.9rem; font-weight: 500; margin-bottom: 15px; display: none; align-items: center; gap: 8px; }
        footer { padding: 50px 0 30px; border-top: 1px solid var(--border-color); }
        .copyright { text-align: center; color: var(--text-muted); font-size: 0.9rem; border-top: 1px solid var(--border-color); padding-top: 25px; }
    </style>
</head>
<body>

<div class="container">
    
    <nav>
        <div class="logo" onclick="window.location.href='{{ route('home') }}'"><i class="fa-solid fa-cube"></i> AxisLab</div>
        <div class="nav-links" id="nav-menu">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('catalogo') }}">Catálogo</a>
            <a href="{{ route('contacto') }}">Contacto</a>
            
            @guest
                <a href="{{ route('login') }}" class="active">Iniciar sesión</a>
                <a href="{{ route('carrito') }}">Carrito</a>
            @endguest
            
            @auth
                @if(Auth::user()->id_rol == 1)
                    <a href="{{ route('admin.dashboard') }}">Panel Admin</a>
                @else
                    <a href="{{ route('carrito') }}">Carrito</a>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #dc2626;"><i class="fa-solid fa-power-off"></i> Salir</a>
            @endauth
        </div>
    </nav>

    <div class="auth-wrapper">
        <section class="auth-container">
            
            <div class="auth-card" id="login-card">
                <h3>Iniciar Sesión</h3>
                
                @if ($errors->has('login_error'))
                    <div class="error-box" style="display: flex;">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('login_error') }}
                    </div>
                @endif
                
                <form action="{{ route('login.submit') }}" method="POST" id="login-form">
                    @csrf
                    <div class="form-group">
                        <input type="email" id="login-email" name="email" class="form-control" placeholder="Correo electrónico" required value="{{ old('email') }}">
                    </div>
                    <div class="form-group" style="margin-bottom: 25px;">
                        <input type="password" id="login-password" name="password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="btn-orange">Enviar</button>
                    <p class="toggle-form-text">¿No tienes una cuenta? <a href="#" id="link-to-register">Regístrate aquí</a></p>
                </form>
            </div>

            <div class="auth-card hidden" id="register-card">
                <h3>Regístrate</h3>
                
                @if ($errors->any() && !$errors->has('login_error'))
                    <div class="error-box" style="display: flex; flex-direction: column; align-items: flex-start; gap: 4px;">
                        @foreach ($errors->all() as $error)
                            <div><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                
                <form action="{{ route('registro.post') }}" method="POST" id="register-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="reg-name" placeholder="Nombre completo" required>
                    </div>
                    <div class="form-group">
                        <select name="tipo_documento" class="form-control" id="reg-doc-type" required style="padding-right:40px;">
                            <option value="" disabled selected hidden>Tipo de Documento</option>
                            <option value="DNI">DNI</option>
                            <option value="CE">Carnet de Extranjería</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                        <i class="fa-solid fa-chevron-down input-icon"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" name="numero_documento" class="form-control" id="reg-doc" placeholder="Número de documento" required maxlength="12">
                        <i class="fa-solid fa-id-card input-icon"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telefono" class="form-control" id="reg-phone" placeholder="Número de teléfono" required maxlength="9">
                        <i class="fa-solid fa-phone input-icon"></i>
                    </div>
                    <div class="form-group">
                        <input type="date" name="fecha_nacimiento" class="form-control" id="reg-birth" required>
                        <i class="fa-solid fa-calendar input-icon"></i>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="reg-email" placeholder="Correo electrónico" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="reg-pass" placeholder="Contraseña" required minlength="8">
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input type="password" name="password_confirmation" class="form-control" id="reg-pass-confirm" placeholder="Repite la contraseña" required minlength="8">
                    </div>
                    <button type="submit" class="btn-orange">Crear Cuenta</button>
                    <p class="toggle-form-text">¿Ya tienes una cuenta? <a href="#" id="link-to-login">Inicia sesión aquí</a></p>
                </form>
            </div>

        </section>
    </div>

    <footer>
        <div class="copyright">© AxisLab. Todos los derechos reservados. 2026.</div>
    </footer>
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

        // Animación de cambio de tarjetas
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

        // Filtros visuales (bloquear números en el nombre, etc.)
        const regName = document.getElementById('reg-name');
        if (regName) regName.addEventListener('input', function() { this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, ''); });
        
        // --- AQUÍ EMPIEZA EL NUEVO BLOQUE DINÁMICO QUE PEGASTE ---
        const regDocType = document.getElementById('reg-doc-type');
        const regDoc = document.getElementById('reg-doc');
        
        if (regDocType && regDoc) {
            // Cuando el usuario cambia la opción (DNI, CE, Pasaporte)
            regDocType.addEventListener('change', function() {
                regDoc.value = ''; // Limpiamos la caja por seguridad
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

            // Cuando el usuario teclea en la caja
            regDoc.addEventListener('input', function() {
                if (regDocType.value === 'DNI') {
                    // Si es DNI: Solo permitimos números
                    this.value = this.value.replace(/[^0-9]/g, '');
                } else {
                    // Si es CE o Pasaporte: Permitimos letras y números
                    this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
                }
            });
        }
        // --- AQUÍ TERMINA EL NUEVO BLOQUE ---

        // El filtro de teléfono se queda igual, justo debajo
        const regPhone = document.getElementById('reg-phone');
        if (regPhone) regPhone.addEventListener('input', function() { this.value = this.value.replace(/[^0-9]/g, ''); });
    });
</script>
</body>
</html>
