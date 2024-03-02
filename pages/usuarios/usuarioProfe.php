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
echo "Bienvenido al panel de Profesores " . $_SESSION['nombre'];
?>
<form action="../../Handlers/logout.php" method="post">
    <input type="submit" value="Cerrar sesión">
  </form>
</body>
</html>
