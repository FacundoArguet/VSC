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
    <title>Escritura - Unite:Creative</title>
    <link rel="stylesheet" href="../CSS/PE2.css">
    <link rel="stylesheet" href="../CSS/theme.css">
</head>

<body>

    <header class="navbar">
        <div class="navbar-left">
            <button class="menu-btn" id="toggleSidebar" aria-label="Abrir menú">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></ line>
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
                <a href="#edp" class="sidebar-item active">
                    <span data-i18n="powerScale">Escala de Poder</span>
                </a>
                <a href="#ddp" class="sidebar-item">
                    <span data-i18n="characterDevelopment">Desarrollo de Personaje</span>
                </a>
                <a href="#conflicto" class="sidebar-item">
                    <span data-i18n="conflicts">Conflictos</span>
                </a>
                <a href="#cliches" class="sidebar-item">
                    <span data-i18n="cliches">Clichés</span>
                </a>
                <a href="#ddm" class="sidebar-item">
                    <span data-i18n="worldDevelopment">Desarrollo del Mundo</span>
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
                <h1 class="main-heading" data-i18n="writingTitle">Escritura y Narrativa</h1>
                <p class="paragraph-main" data-i18n="writingIntro">Aprende los pilares fundamentales para construir historias envolventes, mundos coherentes y personajes memorables.</p>
            </section>

            <section class="content-wrapper">

                <article class="writing-card" id="edp">
                    <div class="card-header">
                        <span class="badge" data-i18n="structure">Estructura & Coherencia</span>
                        <h2 class="section-title" data-i18n="powerScaleTitle">Escala de Poder</h2>
                    </div>
                    <div class="card-body">
                        <p class="paragraph" data-i18n="writingPower1">
                            La escala de poder es una herramienta muy poderosa pero peligrosa si se ejecuta de forma deficiente. Cuando construyes un universo —especialmente si tu trama incluye constantes enfrentamientos o magia— debes establecer una jerarquía clara sobre quiénes son más poderosos y por qué.
                        </p>
                        <p class="paragraph" data-i18n="writingPower2">
                            Es crucial recordar que el poder no se limita a la fuerza física o las habilidades mágicas: la autoridad política de un rey, la influencia económica de un comerciante o la experiencia de un mentor también son formas de poder. Mantener límites claros evita el abuso de resoluciones convenientes (como el "deus ex machina") y garantiza que las victorias se sientan merecidas y satisfactorias.
                        </p>
                        <a href="https://youtu.be/_oBIsCJrePM" target="_blank" rel="noopener noreferrer" class="youtube-link">
                <img src="https://img.youtube.com/vi/_oBIsCJrePM/hqdefault.jpg" alt="Vista previa del video sobre escala de poder" class="video-preview">
                <span data-i18n="watchVideo">Ver video explicativo en YouTube</span>
            </a>
                    </div>
                </article>

                <article class="writing-card" id="ddp">
    <div class="card-header">
        <span class="badge" data-i18n="characterBuilding">Construcción de Personajes</span>
        <h2 class="section-title" data-i18n="characterDevelopmentTitle">Desarrollo de Personaje</h2>
    </div>
    <div class="card-body">
        <p class="paragraph" data-i18n="writingCharacters1">
            El desarrollo de personaje es el corazón latente de cualquier relato. Sin un arco de crecimiento, los protagonistas se perciben bidimensionales y estáticos. Imagina el avance de tu personaje como un camino progresivo: si le otorgas habilidades, sabiduría o importancia excesiva demasiado pronto, eclipsará al resto del elenco y empobrecerá la dinámica de la historia.
        </p>
        <p class="paragraph" data-i18n="writingCharacters2">
            Para evitar el "síndrome de NPC" (personajes secundarios vacíos que solo existen como adorno), otorga a cada figura motivaciones reales, defectos marcados y valores propios. Los personajes memorables evocan emociones intensas en el lector: desde una profunda empatía hasta un rechazo genuino, dependiendo de su función narrativa.
        </p>
        <a href="https://youtu.be/t4q1gY85txA" target="_blank" rel="noopener noreferrer" class="youtube-link">
                <img src="https://img.youtube.com/vi/t4q1gY85txA/hqdefault.jpg" alt="Vista previa del video sobre personajes" class="video-preview">
                <span data-i18n="watchVideo">Ver video explicativo en YouTube</span>
            </a>
    </div>
</article>

<article class="writing-card" id="conflicto">
    <div class="card-header">
        <span class="badge" data-i18n="narrativeEngine">Motor Narrativo</span>
        <h2 class="section-title" data-i18n="conflictsTitle">Conflictos</h2>
    </div>
    <div class="card-body">
        <p class="paragraph" data-i18n="writingConflicts1">
            El conflicto es el motor indispensable que impulsa la trama. Sin él, la historia pierde rumbo y el lector no encuentra motivos para continuar leyendo. Los conflictos se dividen principalmente en externos (enfrentamientos con otros personajes, monstruos, guerras o la sociedad) e internos (dudas morales, traumas o dilemas personales).
        </p>
        <p class="paragraph" data-i18n="writingConflicts2">
            Colocar obstáculos frente a tus protagonistas pone a prueba sus convicciones y los obliga a adaptarse. Es precisamente durante el proceso de resolver estas dificultades cuando los personajes cambian, maduran y revelan su verdadera naturaleza.
        </p>
        <a href="https://youtu.be/NaeUO91ryIk" target="_blank" rel="noopener noreferrer" class="youtube-link">
                <img src="https://img.youtube.com/vi/NaeUO91ryIk/hqdefault.jpg" alt="Vista previa del video sobre conflictos" class="video-preview">
                <span data-i18n="watchVideo">Ver video explicativo en YouTube</span>
            </a>
    </div>
</article>

<article class="writing-card" id="cliches">
    <div class="card-header">
        <span class="badge" data-i18n="typicalResources">Recursos Típicos</span>
        <h2 class="section-title" data-i18n="clichesTitle">Uso y Subversión de Clichés</h2>
    </div>
    <div class="card-body">
        <p class="paragraph" data-i18n="writingCliches1">
            Los clichés o tropos son fórmulas recurrentes como "el elegido", "el sabio anciano" o "el villano incomprendido". Utilizarlos no es necesariamente un error: sirven como un atajo cultural que ayuda al público a familiarizarse rápidamente con el contexto de la obra.
        </p>
        <p class="paragraph" data-i18n="writingCliches2">
            El problema surge cuando se depende únicamente de ellos sin aportar frescura. La clave para dominar un cliché es subvertirlo: toma una premisa conocida y dale un giro inesperado. De esta manera, aprovechas la comodidad del tropo para sorprender gratamente al lector cuando la historia tome una dirección imprevista.
        </p>

        <a href="https://youtu.be/kGY5BS4K0m4" target="_blank" rel="noopener noreferrer" class="youtube-link">
                <img src="https://img.youtube.com/vi/kGY5BS4K0m4/hqdefault.jpg" alt="Vista previa del video sobre clichés" class="video-preview">
                <span data-i18n="watchVideo">Ver video explicativo en YouTube</span>
            </a>
    </div>
</article>

<article class="writing-card" id="ddm">
    <div class="card-header">
        <span class="badge" data-i18n="worldbuilding">Worldbuilding</span>
        <h2 class="section-title" data-i18n="worldbuildingTitle">Desarrollo del Mundo (Worldbuilding)</h2>
    </div>
    <div class="card-body">
        <p class="paragraph" data-i18n="writingWorldbuilding1">
            El desarrollo del mundo permite diseñar la geografía, cultura, política y reglas fundamentales que rigen tu universo. Un worldbuilding sólido otorga coherencia interna al entorno y hace que la ambientación se sienta viva, trascendiendo las fronteras de los personajes principales.
        </p>

        <p class="paragraph" data-i18n="writingWorldbuilding2">
            La clave no está en abrumar al lector con manuales de historia o mapas exhaustivos, sino en mostrar la ambientación de forma orgánica a medida que influye directamente en las acciones y decisiones de los personajes.
        </p>

        <!-- Espacio para el enlace / video de YouTube -->
        <div class="youtube-link-container" style="margin-top: 15px;">
            <a href="https://youtu.be/INDOjCx9GdI" target="_blank" rel="noopener noreferrer" class="youtube-link">
                <img src="https://img.youtube.com/vi/INDOjCx9GdI/hqdefault.jpg" alt="Vista previa del video sobre construcción de mundos" class="video-preview">
                <span data-i18n="watchVideo">Ver video explicativo en YouTube</span>
            </a>
        </div>
    </div>
</article>
            </section>

            <footer class="site-footer">
                <div class="footer-brand"><h3>Unite:Creative</h3><p>© 2026 Todos los derechos reservados</p></div>
                <div class="footer-contact"><h4>Contactos</h4><ul><li>facundocampos916@gmail.com</li><li>francoweber7@gmail.com</li><li>facu08nacho13@gmail.com</li></ul></div>
            </footer>
        </main>
    </div>
    <script src="../JS/site.js"></script>
</body>
</html>
