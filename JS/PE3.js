document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formulario');
    const mensajeInput = document.getElementById('mensaje');
    const emailInput = document.getElementById('email');
    const categoriaSelect = document.getElementById('categoria');
    const charCounter = document.getElementById('charCounter');
    const errorCategoria = document.getElementById('errorCategoria');
    const errorMensaje = document.getElementById('errorMensaje');
    const errorEmail = document.getElementById('errorEmail');

    if (!form || !mensajeInput || !categoriaSelect) return;

    // Contador de caracteres en tiempo real
    mensajeInput.addEventListener('input', () => {
        const cantidad = mensajeInput.value.length;
        charCounter.textContent = `${cantidad} / 200`;
        if (cantidad > 0) {
            errorMensaje.textContent = '';
        }
    });

    // Limpiar error al seleccionar categoría válida
    categoriaSelect.addEventListener('change', () => {
        if (categoriaSelect.value !== '') {
            errorCategoria.textContent = '';
        }
    });

    // Validación del Formulario al Enviar
    form.addEventListener('submit', (e) => {
        let valido = true;

        errorCategoria.textContent = '';
        errorMensaje.textContent = '';
        errorEmail.textContent = '';

        // 1. Validar Categoría
        if (!categoriaSelect.value) {
            errorCategoria.textContent = obtenerTexto('categoryError', 'Debes seleccionar una opción válida (Dibujo o Escritura).');
            valido = false;
        }

        if (!emailInput.validity.valid) {
            errorEmail.textContent = obtenerTexto('emailError', 'Escribe un correo válido de Gmail, Hotmail u Outlook.');
            valido = false;
        }

        // 2. Validar Longitud del Mensaje (no vacío y máx 200)
        const texto = mensajeInput.value.trim();
        if (texto.length === 0) {
            errorMensaje.textContent = obtenerTexto('emptyMessageError', 'El mensaje no puede estar vacío.');
            valido = false;
        } else if (texto.length > 200) {
            errorMensaje.textContent = obtenerTexto('longMessageError', 'El mensaje no puede superar los 200 caracteres.');
            valido = false;
        }

        if (!valido) e.preventDefault();
    });
});
