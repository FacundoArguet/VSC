<?php

function redirigirFormulario(string $mensaje, string $tipo = 'error', bool $registro = false): void
{
    $ancla = $registro ? '#registro' : '';
    header("Location: ../HTML/form.html?{$tipo}=" . urlencode($mensaje) . $ancla);
    exit();
}

function correoValido(string $correo): bool
{
    return strlen($correo) <= 100 && preg_match('/^[^\s@]+@(?:gmail|hotmail|outlook)\.com$/i', $correo) === 1;
}

function contrasenaValida(string $contrasena): bool
{
    return strlen($contrasena) >= 8 && strlen($contrasena) <= 72
        && preg_match('/[A-Z]/', $contrasena)
        && preg_match('/[a-z]/', $contrasena)
        && preg_match('/\d/', $contrasena)
        && preg_match('/[^A-Za-z0-9]/', $contrasena);
}
