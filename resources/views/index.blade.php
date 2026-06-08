<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AxisLab</title>
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

        /* Hero Section */
        .hero-section {
            background-color: var(--dark-gray);
            border-radius: 30px;
            padding: 50px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 80px;
            gap: 40px;
        }

        .hero-content {
            max-width: 50%;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 25px;
        }

        .hero-content p {
            font-size: 1rem;
            color: #d1d5db;
            margin-bottom: 35px;
            max-width: 90%;
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

        .btn-orange:hover {
            background-color: var(--primary-orange-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(248, 154, 32, 0.35);
        }

        .hero-form-card {
            background-color: white;
            border-radius: 24px;
            padding: 35px;
            width: 440px;
            z-index: 2;
            color: var(--text-dark);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .hero-form-card h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.6rem;
            font-weight: 800;
        }

        .form-group {
            margin-bottom: 14px;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 12px 40px 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.95rem;
            background-color: #f9fafb;
            color: var(--text-dark);
            outline: none;
            transition: all 0.3s ease;
            appearance: none;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .form-control:focus {
            border-color: var(--primary-orange);
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(248, 154, 32, 0.15);
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .form-control:focus ~ .input-icon {
            color: var(--primary-orange);
        }

        .hero-form-card .btn-orange {
            width: 100%;
            margin-top: 10px;
            padding: 14px;
        }

        /* Features Section */
        .features {
            background-color: var(--bg-light);
            border-radius: 30px;
            padding: 50px 40px;
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-bottom: 100px;
            gap: 40px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }

        .feature-item {
            flex: 1;
            transition: transform 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 3.2rem;
            margin-bottom: 18px;
            color: var(--text-dark);
        }

        .feature-item h3 {
            font-size: 1.3rem;
            margin-bottom: 12px;
            font-weight: 700;
        }

        .feature-item p {
            color: var(--text-muted);
            font-size: 0.95rem;
            padding: 0 15px;
        }

        /* Process Section */
        .process-section {
            display: flex;
            align-items: center;
            gap: 60px;
            margin-bottom: 100px;
        }

        .process-image {
            flex: 1;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .process-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .process-steps {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .step {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .step-number {
            background-color: var(--purple-accent);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
            font-size: 0.95rem;
        }

        .step-content h4 {
            font-size: 1.15rem;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .step-content p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Catalog Section */
        .catalog-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .catalog-header h2 {
            font-size: 2.8rem;
            font-weight: 800;
        }

        .catalog-header a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s ease;
        }

        .catalog-header a:hover {
            color: var(--primary-orange);
        }

        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 100px;
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

        /* Stats Section */
        .stats-section {
            background-color: var(--dark-gray);
            border-radius: 30px;
            padding: 60px;
            text-align: center;
            color: white;
            margin-bottom: 80px;
        }

        .stats-section h2 {
            font-size: 2.8rem;
            margin-bottom: 15px;
            font-weight: 800;
        }

        .stats-section p {
            color: #d1d5db;
            margin-bottom: 50px;
            font-size: 1.05rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stat-card {
            background-color: white;
            border-radius: 24px;
            padding: 25px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--text-dark);
            text-align: left;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.04);
            box-shadow: 0 12px 25px rgba(0,0,0,0.2);
        }

        .stat-icon {
            background-color: var(--primary-orange);
            color: white;
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }

        .stat-info h4 {
            font-size: 1.45rem;
            font-weight: 800;
            margin-bottom: 2px;
        }

        .stat-info span {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
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

        .footer-icon i {
            color: white;
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
    </style>
</head>
<body>

<div class="container">
    <nav>
        <div class="logo" onclick="window.location.href='index.html'">
            <i class="fa-solid fa-cube"></i> AxisLab
        </div>
        <div class="nav-links" id="nav-menu">
            <a href="{{ route('home') }}" class="active">Inicio</a>
            <a href="{{ route('catalogo') }}">Catálogo</a>
            <a href="{{ route('contacto') }}}">Contacto</a>
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{ route('carrito') }}">Carrito</a>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-content">
            <h1>Diseños 3D al alcance de todos</h1>
            <p>En AxisLab, nos preocupamos del alcance y la importancia de la impresión 3D en la vida cotidiana de las personas del hoy.</p>
            <a href="{{ route('catalogo') }}" class="btn-orange">Ver Productos</a>
        </div>
        <div class="hero-form-card">
            <h2>Regístrate</h2>
            <form action="#" method="POST" id="hero-register-form">
                <div class="form-group">
                    <input type="text" class="form-control" id="hero-name" placeholder="Nombre completo" required>
                </div>
                <div class="form-group">
                    <select class="form-control" required style="padding-right: 40px;">
                        <option value="" disabled selected hidden>Tipo de Documento</option>
                        <option value="DNI">DNI</option>
                        <option value="CE">Carnet de Extranjería</option>
                        <option value="Pasaporte">Pasaporte</option>
                    </select>
                    <i class="fa-solid fa-chevron-down input-icon"></i>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="hero-doc" placeholder="Número de documento" required maxlength="12">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="hero-phone" placeholder="Número de teléfono" required maxlength="9">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Fecha de nacimiento" onfocus="(this.type='date')" onblur="(this.value==''?this.type='text':this.type='date')" required>
                    <i class="fa-solid fa-calendar input-icon"></i>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Correo electrónico" required>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <input type="password" class="form-control" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn-orange">Enviar</button>
            </form>
        </div>
    </section>

    <section class="features">
        <div class="feature-item">
            <div class="feature-icon"><i class="fa-solid fa-location-dot"></i></div>
            <h3>Disponibilidad</h3>
            <p>Contamos además de un entorno físico con un entorno virtual, accesible para el alcance de nuestros clientes.</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fa-solid fa-car"></i></div>
            <h3>Comodidad</h3>
            <p>Nuestro sistema de envío garantiza el viaje del producto al destino de forma segura y con tracking.</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fa-solid fa-wallet"></i></div>
            <h3>Mejores precios</h3>
            <p>Precios accesibles con descuentos disponibles para todos.</p>
        </div>
    </section>

    <section class="process-section">
        <div class="process-image">
            <img src="https://img.kwcdn.com/product/fancy/60fd348e-fa40-4763-9b39-e91a3a7083c5.jpg?imageMogr2/auto-orient%7CimageView2/2/w/800/q/70/format/webp" alt="Figura 3D">
        </div>
        <div class="process-steps">
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h4>Exploración de Catálogo Técnico</h4>
                    <p>Navega por nuestra selección de diseños y productos especializados, filtrando por categorías y materiales de alta precisión.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h4>Configuración Personalizada</h4>
                    <p>Selecciona las especificaciones técnicas de tu pieza, incluyendo el tipo de polímero o resina y el acabado superficial requerido para tu proyecto.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h4>Gestión de Pedidos y Facturación</h4>
                    <p>Registra tu compra de forma segura y centralizada; el sistema genera automáticamente tu comprobante y procesa la orden de manufactura.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h4>Control y Seguimiento de Producción</h4>
                    <p>Monitorea el estado de fabricación de tus piezas en tiempo real y recibe actualizaciones hasta el momento del despacho final.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="catalog">
        <div class="catalog-header">
            <h2>Catálogo</h2>
            <a href="{{ route('catalogo') }}">Ver Todo <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="catalog-grid">
            <div class="product-card" data-name="Modelo 1" data-category="heroes">
                <div class="product-img-container">
                    <img src="https://images.cults3d.com/H1anxZP7uQpThmQVadnHAZLb5_0=/516x516/filters:no_upscale()/https://fbi.cults3d.com/uploaders/19345976/illustration-file/18095dc9-c53b-4bf4-9faa-653165214f12/superman.png" alt="Modelo 1">
                </div>
                <div class="product-info-top">
                    <span class="product-title">Modelo 1</span>
                    <span class="product-price">S/.20</span>
                </div>
                <div class="product-category">Accesorio</div>
                <div class="product-attributes">
                    <span><i class="fa-solid fa-palette"></i> Colores: 3</span>
                    <span><i class="fa-solid fa-ruler"></i> Medida: 100%</span>
                    <span><i class="fa-solid fa-gear"></i> Personalizado</span>
                </div>
                <div class="product-actions">
                    <button class="btn-orange">Ver Detalles</button>
                    <button class="btn-orange btn-add-cart">Agregar al carrito</button>
                </div>
            </div>

            <div class="product-card" data-name="Modelo 2" data-category="animales">
                <div class="product-img-container">
                    <img src="https://tiendakrear3d.com/wp-content/uploads/2024/01/Captura-de-pantalla-2024-01-24-105715.png" alt="Modelo 2">
                </div>
                <div class="product-info-top">
                    <span class="product-title">Modelo 2</span>
                    <span class="product-price">S/.25</span>
                </div>
                <div class="product-category">Accesorio</div>
                <div class="product-attributes">
                    <span><i class="fa-solid fa-palette"></i> Colores: 3</span>
                    <span><i class="fa-solid fa-ruler"></i> Medida: 100%</span>
                    <span><i class="fa-solid fa-gear"></i> Personalizado</span>
                </div>
                <div class="product-actions">
                    <button class="btn-orange">Ver Detalles</button>
                    <button class="btn-orange btn-add-cart">Agregar al carrito</button>
                </div>
            </div>

            <div class="product-card" data-name="Modelo 3" data-category="decoracion">
                <div class="product-img-container">
                    <img src="https://i.pinimg.com/originals/89/e4/a2/89e4a216632d160cb92f0a0a982107de.png" alt="Modelo 3">
                </div>
                <div class="product-info-top">
                    <span class="product-title">Modelo 3</span>
                    <span class="product-price">S/.5</span>
                </div>
                <div class="product-category">Accesorio</div>
                <div class="product-attributes">
                    <span><i class="fa-solid fa-palette"></i> Colores: 3</span>
                    <span><i class="fa-solid fa-ruler"></i> Medida: 100%</span>
                    <span><i class="fa-solid fa-gear"></i> Personalizado</span>
                </div>
                <div class="product-actions">
                    <button class="btn-orange">Ver Detalles</button>
                    <button class="btn-orange btn-add-cart">Agregar al carrito</button>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <h2>AxisLab En El Mercado</h2>
        <p>Como empresa fundadora, AxisLab cumple con el rol de satisfacción y estándar de calidad<br>para con sus clientes.</p>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-car-side"></i></div>
                <div class="stat-info">
                    <h4>+1k</h4>
                    <span>Envíos Realizados</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-user-check"></i></div>
                <div class="stat-info">
                    <h4>+1k</h4>
                    <span>Reseñas Positivas</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div class="stat-info">
                    <h4>+2</h4>
                    <span>Años Vigentes</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-gauge-high"></i></div>
                <div class="stat-info">
                    <h4>+Fiabilidad</h4>
                    <span>Confianza. 100%</span>
                </div>
            </div>
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

<script>
    // Filtros dinámicos de entrada
    document.getElementById('hero-name').addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
    });
    document.getElementById('hero-doc').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    document.getElementById('hero-phone').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Lógica para vincular el botón "Agregar al carrito" con localStorage y Navbar dinámico
    document.addEventListener('DOMContentLoaded', () => {

        // DEFENSA: Sincronización de pestañas para cierre de sesión global
        window.addEventListener('storage', (event) => {
            if (event.key === 'axislab_current_user' && !event.newValue) {
                alert("Tu sesión ha sido cerrada de forma segura en otra pestaña.");
                window.location.href = '{{ route('login') }}';
            }
        });

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
                <a href="{{ route('home') }}" class="active">Inicio</a>
                <a href="{{ route('catalogo') }}">Catálogo</a>
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

        // Invocar la actualización inmediatamente al cargar el DOM
        updateNavbar();

        // LÓGICA DEL FORMULARIO DEL HERO (INDEX)
        const heroFormCard = document.querySelector('.hero-form-card');
        const currentUserData = JSON.parse(localStorage.getItem('axislab_current_user'));

        if (currentUserData) {
            // Si el usuario YA está logueado, transformamos el formulario en un panel de bienvenida
            heroFormCard.innerHTML = `
                <div style="text-align: center; padding: 20px 0;">
                    <i class="fa-solid fa-user-check" style="font-size: 4rem; color: var(--primary-orange); margin-bottom: 20px;"></i>
                    <h2 style="margin-bottom: 10px;">¡Hola, ${currentUserData.name.split(' ')[0]}!</h2>
                    <p style="color: var(--text-muted); margin-bottom: 25px;">Qué bueno tenerte de vuelta en AxisLab. Continúa explorando nuestro catálogo.</p>
                    <a href="{{ route('catalogo') }}" class="btn-orange" style="width: 100%;">Ir al Catálogo</a>
                </div>
            `;
        } else {
            // Si NO está logueado, le damos funcionalidad real al formulario de registro
            const heroForm = document.getElementById('hero-register-form');
            if(heroForm) {
                heroForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    
                    // Capturamos los datos
                    const inputs = heroForm.querySelectorAll('input, select');
                    const emailInput = inputs[5].value.trim().toLowerCase(); 
                    
                    let currentUsers = JSON.parse(localStorage.getItem('axislab_users')) || [];
                    
                    if (currentUsers.some(u => u.email === emailInput)) {
                        alert('Lo sentimos, este correo electrónico ya se encuentra registrado.');
                        return;
                    }

                    const newUser = {
                        email: emailInput,
                        password: inputs[6].value, 
                        role: 'client',
                        name: inputs[0].value.trim(),
                        docType: inputs[1].value,
                        docNum: inputs[2].value.trim(),
                        phone: inputs[3].value.trim(),
                        birth: inputs[4].value
                    };

                    currentUsers.push(newUser);
                    localStorage.setItem('axislab_users', JSON.stringify(currentUsers));

                    alert('¡Cuenta creada exitosamente! Ahora puedes iniciar sesión.');
                    window.location.href = '{{ route('login') }}';
                });
            }
        }

        // Lógica original del carrito
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach((card) => {
            const addBtn = card.querySelector('.btn-add-cart');
            if (!addBtn) return;

            addBtn.addEventListener('click', () => {
                const name = card.getAttribute('data-name') || card.querySelector('.product-title').textContent.trim();
                const categoryText = card.querySelector('.product-category').textContent.trim();
                const categoryAttr = card.getAttribute('data-category') || '';
                const category = categoryAttr ? `${categoryText} / ${categoryAttr.charAt(0).toUpperCase() + categoryAttr.slice(1)}` : categoryText;
                const priceText = card.querySelector('.product-price').textContent.replace('S/.', '').trim();
                const price = parseFloat(priceText);
                const img = card.querySelector('.product-img-container img').src;
                const id = name.replace(/\s+/g, '-').toLowerCase();

                let cart = JSON.parse(localStorage.getItem('axislab_cart')) || [];
                const existingProduct = cart.find(item => item.id === id);
                if (existingProduct) {
                    existingProduct.qty += 1;
                } else {
                    cart.push({ id, name, category, price, img, qty: 1 });
                }

                localStorage.setItem('axislab_cart', JSON.stringify(cart));
                alert(`${name} ha sido añadido a tu carrito de compras de manera exitosa.`);
            });
        });
    });
</script>
</body>
</html>