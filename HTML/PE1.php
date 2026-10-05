<?php
session_start();
$nombreUsuario = $_SESSION['username'] ?? null;
$correoUsuario = $_SESSION['gmail'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dibujo - Unite:Creative</title>
    <link rel="stylesheet" href="../CSS/PE1.css">
    <link rel="stylesheet" href="../CSS/theme.css">
</head>

<body>

    <header class="navbar">
        <div class="navbar-left">
            <button class="menu-btn" id="toggleSidebar" aria-label="Abrir menú">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="navbar-right">
            <a href="index.php" class="btn-login" data-i18n="backHome">← inicio</a>
        </div>
    </header>

    <div class="app-container">
        <aside class="sidebar" id="sidebar">
            <nav class="sidebar-nav">
                <a href="index.php" class="sidebar-item">
                    <span data-i18n="home">Inicio</span>
                </a>
                <a href="#anatomia-info" class="sidebar-item active">
                    <span data-i18n="anatomy">Anatomía</span>
                </a>
                <a href="#poses-info" class="sidebar-item">
                    <span data-i18n="poses">Poses</span>
                </a>
                <a href="#formas-info" class="sidebar-item">
                    <span data-i18n="forms">Formas</span>
                </a>
                <a href="#esqueletos-info" class="sidebar-item">
                    <span data-i18n="skeletons">Esqueletos</span>
                </a>
                <a href="#sombreado-info" class="sidebar-item">
                    <span data-i18n="shading">Sombreado</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <button class="sidebar-user" id="userMenuToggle" type="button" aria-expanded="false" aria-controls="userMenu">
                    <span class="sidebar-username"><?php echo $nombreUsuario ? htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8') : 'Usuario'; ?></span>
                </button>
                <div class="user-menu" id="userMenu" hidden>
                    <strong><?php echo $nombreUsuario ? htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8') : 'Usuario'; ?></strong>
                    <span><?php echo $correoUsuario ? htmlspecialchars($correoUsuario, ENT_QUOTES, 'UTF-8') : 'Correo no disponible'; ?></span>
                    <button type="button" class="user-menu-option" data-i18n="theme">Tema: Claro</button>
                    <button type="button" class="user-menu-option" id="lang-btn" data-i18n="language">Idioma: English</button>
                    <a class="user-menu-logout" href="../PHP/logout.php" data-i18n="logout">Cerrar sesión</a>
                </div>
            </div>
        </aside>

        <main class="main-content">

            <section class="intro">
                <h1 class="main-heading" data-i18n="drawingTitle">Dibujo</h1>
                <p class="paragraph-main" data-i18n="drawingIntro">Explora los fundamentos del dibujo con explicaciones detalladas y ejemplos visuales para desarrollar tu propio estilo.</p>
            </section>

            <section class="content-wrapper">

                <article class="flex-card" id="anatomia-info">
                    <div class="card-text">
                        <h2 class="section-title" data-i18n="anatomy">Anatomía</h2>
                        <p class="paragraph" data-i18n="drawingAnatomy1">
                            La anatomía es uno de los pilares más importantes del dibujo, especialmente cuando se quieren crear personajes creíbles. No significa aprender cada músculo o hueso de memoria, sino comprender cómo está construido el cuerpo humano y cómo se relacionan sus diferentes partes. 
                        </p>
                        <p class="paragraph" data-i18n="drawingAnatomy2">
                            Con una buena base de anatomía será más fácil dibujar personas en distintas posiciones, expresar emociones y evitar proporciones extrañas. Incluso si tu estilo es caricaturesco o anime, conocer la anatomía te permitirá exagerar o simplificar las formas sin que el dibujo pierda naturalidad.
                        </p>
                        <a href="https://www.youtube.com/watch?v=NfwuAZ6ycOs" target="_blank" rel="noopener noreferrer" class="youtube-link">
                            <img src="https://img.youtube.com/vi/NfwuAZ6ycOs/hqdefault.jpg" alt="Vista previa del video sobre anatomía" class="video-preview">
                            <span data-i18n="watchVideo">Ver video explicativo en YouTube</span>
                        </a>
                    </div>
                    <div class="card-media">
                        <img src="../Imagenes/WhatsApp Image 2026-07-20 at 2.37.40 PM (1).jpeg" alt="Estudio de anatomía">
                    </div>
                </article>

                <article class="flex-card" id="poses-info">
                    <div class="card-text">
                        <h2 class="section-title" data-i18n="poses">Poses</h2>
                        <p class="paragraph" data-i18n="drawingPoses1">
                            Las poses transmiten energía, emoción y movimiento a tus ilustraciones. Una figura bien planteada puede mostrar acción y personalidad sin necesidad de recargarla con demasiados detalles.
                        </p>
                        <p class="paragraph" data-i18n="drawingPoses2">
                            Aprender la "línea de acción" ayuda a que la figura no se sienta rígida. Combinar la inclinación de los hombros y la cadera aporta dinamismo natural a la postura del personaje.
                        </p>
                          <a href="https://www.youtube.com/watch?v=Tb6ZJ8IyqBA" target="_blank" rel="noopener noreferrer" class="youtube-link">
                            <img src="https://img.youtube.com/vi/Tb6ZJ8IyqBA/hqdefault.jpg" alt="Vista previa del video sobre poses" class="video-preview">
                            <span data-i18n="watchVideo">Ver video explicativo en YouTube</span>
                        </a>
                    </div>
                    <div class="card-media">
                        <img src="../Imagenes/WhatsApp Image 2026-07-20 at 2.37.40 PM.jpeg" alt="Poses de dibujo">
                    </div>
                </article>

                <article class="flex-card" id="formas-info">
                    <div class="card-text">
                        <h2 class="section-title" data-i18n="forms">Formas</h2>
                        <p class="paragraph" data-i18n="drawingForms1">
                            Trabajar a partir de formas geométricas básicas (círculos, cubos, cilindros) facilita la construcción de cualquier objeto o ser vivo en tres dimensiones.
                        </p>
                        <p class="paragraph" data-i18n="drawingForms2">
                            Desglosar una imagen compleja en formas simples te permite capturar las proporciones correctas antes de dedicar tiempo a dibujar contornos o detalles finales.
                        </p>
                          <a href="https://www.youtube.com/watch?v=YWGNQdVki-s" target="_blank" rel="noopener noreferrer" class="youtube-link">
                            <img src="https://img.youtube.com/vi/YWGNQdVki-s/hqdefault.jpg" alt="Vista previa del video sobre formas" class="video-preview">
                            <span data-i18n="watchVideo">Ver video explicativo en YouTube</span>
                        </a>
                    </div>
                    <div class="card-media">
                        <img src="../Imagenes/skibidi.jpeg" alt="Formas básicas de dibujo">
                    </div>
                </article>

                <article class="flex-card" id="esqueletos-info">
                    <div class="card-text">
                        <h2 class="section-title" data-i18n="skeletons">Esqueletos</h2>
                        <p class="paragraph" data-i18n="drawingSkeletons1">
                            El esqueleto simplificado o monigote funciona como la estructura interna del cuerpo. Entender su posición y proporción permite crear bases estables antes de colocar músculos y ropa.
                        </p>
                        <p class="paragraph" data-i18n="drawingSkeletons2">
                            Utilizar esquemas simples reduce significativamente el margen de error en la perspectiva y en la escala general de tus dibujos.
                        </p>
                          <a href="https://www.youtube.com/watch?v=yZC3UAscogA" target="_blank" rel="noopener noreferrer" class="youtube-link">
                            <img src="https://img.youtube.com/vi/yZC3UAscogA/hqdefault.jpg" alt="Vista previa del video sobre esqueletos" class="video-preview">
                            <span data-i18n="watchVideo">Ver video explicativo en YouTube</span>
                        </a>
                    </div>
                    <div class="card-media">
                        <img src="../Imagenes/WhatsApp Image 2026-07-20 at 2.37.40 PM (2).jpeg" alt="Esqueleto de referencia">
                    </div>
                </article>

                <article class="flex-card" id="sombreado-info">
                    <div class="card-text">
                        <h2 class="section-title" data-i18n="shading">Sombreado</h2>
                        <p class="paragraph" data-i18n="drawingShading1">
                            El sombreado aporta profundidad, contraste y volumen a una imagen. Con diferentes valores de gris y definiendo claramente la fuente de luz, un dibujo pasa de ser bidimensional a sentirse sólido.
                        </p>
                        <p class="paragraph" data-i18n="drawingShading2">
                            Dominar los degradados, sombras propias y proyectadas te dará la habilidad de crear distintas texturas e iluminación realista en tus obras.
                        </p>
                          <a href="https://www.youtube.com/watch?v=CyMVDYBleDk" target="_blank" rel="noopener noreferrer" class="youtube-link">
                            <img src="https://img.youtube.com/vi/CyMVDYBleDk/hqdefault.jpg" alt="Vista previa del video sobre sombreado" class="video-preview">
                            <span data-i18n="watchVideo">Ver video explicativo en YouTube</span>
                        </a>
                    </div>
                    <div class="card-media">
                        <img src="../Imagenes/WhatsApp Image 2026-07-20 at 2.37.39 PM.jpeg" alt="Ejemplo de sombreado">
                    </div>
                </article>

            </section>

            <footer class="site-footer">
                <div class="footer-brand">
                    <h3>Unite:Creative</h3>
                    <p>© 2026 Todos los derechos reservados</p>
                </div>
                <div class="footer-contact">
                    <h4>Contactos</h4>
                    <ul>
                        <li>facundocampos916@gmail.com</li>
                        <li>francoweber7@gmail.com</li>
                        <li>facu08nacho13@gmail.com</li>
                    </ul>
                </div>
            </footer>

        </main>
    </div>

    <script src="../JS/site.js"></script>
</body>

</html>
