<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Crush Gym</title>
  <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
  <div class="score-container">
    <div>
      <h2>Tu puntuación:</h2>
      <h2 id="score">0</h2>
    </div>
    <div>
      <h2>Tiempo que te queda:</h2>
      <h2 id="time-left">20</h2>
    </div>
    <button id="start-button">Iniciar Juego</button>
    <a href="../minigames.php"><button>Cancelar</button></a>
    <p>Primer nivel 10 puntos</p>
    <p>segundo nivel 25 puntos</p>
    <p>tercer nivel machaca el ratón!!</p>
  </div>

  <div class="grid">
    <div class="square" id="1"></div>
    <div class="square" id="2"></div>
    <div class="square" id="3"></div>
    <div class="square" id="4"></div>
    <div class="square" id="5"></div>
    <div class="square" id="6"></div>
    <div class="square" id="7"></div>
    <div class="square" id="8"></div>
    <div class="square" id="9"></div>
  </div>

  <script src="js/app.js"></script>
</body>
</html>