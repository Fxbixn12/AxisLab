<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso - AxisLab</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-orange: #f89a20;
            --primary-orange-hover: #e0891b;
            --dark-gray: #55575e;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --bg-light: #f4f5f7;
            --purple-accent: var(--primary-orange);
            --border-color: #e5e7eb;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #ffffff; color: var(--text-dark); line-height: 1.5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        /* Navbar */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 25px 0; margin-bottom: 20px; }
        .logo { display: flex; align-items: center; font-weight: 800; font-size: 1.3rem; gap: 10px; cursor: pointer; }
        .logo i { font-size: 2.2rem; color: var(--dark-gray); }
        .nav-links { display: flex; gap: 40px; align-items: center; }
        .nav-links a { text-decoration: none; color: var(--text-dark); font-weight: 600; font-size: 0.95rem; transition: color 0.2s ease; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary-orange); }

        /* Auth Container */
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

        /* Error message style */
        .error-box { color: #dc2626; background-color: #fef2f2; border: 1px solid #fee2e2; padding: 12px; border-radius: 10px; font-size: 0.9rem; font-weight: 500; margin-bottom: 15px; display: none; align-items: center; gap: 8px; }

        /* Footer */
        footer { padding: 50px 0 30px; border-top: 1px solid var(--border-color); }
        .footer-top { display: flex; justify-content: space-between; margin-bottom: 50px; }
        .footer-col { display: flex; align-items: flex-start; gap: 15px; }
        .footer-icon { background-color: var(--primary-orange); color: white; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
        .footer-info h5 { font-size: 1rem; font-weight: 700; margin-bottom: 5px; color: var(--text-muted); }
        .footer-info p { color: var(--text-dark); font-weight: 700; font-size: 1rem; }
        .footer-bottom { display: flex; justify-content: space-between; margin-bottom: 40px; }
        .social-links { display: flex; gap: 20px; margin-top: 15px; }
        .social-links a { color: var(--text-dark); font-size: 1.6rem; transition: color 0.2s ease, transform 0.2s ease; }
        .social-links a:hover { color: var(--primary-orange); transform: scale(1.15); }
        .footer-links { display: flex; flex-direction: column; gap: 12px; }
        .footer-links h5 { font-size: 1.15rem; margin-bottom: 5px; font-weight: 700; }
        .footer-links a { color: var(--text-muted); text-decoration: none; font-size: 0.95rem; transition: color 0.2s ease; }
        .footer-links a:hover { color: var(--primary-orange); }
        .copyright { text-align: center; color: var(--text-muted); font-size: 0.9rem; border-top: 1px solid var(--border-color); padding-top: 25px; }
    </style>
</head>
<body>

<div class="container">
    <nav>
        <div class="logo" onclick="window.location.href='{{ route('home') }}'"><i class="fa-solid fa-cube"></i> AxisLab</div>
        <div class="nav-links" id="nav-menu"></div>
    </nav>

    <div class="auth-wrapper">
        <section class="auth-container">
            <div class="auth-card" id="login-card">
                <h3>Iniciar Sesión</h3>
                @if ($errors->has('login_error'))
                    <div class="error-box" id="error-box-login" style="display: block;">
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
                <form action="{{ url('/registrotemporalcambiar') }}" method="POST" id="register-form">
                    <div class="form-group">
                        <input type="text" class="form-control" id="reg-name" placeholder="Nombre completo" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="reg-doc-type" required style="padding-right:40px;">
                            <option value="" disabled selected hidden>Tipo de Documento</option>
                            <option value="DNI">DNI</option>
                            <option value="CE">Carnet de Extranjería</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                        <i class="fa-solid fa-chevron-down input-icon"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="reg-doc" placeholder="Número de documento" required maxlength="12">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="reg-phone" placeholder="Número de teléfono" required maxlength="9">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="reg-birth" placeholder="Fecha de nacimiento" onfocus="(this.type='date')" onblur="(this.value==''?this.type='text':this.type='date')" required>
                        <i class="fa-solid fa-calendar input-icon"></i>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="reg-email" placeholder="Correo electrónico" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input type="password" class="form-control" id="reg-pass" placeholder="Contraseña" required minlength="6">
                    </div>
                    <button type="submit" class="btn-orange">Crear Cuenta</button>
                    <p class="toggle-form-text">¿Ya tienes una cuenta? <a href="#" id="link-to-login">Inicia sesión aquí</a></p>
                </form>
            </div>
        </section>
    </div>

    <footer>
        <div class="footer-top">
            <div class="footer-col" style="flex-direction: column;">
                <h5 style="margin-bottom: 5px; font-size: 1rem;">Información Adicional</h5>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <div class="footer-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="footer-info"><h5>Dirección</h5><p>Enrique Segoviano, Tecsup</p></div>
            </div>
            <div class="footer-col">
                <div class="footer-icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="footer-info"><h5>Email</h5><p>cliente@axislab.com</p></div>
            </div>
            <div class="footer-col">
                <div class="footer-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="footer-info"><h5>Teléfono</h5><p>+51 123 456 789</p></div>
            </div>
        </div>
        <div class="footer-bottom">
            <div style="flex: 1;"><h5 style="font-size: 1.15rem; font-weight: 700;">Redes Sociales</h5></div>
            <div class="footer-links" style="flex: 1; text-align: right; padding-right: 20px;">
                <h5>Links</h5>
                <a href="#">Sobre Nosotros</a>
                <a href="#">F.A.Q</a>
            </div>
        </div>
        <div class="copyright">© AxisLab. Todos los derechos reservados. 2026.</div>
    </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // DEFENSA: Sincronización de pestañas para cierre de sesión global
        window.addEventListener('storage', (event) => {
            if (event.key === 'axislab_current_user' && !event.newValue) {
                alert("Tu sesión ha sido cerrada de forma segura en otra pestaña.");
                window.location.href = '{{ route('login') }}';
            }
        });

        // Inicialización predefinida de los 4 usuarios del sistema
        const defaultUsers = [
            { email: 'admin1@axislab.com', password: 'admin123', role: 'admin', name: 'Carlos Admin' },
            { email: 'admin2@axislab.com', password: 'admin456', role: 'admin', name: 'Ana Admin' },
            { email: 'cliente1@axislab.com', password: 'user123', role: 'client', name: 'Juan Pérez' },
            { email: 'cliente2@axislab.com', password: 'user456', role: 'client', name: 'María López' }
        ];

        if (!localStorage.getItem('axislab_users')) {
            localStorage.setItem('axislab_users', JSON.stringify(defaultUsers));
        }

        // --- DEFENSA: Validación de Rango de Edad (18 a 100 años) ---
        const birthInput = document.getElementById('reg-birth');
        const today = new Date();
        const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate()).toISOString().split('T')[0];
        const minDate = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate()).toISOString().split('T')[0];
        birthInput.setAttribute('max', maxDate);
        birthInput.setAttribute('min', minDate);
        birthInput.addEventListener('change', function() {
            if (this.value > maxDate) {
                alert("Debes ser mayor de 18 años para registrarte.");
                this.value = '';
            } else if (this.value < minDate) {
                alert("Por favor, ingresa una fecha de nacimiento válida.");
                this.value = '';
            }
        });

        function updateNavbar() {
            const navMenu = document.getElementById('nav-menu');
            const currentUser = JSON.parse(localStorage.getItem('axislab_current_user'));
            const masterUsers = JSON.parse(localStorage.getItem('axislab_users')) || [];

            if (currentUser) {
                const realUser = masterUsers.find(u => u.email === currentUser.email);
                if (!realUser || realUser.role !== currentUser.role) {
                    localStorage.removeItem('axislab_current_user');
                    alert("Se ha detectado una alteración en los privilegios de la sesión. Inicia sesión nuevamente.");
                    window.location.reload();
                    return;
                }

                if (currentUser.loginTime) {
                    const timeElapsed = Date.now() - currentUser.loginTime;
                    const maxTime = 1 * 60 * 1000; 
                    if (timeElapsed > maxTime) {
                        localStorage.removeItem('axislab_current_user');
                        localStorage.removeItem('axislab_cart'); 
                        alert("Tu sesión ha expirado por inactividad.");
                        window.location.reload();
                        return; 
                    }
                }   
            }
            
            let linksHtml = `
                <a href="{{ route('home') }}">Inicio</a>
                <a href="{{ route('catalogo') }}">Catálogo</a>
                <a href="{{ route('contacto') }}">Contacto</a>
            `;
            if (currentUser) {
                if (currentUser.role === 'admin') {
                    linksHtml += `<a href="{{ route('carrito') }}">Carrito</a>`; 
                }
                linksHtml += `<a href="#" id="btn-logout" style="color: #dc2626;"><i class="fa-solid fa-power-off"></i> Salir</a>`;
            } else {
                linksHtml += `
                    <a href="{{ route('login') }}" class="active">Iniciar sesión</a>
                    <a href="{{ route('carrito') }}">Carrito</a>
                `;
            }
            
            navMenu.innerHTML = linksHtml;

            const logoutBtn = document.getElementById('btn-logout');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    localStorage.removeItem('axislab_current_user');
                    localStorage.removeItem('axislab_cart');
                    alert('Sesión finalizada correctamente.');
                    window.location.href = '{{ route('login') }}'; 
                });
            }
        }

        updateNavbar();

        const loginForm = document.getElementById('login-form');
        const errorBox = document.getElementById('error-box-login');

        loginForm.addEventListener('submit', (e) => {
            
            const emailInput = document.getElementById('login-email').value.trim().toLowerCase();
            const passwordInput = document.getElementById('login-password').value;

            const registeredUsers = JSON.parse(localStorage.getItem('axislab_users'));
            const userMatched = registeredUsers.find(u => u.email === emailInput && u.password === passwordInput);

            if (userMatched) {
                errorBox.style.display = 'none';
                localStorage.removeItem('axislab_cart');
                localStorage.setItem('axislab_current_user', JSON.stringify({
                    email: userMatched.email,
                    role: userMatched.role,
                    name: userMatched.name,
                    loginTime: Date.now()
                }));

                alert(`Bienvenido, ${userMatched.name}`);
                
                // REDIRECCIÓN INTELIGENTE
                if (userMatched.role === 'admin') {
                    window.location.href = '{{ route('admin.dashboard') }}';
                } else if (localStorage.getItem('axislab_redirect_to_cart') === 'true') {
                    localStorage.removeItem('axislab_redirect_to_cart');
                    window.location.href = '{{ route('carrito') }}';
                } else {
                    window.location.href = '{{ route('catalogo') }}';
                }
            } else {
                errorBox.style.display = 'flex';
                document.getElementById('login-password').value = '';
            }
        });

        const loginCard = document.getElementById('login-card');
        const registerCard = document.getElementById('register-card');
        
        document.getElementById('link-to-register').addEventListener('click', (e) => { 
            e.preventDefault(); 
            loginCard.classList.add('hidden'); 
            registerCard.classList.remove('hidden'); 
        });
        document.getElementById('link-to-login').addEventListener('click', (e) => { 
            e.preventDefault(); 
            registerCard.classList.add('hidden'); 
            loginCard.classList.remove('hidden'); 
        });

        const registerForm = document.getElementById('register-form');
        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const nameInput = document.getElementById('reg-name').value.trim();
            const docTypeInput = document.getElementById('reg-doc-type').value;
            const docNumInput = document.getElementById('reg-doc').value.trim();
            const phoneInput = document.getElementById('reg-phone').value.trim();
            const birthInput = document.getElementById('reg-birth').value;
            const emailInput = document.getElementById('reg-email').value.trim().toLowerCase();
            const passwordInput = document.getElementById('reg-pass').value;

            let currentUsers = JSON.parse(localStorage.getItem('axislab_users')) || [];

            const isDuplicated = currentUsers.some(u => u.email === emailInput);
            if (isDuplicated) {
                alert('Lo sentimos, este correo electrónico ya se encuentra registrado.');
                return;
            }

            const newUser = {
                email: emailInput,
                password: passwordInput,
                role: 'client',
                name: nameInput,
                docType: docTypeInput,
                docNum: docNumInput,
                phone: phoneInput,
                birth: birthInput
            };

            currentUsers.push(newUser);
            localStorage.setItem('axislab_users', JSON.stringify(currentUsers));

            alert('¡Cuenta creada exitosamente! Ahora puedes iniciar sesión con tus credenciales.');
            registerForm.reset();
            registerCard.classList.add('hidden');
            loginCard.classList.remove('hidden');
        });

        document.getElementById('reg-name').addEventListener('input', function() { this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, ''); });
        document.getElementById('reg-doc').addEventListener('input', function() { this.value = this.value.replace(/[^0-9]/g, ''); });
        document.getElementById('reg-phone').addEventListener('input', function() { this.value = this.value.replace(/[^0-9]/g, ''); });
    });
</script>
</body>
</html>

