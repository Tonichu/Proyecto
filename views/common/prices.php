<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Precios del Gimnasio</title>

  <link rel="stylesheet" href="../../public/css/Homepage/Homepage.css" />
  <link rel="stylesheet" href="../../public/css/Homepage/modal.css" />
  <link rel="stylesheet" href="../../public/css/prices/prices.css" />

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
              <?php include '../navbar/homepage.php'; ?>
              <?php include '../navbar/customer_area.php'; ?>
              <?php include '../navbar/user_registration.php'; ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="precios">
    <div class="contenedor-precios">
      <div class="plan-gimnasio">
        <h2>Básico</h2>
        <img src="../../public/img/icons/basico.png" alt="">
        <h3>60 <sup>€</sup></h3>
        <p>Escoge a que servicio te quieres apuntar y disfruta de todas las ventajas de entrenar con nuestros mejores
          profesores</p>
        <a href="credit_card.php" class="boton-comprar">Comprar ahora</a>
      </div>
      <div class="plan-gimnasio">
        <h2>Estándar</h2>
        <img src="../../public/img/icons/estandar.png" alt="">
        <h3>100 <sup>€</sup></h3>
        <p>Apuntate ahora y tendras acceso a 3 de nuestros servicios a tu elección. Disfruta de las ventajas de nuestras
          instalaciones</p>
        <a href="credit_card.php" class="boton-comprar">Comprar ahora</a>
      </div>
      <div class="plan-gimnasio">
        <h2>Premium</h2>
        <img src="../../public/img/icons/premium.png" alt="">
        <h3>200 <sup>€</sup></h3>
        <p><strong>Acceso ilimitado a todas las clases. Paga ahora y ahorrate hasta un 20% de descuento.</strong> </p>
        <p>
          Podrás disfrutar de los
          mejores entrenamientos juntos a nuestros profesores de confianza y tendrás un asesoramiento personal de
          nuestro entrenador personal.
        </p>
        <a href="credit_card.php" class="boton-comprar">Comprar ahora</a>
      </div>
    </div>
  </div>

  <div class="footer">
    <p id="frase-motivacional"></p>
  </div>
  <?php include '../navbar/footer.php'; ?>
  <script src="../../public/js/prices/motivationalQuotes.js"></script>

</body>

</html>