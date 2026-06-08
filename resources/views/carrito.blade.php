<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - AxisLab</title>
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
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #ffffff; color: var(--text-dark); line-height: 1.5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        /* Navbar */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 25px 0; }
        .logo { display: flex; align-items: center; font-weight: 800; font-size: 1.3rem; gap: 10px; cursor: pointer; }
        .logo i { font-size: 2.2rem; color: var(--dark-gray); }
        .nav-links { display: flex; gap: 40px; align-items: center; }
        .nav-links a { text-decoration: none; color: var(--text-dark); font-weight: 600; font-size: 0.95rem; transition: color 0.2s ease; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary-orange); }

        /* Carrito Layout */
        .cart-header { margin: 40px 0 20px; }
        .back-btn { display: flex; align-items: center; gap: 15px; text-decoration: none; color: #000; font-weight: 800; font-size: 1.8rem; }
        .cart-count { color: var(--text-muted); font-size: 0.95rem; font-weight: 600; margin-left: 45px; margin-top: 5px; }

        .cart-content { display: flex; gap: 50px; margin-bottom: 80px; align-items: flex-start; }
        .cart-items { flex: 1.4; display: flex; flex-direction: column; gap: 30px; }
        
        .cart-item { display: flex; align-items: center; justify-content: space-between; padding-bottom: 20px; border-bottom: 1px solid var(--border-color); }
        .item-img { width: 140px; height: 140px; border-radius: 20px; background-color: #e3f2fd; background-size: cover; background-position: center; }
        .item-details { flex: 1; padding: 0 25px; }
        .item-details h4 { font-size: 1.4rem; font-weight: 700; margin-bottom: 5px; }
        .item-details p { color: var(--text-muted); font-size: 0.95rem; font-weight: 500; }
        
        .quantity-control { display: flex; align-items: center; background: var(--bg-light); padding: 5px 12px; border-radius: 20px; gap: 15px; margin-top: 15px; width: fit-content; }
        .quantity-control button { border: none; background: transparent; font-size: 1rem; font-weight: 600; cursor: pointer; padding: 2px 5px; }
        .quantity-control span { font-weight: 700; font-size: 0.95rem; min-width: 15px; text-align: center; }
        .delete-btn { border: none; background: transparent; color: var(--text-muted); cursor: pointer; font-size: 1rem; margin-left: 10px; transition: color 0.2s; }
        .delete-btn:hover { color: #ef4444; }

        .item-price { font-size: 1.5rem; font-weight: 700; color: var(--primary-orange); text-align: right; min-width: 100px; }
        .item-price span { display: block; font-size: 0.8rem; color: var(--text-muted); font-weight: 500; margin-top: 4px; }

        /* Resumen Panel */
        .cart-summary { flex: 0.8; background: #ffffff; padding: 10px; border-radius: 24px; }
        .summary-title { font-size: 1.8rem; font-weight: 800; margin-bottom: 25px; }
        .summary-row { display: flex; justify-content: space-between; font-size: 1.3rem; font-weight: 500; margin-bottom: 20px; color: var(--text-muted); }
        .summary-row.total-row { font-size: 2.2rem; font-weight: 800; color: var(--text-dark); margin-top: 40px; margin-bottom: 30px; }
        .summary-row.total-row .price-amount { color: var(--primary-orange); }

        .btn-orange { background-color: var(--primary-orange); color: white; border: none; padding: 16px; border-radius: 14px; font-weight: 700; font-size: 1.1rem; cursor: pointer; transition: all 0.2s ease; text-align: center; text-decoration: none; display: block; width: 100%; }
        .btn-orange:hover { background-color: var(--primary-orange-hover); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(248, 154, 32, 0.35); }
        .continue-link { display: block; text-align: center; margin-top: 20px; color: var(--text-muted); font-weight: 600; text-decoration: none; font-size: 0.95rem; }
        .continue-link:hover { text-decoration: underline; }

        /* Cartel Elegante de Advertencia de Sesión */
        .login-notice-box { background-color: #fffbeb; border: 1px solid #fef3c7; padding: 14px; border-radius: 12px; margin-bottom: 20px; font-size: 0.9rem; color: #b45309; display: flex; align-items: center; gap: 10px; line-height: 1.4; }
        .login-notice-box i { font-size: 1.2rem; color: #d97706; flex-shrink: 0; }

        /* Estado Vacío Personalizado */
        .empty-cart-view { text-align: center; width: 100%; padding: 60px 0; }
        .empty-cart-view i { font-size: 4.5rem; color: #d1d5db; margin-bottom: 20px; }
        .empty-cart-view h4 { font-size: 1.6rem; font-weight: 700; margin-bottom: 10px; color: var(--text-dark); }
        .empty-cart-view p { color: var(--text-muted); margin-bottom: 30px; font-size: 1rem; }

        /* Footer */
        footer { padding: 50px 0 30px; border-top: 1px solid var(--border-color); margin-top: 60px; }
        .footer-top { display: flex; justify-content: space-between; margin-bottom: 50px; }
        .footer-col { display: flex; align-items: flex-start; gap: 15px; }
        .footer-icon { background-color: var(--primary-orange); color: white; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
        .footer-info h5 { font-size: 1rem; font-weight: 700; color: var(--text-muted); margin-bottom: 5px; }
        .footer-info p { font-weight: 700; color: var(--text-dark); font-size: 1rem; }
        
        .social-links { display: flex; gap: 20px; margin-top: 15px; }
        .social-links a { color: var(--text-dark); font-size: 1.6rem; transition: all 0.2s ease; }
        .social-links a:hover { color: var(--primary-orange); transform: scale(1.15); }
        
        .footer-bottom { display: flex; justify-content: space-between; margin-bottom: 40px; }
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
        <div class="logo" onclick="window.location.href='{{ route('home') }}'">
            <i class="fa-solid fa-cube"></i> AxisLab
        </div>
        <div class="nav-links" id="nav-menu">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('catalogo') }}">Catálogo</a>
            <a href="{{ route('contacto') }}">Contacto</a>
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{ route('carrito') }}" class="active">Carrito</a>
        </div>
    </nav>

    <div class="cart-header">
        <a href="{{ route('catalogo') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Carrito De Compras</a>
        <div class="cart-count" id="items-count-text">0 Productos En Tu Carrito</div>
    </div>

    <div class="cart-content" id="cart-main-content">
        <div class="cart-items" id="cart-items-container"></div>

        <div class="cart-summary" id="cart-summary-panel">
            <h3 class="summary-title">Resumen Del Pedido</h3>
            <div class="summary-row">
                <span>Subtotal</span>
                <span>S/. <span id="subtotal-val">0.00</span></span>
            </div>
            <div class="summary-row total-row">
                <span>Total</span>
                <span class="price-amount">S/. <span id="total-val">0.00</span></span>
            </div>
            
            <div id="auth-notice-area"></div>
            
            <button id="btn-comprar" class="btn-orange">Comprar</button>
            <a href="{{ route('catalogo') }}" class="continue-link">Continuar Comprando</a>
        </div>
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
            <div style="flex: 1;">
                <h5 style="font-size: 1.15rem; font-weight: 700;">Redes Sociales</h5>
            </div>
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
        
        const mainContent = document.getElementById('cart-main-content');
        const container = document.getElementById('cart-items-container');
        const summaryPanel = document.getElementById('cart-summary-panel');
        const subtotalElement = document.getElementById('subtotal-val');
        const totalElement = document.getElementById('total-val');
        const countText = document.getElementById('items-count-text');

        // Función unificada para renderizar el Navbar dinámico de AxisLab
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
                    <a href="{{ route('carrito') }}" class="active">Carrito</a>
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

        updateNavbar();

        // --- INICIO DE LÓGICA DE VALIDACIÓN DE INTEGRIDAD ---
        // DEFENSA: Validación de integridad (Elimina productos fantasma si fueron borrados del catálogo por un admin)
        let rawCart = JSON.parse(localStorage.getItem('axislab_cart')) || [];
        const inventory = JSON.parse(localStorage.getItem('axislab_inventory')) || [];
        
        // Filtramos: solo sobreviven los productos del carrito que sigan existiendo en el inventario actual
        let cart = rawCart.filter(cartItem => {
            return inventory.some(invItem => invItem.id === cartItem.id);
        });

        // Si el tamaño de la lista cambió, significa que eliminamos productos fantasma
        if (rawCart.length !== cart.length) {
            localStorage.setItem('axislab_cart', JSON.stringify(cart));
            alert("Atención: Algunos productos de tu carrito ya no están disponibles en el catálogo y han sido removidos automáticamente.");
        }
        // --- FIN DE LÓGICA DE VALIDACIÓN DE INTEGRIDAD ---

        function renderCart() {
            if (cart.length === 0) {
                countText.textContent = '0 Productos En Tu Carrito';
                localStorage.setItem('cartSubtotal', '0.00');
                
                mainContent.innerHTML = `
                    <div class="empty-cart-view">
                        <i class="fa-solid fa-basket-shopping"></i>
                        <h4>Tu carrito está vacío</h4>
                        <p style="margin-bottom:25px;">No has agregado ningún artículo a tu lista todavía.</p>
                        <a href="{{ route('catalogo') }}" class="btn-orange" style="display:inline-block; width:auto; padding:14px 35px;">Explorar Catálogo</a>
                    </div>
                `;
                return;
            }

            mainContent.innerHTML = '';
            mainContent.appendChild(container);
            mainContent.appendChild(summaryPanel);
            container.innerHTML = '';

            let subtotal = 0;
            let totalItems = 0;

            cart.forEach((item, index) => {
                const itemTotal = item.price * item.qty;
                subtotal += itemTotal;
                totalItems += item.qty;

                const itemHtml = `
                    <div class="cart-item" data-id="${item.id}">
                        <div style="background-image: url('${item.img}');" class="item-img"></div>
                        <div class="item-details">
                            <h4>${item.name}</h4>
                            <p>${item.category}</p>
                            <div class="quantity-control">
                                <button class="btn-minus" data-index="${index}">-</button>
                                <span class="qty-val">${item.qty}</span>
                                <button class="btn-plus" data-index="${index}">+</button>
                            </div>
                            <button class="delete-btn" data-index="${index}"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                        <div class="item-price">S/. <span class="item-total-price">${itemTotal.toFixed(2)}</span><span>S/. ${parseFloat(item.price).toFixed(2)} C/Unidad</span></div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', itemHtml);
            });

            subtotalElement.textContent = subtotal.toFixed(2);
            totalElement.textContent = subtotal.toFixed(2);
            countText.textContent = `${totalItems} ${totalItems === 1 ? 'Producto' : 'Productos'} En Tu Carrito`;
            localStorage.setItem('cartSubtotal', subtotal.toFixed(2));

            const currentUser = JSON.parse(localStorage.getItem('axislab_current_user'));
            const authNoticeArea = document.getElementById('auth-notice-area');
            const btnComprar = document.getElementById('btn-comprar');

            if (authNoticeArea && btnComprar) {
                if (!currentUser) {
                    authNoticeArea.innerHTML = `
                        <div class="login-notice-box">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Debes iniciar sesión o registrarte en la plataforma para poder procesar la compra de tus artículos.</span>
                        </div>
                    `;
                    btnComprar.textContent = 'Inicia Sesión para Comprar';
                } else {
                    authNoticeArea.innerHTML = '';
                    btnComprar.textContent = 'Comprar';
                }
            }
        }

        mainContent.addEventListener('click', (e) => {
            const idx = e.target.getAttribute('data-index');
            
            if (e.target.classList.contains('btn-plus')) {
                // DEFENSA: Validación estricta de stock máximo desde la base de datos
                const productRef = inventory.find(p => p.id === cart[idx].id);
                if (productRef && cart[idx].qty >= productRef.stock) {
                    alert('No hay más stock disponible para este producto.');
                    return;
                }
                cart[idx].qty += 1;
                localStorage.setItem('axislab_cart', JSON.stringify(cart));
                renderCart();
            } else if (e.target.classList.contains('btn-minus')) {
                if (cart[idx].qty > 1) {
                    cart[idx].qty -= 1;
                    localStorage.setItem('axislab_cart', JSON.stringify(cart));
                    renderCart();
                }
            } else if (e.target.closest('.delete-btn')) {
                const btn = e.target.closest('.delete-btn');
                const idx = btn.getAttribute('data-index');
                cart.splice(idx, 1);
                localStorage.setItem('axislab_cart', JSON.stringify(cart));
                renderCart();
            } else if (e.target.id === 'btn-comprar') {
                if(cart.length === 0) return;
                const currentUser = JSON.parse(localStorage.getItem('axislab_current_user'));
                if (!currentUser) {
                    alert('Es necesario iniciar sesión para comprar.');
                    localStorage.setItem('axislab_redirect_to_cart', 'true');
                    window.location.href = '{{ route('login') }}';
                } else {
                    window.location.href = '{{ route('checkout') }}';
                }
            }
        });

        renderCart();
    });
</script>
</body>
</html>