<?php
session_start();


if (!isset($_SESSION["tipo_usuarios"]) || !isset($_SESSION["id_usuarios"])) {
  // Si no ha iniciado sesión, redirige a la página de inicio de sesión
  echo "Acceso denegado. Debes de loguearte.";
  header("refresh:2;url= areaClientes.php"); // Redirige a la página principal después de 2 segundos
  exit;
}
if ($_SESSION["tipo_usuarios"] == 1) {
  // Si el usuario es profesor, redirige a la página de profesor
  echo "no tienes acceso a esa página";
  header("refresh:2;url= usuarioProfe.php");
  exit;
} elseif ($_SESSION["tipo_usuarios"] == 2) {
  // Si el usuario es alumno, redirige a la página
  echo "Acceso denegado. No tienes permiso para acceder a esta página.";
  header("refresh:2;url= areaUsuario.php"); // Redirige a la página principal después de 2 segundos
  exit;
}
// Verifica si el tipo de usuario es 0 (admin)
echo "Bienvenido al panel de administrador " . $_SESSION['nombre'];
// Si el usuario no ha iniciado sesión de administrador, se redirige a index.php

$tipo_usuario = $_SESSION["tipo_usuarios"];

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Tabla de usuarios</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <form action="../../Handlers/logout.php" method="post">
    <input type="submit" value="Cerrar sesión">
  </form>