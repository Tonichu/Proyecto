<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Página usuarios</h1>
  <form class="formIndex" action="comprobar_usuario.php" method="post">
    <label class="labelIndex" for="Email">Nombre de Email:</label>
    <input type="text" id="Email" name="Email" required>

    <label class="labelIndex" for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <input class="botonInicio" type="submit" value="Login">
  </form>
  <a href="../../index.php"><button>Cancelar</button></a>
</body>

</html>