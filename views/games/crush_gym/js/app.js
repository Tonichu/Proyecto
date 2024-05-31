class crush {
  constructor() {
    this.squares = document.querySelectorAll('.square');
    this.timeLeft = document.querySelector('#time-left');
    this.score = document.querySelector('#score');
    this.startButton = document.querySelector('#start-button');
    this.result = 0;
    this.hitPosition = null;
    this.currentTime = 20;
    this.timerId = null;
    this.countDownTimerId = null;
    this.level = 1;
    this.levels = [
      { scoreThreshold: 10, timeBetweenImages: 1000 },
      { scoreThreshold: 25, timeBetweenImages: 600, currentTime: 15 },
      { scoreThreshold: Infinity, timeBetweenImages: 300, currentTime: 5 }
    ];
    this.totalScore = 0; // Variable para almacenar la puntuación total acumulada
    this.levelScores = Array(this.levels.length).fill(0); // Almacena la puntuación de cada nivel
    this.startButton.addEventListener('click', () => this.startGame());
    this.squares.forEach(square => {
      square.addEventListener('mousedown', () => this.handleSquareClick(square));
    });
  }

  startGame() {
    this.result = 0;
    this.currentTime = this.levels[this.level - 1].currentTime || 20; // Use currentTime of the current level
    this.score.textContent = this.result;
    this.timeLeft.textContent = this.currentTime;

    const currentLevel = this.levels[this.level - 1];

    clearInterval(this.countDownTimerId);
    clearInterval(this.timerId);
    this.countDownTimerId = setInterval(() => this.countDown(), 1000);
    this.timerId = setInterval(() => this.randomSquare(), currentLevel.timeBetweenImages);
  }

  randomSquare() {
    this.squares.forEach(square => {
      square.innerHTML = '';
    });

    let randomIndex = Math.floor(Math.random() * 8) + 1;
    let randomSquare = this.squares[randomIndex - 1];
    let imagePath = `${randomIndex}.jpg`;

    randomSquare.innerHTML = `<img src="images/${imagePath}">`;
    this.hitPosition = randomIndex.toString();
  }

  handleSquareClick(square) {
    if (square.id == this.hitPosition) {
      this.result++;
      this.score.textContent = this.result;
    }
  }

  countDown() {
    this.currentTime--;
    this.timeLeft.textContent = this.currentTime;

    const currentLevel = this.levels[this.level - 1];

    if (this.result >= currentLevel.scoreThreshold) {
      this.levelScores[this.level - 1] = this.result; // Almacena la puntuación del nivel actual
      this.level++; // Pasar al siguiente nivel
      alert(`¡Inicio del nivel ${this.level}!`);
      this.startGame(); // Iniciar el siguiente nivel
    }

    if (this.level === this.levels.length && this.currentTime === 0) {
      alert('¡Felicidades! Has completado todos los niveles.');
      this.showTotalScore(); // Mostrar la puntuación total al completar todos los niveles
      clearInterval(this.countDownTimerId); // Detener el contador de tiempo
      clearInterval(this.timerId); // Detener el juego
      return;
    }

    if (this.currentTime === 0) {
      let totalScore = this.levelScores.reduce((acc, score) => acc + score, 0);
      alert('¡El tiempo se acabó! ');
      this.score.textContent = totalScore; // Actualizar el campo de puntuación con la puntuación final
      clearInterval(this.countDownTimerId); // Detener el contador de tiempo
      clearInterval(this.timerId); // Detener el juego
      window.location.href = `save_scores/save_score.php?totalScore=${totalScore}`;
    }
  }

  clearGrid() {
    this.squares.forEach(square => {
      square.innerHTML = '';
    });
  }

  showTotalScore() {
    let totalScore = this.levelScores.reduce((acc, score) => acc + score, 0);
    totalScore += 30; // Sumar 30 al totalScore al completar todos los niveles
    alert(`Puntuación final: ${totalScore}`);
    this.score.textContent = totalScore; // Actualizar el campo de puntuación con la puntuación final
    clearInterval(this.countDownTimerId); // Detener el contador de tiempo
    clearInterval(this.timerId); // Detener el juego
    window.location.href = `save_scores/save_score.php?totalScore=${totalScore}`;
  }
}

const game = new crush();
