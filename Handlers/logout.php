
<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();
echo "Has cerrado sesión correctamente.";
// Redirigir al usuario a la página de inicio de sesión

header("refresh:2;url=../index.php");
exit;

?>