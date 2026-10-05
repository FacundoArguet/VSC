(() => {
    const $ = (selector, raiz = document) => raiz.querySelector(selector);
    window.obtenerTexto = (clave, alternativo) => window.textosActuales?.[clave] || alternativo;

    function aplicarTraduccion(traducciones, idioma) {
        const textos = traducciones[idioma];
        if (!textos) return;

        document.documentElement.lang = idioma;
        window.textosActuales = textos;
        const tipos = { i18n: 'textContent', i18nPlaceholder: 'placeholder', i18nTitle: 'title', i18nAriaLabel: 'aria-label' };

        Object.entries(tipos).forEach(([dato, atributo]) => {
            const selector = `[data-${dato.replace(/[A-Z]/g, (letra) => `-${letra.toLowerCase()}`)}]`;
            document.querySelectorAll(selector).forEach((elemento) => {
                const valor = textos[elemento.dataset[dato]];
                if (!valor) return;
                atributo === 'textContent' ? elemento.textContent = valor : elemento.setAttribute(atributo, valor);
            });
        });
    }

    async function iniciarTraducciones() {
        try {
            const respuesta = await fetch('../translations.json');
            if (!respuesta.ok) throw new Error(`HTTP ${respuesta.status}`);

            const traducciones = await respuesta.json();
            aplicarTraduccion(traducciones, localStorage.getItem('idioma') || 'es');
            $('#lang-btn')?.addEventListener('click', () => {
                const idioma = document.documentElement.lang === 'es' ? 'en' : 'es';
                localStorage.setItem('idioma', idioma);
                aplicarTraduccion(traducciones, idioma);
            });
        } catch (error) {
            console.error('No se pudieron cargar las traducciones:', error);
        }
    }

    function iniciarMenuUsuario() {
        const boton = $('#userMenuToggle');
        const menu = $('#userMenu');
        if (!boton || !menu) return;

        const cerrar = () => {
            menu.hidden = true;
            boton.setAttribute('aria-expanded', 'false');
        };

        boton.addEventListener('click', () => {
            const abierto = !menu.hidden;
            menu.hidden = abierto;
            boton.setAttribute('aria-expanded', String(!abierto));
            if (abierto) cerrar();
        });
        document.addEventListener('click', (evento) => !menu.contains(evento.target) && !boton.contains(evento.target) && cerrar());
        document.addEventListener('keydown', (evento) => evento.key === 'Escape' && cerrar());
    }

    function iniciarNavegacionActiva() {
        const enlaces = [...document.querySelectorAll('.sidebar-item[href^="#"]')];
        const secciones = enlaces
            .map((enlace) => ({ enlace, seccion: document.querySelector(enlace.getAttribute('href')) }))
            .filter(({ seccion }) => seccion);
        if (!secciones.length) return;

        const activar = (elemento) => secciones.forEach(({ enlace, seccion }) => {
            const activa = seccion === elemento;
            enlace.classList.toggle('active', activa);
            activa ? enlace.setAttribute('aria-current', 'location') : enlace.removeAttribute('aria-current');
        });

        const actualizar = () => {
            const referencia = window.innerHeight * 0.35;
            const actual = secciones
                .filter(({ seccion }) => seccion.getBoundingClientRect().top <= referencia)
                .at(-1);
            activar(actual?.seccion || secciones[0].seccion);
        };

        window.addEventListener('scroll', actualizar, { passive: true });
        window.addEventListener('hashchange', actualizar);
        actualizar();
    }

    function iniciarInterfaz() {
        const barra = $('#sidebar');
        $('#toggleSidebar')?.addEventListener('click', () => barra?.classList.toggle('collapsed'));

        const parametros = new URLSearchParams(location.search);
        const estado = parametros.get('success') || parametros.get('error');
        const mensaje = $('#mensajeEstado');
        if (estado && mensaje) {
            mensaje.textContent = estado;
            mensaje.hidden = false;
            mensaje.classList.add(parametros.has('success') ? 'exito' : 'error');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        iniciarTraducciones();
        iniciarMenuUsuario();
        iniciarNavegacionActiva();
        iniciarInterfaz();
    });
})();
