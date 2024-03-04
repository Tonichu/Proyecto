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
  require_once(__DIR__ . "/../../librerias/utils/usuario_normal.php");
  usuarioNormal();
 
  echo "Bienvenido a tu panel " . $_SESSION['nombre'];
  ?>
  <form action="../../Handlers/logout.php" method="post">
    <input type="submit" value="Cerrar sesión">
  </form>
</body>

</html>