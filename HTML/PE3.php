<?php
session_start();
require_once '../PHP/db_connect.php';

$usuario = null;
$pedidos = [];
$correoSesion = $_SESSION['gmail'] ?? '';

if ($correoSesion) {
    $consultaUsuario = $conn->prepare('SELECT id, username, gmail, role FROM users WHERE gmail = ?');
    $consultaUsuario->bind_param('s', $correoSesion);
    $consultaUsuario->execute();
    $usuario = $consultaUsuario->get_result()->fetch_assoc();
    $consultaUsuario->close();

    if ($usuario) {
        $userId = (int) $usuario['id'];
        $_SESSION['user_id'] = $userId;
        $_SESSION['role'] = $usuario['role'];
        $esAdmin = $usuario['role'] === 'admin';
        $sql = 'SELECT o.email, o.category, o.details, o.status, o.created_at, u.username
                FROM orders o INNER JOIN users u ON u.id = o.user_id';

        if ($esAdmin) {
            $consultaPedidos = $conn->prepare($sql . ' ORDER BY o.created_at DESC');
        } else {
            $consultaPedidos = $conn->prepare($sql . ' WHERE o.user_id = ? ORDER BY o.created_at DESC');
            $consultaPedidos->bind_param('i', $userId);
        }
        $consultaPedidos->execute();
        $pedidos = $consultaPedidos->get_result()->fetch_all(MYSQLI_ASSOC);
        $consultaPedidos->close();
    }
}

function escapar(?string $texto): string
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

$mensaje = $_GET['success'] ?? $_GET['error'] ?? '';
$tipoMensaje = isset($_GET['success']) ? 'exito' : 'error';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-i18n="ordersPageTitle">Pedidos y Ayuda - Unite:Creative</title>
    <link rel="stylesheet" href="../CSS/PE3.css">
    <link rel="stylesheet" href="../CSS/translation-button.css">
    <link rel="stylesheet" href="../CSS/theme.css">
    <script src="../JS/PE3.js" defer></script>
</head>
<body class="bg-imagen orders-page">
    <div class="overlay"></div>
    <main class="contenedor-centrado">
        <div class="card-ayuda">
            <a href="index.php" class="btn-volver" data-i18n="backIndex">← Volver al inicio</a>

            <header class="card-header">
                <span class="badge-tag" data-i18n="ordersBadge">Pedidos y ayuda</span>
                <h1 data-i18n="ordersHeading">PEDIDOS Y AYUDA</h1>
                <p class="descripcion" data-i18n="ordersDescription">Crea y consulta solicitudes relacionadas con dibujo y escritura.</p>
            </header>

            <?php if ($mensaje): ?>
                <p class="mensaje-feedback <?= $tipoMensaje ?>" role="status"><?= escapar($mensaje) ?></p>
            <?php endif; ?>

            <?php if ($usuario): ?>
                <form id="formulario" action="../PHP/orders.php" method="post" novalidate>
                    <div class="form-group">
                        <label for="email" data-i18n="orderEmailLabel">Correo electrónico</label>
                        <input id="email" name="email" type="email" value="<?= escapar($usuario['gmail']) ?>" required readonly>
                        <span class="mensaje-error" id="errorEmail"></span>
                    </div>

                    <div class="form-group">
                        <label for="categoria"><span data-i18n="helpArea">Área de ayuda</span> <span class="required">*</span></label>
                        <select id="categoria" name="category" required>
                            <option value="" disabled selected data-i18n="unspecified">Sin especificar</option>
                            <option value="dibujo" data-i18n="drawingOption">Dibujo</option>
                            <option value="escritura" data-i18n="writingOption">Escritura</option>
                        </select>
                        <span class="mensaje-error" id="errorCategoria"></span>
                    </div>

                    <div class="form-group">
                        <div class="label-with-counter">
                            <label for="mensaje" data-i18n="orderDetailsLabel">Detalles del pedido</label>
                            <span class="char-counter" id="charCounter">0 / 200</span>
                        </div>
                        <textarea id="mensaje" name="details" rows="4" maxlength="200" required data-i18n-placeholder="orderDetailsPlaceholder" placeholder="Describe el producto o servicio que necesitas..."></textarea>
                        <span class="mensaje-error" id="errorMensaje"></span>
                    </div>

                    <button type="submit" class="btn-submit" data-i18n="createOrder">Crear pedido</button>
                </form>
            <?php else: ?>
                <section class="auth-cta">
                    <h2 data-i18n="authRequiredTitle">Inicia sesión para crear un pedido</h2>
                    <p data-i18n="authRequiredText">Los pedidos están disponibles únicamente para usuarios registrados.</p>
                    <a class="btn-primary" href="form.html#login" data-i18n="login">Iniciar Sesión / Registrarse</a>
                </section>
            <?php endif; ?>

            <?php if ($usuario): ?>
                <section class="orders-list" aria-labelledby="ordersListTitle">
                    <h2 id="ordersListTitle" data-i18n="ordersListTitle">Mis pedidos</h2>
                    <?php if ($pedidos): ?>
                        <div class="orders-table-wrap">
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th data-i18n="orderPerson">Persona</th>
                                        <th data-i18n="orderEmailLabel">Correo electrónico</th>
                                        <th data-i18n="orderDetailsLabel">Detalles del pedido</th>
                                        <th data-i18n="orderStatus">Estado</th>
                                        <th data-i18n="orderCreatedAt">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pedidos as $pedido): ?>
                                        <tr>
                                            <td><?= escapar($pedido['username']) ?></td>
                                            <td><?= escapar($pedido['email']) ?></td>
                                            <td><strong><?= escapar(ucfirst($pedido['category'])) ?></strong><br><?= escapar($pedido['details']) ?></td>
                                            <td><?= escapar($pedido['status']) ?></td>
                                            <td><?= escapar(date('d/m/Y H:i', strtotime($pedido['created_at']))) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="empty-orders" data-i18n="noOrders">Todavía no has creado pedidos.</p>
                    <?php endif; ?>
                </section>
            <?php endif; ?>
        </div>
    </main>

    <button class="btn-subir" type="button" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" title="Subir al inicio" data-i18n-title="backToTop">
        <span data-i18n="backToTop">Subir al inicio</span>
    </button>
    <button class="translation-button" id="lang-btn" type="button" aria-label="Cambiar idioma" title="Cambiar idioma">
        <img src="../Imagenes/translate-icon.svg" alt="Traducir">
        <span class="sr-only" data-i18n="language">Idioma: English</span>
    </button>
    <script src="../JS/site.js"></script>
</body>
</html>
