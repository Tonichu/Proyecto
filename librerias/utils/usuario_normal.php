
<?php
function usuarioNormal ( ){
if (!isset($_SESSION["tipo_usuarios"]) || !isset($_SESSION["id_usuarios"])) {
    // Si no ha iniciado sesión, redirige a la página de inicio de sesión
    echo "Acceso denegado. Debes de loguearte.";
    header("refresh:2;url= area_clientes.php"); // Redirige a la página principal después de 2 segundos
    exit;
  }
  if ($_SESSION["tipo_usuarios"] == 0) {
    // Si el usuario es profesor, redirige a la página de profesor
    echo "no tienes acceso a esa página";
    header("refresh:2;url= panel_de_control.php");
    exit;
  } elseif ($_SESSION["tipo_usuarios"] == 1) {
    // Si el usuario es alumno, redirige a la página
    echo "Acceso denegado. No tienes permiso para acceder a esta página.";
    header("refresh:2;url= usuario_profe.php"); // Redirige a la página principal después de 2 segundos
    exit;
  }}
  ?>