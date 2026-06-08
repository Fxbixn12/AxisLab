<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Despacho y Pago - AxisLab</title>
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
            --card-bg-gray: #e9eaec;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #ffffff; color: var(--text-dark); line-height: 1.5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        /* Navbar */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 25px 0; margin-bottom: 20px; }
        .logo { display: flex; align-items: center; font-weight: 800; font-size: 1.3rem; gap: 10px; cursor: pointer; }
        .logo i { font-size: 2.2rem; color: var(--dark-gray); }
        .nav-links { display: flex; gap: 40px; }
        .nav-links a { text-decoration: none; color: var(--text-dark); font-weight: 600; font-size: 0.95rem; transition: color 0.2s ease; }
        .nav-links a:hover { color: var(--primary-orange); }

        .checkout-header { margin: 40px 0 20px; }
        .back-btn { display: flex; align-items: center; gap: 15px; text-decoration: none; color: #000; font-weight: 800; font-size: 1.8rem; }
        .checkout-count { color: var(--text-muted); font-size: 0.95rem; font-weight: 600; margin-left: 45px; margin-top: 5px; }

        .checkout-layout { display: flex; gap: 60px; margin-bottom: 80px; align-items: flex-start; }
        .form-side { flex: 1.2; background-color: var(--card-bg-gray); border-radius: 28px; padding: 35px 40px; }
        .section-title { font-size: 1.5rem; font-weight: 800; margin-bottom: 25px; color: var(--text-dark); }
        
        .form-group { position: relative; margin-bottom: 18px; }
        .form-control { width: 100%; padding: 14px 20px; background-color: #ffffff; border: 1px solid transparent; border-radius: 12px; font-size: 0.95rem; color: var(--text-dark); outline: none; transition: all 0.2s ease; appearance: none; font-weight: 500; }
        .form-group i.fa-chevron-down { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); color: var(--text-dark); pointer-events: none; font-size: 0.9rem; }

        .shipping-notice { background-color: #fff3cd; color: #856404; border-left: 4px solid var(--primary-orange); padding: 12px 16px; border-radius: 8px; font-size: 0.9rem; font-weight: 600; margin-top: -10px; margin-bottom: 15px; display: none; }
        .row-inputs { display: flex; gap: 15px; }
        .row-inputs .form-group { flex: 1; }

        .summary-side { flex: 1; padding-top: 10px; }
        .summary-side h3 { font-size: 2rem; font-weight: 800; margin-bottom: 30px; }
        .product-manifest { margin-bottom: 35px; max-height: 240px; overflow-y: auto; padding-right: 5px; }
        .manifest-row { display: flex; justify-content: space-between; font-size: 1.15rem; font-weight: 600; color: var(--text-muted); margin-bottom: 12px; }
        .manifest-row .manifest-price { color: #000; font-weight: 700; }

        .price-breakdown { border-top: 1px solid var(--border-color); padding-top: 25px; margin-bottom: 35px; }
        .breakdown-row { display: flex; justify-content: space-between; font-size: 1.4rem; font-weight: 500; color: var(--text-muted); margin-bottom: 15px; }
        .breakdown-row.total-bold { font-size: 2.6rem; font-weight: 800; color: var(--text-dark); margin-top: 30px; }
        .breakdown-row.total-bold .total-color { color: var(--primary-orange); }

        .btn-confirm { background-color: var(--primary-orange); color: white; border: none; padding: 16px; border-radius: 14px; font-weight: 700; font-size: 1.1rem; cursor: pointer; transition: all 0.2s; width: 100%; text-align: center; }
        .btn-confirm:hover { background-color: var(--primary-orange-hover); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(248, 154, 32, 0.35); }

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
        <div class="logo"><i class="fa-solid fa-cube"></i> AxisLab</div>
        <div class="nav-links">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('catalogo') }}">Catálogo</a>
            <a href="{{ route('contacto') }}">Contacto</a>
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{ route('carrito') }}">Carrito</a>
        </div>
    </nav>

    <div class="checkout-header">
        <a href="{{ route('carrito') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Volver Al Carrito De Compras</a>
        <div class="checkout-count" id="checkout-count-text">0 Productos En Tu Carrito</div>
    </div>

    // DEFENSA: Formulario de checkout con validaciones de entrada y manejo de estado robusto
    <form id="checkout-form" class="checkout-layout">
        <div class="form-side">
            <h4 class="section-title">Dirección</h4>
            <div class="form-group">
                <input type="text" class="form-control" id="check-name" placeholder="Nombre completo" required>
            </div>
            <div class="form-group">
                <select id="tipo-envio" class="form-control" required style="padding-right: 40px;">
                    <option value="" disabled selected hidden>Tipo de envío</option>
                    <option value="lima_metro">Lima Metropolitana (S/. 7.00)</option>
                    <option value="lima_prov">Lima Provincia (S/. 15.00)</option>
                    <option value="provincia">Provincia (Costo por coordinar)</option>
                </select>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div id="notice-box" class="shipping-notice">
                <i class="fa-solid fa-circle-info" style="margin-right: 8px;"></i> Deberá contactarnos para saber cuánto le costaría el envío.
            </div>
            <div class="form-group">
                {{-- Añadimos id="check-address" para capturar la dirección --}}
                <input type="text" class="form-control" id="check-address" placeholder="Dirección de envío" required>
            </div>
            <div class="form-group">
                {{-- Añadimos id="check-email" para capturar el correo --}}
                <input type="email" class="form-control" id="check-email" placeholder="Dirección de correo electrónico" required>
            </div>
            <div class="form-group" style="margin-bottom: 35px;">
                <input type="text" class="form-control" id="check-phone" placeholder="Teléfono" required maxlength="9">
            </div>

            <h4 class="section-title">Datos de pago</h4>
            <div class="form-group">
                <input type="text" class="form-control" id="card-number" placeholder="0000 0000 0000 0000" required maxlength="19">
            </div>
            <div class="row-inputs">
                <div class="form-group">
                    <input type="text" class="form-control" id="card-expiry" placeholder="MM / AA" required maxlength="7">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="card-cvv" placeholder="CVV" required maxlength="3">
                </div>
            </div>
        </div>

       <div class="summary-side">
            <h3>Resumen Del Pedido</h3>
            <div class="product-manifest" id="manifest-container">
                </div>
            <div class="price-breakdown">
                <div class="breakdown-row"><span>Subtotal</span><span style="color:#000; font-weight:700;">S/. <span id="subtotal-span">0.00</span></span></div>
                <div class="breakdown-row"><span>Envío</span><span id="shipping-span" style="color:#000; font-weight:700;">S/. 0.00</span></div>
                <div class="breakdown-row total-bold"><span>Total</span><span class="total-color">S/. <span id="total-span">0.00</span></span></div>
            </div>
            <button type="submit" class="btn-confirm">Confirmar y pagar</button>
        </div>
    </form>
    
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

        // DEFENSA: Guardián de seguridad independiente y validación cruzada para Checkout
        (function() {
            const session = JSON.parse(localStorage.getItem('axislab_current_user'));
            const masterUsers = JSON.parse(localStorage.getItem('axislab_users')) || [];

            if (!session) {
                alert("Debes iniciar sesión para procesar tu compra.");
                window.location.href = '{{ route('login') }}';
                return;
            }

            const realUser = masterUsers.find(u => u.email === session.email);
            if (!realUser || realUser.role !== session.role) {
                localStorage.removeItem('axislab_current_user');
                alert("Violación de seguridad: Se ha detectado una alteración en los privilegios. Acceso denegado.");
                window.location.href = '{{ route('login') }}';
                return;
            }

            if (session.loginTime) {
                const timeElapsed = Date.now() - session.loginTime;
                const maxTime = 1 * 60 * 1000;
                
                if (timeElapsed > maxTime) {
                    localStorage.removeItem('axislab_current_user');
                    localStorage.removeItem('axislab_cart'); 
                    alert("Tu sesión ha expirado por inactividad.");
                    window.location.href = '{{ route('login') }}';
                    return; 
                }
            }
        })();

        // Validaciones de tarjeta
        document.getElementById('card-cvv').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 3);
        });

        document.getElementById('card-expiry').addEventListener('input', function(e) {
            let v = this.value.replace(/[^0-9]/g, '');
            if (v.length >= 2) {
                this.value = v.substring(0, 2) + ' / ' + v.substring(2, 4);
            } else {
                this.value = v;
            }
        });

        document.getElementById('card-number').addEventListener('input', function() {
            let v = this.value.replace(/\s+/g, '').replace(/[^0-9]/g, '');
            let parts = [];
            for (let i = 0; i < v.length; i += 4) {
                parts.push(v.substring(i, i + 4));
            }
            this.value = parts.join(' ');
        });

        // Forzar recarga si la página se carga desde la caché del botón "Atrás"
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        });

        const manifestContainer = document.getElementById('manifest-container');
        const countText = document.getElementById('checkout-count-text');
        const subtotalSpan = document.getElementById('subtotal-span');
        const shippingSpan = document.getElementById('shipping-span');
        const totalSpan = document.getElementById('total-span');
        const selectEnvio = document.getElementById('tipo-envio');
        const noticeBox = document.getElementById('notice-box');

        let rawCart = JSON.parse(localStorage.getItem('axislab_cart')) || [];
        const inventory = JSON.parse(localStorage.getItem('axislab_inventory')) || [];
        
        let cart = rawCart.filter(cartItem => {
            return inventory.some(invItem => invItem.id === cartItem.id);
        });

        if (rawCart.length !== cart.length) {
            localStorage.setItem('axislab_cart', JSON.stringify(cart));
            alert("Atención: Algunos productos de tu pedido ya no están disponibles en el catálogo y han sido removidos automáticamente.");
            if (cart.length === 0) { window.location.href = '{{ route('carrito') }}'; }
        }

        let subtotal = 0;
        let totalItems = 0;

        manifestContainer.innerHTML = '';
        if (cart.length === 0) {
            manifestContainer.innerHTML = '<div class="manifest-row"><span>El carrito está vacío</span><span class="manifest-price">S/. 0.00</span></div>';
        } else {
            cart.forEach(item => {
                const itemTotal = item.price * item.qty;
                subtotal += itemTotal;
                totalItems += item.qty;
                const rowHtml = `
                    <div class="manifest-row">
                        <span>${item.qty}x ${item.name}</span>
                        <span class="manifest-price">S/. ${itemTotal.toFixed(2)}</span>
                    </div>
                `;
                manifestContainer.insertAdjacentHTML('beforeend', rowHtml);
            });
        }

        countText.textContent = `${totalItems} ${totalItems === 1 ? 'Producto' : 'Productos'} En Tu Carrito`;
        subtotalSpan.textContent = subtotal.toFixed(2);
        totalSpan.textContent = subtotal.toFixed(2);

        selectEnvio.addEventListener('change', () => {
            let cost = 0;
            if (selectEnvio.value === 'lima_metro') {
                cost = 7; 
                noticeBox.style.display = 'none';
                shippingSpan.textContent = `S/. ${cost.toFixed(2)}`;
                totalSpan.textContent = (subtotal + cost).toFixed(2);
            } else if (selectEnvio.value === 'lima_prov') {
                cost = 15; 
                noticeBox.style.display = 'none';
                shippingSpan.textContent = `S/. ${cost.toFixed(2)}`;
                totalSpan.textContent = (subtotal + cost).toFixed(2);
            } else if (selectEnvio.value === 'provincia') {
                noticeBox.style.display = 'block';
                shippingSpan.textContent = 'Por coordinar';
                totalSpan.textContent = subtotal.toFixed(2);
            }
        });

        document.getElementById('check-name').addEventListener('input', function() { this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, ''); });
        document.getElementById('check-phone').addEventListener('input', function() { this.value = this.value.replace(/[^0-9]/g, ''); });

        document.getElementById('checkout-form').addEventListener('submit', (e) => {
            e.preventDefault();
            if(cart.length === 0) {
                alert('No puedes procesar un pedido con el carrito vacío.');
                return;
            }
            localStorage.setItem('selectedShippingType', selectEnvio.value);
            window.location.href = '{{ route('success') }}';
        
        // DEFENSA: Proceso de checkout con validación de datos y manejo de errores robusto
        
        document.getElementById('btn-process-checkout').addEventListener('click', async function() {
            // 1. Jalamos el carrito desde el almacenamiento del navegador
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            
            if (cart.length === 0) {
                alert('El carrito está vacío');
                return;
            }

            // 2. Recolectamos la información usando tus IDs originales de la pantalla anterior
            const orderData = {
                nombre: document.getElementById('check-name').value,
                tipo_envio: document.getElementById('tipo-envio').value,
                direccion: document.getElementById('check-address').value,
                correo: document.getElementById('check-email').value,
                telefono: document.getElementById('check-phone').value,
                subtotal: document.getElementById('subtotal-span').innerText,
                envio: document.getElementById('shipping-span').innerText.replace('S/. ', ''),
                total: document.getElementById('total-span').innerText,
                items: cart, 
                _token: '{{ csrf_token() }}'
            };

            // Validamos rápidamente que los campos obligatorios no estén vacíos
            if (!orderData.nombre || !orderData.direccion || !orderData.telefono) {
                alert('Por favor, complete los campos de dirección requeridos.');
                return;
            }

            try {
                // 3. Enviamos la orden completa hacia el servidor de Laravel
                const response = await fetch("{{ route('checkout.process') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(orderData)
                });

                const result = await response.json();

                if (result.success) {
                    // 4. Compra exitosa: limpiamos el almacenamiento local y avanzamos
                    localStorage.removeItem('cart');
                    window.location.href = "{{ route('checkout.success') }}";
                } else {
                    alert('Error: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Hubo un problema al conectar con el servidor.');
            }
        });
    });
</script>
</body>
</html>