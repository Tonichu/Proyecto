<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="librerias/css/estilo_pag_principal.css">
  <link rel="stylesheet" href="librerias/css/modal.css">
  <link rel="stylesheet" href="librerias/css/card-carrusel.css">
  <link rel="stylesheet" href="librerias/css/carrusel-imagenes.css">
</head>

<body>
  <!-- Navbar con los modal incluidos -->
  <div class="header">
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <h2>BUNKAY</h2>
        </div>
        <div class="menu">
          <nav>
            <ul>
              <?php include 'librerias/navbar/menu_principal.php'; ?>
              <?php include 'librerias/navbar/area_clientes.php'; ?>
              <?php include 'librerias/navbar/registro_usuario.html'; ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <?php include 'librerias/index/descripcion.html'; ?>

  <?php include 'librerias/index/horarios.html'; ?>

  <?php include 'librerias/index/carousel.html'; ?>

  <?php include 'librerias/index/slider_carrousel.html'; ?>

  <?php include 'librerias/navbar/footer.php'; ?>

  <script src="librerias/javascript/pagina_principal_carrusel.js"></script>

</body>

</html>