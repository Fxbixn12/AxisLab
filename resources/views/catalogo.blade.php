<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - AxisLab</title>
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

        /* Habilitar desplazamiento suave global */
        html {
            scroll-behavior: smooth;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #ffffff;
            color: var(--text-dark);
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Navbar */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 0;
            margin-bottom: 20px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-weight: 800;
            font-size: 1.3rem;
            gap: 10px;
            cursor: pointer;
        }
        
        .logo i {
            font-size: 2.2rem;
            color: var(--dark-gray);
        }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--primary-orange);
        }

        .btn-orange {
            background-color: var(--primary-orange);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .btn-orange:hover:not(:disabled) {
            background-color: var(--primary-orange-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(248, 154, 32, 0.35);
        }

        .btn-orange:active:not(:disabled) {
            transform: translateY(0);
        }

        /* Estilo añadido para reflejar el estado deshabilitado manteniendo la armonía */
        .btn-orange:disabled {
            background-color: #d1d5db;
            color: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Catalog Filters & Search Section */
        .catalog-controls {
            margin-top: 20px;
            margin-bottom: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 25px;
        }

        .filter-tags {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .tag-btn {
            background-color: var(--bg-light);
            border: none;
            padding: 10px 22px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .tag-btn i {
            font-size: 0.95rem;
        }

        .tag-btn.active {
            background-color: var(--primary-orange);
            color: white;
        }

        .tag-btn:hover:not(.active) {
            background-color: #e5e7eb;
        }

        .search-bar-wrapper {
            position: relative;
            width: 100%;
            max-width: 480px;
        }

        .search-bar-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .search-input {
            width: 100%;
            padding: 14px 20px 14px 48px;
            border: 1px solid var(--border-color);
            border-radius: 30px;
            font-size: 0.95rem;
            outline: none;
            color: var(--text-dark);
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
            transition: all 0.2s ease;
        }

        .search-input:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px rgba(248, 154, 32, 0.15);
        }

        .catalog-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .catalog-header h2 {
            font-size: 3rem;
            font-weight: 800;
        }

        /* Unified Catalog Grid & Uniform Cards */
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 60px;
        }

        .product-card {
            background-color: var(--bg-light);
            border-radius: 24px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .product-card:hover {
            transform: translateY(-8px);
            background-color: #ffffff;
            border-color: rgba(0,0,0,0.05);
            box-shadow: 0 15px 35px rgba(0,0,0,0.06);
        }

        .product-img-container {
            width: 100%;
            height: 240px;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 20px;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-img-container img {
            transform: scale(1.04);
        }

        .product-info-top {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 4px;
        }

        .product-title {
            font-weight: 800;
            font-size: 1.25rem;
        }

        .product-price {
            color: var(--purple-accent);
            font-weight: 800;
            font-size: 1.25rem;
            white-space: nowrap;
        }

        .product-category {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .product-attributes {
            display: flex;
            gap: 12px;
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .product-attributes span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .product-actions {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .product-actions .btn-orange {
            width: 100%;
            padding: 12px;
            font-size: 0.95rem;
        }

        .no-results-msg {
            grid-column: span 3;
            text-align: center;
            padding: 60px 0;
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        /* Custom Order CTA Section */
        .custom-design-cta {
            text-align: center;
            margin: 80px 0 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            padding-top: 20px;
        }

        .custom-design-cta h3 {
            color: var(--primary-orange);
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .whatsapp-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #00ff66;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 2.2rem;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(0, 255, 102, 0.35);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .whatsapp-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 255, 102, 0.5);
        }

        /* Footer */
        footer {
            padding: 50px 0 30px;
            border-top: 1px solid var(--border-color);
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 50px;
        }

        .footer-col {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .footer-icon {
            background-color: var(--primary-orange);
            color: white;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .footer-info h5 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-muted);
        }

        .footer-info p {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1rem;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .social-links {
            display: flex;
            gap: 20px;
            margin-top: 15px;
        }

        .social-links a {
            color: var(--text-dark);
            font-size: 1.6rem;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .social-links a:hover {
            color: var(--primary-orange);
            transform: scale(1.15);
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-links h5 {
            font-size: 1.15rem;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: var(--primary-orange);
        }

        .copyright {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
            border-top: 1px solid var(--border-color);
            padding-top: 25px;
        }

        /* Estilos Integrados para la Ventana Modal de Detalles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }
        .modal-wrapper {
            background-color: #ffffff;
            border-radius: 24px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            position: relative;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            gap: 15px;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }
        .modal-overlay.active .modal-wrapper {
            transform: translateY(0);
        }
        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.8rem;
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.2s ease;
        }
        .modal-close:hover {
            color: var(--primary-orange);
        }
        .modal-img-container {
            width: 100%;
            height: 240px;
            border-radius: 16px;
            overflow: hidden;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
        }
        .modal-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .modal-info-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .modal-info-price {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary-orange);
            white-space: nowrap;
        }
        .modal-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            font-size: 0.9rem;
            color: var(--text-dark);
            background-color: var(--bg-light);
            padding: 15px;
            border-radius: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <nav>
        <div class="logo" onclick="window.location.href='index.html'">
            <i class="fa-solid fa-cube"></i> AxisLab
        </div>
        <div class="nav-links" id="nav-menu">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('catalogo') }}" class="active">Catálogo</a>
            <a href="{{ route('contacto') }}">Contacto</a>
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{ route('carrito') }}">Carrito</a>
        </div>
    </nav>

    <section class="catalog" id="catalogo-seccion">
        <div class="catalog-controls">
            <div class="filter-tags">
                <button class="tag-btn active" data-filter="todos"><i class="fa-solid fa-border-all"></i> Todos los productos</button>
                <button class="tag-btn" data-filter="heroes"><i class="fa-solid fa-mask"></i> Heroes</button>
                <button class="tag-btn" data-filter="animales"><i class="fa-solid fa-paw"></i> Animales</button>
                <button class="tag-btn" data-filter="decoracion"><i class="fa-solid fa-wand-magic-sparkles"></i> Decoracion</button>
                <button class="tag-btn" data-filter="videojuegos"><i class="fa-solid fa-gamepad"></i> Videojuegos</button>
                <button class="tag-btn" data-filter="carros"><i class="fa-solid fa-car"></i> Carros</button>
            </div>
            
            <div class="search-bar-wrapper">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="search-products" class="search-input" placeholder="Buscar productos...">
            </div>
        </div>

        <div class="catalog-header">
            <h2>Catálogo</h2>
        </div>
        
        <!-- Renderizado dinámico de productos basado en la base de datos con defensas integradas -->

        <div class="catalog-grid" id="product-grid">
            @foreach($productos as $producto)
                @php
                    // Control funcional de stock basado en la base de datos de tu compañero
                    $isAgotado = $producto->stock <= 0;
                    
                    // Atributos visuales simulados de forma segura para mantener tu diseño original
                    $colorSimulado = "Estándar"; 
                    $medidaSimulada = "M";
                @endphp

                <div class="product-card" data-id="{{ $producto->id_producto }}">
                    <div class="product-img-container">
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" loading="lazy">
                    </div>
                    
                    <div class="product-info-top">
                        <span class="product-title">{{ $producto->nombre }}</span>
                        <span class="product-price">S/. {{ number_format($producto->precio, 2) }}</span>
                    </div>
                    
                    {{-- Acceso seguro a la categoría vinculada por tu compañero --}}
                    <div class="product-category">{{ $producto->categoria->nombre ?? 'Sin Categoría' }}</div>
                    
                    <div class="product-attributes">
                        <span><i class="fa-solid fa-palette"></i> Colores: {{ $colorSimulado }}</span>
                        <span><i class="fa-solid fa-ruler"></i> Medida: {{ $medidaSimulada }}</span>
                        <span><i class="fa-solid fa-boxes-stacked"></i> Stock: {{ $producto->stock }} u.</span>
                    </div>
                    
                    <div class="product-actions">
                        <button class="btn-orange btn-view-details">Ver Detalles</button>
                        
                        {{-- Botón interactivo renderizado por el servidor --}}
                        <button class="btn-orange btn-add-cart" 
                                {{ $isAgotado ? 'disabled' : '' }}
                                data-id="{{ $producto->id_producto }}"
                                data-nombre="{{ $producto->nombre }}"
                                data-precio="{{ $producto->precio }}"
                                data-imagen="{{ $producto->imagen }}">
                            {{ $isAgotado ? 'Agotado' : 'Agregar al carrito' }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="custom-design-cta" id="contacto-wsp">
            <h3>¿TIENES UN DISEÑO PROPIO? SOLICÍTALO AQUÍ</h3>
            <a href="https://wa.me/51123456789" target="_blank" class="whatsapp-btn">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
        </div>
    </section>

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
                <div class="footer-info">
                    <h5>Dirección</h5>
                    <p>Enrique Segoviano, Tecsup</p>
                </div>
            </div>
            <div class="footer-col">
                <div class="footer-icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="footer-info">
                    <h5>Email</h5>
                    <p>cliente@axislab.com</p>
                </div>
            </div>
            <div class="footer-col">
                <div class="footer-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="footer-info">
                    <h5>Teléfono</h5>
                    <p>+51 123 456 789</p>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div style="flex: 1;">
                <h5 style="font-size: 1.15rem; font-weight: 700;">Redes Sociales</h5>
            </div>
            <div class="footer-links" style="flex: 1; text-align: right; padding-right: 20px;">
                <h5>Links</h5>
                <a href="#">Sobre Nosotros</a>
                <a href="#">F.A.Q</a>
            </div>
        </div>

        <div class="copyright">
            © AxisLab. Todos los derechos reservados. 2026.
        </div>
    </footer>
</div>

<div id="modal-detalles" class="modal-overlay">
    <div class="modal-wrapper">
        <span class="modal-close" id="close-modal-btn">&times;</span>
        <div class="modal-img-container">
            <img id="modal-product-img" src="" alt="">
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
            <h3 id="modal-product-name" class="modal-info-title"></h3>
            <span id="modal-product-price" class="modal-info-price"></span>
        </div>
        <p id="modal-product-category" style="color: var(--text-muted); font-size: 0.95rem; margin-top: -10px; font-weight: 500;"></p>
        <div class="modal-details-grid">
            <div><strong><i class="fa-solid fa-palette"></i> Colores:</strong> <span id="modal-product-colors"></span></div>
            <div><strong><i class="fa-solid fa-ruler"></i> Medida:</strong> <span id="modal-product-size"></span></div>
            <div><strong><i class="fa-solid fa-boxes-stacked"></i> Stock disponible:</strong> <span id="modal-product-stock"></span> unidades</div>
            <div><strong><i class="fa-solid fa-gear"></i> Tipo:</strong> Personalizado</div>
        </div>
        <button id="modal-add-to-cart-btn" class="btn-orange" style="width: 100%; margin-top: 10px; padding: 12px; font-size: 0.95rem;">Agregar al carrito</button>
    </div>
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

        // Lógica de Renderizado Dinámico de la barra de navegación idéntica a los demás archivos
        function updateNavbar() {
            const navMenu = document.getElementById('nav-menu');
            const currentUser = JSON.parse(localStorage.getItem('axislab_current_user'));
            const masterUsers = JSON.parse(localStorage.getItem('axislab_users')) || [];

            if (currentUser) {
                // DEFENSA: Validación cruzada contra la base de datos para detectar manipulación de roles (F12)
                const realUser = masterUsers.find(u => u.email === currentUser.email);
                
                if (!realUser || realUser.role !== currentUser.role) {
                    localStorage.removeItem('axislab_current_user');
                    alert("Se ha detectado una alteración en los privilegios de la sesión. Inicia sesión nuevamente.");
                    window.location.reload();
                    return;
                }

                // DEFENSA: Expiración de sesión por inactividad prolongada
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
                <a href="{{ route('catalogo') }}" class="active">Catálogo</a>
                <a href="{{ route('contacto') }}">Contacto</a>
            `;

            if (currentUser) {
                if (currentUser.role === 'admin') {
                    linksHtml += `<a href="{{ route('admin.dashboard') }}">Panel Admin</a>`;
                } else {
                    // Solo los clientes ven el carrito
                    linksHtml += `<a href="{{ route('carrito') }}">Carrito</a>`; 
                }
                linksHtml += `<a href="#" id="btn-logout" style="color: #dc2626;"><i class="fa-solid fa-power-off"></i> Salir</a>`;
            } else {
                linksHtml += `
                    <a href="{{ route('login') }}">Iniciar sesión</a>
                    <a href="{{ route('carrito') }}">Carrito</a>
                `;
            }
            
            navMenu.innerHTML = linksHtml;

            const logoutBtn = document.getElementById('btn-logout');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    localStorage.removeItem('axislab_current_user');
                    localStorage.removeItem('axislab_cart'); // DEFENSA: Limpieza forzada del carrito al salir
                    alert('Sesión finalizada correctamente.');
                    window.location.href = '{{ route('login') }}'; 
                });
            }
        }

        // Ejecutar la actualización del navbar al cargar la página
        updateNavbar();
        
        // Estructura de respaldo idéntica a la configurada en el Panel de Administración
        const initialProducts = [
            { id: "modelo-1", name: "Modelo 1", filterCategory: "heroes", visualCategory: "Accesorio", price: 20, stock: 12, colors: 3, size: "100%", img: "https://images.cults3d.com/H1anxZP7uQpThmQVadnHAZLb5_0=/516x516/filters:no_upscale()/https://fbi.cults3d.com/uploaders/19345976/illustration-file/18095dc9-c53b-4bf4-9faa-653165214f12/superman.png" },
            { id: "modelo-2", name: "Modelo 2", filterCategory: "animales", visualCategory: "Accesorio", price: 25, stock: 15, colors: 3, size: "100%", img: "https://tiendakrear3d.com/wp-content/uploads/2024/01/Captura-de-pantalla-2024-01-24-105715.png" },
            { id: "modelo-3", name: "Modelo 3", filterCategory: "decoracion", visualCategory: "Accesorio", price: 5, stock: 30, colors: 3, size: "100%", img: "https://i.pinimg.com/originals/89/e4/a2/89e4a216632d160cb92f0a0a982107de.png" },
            { id: "modelo-4", name: "Modelo 4", filterCategory: "videojuegos", visualCategory: "Accesorio", price: 15, stock: 5, colors: 2, size: "100%", img: "https://makerworld.bblmw.com/makerworld/model/US337ac02710bed/design/2024-08-22_4a600dced7de9.png?x-oss-process=image/resize,w_1000/format,webp" },
            { id: "modelo-5", name: "Modelo 5", filterCategory: "videojuegos", visualCategory: "Figura", price: 15, stock: 8, colors: 3, size: "100%", img: "https://www.impresoras3d.com/wp-content/uploads/2024/07/Ideas-3D-Nintendo-Switch-Joy-Con-Adapter.jpg" },
            { id: "modelo-6", name: "Modelo 6", filterCategory: "carros", visualCategory: "Figura", price: 25, stock: 3, colors: 3, size: "100%", img: "https://images.cults3d.com/urXY-927nIa5lDmYGbSkpnBqExI=/516x516/filters:no_upscale()/https://fbi.cults3d.com/uploaders/13845051/illustration-file/4818a0ad-b650-4606-9e38-e79bbd35b7e9/4.JPG" },
            { id: "modelo-7", name: "Modelo 7", filterCategory: "decoracion", visualCategory: "Accesorio", price: 25, stock: 10, colors: 3, size: "100%", img: "https://images.cults3d.com/aQw38LVBfVTnIAU_y8BkkEehebA=/516x516/filters:no_upscale()/https://fbi.cults3d.com/uploaders/23497713/illustration-file/373a95bb-116a-4b4e-8062-816220caf7d1/1.jpg" },
            { id: "modelo-8", name: "Modelo 8", filterCategory: "heroes", visualCategory: "Accesorio", price: 25, stock: 7, colors: 3, size: "100%", img: "https://www.papercraft-3d.com/wp-content/uploads/2026/01/papercraft-de-batman-super-hero-en-origami-3d.jpeg" },
            { id: "modelo-9", name: "Modelo 9", filterCategory: "animales", visualCategory: "Accesorio", price: 35, stock: 2, colors: 7, size: "100%", img: "https://www.impresoras3d.com/wp-content/uploads/2019/09/5-Dispensador-de-bolsas-de-caca.jpg" }
        ];

        // Lectura de los productos modificados y confirmados en el panel de administración
        let activeInventory = JSON.parse(localStorage.getItem('axislab_inventory'));
        if (!activeInventory) {
            activeInventory = initialProducts;
            localStorage.setItem('axislab_inventory', JSON.stringify(activeInventory));
        }

        const productGrid = document.getElementById('product-grid');
        const searchInput = document.getElementById('search-products');
        const filterButtons = document.querySelectorAll('.tag-btn');
        
        // Elementos de la Ventana Modal de Detalles
        const modalOverlay = document.getElementById('modal-detalles');
        const closeModalBtn = document.getElementById('close-modal-btn');
        let currentModalProductId = null;

        let currentFilter = 'todos';
        let searchQuery = '';

        // Función auxiliar para obtener de manera directa las unidades separadas en el carrito local
        function getCartQuantities() {
            const cart = JSON.parse(localStorage.getItem('axislab_cart')) || [];
            const quantities = {};
            cart.forEach(item => {
                quantities[item.id] = item.qty;
            });
            return quantities;
        }

        // Función encargada de construir y dibujar las tarjetas dinámicas del inventario activo
        function renderCatalog() {
            productGrid.innerHTML = '';
            const cartQuantities = getCartQuantities();
            
            ///si es administrador, se verifica para opciones de añadido de carrito
            const currentUser = JSON.parse(localStorage.getItem('axislab_current_user'));
            const isAdmin = currentUser && currentUser.role === 'admin';

            const filteredProducts = activeInventory.filter(product => {
                const matchesSearch = product.name.toLowerCase().includes(searchQuery);
                const matchesCategory = currentFilter === 'todos' || product.filterCategory === currentFilter;
                return matchesSearch && matchesCategory;
            });

            if (filteredProducts.length === 0) {
                productGrid.innerHTML = '<div class="no-results-msg"><i class="fa-solid fa-magnifying-glass" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i> No se encontraron productos que coincidan con los filtros aplicados.</div>';
                return;
            }

            filteredProducts.forEach(product => {
                const qtyInCart = cartQuantities[product.id] || 0;
                // Cálculo del stock reactivo en tiempo real
                const availableStock = Math.max(0, product.stock - qtyInCart);
                const isAgotado = product.stock <= 0 || availableStock <= 0;

                const cardHtml = `
                    <div class="product-card" data-id="${product.id}">
                        <div class="product-img-container">
                            <img src="${product.img}" alt="${product.name}" loading="lazy">
                        </div>
                        <div class="product-info-top">
                            <span class="product-title">${product.name}</span>
                            <span class="product-price">S/. ${parseFloat(product.price).toFixed(2)}</span>
                        </div>
                        <div class="product-category">${product.visualCategory}</div>
                        <div class="product-attributes">
                            <span><i class="fa-solid fa-palette"></i> Colores: ${product.colors}</span>
                            <span><i class="fa-solid fa-ruler"></i> Medida: ${product.size}</span>
                            <span><i class="fa-solid fa-boxes-stacked"></i> Stock: ${availableStock} u.</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn-orange btn-view-details">Ver Detalles</button>
                            <button class="btn-orange btn-add-cart" ${(isAgotado || isAdmin) ? 'disabled' : ''} style="${isAdmin ? 'background-color: var(--dark-gray); cursor: not-allowed;' : ''}">
                                ${isAdmin ? 'Modo Admin' : (isAgotado ? 'Agotado' : 'Agregar al carrito')}
                            </button>
                        </div>
                    </div>
                `;
            });
        }

        // Buscador reactivo por texto
        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value.toLowerCase().trim();
            renderCatalog();
        });

        // Filtrado dinámico por tags de categorías
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                currentFilter = button.getAttribute('data-filter');
                renderCatalog();
            });
        });

        // Lógica para agregar productos al carrito controlando el stock disponible del administrador
        function agregarProductoAlCarrito(product) {
            // --- DEFENSA FINAL: Bloqueo de compra para Admin ---
            const user = JSON.parse(localStorage.getItem('axislab_current_user'));
            if (user && user.role === 'admin') {
                alert("Acción no permitida: Los administradores no pueden realizar compras.");
                return;
            }
            
            let cart = JSON.parse(localStorage.getItem('axislab_cart')) || [];
            const existingProduct = cart.find(item => item.id === product.id);
            const currentQtyInCart = existingProduct ? existingProduct.qty : 0;

            if (product.stock <= 0) {
                alert(`Lo sentimos, el producto "${product.name}" se encuentra temporalmente agotado.`);
                return;
            }

            if (currentQtyInCart >= product.stock) {
                alert(`Lo sentimos, no hay suficiente stock disponible para "${product.name}". Stock máximo: ${product.stock}`);
                return;
            }

            if (existingProduct) {
                existingProduct.qty += 1;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    category: `${product.visualCategory} / ${product.filterCategory.charAt(0).toUpperCase() + product.filterCategory.slice(1)}`,
                    price: parseFloat(product.price),
                    img: product.img,
                    qty: 1
                });
            }

            localStorage.setItem('axislab_cart', JSON.stringify(cart));
            alert(`"${product.name}" ha sido añadido a tu carrito de compras de manera exitosa.`);
            
            // Actualizar la interfaz de forma inmediata e interactiva tras la acción
            renderCatalog();
            
            // Si la modal de detalles está abierta al presionar agregar, refrescar sus datos internos
            if (modalOverlay.classList.contains('active') && currentModalProductId === product.id) {
                openDetailsModal(product);
            }
        }

        // Función para abrir la ventana modal con la información detallada del producto
        function openDetailsModal(product) {
            currentModalProductId = product.id;
            const cartQuantities = getCartQuantities();
            const qtyInCart = cartQuantities[product.id] || 0;
            const availableStock = Math.max(0, product.stock - qtyInCart);

            // --- NUEVA VALIDACIÓN PARA ADMIN EN MODAL ---
            const currentUser = JSON.parse(localStorage.getItem('axislab_current_user'));
            const isAdmin = currentUser && currentUser.role === 'admin';

            document.getElementById('modal-product-img').src = product.img;
            document.getElementById('modal-product-img').alt = product.name;
            document.getElementById('modal-product-name').textContent = product.name;
            document.getElementById('modal-product-price').textContent = `S/. ${parseFloat(product.price).toFixed(2)}`;
            document.getElementById('modal-product-category').textContent = `${product.visualCategory} / ${product.filterCategory.charAt(0).toUpperCase() + product.filterCategory.slice(1)}`;
            document.getElementById('modal-product-colors').textContent = product.colors;
            document.getElementById('modal-product-size').textContent = product.size;
            
            // Mostrar de forma coherente el stock disponible real restante para este cliente
            document.getElementById('modal-product-stock').textContent = availableStock;
            
            const modalAddBtn = document.getElementById('modal-add-to-cart-btn');
            
            // --- LÓGICA DE BLOQUEO EN MODAL ---
            if (isAdmin) {
                modalAddBtn.textContent = "Modo Admin: No disponible";
                modalAddBtn.style.backgroundColor = "var(--dark-gray)";
                modalAddBtn.disabled = true;
            } else if (product.stock <= 0 || availableStock <= 0) {
                modalAddBtn.textContent = "Agotado";
                modalAddBtn.disabled = true;
            } else {
                modalAddBtn.textContent = "Agregar al carrito";
                modalAddBtn.style.backgroundColor = "var(--primary-orange)";
                modalAddBtn.disabled = false;
            }
            
            modalOverlay.classList.add('active');
        }

        // Controladores para cerrar la ventana modal de detalles
        closeModalBtn.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
        });

        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('active');
            }
        });

        // Evento de escucha para añadir productos al carrito desde adentro de la modal de detalles
        document.getElementById('modal-add-to-cart-btn').addEventListener('click', () => {
            if (currentModalProductId) {
                const product = activeInventory.find(item => item.id === currentModalProductId);
                if (product) {
                    agregarProductoAlCarrito(product);
                }
            }
        });

        // Manejador del catálogo usando delegación de eventos para las acciones de las tarjetas dinámicas
        productGrid.addEventListener('click', (e) => {
            const addBtn = e.target.closest('.btn-add-cart');
            const detailsBtn = e.target.closest('.btn-view-details');
            
            if (addBtn || detailsBtn) {
                const card = e.target.closest('.product-card');
                const productId = card.getAttribute('data-id');
                const product = activeInventory.find(item => item.id === productId);
                
                if (product) {
                    if (addBtn) {
                        agregarProductoAlCarrito(product);
                    } else if (detailsBtn) {
                        openDetailsModal(product);
                    }
                }
            }
        });

        // Primer renderizado oficial del catálogo al arrancar
        renderCatalog();
    });
</script>
</body>
</html>