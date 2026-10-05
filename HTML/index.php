    <?php
    session_start();
    $nombreUsuario = $_SESSION['username'] ?? null;
    $correoUsuario = $_SESSION['gmail'] ?? null;
    $logOutButton = $nombreUsuario
        ? '<a href="../PHP/logout.php" class="btn-login btn-logout" data-i18n="logout">Cerrar sesión</a>'
        : '<a href="../PHP/login.php" class="btn-login" data-i18n="login">Iniciar Sesión / Registrarse</a>';
    ?>
    <!DOCTYPE html>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Unite:Creative</title>
        <link rel="stylesheet" href="../CSS/index.css">
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
                <?php echo $logOutButton; ?>
            </div>
        </header>

        <div class="app-container">
            <aside class="sidebar" id="sidebar">
                <nav class="sidebar-nav">
                    <a href="#somos" class="sidebar-item active">
                        <span data-i18n="about">Quiénes Somos</span>
                    </a>
                    <a href="#dibujo" class="sidebar-item">
                        <span data-i18n="drawing">Dibujo</span>
                    </a>
                    <a href="#escritura" class="sidebar-item">
                        <span data-i18n="writing">Escritura</span>
                    </a>
                    <a href="PE3.php" class="sidebar-item">
                        <span data-i18n="community">Tablón Comunitario</span>
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

                <p id="mensajeEstado" class="mensaje-estado" role="status" hidden></p>

                <section class="nosotros content-section about-layout" id="somos">
                    <img src="../Imagenes/UniteCreativeIMG.jpg" alt="Logo de Unite:Creative" class="about-logo">
                    <div class="about-copy">
                        <h1 class="main-heading" data-i18n="aboutTitle">Sobre Nosotros</h1>
                        <p class="paragraph" data-i18n="indexWelcome1">
                            ¡Bienvenidos! Somos Unite:Creative, un proyecto dedicado a ayudar a las personas que quieren comenzar en el mundo del dibujo o la escritura. Con esta página proporcionamos tutoriales, consejos e imágenes donde aprenderán las bases de la escritura y el dibujo.
                        </p>
                        <p class="paragraph" data-i18n="indexWelcome2">
                            Creamos este proyecto con el fin de ayudar a todas las personas a aprender lo que nos gusta hacer, creando distintas guías y modos de enseñarles a todos de una manera clara y sencilla, para que todos puedan acceder a la información, aprender y ayudarse mutuamente en sus dudas.
                        </p>
                        <p class="paragraph" data-i18n="indexWelcome3">
                            Verás consejos básicos, conceptos y guías base para comenzar a crear, además de tener vínculos para poder ir a creadores grandes que pueden ayudarte a desarrollarte. No te convertirás en un gran artista de la noche a la mañana, pero podrás aprender las bases para comenzar a desarrollar tu propio estilo. El único límite es tu creatividad.
                        </p>
                    </div>
                </section>

                <section class="dibubasico content-section" id="dibujo">
                    <h2 class="section-title" data-i18n="drawingBasics">Conceptos básicos del dibujo</h2>

                    <ul class="concept-grid grid-6">
                        <li class="grid-card">
                            <strong data-i18n="indexDrawingAnatomyTitle">Anatomía</strong>
                            <p data-i18n="indexDrawingAnatomy">La anatomía artística estudia la estructura ósea y muscular para representar correctamente los volúmenes y proporciones del cuerpo humano, centrándose en la construcción de formas externas.</p>
                        </li>
                        <li class="grid-card">
                            <strong data-i18n="indexDrawingSkeletonsTitle">Esqueletos</strong>
                            <p data-i18n="indexDrawingSkeletons">Estructura ósea que da soporte al cuerpo. En el dibujo se utiliza como guía para marcar proporciones, poses y formas mediante figuras geométricas simples.</p>
                        </li>
                        <li class="grid-card">
                            <strong data-i18n="indexDrawingFormsTitle">Formas claves</strong>
                            <p data-i18n="indexDrawingForms">Formas geométricas básicas que representan objetos y seres vivos. Sirven para construir la figura principal antes de añadir detalles complejos.</p>
                        </li>
                        <li class="grid-card">
                            <strong data-i18n="indexDrawingMovementTitle">Movimiento</strong>
                            <p data-i18n="indexDrawingMovement">Permite representar la acción y la dinámica mediante líneas, poses y direcciones que transmiten la sensación de movimiento fluido.</p>
                        </li>
                        <li class="grid-card">
                            <strong data-i18n="indexDrawingBackgroundTitle">Fondo</strong>
                            <p data-i18n="indexDrawingBackground">Parte de la imagen que está detrás del sujeto principal. Aporta contexto, resalta al sujeto y sitúa la escena en un entorno determinado.</p>
                        </li>
                        <li class="grid-card">
                            <strong data-i18n="indexDrawingPerspectiveTitle">Perspectiva</strong>
                            <p data-i18n="indexDrawingPerspective">Técnica para representar objetos en tres dimensiones sobre una superficie plana, mostrando profundidad, distancia y volumen realista.</p>
                        </li>
                    </ul>

                    <div class="action-container">
                        <a href="PE1.php" class="btn-primary" data-i18n="fullDrawing">Ir a la sección de Dibujo completa</a>
                    </div>
                </section>

                <section class="escrbasica content-section" id="escritura">
                    <h2 class="section-title" data-i18n="writingBasics">Conceptos básicos de la escritura</h2>

                    <ul class="concept-grid grid-4">
                        <li class="grid-card">
                            <strong data-i18n="indexWritingCharactersTitle">Desarrollo de Personajes</strong>
                            <p data-i18n="indexWritingCharacters">Fundamental para dar tridimensionalidad y empatía. Evita que las figuras de la historia se sientan planas o sin personalidad.</p>
                        </li>
                        <li class="grid-card">
                            <strong data-i18n="indexWritingSettingsTitle">Desarrollo de Escenarios</strong>
                            <p data-i18n="indexWritingSettings">Los escenarios proporcionan el contexto, la cultura y las reglas en las que se desarrolla la historia, otorgando coherencia al universo.</p>
                        </li>
                        <li class="grid-card">
                            <strong data-i18n="indexWritingConflictsTitle">Conflictos</strong>
                            <p data-i18n="indexWritingConflicts">Motor de la narración que impulsa la trama e incita al cambio en los personajes. Pueden ser tanto internos como externos.</p>
                        </li>
                        <li class="grid-card">
                            <strong data-i18n="indexWritingPowerTitle">Escalas de Poder</strong>
                            <p data-i18n="indexWritingPower">Establecen jerarquías claras entre los personajes y garantizan que los enfrentamientos y la lógica del mundo se mantengan consistentes.</p>
                        </li>
                    </ul>

                    <div class="action-container">
                        <a href="PE2.php" class="btn-primary" data-i18n="fullWriting">Ir a la sección de Escritura completa</a>
                    </div>
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
