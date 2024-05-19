<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events</title>
  <link rel="stylesheet" href="../../public/css/Homepage/Homepage.css" />
  <link rel="stylesheet" href="../../public/css/Homepage/modal.css" />
  <link rel="stylesheet" href="../../public/css/event/event.css" />

  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" />
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

  <section class="seccion">
    <div class="contenedor">
      <div class="fila">
        <div class="imagen">
          <img class="img-responsive" src="../../public/img\icons/reloj.png" alt="" />
        </div>
        <div class="col-md-4 col-md-offset-2 col-sm-5">
          <h2>Próximo evento del gimnasio bunkai</h2>
        </div>
        <div class="col-sm-7 col-md-6">
          <ul class="cuenta" id="cuenta-regresiva">
            <li>
              <span class="dias fuente-tiempo">10</span>
              <p class="etiqueta-tiempo">días</p>
            </li>
            <li>
              <span class="horas fuente-tiempo">01</span>
              <p class="etiqueta-tiempo">horas</p>
            </li>
            <li>
              <span class="minutos fuente-tiempo">50</span>
              <p class="etiqueta-tiempo">minutos</p>
            </li>
            <li>
              <span class="segundos fuente-tiempo">14</span>
              <p class="etiqueta-tiempo">segundos</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <div class="contenedor linea-eventos">
    <aside>
      <div class="contenedor-eventos" id="eventos">
        <h3 class="titulo">Eventos</h3>
        <ul class="lista">
          <li class="activo">
            <a href="#1">1. Encuentro con Campeón de Culturismo</a>
          </li>
          <li><a href="#2">2. Charla con Ciclista Profesional</a></li>
          <li>
            <a href="#3">3. Clínica de Natación con Medallista Olímpico</a>
          </li>
          <li>
            <a href="#4">
              4. Entrenamiento de Tenis con Exjugador Profesional</a>
          </li>
          <li>
            <a href="#5">5. Exhibición de Pádel con Estrella Internacional</a>
          </li>
          <li>
            <a href="#6">6. Taller de Nutrición con Expertos en Fitness</a>
          </li>
          <li>
            <a href="#7">
              7. Conferencia de Psicología Deportiva con Renombrado
              Psicólogo</a>
          </li>
          <li>
            <a href="#8">8. Demostración de CrossFit con Atleta de Alto Rendimiento</a>
          </li>
          <li>
            <a href="#9">9. Charla con Futbolista Retirado: Experiencias y Anécdotas</a>
          </li>
          <li>
            <a href="#10">10. Encuentro con Campeón de CrossFit Español</a>
          </li>
        </ul>
      </div>
    </aside>
    <main>
      <div class="carta" id="1">
        <h1>1. Encuentro con Campeón de Culturismo</h1>
        <p>
          Únete a nosotros para una inspiradora sesión de preguntas y
          respuestas con el campeón de culturismo, donde compartirá sus
          experiencias, rutinas de entrenamiento y consejos sobre nutrición.
        </p>
        <button type="button" class="btn-custom" onclick="window.location.href = 'list_event.html';">Evento</button>
      </div>
      <div class="carta" id="2">
        <h1>2. Charla con Ciclista Profesional</h1>
        <p>
          Sumérgete en el mundo del ciclismo profesional con esta charla
          exclusiva impartida por un ciclista experimentado. Descubre los
          secretos de su éxito, las estrategias de entrenamiento y sus
          emocionantes experiencias en la carretera.
        </p>
        <button type="button" class="btn-custom" onclick="window.location.href = 'list_event.html';">Evento</button>
      </div>
      <div class="carta" id="3">
        <h1>3. Clínica de Natación con Medallista Olímpico</h1>
        <p>
          Aprende de los mejores en esta clínica de natación dirigida por un
          medallista olímpico. Mejora tu técnica, resistencia y velocidad en
          el agua mientras recibes consejos valiosos de un experto en la
          disciplina.
        </p>
        <button type="button" class="btn-custom" onclick="window.location.href = 'list_event.html';">Evento</button>
      </div>
      <div class="carta" id="4">
        <h1>4. Entrenamiento de Tenis con Exjugador Profesional</h1>
        <p>
          Perfecciona tu juego de tenis con este entrenamiento dirigido por un
          exjugador profesional. Desde técnicas básicas hasta tácticas
          avanzadas, este evento te proporcionará los conocimientos y
          habilidades necesarios para mejorar tu rendimiento en la cancha.
        </p>
        <button type="button" class="btn-custom" onclick="window.location.href = 'list_event.html';">Evento</button>
      </div>
      <div class="carta" id="5">
        <h1>5. Exhibición de Pádel con Estrella Internacional</h1>
        <p>
          Asiste a una emocionante exhibición de pádel protagonizada por una
          estrella internacional del deporte. Disfruta de demostraciones de
          habilidades, consejos de juego y la oportunidad de jugar junto a uno
          de los mejores en el mundo del pádel.
        </p>
        <button type="button" class="btn-custom" onclick="window.location.href = 'list_event.html';">Evento</button>
      </div>
      <div class="carta" id="6">
        <h1>6. Taller de Nutrición con Expertos en Fitness</h1>
        <p>
          Descubre los fundamentos de una alimentación saludable y equilibrada
          en este taller de nutrición conducido por expertos en fitness.
          Aprende a optimizar tu dieta para maximizar tu rendimiento deportivo
          y mejorar tu bienestar general.
        </p>
        <button type="button" class="btn-custom" onclick="window.location.href = 'list_event.html';">Evento</button>
      </div>
      <div class="carta" id="7">
        <h1>
          7. Conferencia de Psicología Deportiva con Renombrado Psicólogo
        </h1>
        <p>
          Explora los aspectos mentales del rendimiento deportivo en esta
          conferencia impartida por un reconocido psicólogo deportivo. Obtén
          conocimientos sobre la gestión del estrés, la motivación y la
          concentración para alcanzar tus metas deportivas.
        </p>
        <button type="button" class="btn-custom" onclick="window.location.href = 'list_event.html';">Evento</button>
      </div>
      <div class="carta" id="8">
        <h1>8. Demostración de CrossFit con Atleta de Alto Rendimiento</h1>
        <p>
          Presencia una emocionante demostración de entrenamiento de CrossFit
          realizada por un atleta de alto rendimiento. Descubre los principios
          básicos y las técnicas avanzadas de este exigente programa de
          entrenamiento funcional.
        </p>
        <button type="button" class="btn-custom" onclick="window.location.href = 'list_event.html';">Evento</button>
      </div>
      <div class="carta" id="9">
        <h1>9. Charla con Futbolista Retirado: Experiencias y Anécdotas</h1>
        <p>
          Únete a una charla íntima con un futbolista retirado, donde
          compartirá sus experiencias, anécdotas y sabiduría acumulada a lo
          largo de su carrera profesional. Descubre los secretos del éxito en
          el mundo del fútbol desde la perspectiva de un verdadero experto.
        </p>
        <button type="button" class="btn-custom" onclick="window.location.href = 'list_event.html';">Evento</button>
      </div>
      <div class="carta" id="10">
        <h1>10. Encuentro con Campeón de CrossFit Español</h1>
        <p>
          Asiste a un emocionante encuentro con un campeón de CrossFit
          español, donde compartirá sus consejos, estrategias y experiencias
          en este exigente deporte. Aprende de los mejores y descubre cómo
          puedes llevar tu entrenamiento al siguiente nivel.
        </p>
        <button type="button" class="btn-custom" onclick="window.location.href = 'list_event.html';">Evento</button>
      </div>
    </main>
  </div>

  <?php include '../navbar/footer.php'; ?>

</body>

<script src="../../public/js/events/event.js"></script>
<script src="../../public/js/events/event.js"></script>

</html>