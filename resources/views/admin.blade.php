<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - AxisLab</title>
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
            --border-color: #e5e7eb;
            --danger-red: #ef4444;
            --danger-red-hover: #dc2626;
            --success-green: #10b981;
            --success-green-hover: #059669;
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

        /* Navbar Idéntico al de Catálogo */
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

        /* Admin Layout Header */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 40px 0 25px;
        }

        .admin-header h2 {
            font-size: 2.2rem;
            font-weight: 800;
        }

        /* Metrics Grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .metric-card {
            background-color: var(--bg-light);
            padding: 20px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            background-color: #ffffff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: var(--primary-orange);
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        }

        .metric-info h5 {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .metric-info p {
            font-size: 1.5rem;
            font-weight: 800;
        }

        /* Buttons matching style guide */
        .btn-orange {
            background-color: var(--primary-orange);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-orange:hover {
            background-color: var(--primary-orange-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(248, 154, 32, 0.35);
        }

        .btn-success {
            background-color: var(--success-green);
        }

        .btn-success:hover {
            background-color: var(--success-green-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.35);
        }

        /* Management Table */
        .table-container {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            margin-bottom: 25px;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .admin-table th {
            background-color: var(--bg-light);
            padding: 18px 24px;
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-table td {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.95rem;
            color: var(--text-dark);
            vertical-align: middle;
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .table-img {
            width: 55px;
            height: 55px;
            border-radius: 10px;
            object-fit: cover;
            background-color: var(--bg-light);
        }

        .badge-category {
            background-color: var(--bg-light);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--dark-gray);
            text-transform: capitalize;
        }

        .stock-indicator {
            font-weight: 700;
        }
        .stock-low { color: var(--danger-red); }
        .stock-normal { color: var(--success-green); }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        .btn-edit {
            background-color: #fef3c7;
            color: #d97706;
        }
        .btn-edit:hover { background-color: #fde68a; }

        .btn-delete {
            background-color: #fee2e2;
            color: var(--danger-red);
        }
        .btn-delete:hover { background-color: #fca5a5; }

        /* Commit Actions Bar */
        .commit-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--bg-light);
            padding: 15px 25px;
            border-radius: 16px;
            margin-bottom: 60px;
            border: 1px dashed var(--border-color);
        }

        /* Modal Styled View */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(17, 24, 39, 0.5);
            backdrop-filter: blur(4px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-box {
            background-color: #ffffff;
            width: 100%;
            max-width: 550px;
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            animation: modalFade 0.3s ease;
        }

        @keyframes modalFade {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .modal-header h3 {
            font-size: 1.5rem;
            font-weight: 800;
        }

        .close-modal {
            background: transparent;
            border: none;
            font-size: 1.3rem;
            cursor: pointer;
            color: var(--text-muted);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 15px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--dark-gray);
        }

        .form-group input, .form-group select {
            padding: 11px 16px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.95rem;
            outline: none;
            background-color: var(--bg-light);
            transition: all 0.2s ease;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: var(--primary-orange);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(248, 154, 32, 0.15);
        }

        .modal-footer {
            margin-top: 15px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn-cancel {
            background-color: var(--bg-light);
            color: var(--text-dark);
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        /* Backup History Specific Styles */
        .backups-container {
            max-height: 350px;
            overflow-y: auto;
            margin-top: 10px;
            padding-right: 5px;
        }

        .backup-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 18px;
            background-color: var(--bg-light);
            border-radius: 14px;
            margin-bottom: 12px;
            border: 1px solid var(--border-color);
        }

        .backup-left {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .backup-title {
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-dark);
        }

        .backup-meta {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .backup-meta i {
            margin-right: 3px;
        }

        .no-backups-text {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.95rem;
            padding: 30px 0;
        }

        /* Footer */
        footer {
            padding: 50px 0 30px;
            border-top: 1px solid var(--border-color);
        }

        .copyright {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
            padding-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <nav>
        <div class="logo" onclick="window.location.href='{{ route('home') }}'">
            <i class="fa-solid fa-cube"></i> AxisLab
        </div>
        <div class="nav-links" id="nav-menu">
            </div>
    </nav>

    <div class="admin-header">
        <div>
            <h2>Panel de Control</h2>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Gestiona el inventario global de tu plataforma AxisLab</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <button class="btn-orange" id="btn-open-backups-modal" style="background-color: var(--dark-gray);"><i class="fa-solid fa-clock-rotate-left"></i> Ver Respaldos</button>
            <button class="btn-orange" id="btn-backup-system" style="background-color: var(--dark-gray);"><i class="fa-solid fa-cloud-arrow-up"></i> Respaldar Inventario</button>
            <button class="btn-orange" id="btn-open-add"><i class="fa-solid fa-plus"></i> Añadir Producto</button>
        </div>
    </div>

    <div class="metrics-grid">
        <div class="metric-card">
            <div class="metric-icon"><i class="fa-solid fa-box"></i></div>
            <div class="metric-info"><h5>Productos</h5><p id="metric-total">0</p></div>
        </div>
        <div class="metric-card">
            <div class="metric-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
            <div class="metric-info"><h5>Stock Total</h5><p id="metric-stock">0</p></div>
        </div>
        <div class="metric-card">
            <div class="metric-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="metric-info"><h5>Stock Bajo</h5><p id="metric-low">0</p></div>
        </div>
        <div class="metric-card">
            <div class="metric-icon"><i class="fa-solid fa-tags"></i></div>
            <div class="metric-info"><h5>Categorías</h5><p>5</p></div>
        </div>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Detalles / Atributos</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody id="admin-table-body">
                @foreach($productos as $producto)
                    <tr data-id="{{ $producto->id_producto }}">
                        {{-- 1. Imagen --}}
                        <td>
                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px;">
                        </td>
                        
                        {{-- 2. Nombre --}}
                        <td>{{ $producto->nombre }}</td>
                        
                        {{-- 3. Categoría --}}
                        <td>{{ $producto->categoria->nombre ?? 'Sin Categoría' }}</td>
                        
                        {{-- 4. Precio --}}
                        <td>S/. {{ number_format($producto->precio, 2) }}</td>
                        
                        {{-- 5. Stock --}}
                        <td>{{ $producto->stock }} u.</td>
                        
                        {{-- 6. Detalles / Atributos (Mapeado a la descripción de la BD) --}}
                        <td>{{ Str::limit($producto->descripcion, 40) }}</td>
                        
                        {{-- 7. Acciones CRUD --}}
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 5px; justify-content: center;">
                                {{-- Botón Editar (Pasa los datos al modal mediante atributos data) --}}
                                <button class="btn-orange btn-edit" 
                                        data-id="{{ $producto->id_producto }}"
                                        data-nombre="{{ $producto->nombre }}"
                                        data-categoria="{{ $producto->id_categoria }}"
                                        data-precio="{{ $producto->precio }}"
                                        data-stock="{{ $producto->stock }}"
                                        data-imagen="{{ $producto->imagen }}"
                                        data-descripcion="{{ $producto->descripcion }}"
                                        style="padding: 5px 10px; font-size: 0.85rem;">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </button>

                                {{-- Formulario para Eliminar de forma directa a la BD --}}
                                <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto de la base de datos?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-orange" style="background-color: #ef4444; padding: 5px 10px; font-size: 0.85rem;">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                {{-- Estado vacío si no hay filas en MySQL --}}
                @if($productos->isEmpty())
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 25px; color: var(--text-muted);">
                            <i class="fa-solid fa-box-open" style="font-size: 1.3rem; display: block; margin-bottom: 5px; color: var(--primary-orange);"></i>
                            No hay productos en la base de datos.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="commit-container">
        <p style="color: var(--text-muted); font-size: 0.9rem; font-weight: 500;">
            <i class="fa-solid fa-circle-info" style="color: var(--primary-orange); margin-right: 5px;"></i> 
            Las modificaciones actuales son locales. Presiona el botón verde para aplicarlas en el catálogo.
        </p>
        <button class="btn-orange btn-success" id="btn-confirm-catalog-changes">
            <i class="fa-solid fa-circle-check"></i> Confirmar y Aplicar Cambios en Catálogo
        </button>
    </div>

    <footer>
        <div class="copyright">
            © AxisLab. Todos los derechos reservados. 2026.
        </div>
    </footer>
</div>

<div class="modal-overlay" id="product-modal">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="modal-title">Añadir Nuevo Producto</h3>
            <button class="close-modal" id="btn-close-modal" type="button"><i class="fa-solid fa-xmark"></i></button>
        </div>
        
        {{-- Conectamos por defecto a la ruta store (Agregar) --}}
        <form id="product-form" action="{{ route('admin.productos.store') }}" method="POST">
            @csrf
            {{-- Este input oculto nos servirá en JS para cambiar a método PUT al editar --}}
            <input type="hidden" id="product-id" name="id_producto">
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="prod-name">Nombre del Producto</label>
                    <input type="text" id="prod-name" name="nombre" required placeholder="Ej. Modelo 10">
                </div>
                
                <div class="form-group">
                    <label for="prod-category">Categoría</label>
                    <select id="prod-category" name="id_categoria" required>
                        <option value="">Seleccione...</option>
                        {{-- Bucle procedural para jalar los IDs reales de la base de datos --}}
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Mapeamos "Tipo de Producto" al campo 'descripcion' de tu BD ya que es lo más cercano --}}
                <div class="form-group">
                    <label for="prod-type">Descripción / Tipo</label>
                    <input type="text" id="prod-type" name="descripcion" required placeholder="Ej. Accesorio o Figura">
                </div>
                
                <div class="form-group">
                    <label for="prod-price">Precio (S/.)</label>
                    <input type="number" id="prod-price" name="precio" step="0.01" required placeholder="0.00">
                </div>
                
                <div class="form-group">
                    <label for="prod-stock">Stock Disponible</label>
                    <input type="number" id="prod-stock" name="stock" required placeholder="0">
                </div>

                {{-- Añadimos un campo simple para la ruta de la imagen --}}
                <div class="form-group full-width">
                    <label for="prod-img">Ruta de la Imagen</label>
                    <input type="text" id="prod-img" name="imagen" required placeholder="Ej. img/productos/modelo10.jpg" value="img/productos/default.jpg">
                </div>
            </div>

            {{-- Faltaban los botones de acción del formulario, asegúrate de tenerlos antes del cierre --}}
            <div class="modal-footer" style="margin-top: 20px; text-align: right;">
                <button type="submit" class="btn-orange" id="btn-save-product">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="backups-modal">
    <div class="modal-box" style="max-width: 650px;">
        <div class="modal-header">
            <h3>Historial de Respaldos Guardados</h3>
            <button class="close-modal" id="btn-close-backups"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="backups-container" id="backups-list-body"></div>
        <div class="modal-footer" style="margin-top: 20px;">
            <button type="button" class="btn-cancel" id="btn-close-backups-footer">Cerrar Historial</button>
        </div>
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

        // DEFENSA: Aduana de Sanitización XSS (Previene inyección de código)
        function escapeHTML(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
        
         // DEFENSA: Guardián de acceso y protección contra manipulación de consola (F12) // Erick
        (function() {
            const session = JSON.parse(localStorage.getItem('axislab_current_user'));
            const usersDB = JSON.parse(localStorage.getItem('axislab_users')) || [];
            
            if (!session) {
                window.location.href = '{{ route('login') }}';
                return;
            }

            // Buscamos la verdadera identidad del usuario en la base maestra
            const realUser = usersDB.find(u => u.email === session.email);
            
            // Si el usuario no existe, o su rol real NO es admin, o intentó falsificar la sesión
            if (!realUser || realUser.role !== 'admin' || session.role !== 'admin') {
                alert("Violación de seguridad: Manipulación de privilegios detectada. Acceso denegado.");
                localStorage.removeItem('axislab_current_user'); // Destruimos la sesión falsa
                window.location.href = '{{ route('catalogo') }}'; // Lo enviamos fuera
            }
        })();

        // Forzar recarga si la página se carga desde la caché del botón "Atrás" - Erick
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        });

        function updateNavbar() {
            const navMenu = document.getElementById('nav-menu');
            const currentUser = JSON.parse(localStorage.getItem('axislab_current_user'));
            const masterUsers = JSON.parse(localStorage.getItem('axislab_users')) || [];

            if (currentUser) {
                // DEFENSA: Validación cruzada de seguridad en la barra de navegación
                const realUser = masterUsers.find(u => u.email === currentUser.email);
                
                if (!realUser || realUser.role !== currentUser.role) {
                    localStorage.removeItem('axislab_current_user');
                    alert("Se ha detectado una alteración en los privilegios de la sesión. Inicia sesión nuevamente.");
                    window.location.reload();
                    return;
                }

                // Expiración por inactividad
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
                    linksHtml += `<a href="{{ route('admin.dashboard') }}">Panel Admin</a>`;
                } else {
                    // Solo los clientes ven el carrito
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
                    localStorage.removeItem('axislab_cart'); // DEFENSA: Limpieza de carrito al salir
                    alert('Sesión finalizada correctamente.');
                    window.location.href = '{{ route('login') }}'; 
                });
            }
        }

        // Ejecutar inicialización del menú
        updateNavbar();

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

        let globalCatalog = JSON.parse(localStorage.getItem('axislab_inventory'));
        if (!globalCatalog) {
            globalCatalog = initialProducts;
            localStorage.setItem('axislab_inventory', JSON.stringify(globalCatalog));
        }

        let products = [...globalCatalog];
        let backupHistory = JSON.parse(localStorage.getItem('axislab_backups_history')) || [];

        const tableBody = document.getElementById('admin-table-body');
        const modal = document.getElementById('product-modal');
        const backupsModal = document.getElementById('backups-modal');
        const form = document.getElementById('product-form');
        const modalTitle = document.getElementById('modal-title');
        const backupsListBody = document.getElementById('backups-list-body');
        
        const metricTotal = document.getElementById('metric-total');
        const metricStock = document.getElementById('metric-stock');
        const metricLow = document.getElementById('metric-low');

        function updateDashboard() {
            tableBody.innerHTML = '';
            let totalStock = 0;
            let lowStockCount = 0;

            products.forEach((product, idx) => {
                totalStock += parseInt(product.stock);
                if(parseInt(product.stock) <= 4) lowStockCount++;

                const stockClass = product.stock <= 4 ? 'stock-low' : 'stock-normal';

                const trHtml = `
                    <tr>
                        <td><img src="${product.img}" class="table-img" alt="${product.name}"></td>
                        <td style="font-weight: 700;">${product.name}</td>
                        <td><span class="badge-category">${product.filterCategory}</span></td>
                        <td style="font-weight: 600;">S/. ${parseFloat(product.price).toFixed(2)}</td>
                        <td><span class="stock-indicator ${stockClass}">${product.stock} u.</span></td>
                        <td style="color: var(--text-muted); font-size: 0.85rem;">
                            ${product.visualCategory} • ${product.colors} Colores • ${product.size}
                        </td>
                        <td>
                            <div class="action-btns" style="justify-content: center;">
                                <button class="btn-action btn-edit" data-index="${idx}" title="Editar"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-action btn-delete" data-index="${idx}" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', trHtml);
            });

            metricTotal.textContent = products.length;
            metricStock.textContent = totalStock;
            metricLow.textContent = lowStockCount;
        }

        function renderBackupsHistory() {
            backupsListBody.innerHTML = '';
            if (backupHistory.length === 0) {
                backupsListBody.innerHTML = '<p class="no-backups-text"><i class="fa-solid fa-folder-open"></i> No hay copias de seguridad registradas.</p>';
                return;
            }

            backupHistory.forEach((backup, idx) => {
                const itemHtml = `
                    <div class="backup-item">
                        <div class="backup-left">
                            <span class="backup-title">${backup.name}</span>
                            <span class="backup-meta">
                                <i class="fa-solid fa-calendar-alt"></i> ${backup.date} &nbsp;|&nbsp; 
                                <i class="fa-solid fa-user-shield"></i> Hecho por: <strong>${backup.author}</strong>
                            </span>
                        </div>
                        <button class="btn-orange btn-restore-backup" data-index="${idx}" style="font-size: 0.85rem; padding: 8px 16px;">
                            <i class="fa-solid fa-arrow-rotate-left"></i> Ir a ese respaldo
                        </button>
                    </div>
                `;
                backupsListBody.insertAdjacentHTML('beforeend', itemHtml);
            });
        }

        // Delegación de eventos para botones de acción en la tabla
        function openModal(mode, id = null) {
            modal.style.display = 'flex';
            const form = document.getElementById('product-form');

            if (mode === 'add') {
                modalTitle.textContent = 'Añadir Nuevo Producto';
                form.reset();
                document.getElementById('product-id').value = '';
                
                // Asignamos la ruta real de Laravel para CREAR
                form.action = "{{ route('admin.productos.store') }}";
                
                // Removemos el input PUT si es que se quedó pegado de una edición anterior
                const methodInput = document.getElementById('product-method');
                if (methodInput) methodInput.remove();

            } else if (mode === 'edit') {
                modalTitle.textContent = 'Editar Atributos del Producto';
                
                // Buscamos el botón de la tabla que tiene guardados todos los datos reales de la BD
                const btn = document.querySelector(`.btn-edit[data-id="${id}"]`);
                
                if (btn) {
                    // Rellenamos el formulario con los atributos data- que pusimos en la tabla
                    document.getElementById('product-id').value = id;
                    document.getElementById('prod-name').value = btn.getAttribute('data-nombre');
                    document.getElementById('prod-category').value = btn.getAttribute('data-categoria');
                    document.getElementById('prod-type').value = btn.getAttribute('data-descripcion');
                    document.getElementById('prod-price').value = btn.getAttribute('data-precio');
                    document.getElementById('prod-stock').value = btn.getAttribute('data-stock');
                    document.getElementById('prod-img').value = btn.getAttribute('data-imagen');
                }
                
                // Cambiamos dinámicamente la ruta del formulario para EDITAR apuntando al ID real
                form.action = `/admin-dashboard/productos/${id}`;
                
                // Inyectamos el método PUT necesario para Laravel si no existe
                let methodInput = document.getElementById('product-method');
                if (!methodInput) {
                    methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.id = 'product-method';
                    form.appendChild(methodInput);
                }
                methodInput.value = 'PUT';
            }
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function openBackupsModal() {
            renderBackupsHistory();
            backupsModal.style.display = 'flex';
        }

        function closeBackupsModal() {
            backupsModal.style.display = 'none';
        }

        document.getElementById('btn-open-add').addEventListener('click', () => openModal('add'));
        document.getElementById('btn-close-modal').addEventListener('click', closeModal);
        document.getElementById('btn-cancel-modal').addEventListener('click', closeModal);
        
        document.getElementById('btn-open-backups-modal').addEventListener('click', openBackupsModal);
        document.getElementById('btn-close-backups').addEventListener('click', closeBackupsModal);
        document.getElementById('btn-close-backups-footer').addEventListener('click', closeBackupsModal);

        document.getElementById('btn-backup-system').addEventListener('click', () => {
            const dateObj = new Date();
            const formattedDate = dateObj.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' }) + ' ' + 
                                  dateObj.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            
            const backupIndex = backupHistory.length + 1;
            const newBackup = {
                id: "backup-" + dateObj.getTime(),
                name: `Copia de Seguridad #${backupIndex}`,
                date: formattedDate,
                author: "Admin AxisLab",
                data: JSON.parse(JSON.stringify(products))
            };

            backupHistory.push(newBackup);
            localStorage.setItem('axislab_backups_history', JSON.stringify(backupHistory));

            const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(products, null, 2));
            const downloadAnchor = document.createElement('a');
            downloadAnchor.setAttribute("href", dataStr);
            downloadAnchor.setAttribute("download", `axislab_respaldo_n${backupIndex}.json`);
            document.body.appendChild(downloadAnchor);
            downloadAnchor.click();
            downloadAnchor.remove();
            
            alert(`¡Respaldo guardado correctamente! Registrado como "Copia de Seguridad #${backupIndex}" en tu historial local.`);
        });

        backupsListBody.addEventListener('click', (e) => {
            const btnRestore = e.target.closest('.btn-restore-backup');
            if (btnRestore) {
                const idx = btnRestore.getAttribute('data-index');
                const selectedBackup = backupHistory[idx];
                
                if (confirm(`¿Estás seguro de que deseas regresar al estado de la "${selectedBackup.name}"? Los datos actuales en pantalla se sobrescribirán.`)) {
                    products = JSON.parse(JSON.stringify(selectedBackup.data));
                    updateDashboard();
                    closeBackupsModal();
                    alert(`¡Éxito! Se han restaurado por completo todos los datos correspondientes a la "${selectedBackup.name}".`);
                }
            }
        });

        tableBody.addEventListener('click', (e) => {
            const btnEdit = e.target.closest('.btn-edit');
            
            if (btnEdit) {
                // Obtenemos el ID real del producto desde el atributo data-id que pusimos en la tabla
                const idProducto = btnEdit.getAttribute('data-id');
                openModal('edit', idProducto);
            }
            
            // El bloque de btnDelete se elimina por completo de aquí, 
            // porque ahora la eliminación la maneja el formulario HTML nativo con su botón.
        });

         // Al enviar el formulario, actualizamos el catálogo global y la tabla sin recargar la página
        updateDashboard();
    });
</script>
</body>
</html>