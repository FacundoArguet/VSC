<?php
session_start();

require_once 'db_connect.php';

function redirigirPedidos(string $mensaje, string $tipo = 'error'): void
{
    header('Location: ../HTML/PE3.php?' . $tipo . '=' . urlencode($mensaje));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigirPedidos('Acceso no válido.');
}

$userId = (int) ($_SESSION['user_id'] ?? 0);
$correoSesion = trim($_SESSION['gmail'] ?? '');
if (!$userId || !filter_var($correoSesion, FILTER_VALIDATE_EMAIL)) {
    redirigirPedidos('Debes iniciar sesión para crear un pedido.');
}

$correo = trim($_POST['email'] ?? '');
$categoria = trim($_POST['category'] ?? '');
$detalle = trim($_POST['details'] ?? '');
$categorias = ['dibujo', 'escritura'];

if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || strcasecmp($correo, $correoSesion) !== 0
    || !in_array($categoria, $categorias, true) || $detalle === '' || mb_strlen($detalle) > 200) {
    redirigirPedidos('Revisa el correo, el área y los detalles del pedido.');
}

$stmt = $conn->prepare('INSERT INTO orders (user_id, email, category, details) VALUES (?, ?, ?, ?)');
if (!$stmt) {
    redirigirPedidos('No se pudo guardar el pedido.');
}

$stmt->bind_param('isss', $userId, $correo, $categoria, $detalle);
if (!$stmt->execute()) {
    redirigirPedidos('No se pudo guardar el pedido.');
}

redirigirPedidos('Pedido creado correctamente.', 'success');
