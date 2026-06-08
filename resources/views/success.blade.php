<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transacción Exitosa - AxisLab</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-orange: #f89a20;
            --primary-orange-hover: #e0891b;
            --dark-gray: #55575e;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --success-green: #5ccda1;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #ffffff; color: var(--text-dark); line-height: 1.5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        /* Navbar */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 25px 0; }
        .logo { display: flex; align-items: center; font-weight: 800; font-size: 1.3rem; gap: 10px; }
        .logo i { font-size: 2.2rem; color: var(--dark-gray); }

        /* Header layout */
        .success-header { margin: 40px 0 10px; }
        .back-btn { display: flex; align-items: center; gap: 15px; text-decoration: none; color: #000; font-weight: 800; font-size: 1.8rem; }

        /* Success Central Graphic Components */
        .success-wrapper { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; margin: 40px 0 100px; padding: 0 10px; }
        
        .animated-check-holder { position: relative; margin-bottom: 30px; display: flex; justify-content: center; align-items: center; }
        .animated-check-holder .circle-bg { width: 180px; height: 180px; background-color: var(--success-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 6rem; box-shadow: 0 10px 25px rgba(92, 205, 161, 0.3); }
        
        /* Chispas amarillas */
        .spark { position: absolute; background-color: #f7ff00; border-radius: 40px; }
        .spark-1 { width: 12px; height: 35px; top: -15px; left: 45px; transform: rotate(-25deg); }
        .spark-2 { width: 12px; height: 35px; top: -15px; right: 45px; transform: rotate(25deg); }
        .spark-3 { width: 35px; height: 12px; top: 45px; left: -25px; transform: rotate(-15deg); }
        .spark-4 { width: 35px; height: 12px; top: 35px; right: -25px; transform: rotate(15deg); }

        .success-wrapper h2 { font-size: 3.5rem; font-weight: 800; margin-bottom: 20px; letter-spacing: -1px; }
        .success-wrapper p.main-msg { font-size: 1.25rem; color: var(--text-dark); font-weight: 500; max-width: 600px; margin-bottom: 20px; }

        /* Bloque Condicional para Provincias */
        .provincia-alert-box { background-color: #fff8e1; border: 2px dashed #ffe082; border-radius: 18px; padding: 25px 35px; max-width: 620px; margin-top: 15px; display: none; }
        .provincia-alert-box h5 { color: #b78103; font-size: 1.15rem; font-weight: 700; margin-bottom: 8px; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .provincia-alert-box p { color: #5d4037; font-size: 1rem; font-weight: 600; line-height: 1.4; }

        /* Footer */
        footer { padding: 50px 0 30px; border-top: 1px solid var(--border-color); }
        .footer-top { display: flex; justify-content: space-between; margin-bottom: 40px; }
        .footer-col { display: flex; align-items: flex-start; gap: 15px; }
        .footer-icon { background-color: var(--primary-orange); color: white; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .footer-info h5 { font-size: 1rem; font-weight: 700; color: var(--text-muted); margin-bottom: 5px; }
        .footer-info p { font-weight: 700; }
        .copyright { text-align: center; color: var(--text-muted); font-size: 0.9rem; border-top: 1px solid var(--border-color); padding-top: 25px; }
    </style>
</head>
<body>

<div class="container">
    <nav>
        <div class="logo"><i class="fa-solid fa-cube"></i> AxisLab</div>
    </nav>

    <div class="success-header">
        {{-- Ajuste 1: Apuntamos al home usando el asistente url de Laravel --}}
        <a href="{{ url('/') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Ir Al Inicio</a>
    </div>

    <div class="success-wrapper">
        <div class="animated-check-holder">
            <div class="spark spark-1"></div>
            <div class="spark spark-2"></div>
            <div class="spark spark-3"></div>
            <div class="spark spark-4"></div>
            <div class="circle-bg">
                <i class="fa-solid fa-check"></i>
            </div>
        </div>

        <h2>¡Transacción exitosa!</h2>
        <p class="main-msg">Hemos enviado a su correo la información de su compra.</p>

        <div id="provincia-notice-card" class="provincia-alert-box">
            <h5><i class="fa-solid fa-triangle-exclamation"></i> ACCIÓN REQUERIDA</h5>
            <p>Due to your province selection, remember to contact us quickly to calculate your shipping fee and coordinate the final delivery.</p>
        </div>
    </div>

    <footer>
        <div class="footer-top">
            <div class="footer-col">
                <div class="footer-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="footer-info"><h5>Dirección</h5><p>Enrique Segoviano, Tecsup</p></div>
            </div>
            <div class="footer-col">
                <div class="footer-icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="footer-info"><h5>Email</h5><p>cliente@axis-lab.com</p></div>
            </div>
            <div class="footer-col">
                <div class="footer-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="footer-info"><h5>Teléfono</h5><p>+51 123 456 789</p></div>
            </div>
        </div>
        <div class="copyright">© AxisLab. Todos los derechos reservados. 2026.</div>
    </footer>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Ajuste 2: Sincronizamos con el id="tipo-envio" que configuramos en la vista anterior
        const shippingType = localStorage.getItem('selectedShippingType');
        const provinciaBox = document.getElementById('provincia-notice-card');

        if (shippingType === 'provincia') {
            provinciaBox.style.display = 'block';
        }
    });
</script>
</body>
</html>