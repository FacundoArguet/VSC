<?php
session_start();

require_once 'db_connect.php';
require_once 'helpers.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirigirFormulario('Acceso no válido.');
}

$usuario = trim($_POST['username'] ?? '');
$contrasena = $_POST['password'] ?? '';

if ($usuario !== '' && $contrasena !== '') {
    $stmt = $conn->prepare('SELECT id, username, gmail, password, role FROM users WHERE username = ?');

    if ($stmt) {
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $cuenta = $stmt->get_result()->fetch_assoc();

        if ($cuenta && password_verify($contrasena, $cuenta['password'])) {
            session_regenerate_id(true);
            $_SESSION['username'] = $cuenta['username'];
            $_SESSION['gmail'] = $cuenta['gmail'];
            $_SESSION['user_id'] = (int) $cuenta['id'];
            $_SESSION['role'] = $cuenta['role'];
            header('Location: ../HTML/index.php');
            exit();
        }
        $stmt->close();
    }
}

redirigirFormulario('Usuario o contraseña incorrectos');
?>
