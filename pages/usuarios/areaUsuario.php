<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <?php
  session_start();

  if (!isset($_SESSION["tipo_usuarios"]) || !isset($_SESSION["id_usuarios"])) {
    // Si no ha iniciado sesión, redirige a la página de inicio de sesión
    echo "Acceso denegado. Debes de loguearte.";
    header("refresh:2;url= areaClientes.php"); // Redirige a la página principal después de 2 segundos
    exit;
  }
  if ($_SESSION["tipo_usuarios"] == 0) {
    // Si el usuario es profesor, redirige a la página de profesor
    echo "no tienes acceso a esa página";
    header("refresh:2;url= panelDeControl.php");
    exit;
  } elseif ($_SESSION["tipo_usuarios"] == 1) {
    // Si el usuario es alumno, redirige a la página
    echo "Acceso denegado. No tienes permiso para acceder a esta página.";
    header("refresh:2;url= usuarioProfe.php"); // Redirige a la página principal después de 2 segundos
    exit;
  }
  echo "Bienvenido a tu panel " . $_SESSION['nombre'];
  ?>
  <form action="../../Handlers/logout.php" method="post">
    <input type="submit" value="Cerrar sesión">
  </form>
</body>

</html>