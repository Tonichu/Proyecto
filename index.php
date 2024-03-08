<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="librerias/css/style.css">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>

<body >
  <?php
  include('layout/navbar/navbar.php');
  ?>
  <h1>Bienvenido a Bunkay</h1>
  <a href="pages/calendario/calendario.php">calendario</a>
  <div class="container">
    <div class="row" style="background-color: blue;">
      <div class="col-lg-6 col-md-1 col-xs-11" style="background-color: red;">.col-md-8</div>
      <div class="col-lg-6 col-md-4 col-xs-6" style="background-color: green;">.col-md-4</div>
    </div>
    <div class="row">
      <div class="col-md-4">.col-md-4</div>
      <div class="col-md-4">.col-md-4</div>
      <div class="col-md-4">.col-md-4</div>
    </div>
    <div class="row">
      <div class="col-md-6">.col-md-6</div>
      <div class="col-md-6">.col-md-6</div>
    </div>
  </div>
  <div>
    <div class="container"></div>
    <div class="container"></div>
    <div class="container"></div>
    <div class="container"></div>
    <div class="container"></div>
    <div class="container"></div>
    <div class="container"></div>
    <div class="container"></div>
  </div>
  <div class="container">
  <button onclick="window.modal1.showModal();">Abrir  ventana modal</button>
  <dialog id="modal1">
  <h2>Registro de Usuario</h2>
    <form action="usuarios/crear_usuario.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono"><br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion"><br><br>

        <label for="pass">Contraseña:</label>
        <input type="password" id="pass" name="pass" required><br><br>

        <label for="foto">Foto de Perfil:</label>
        <input type="file" id="foto" name="foto"><br><br>

        <input type="submit" value="Registrar">
    </form>
  <button onclick="window.modal1.close();">Cerrar</button>
</div>
</body>

</html>