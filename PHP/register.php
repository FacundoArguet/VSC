<?php
session_start(); 

// Carga la conexión a la base de datos
require_once 'db_connect.php';
require_once 'helpers.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirigirFormulario('Acceso no válido.', 'error', true);
}

$usuario = trim($_POST['username'] ?? '');
$correo = trim($_POST['gmail'] ?? '');
$contrasena = $_POST['password'] ?? '';
$confirmacion = $_POST['password_confirm'] ?? '';

if (strlen($usuario) < 3 || strlen($usuario) > 30 || !correoValido($correo)
    || !contrasenaValida($contrasena) || !hash_equals($contrasena, $confirmacion)) {
    redirigirFormulario('Completa correctamente los campos y confirma la contraseña.', 'error', true);
}

$consulta = $conn->prepare('SELECT username, gmail FROM users WHERE username = ? OR gmail = ?');
if (!$consulta) redirigirFormulario('No se pudo validar el registro.', 'error', true);

$consulta->bind_param('ss', $usuario, $correo);
$consulta->execute();

foreach ($consulta->get_result() as $existente) {
    $mensaje = $existente['username'] === $usuario
        ? 'Ese nombre de usuario ya está utilizado.'
        : 'Este correo ya está utilizado.';
    redirigirFormulario($mensaje, 'error', true);
}

$hash = password_hash($contrasena, PASSWORD_BCRYPT);
$registro = $conn->prepare('INSERT INTO users (username, gmail, password) VALUES (?, ?, ?)');
if (!$registro) redirigirFormulario('No se pudo procesar el registro.', 'error', true);

$registro->bind_param('sss', $usuario, $correo, $hash);
if (!$registro->execute()) redirigirFormulario('El nombre de usuario o correo ya está registrado.', 'error', true);

session_regenerate_id(true);
$_SESSION['username'] = $usuario;
$_SESSION['gmail'] = $correo;
$_SESSION['user_id'] = (int) $registro->insert_id;
$_SESSION['role'] = 'user';
header('Location: ../HTML/index.php?success=' . urlencode('¡Cuenta creada con éxito!'));
exit();
?>
