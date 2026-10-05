<?php

session_start();
session_unset();
session_destroy();
header("Location: ../HTML/form.html?success=" . urlencode("Sesión cerrada correctamente."));
exit();
?>