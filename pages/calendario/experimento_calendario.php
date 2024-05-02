<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario - experimento</title>
    <link rel="stylesheet" href="../../librerias/css/calendar.css">
</head>
<body>

    <button onclick="OcultarMannana()"> Mañanas </button>
    <button onclick="OcultarTarde()"> Tardes </button>

    <table class="calendario" >
        <thead>
            <tr class="filadias"> 
                <th>Hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sábado</th>
                <th>Domingo</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'generar_experimento_calendario.php'; ?>
        </tbody>
<script>
  scr="../javascript/calendario_ocultar.js"
  /* 
  function OcultarMannana() {
    Array.from(document.getElementsByClassName("mannana")).forEach(
      function(element, index, array){
        element.classList.toggle("ocultar");
      }
    )
    Array.from(document.getElementsByClassName("con-sesion-mannana")).forEach(
      function(element, index, array){
        element.classList.toggle("ocultar");
      }
    )
    Array.from(document.getElementsByClassName("sin-sesion-mannana")).forEach(
      function(element, index, array){
        element.classList.toggle("ocultar");
      }
    )
   
  
}
function OcultarTarde() {
    Array.from(document.getElementsByClassName("tarde")).forEach(
      function(element, index, array){
        element.classList.toggle("ocultar");
      }
    )
    Array.from(document.getElementsByClassName("con-sesion-tarde")).forEach(
      function(element, index, array){
        element.classList.toggle("ocultar");
      }
    )
    Array.from(document.getElementsByClassName("sin-sesion-tarde")).forEach(
      function(element, index, array){
        element.classList.toggle("ocultar");
      }
    )
}
*/
/*
  function OcultarTarde() {
    let tarde[]= document.getElementsByClassName("tarde");//guardo elementos con clase mañana en morning
    for (let i = 0; i < tarde.length; i++) { //recorro morning cambiando la clase a ocultar
      tarde[i].classList.toggle("ocultar");
    let tardes = document.getElementsByClassName("con-sesion-tarde");//guardo elementos con clase 
    for (let i = 0; i < tardes.length; i++) { //recorro morning cambiando la clase a ocultar
      tardes[i].classList.toggle("ocultar");
    }
  }
  }
  */
</script>
    
</body>
</html>