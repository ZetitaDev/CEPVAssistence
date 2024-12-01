<?php
// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Evitar que el navegador almacene la caché de esta página
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// Redirigir a la página de login después de cerrar sesión
header("Location: ../Login.php");
exit();
?>
