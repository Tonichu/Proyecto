function OcultarMannana() {
    Array.from(document.getElementsByClassName("mannana")).forEach(
      function(element, index, array){
        element.classList.toggle("ocultar");
      }
    )
    Array.from(document.getElementsByClassName("apuntado-mannana")).forEach(
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
    Array.from(document.getElementsByClassName("apuntado-tarde")).forEach(
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