
document.addEventListener("DOMContentLoaded", function() {
  var formSesiones = document.getElementById("form_sessions");
  if (formSesiones) {
    formSesiones.addEventListener("submit", function(event) {
      if (!validateHours()) {
        console.log("Validación de horas fallida. Evitando envío del formulario.");
        event.preventDefault(); // Evitar que el formulario se envíe si la validación falla
      } else {
        console.log("Validación de horas exitosa. Enviando formulario.");
      }
    });
  }
});

function validateHours() {
  var fechaInicio = new Date(document.getElementById("fecha_hora_inicio").value);
  var fechaFin = new Date(document.getElementById("fecha_hora_fin").value);
  
  // Verificar si no es el mismo día
  if (!isSameDay(fechaInicio, fechaFin)) {
    alert("La fecha de inicio y fin deben ser el mismo día.");
    return false;
  }
  
  // Calcular la diferencia en minutos
  var diffMs = fechaFin - fechaInicio;
  var diffMinutes = Math.floor(diffMs / (1000 * 60)); // Convertir la diferencia a minutos
  
    // Verificar si la diferencia está en el rango permitido (35 a 90 minutos)
    if (diffMinutes < 35 || diffMinutes > 90) {
      alert("La diferencia entre la hora de inicio y la hora de fin debe estar entre 35 y 90 minutos.");
      return false;
    }
    
    return true; // Permitir enviar el formulario si las validaciones pasan
  }

function isSameDay(date1, date2) {
  return date1.toDateString() === date2.toDateString();
}