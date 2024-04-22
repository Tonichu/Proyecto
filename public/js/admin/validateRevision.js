// Función para validar la fecha de última revisión
function validateRevision() {
  var fechaAdquisicion = new Date(document.getElementById("fecha_adquisicion").value);
  var fechaRevisión = new Date(document.getElementById("ultima_revision").value);

  if (fechaRevisión < fechaAdquisicion) {
    alert("La fecha de última revisión debe ser mayor o igual a la fecha de adquisición.");
    return false;
  }
  return true;
}

// Event listener para validar antes de enviar el formulario
document.addEventListener("DOMContentLoaded", function() {
  var form = document.querySelector("form"); // Cambiado a un selector genérico para cualquier formulario
  form.addEventListener("submit", function(event) {
    if (!validateRevision()) { // Corregido el nombre de la función
      event.preventDefault(); // Evita el envío si la validación falla
    }
  });
});