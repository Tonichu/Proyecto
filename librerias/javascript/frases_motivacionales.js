document.addEventListener("DOMContentLoaded", function () {
  var frasesMotivacionales = [
    "El éxito llega a aquellos que están demasiado ocupados buscándolo.",
    "El dolor que sientes hoy será la fuerza que sientas mañana.",
    "No te preocupes por los resultados, preocúpate por el trabajo que tienes que hacer.",
    "Si lo puedes soñar, lo puedes lograr.",
    "No te compares con nadie más que contigo mismo.",
    "El camino hacia la grandeza está lleno de obstáculos, pero depende de ti superarlos.",
    "La diferencia entre lo imposible y lo posible está en tu determinación.",
    "No te detengas hasta que estés orgulloso.",
    "Cada día es una oportunidad para mejorar.",
    "El éxito no es definitivo, el fracaso no es fatal: es el coraje para continuar lo que cuenta.",
    "Cada gota de sudor es un paso más cerca de tus metas fitness.",
    "El verdadero cambio comienza cuando sales de tu zona de confort.",
    "No importa cuánto tardes en llegar, siempre y cuando no te detengas.",
    "El entrenamiento es el mejor regalo que puedes darte a ti mismo.",
    "Cree en ti mismo y todo será posible en el gimnasio y más allá.",
    "El único entrenamiento malo es el que no haces.",
    "La fuerza no viene de ganar, viene de no rendirse.",
    "Cada repetición te acerca más a convertirte en tu mejor versión.",
    "La disciplina es el puente entre tus metas y tus logros.",
    "El gimnasio es donde el dolor se convierte en ganancia.",
    "El éxito en el entrenamiento comienza con la decisión de intentarlo.",
    "La resistencia que sientes hoy será la fuerza que sientas mañana.",
    "Entrena como un atleta, vive como un campeón.",
    "Tu cuerpo puede hacerlo, es tu mente la que necesitas convencer.",
    "Cada día es una oportunidad para superarte a ti mismo.",
    "La diferencia entre lo que eres y lo que quieres ser es lo que haces.",
    "El entrenamiento es una celebración del progreso, no una condena al esfuerzo.",
    "El verdadero dolor es el arrepentimiento de no haberlo intentado.",
    "Los límites solo existen en tu mente, desafíalos en el gimnasio.",
    "El mejor proyecto en el que trabajar eres tú mismo; ve al gimnasio y comienza a construirlo.",
  ];

  var fraseAleatoria =
    frasesMotivacionales[
      Math.floor(Math.random() * frasesMotivacionales.length)
    ];
  var footerElement = document.getElementById("frase-motivacional");
  if (footerElement) {
    footerElement.textContent = fraseAleatoria;
  }
});
