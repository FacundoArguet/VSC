function mostrarRegistro() {
    document.getElementById('login').classList.remove('active');
    document.getElementById('registro').classList.add('active');
}

function mostrarLogin() {
    document.getElementById('registro').classList.remove('active');
    document.getElementById('login').classList.add('active');
}

window.addEventListener('DOMContentLoaded', () => {
    const parametros = new URLSearchParams(window.location.search);
    const mensaje = parametros.get('success') || parametros.get('error');
    const esRegistro = window.location.hash === '#registro';
    const elemento = document.getElementById(esRegistro ? 'regMsg' : 'loginMsg');

    if (esRegistro) {
        mostrarRegistro();
    } else {
        mostrarLogin();
    }

    if (mensaje && elemento) {
        elemento.textContent = mensaje;
        elemento.classList.add(parametros.has('success') ? 'exito' : 'error');
    }

    const registroForm = document.getElementById('registroForm');
    const usuario = document.getElementById('regUsuario');
    const correo = document.getElementById('regCorreo');
    const password = document.getElementById('regPassword');
    const passwordConfirm = document.getElementById('regPasswordConfirm');
    const barraFuerza = document.getElementById('barraFuerza');
    const fuerzaTexto = document.getElementById('fuerzaTexto');
    const botonRegistro = document.getElementById('btnRegistro');
    const mensajeRegistro = document.getElementById('regMsg');

    const actualizarFuerza = () => {
        const valor = password.value;
        const puntos = [
            valor.length >= 8,
            /[A-Z]/.test(valor),
            /[a-z]/.test(valor),
            /\d/.test(valor),
            /[^A-Za-z0-9]/.test(valor)
        ].filter(Boolean).length;
        const nivel = puntos <= 2 ? 'debil' : puntos <= 4 ? 'media' : 'fuerte';
        const etiquetas = {
            debil: obtenerTexto('strengthWeak', 'Débil'),
            media: obtenerTexto('strengthMedium', 'Media'),
            fuerte: obtenerTexto('strengthStrong', 'Fuerte')
        };
        barraFuerza.style.width = `${puntos * 20}%`;
        barraFuerza.className = nivel;
        fuerzaTexto.textContent = valor ? etiquetas[nivel] : '';
        fuerzaTexto.className = `fuerza-texto ${nivel}`;
    };

    if (password) {
        password.addEventListener('input', actualizarFuerza);
    }

    if (registroForm) {
        registroForm.addEventListener('submit', (evento) => {
            const nombreValido = usuario.value.trim().length >= 3 && usuario.value.trim().length <= 30;
            const correoValido = /^[^\s@]+@(?:gmail|hotmail|outlook)\.com$/i.test(correo.value.trim()) && correo.value.trim().length <= 100;
            const passwordValida = password.value.length >= 8 && password.value.length <= 72 && /[A-Z]/.test(password.value) && /[a-z]/.test(password.value) && /\d/.test(password.value) && /[^A-Za-z0-9]/.test(password.value);
            const confirmacionValida = password.value === passwordConfirm.value && passwordConfirm.value.length > 0;
            document.getElementById('regUsuarioMsg').textContent = nombreValido ? '' : obtenerTexto('usernameError', 'El usuario debe tener entre 3 y 30 caracteres.');
            document.getElementById('regCorreoMsg').textContent = correoValido ? '' : obtenerTexto('emailError', 'Escribe un correo válido de Gmail, Hotmail u Outlook.');
            document.getElementById('regPasswordMsg').textContent = passwordValida ? '' : obtenerTexto('passwordError', 'Usa 8-72 caracteres, mayúscula, minúscula, número y símbolo.');
            document.getElementById('regPasswordConfirmMsg').textContent = confirmacionValida ? '' : obtenerTexto('confirmPasswordError', 'Las contraseñas no coinciden.');

            if (!nombreValido || !correoValido || !passwordValida || !confirmacionValida) {
                evento.preventDefault();
                mensajeRegistro.textContent = obtenerTexto('correctFields', 'Corrige los campos marcados para continuar.');
                mensajeRegistro.className = 'mensaje-general error';
                return;
            }

            botonRegistro.disabled = true;
            botonRegistro.classList.add('cargando');
            botonRegistro.innerHTML = `<span class="spinner" aria-hidden="true"></span> ${obtenerTexto('creatingAccount', 'Creando cuenta...')}`;
        });
    }

    if (passwordConfirm) {
        passwordConfirm.addEventListener('input', () => {
            document.getElementById('regPasswordConfirmMsg').textContent = password.value === passwordConfirm.value ? '' : obtenerTexto('confirmPasswordError', 'Las contraseñas no coinciden.');
        });
    }

    // Lógica independiente para los ojitos de contraseña en los 3 campos
    const botonesOjo = document.querySelectorAll('.btn-toggle-password');
    const iconoOjoAbierto = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>`;
    const iconoOjoCerrado = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>`;

    botonesOjo.forEach(boton => {
        boton.addEventListener('click', () => {
            const targetId = boton.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const svg = boton.querySelector('svg');

            if (!input || !svg) return;

            if (input.type === 'password') {
                input.type = 'text';
                svg.innerHTML = iconoOjoCerrado;
                boton.setAttribute('aria-label', obtenerTexto('hidePassword', 'Ocultar contraseña'));
            } else {
                input.type = 'password';
                svg.innerHTML = iconoOjoAbierto;
                boton.setAttribute('aria-label', obtenerTexto('showPassword', 'Mostrar contraseña'));
            }
        });
    });
});