<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Precios del Gimnasio</title>

  <link rel="stylesheet" href="librerias/css/estilo_pag_principal.css" />
  <link rel="stylesheet" href="librerias/css/modal.css" />

</head>
<body>
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

  <div class="bg-img">
    <div class="container">
      <div class="text-center text-white">
        <h1>Quiénes somos nosotros</h1>
        <h3>... nosotros somos un nuevo gimnasio de apertura en tu pueblo donde podrás vivir experiencias únicas con nuestros profesores.</h3>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="text-center">
      <h1>¿POR QUÉ ESCOGER BUNKAY?</h1>
      <p>¡Ven a descubrir una nueva forma de entrenar y cuidar tu cuerpo!</p>
    </div>

    <div class="row mt-5">
      <div class="col-md-6">
        <h1>Lo que nos hace únicos y diferentes</h1>
        <p>Tenemos un enfoque personalizado en cada uno de nuestros clientes, adaptando nuestros programas a tus necesidades individuales.</p>
        <p><strong>¡Tú decides cuándo te vienes y cuándo te vas, pero te va a enganchar!</strong></p>
        <p>★★★★★ Puntos a tener en cuenta: Entrenadores certificados, Equipamiento de última generación, Ambiente motivador, Variedad de clases, Resultados garantizados.</p>
      </div>
      <div class="col-md-6">
        <img src="ruta_de_la_segunda_imagen.jpg" class="img-fluid" alt="Imagen de gimnasio" />
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-6">
        <h2>Nuestro pronóstico</h2>
        <p>Nuestra visión es crear una comunidad activa y saludable, donde cada persona pueda alcanzar sus metas de fitness de manera divertida y sostenible.</p>
      </div>
      <div class="col-md-6">
        <h2>Nuestra misión</h2>
        <p>Nuestra misión es inspirar y guiar a nuestros miembros hacia un estilo de vida más activo y saludable, proporcionando un entorno seguro y motivador para su desarrollo físico y mental.</p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
