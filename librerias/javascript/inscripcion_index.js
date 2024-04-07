// Función para validar un campo específico
function validarCampo(input, error, mensaje) {
  if (input.value.trim() === "") {
    error.textContent = "";
  } else {
    if (mensaje && !mensaje(input.value.trim())) {
      error.textContent = mensaje;
      error.style.color = "red";
    } else {
      error.textContent = "";
    }
  }
}

// Función para verificar si el valor contiene solo letras
function contieneSoloLetras(value) {
  return /^[a-zA-Z]+$/.test(value);
}

// Función para verificar si el valor contiene solo números
function contieneSoloNumeros(value) {
  return /^[0-9]+$/.test(value);
}

// Función para validar el formulario
function validarFormulario(event) {
  event.preventDefault();

  // Obtener referencias a los elementos del formulario y sus errores
  var nombreInput = document.getElementById("nombre");
  var apellidosInput = document.getElementById("apellidos");
  var telefonoInput = document.getElementById("telefono");
  var correoInput = document.getElementById("correo");
  var direccionInput = document.getElementById("direccion");
  var passInput = document.getElementById("pass");
  var fotoInput = document.getElementById("foto");

  var nombreError = document.getElementById("nombre-error");
  var apellidosError = document.getElementById("apellidos-error");
  var telefonoError = document.getElementById("telefono-error");
  var correoError = document.getElementById("correo-error");
  var direccionError = document.getElementById("direccion-error");
  var passError = document.getElementById("pass-error");
  var fotoError = document.getElementById("foto-error");

  let valid = true;

    // Validar nombre
    const nombreRegex = /^[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+$/;
    if (
      nombre.value.trim().length < 2 ||
      !nombreRegex.test(nombre.value.trim())
    ) {
      nombreError.textContent =
        "El nombre debe tener al menos 2 caracteres y no puede contener números.";
      valid = false;
    } else {
      nombreError.textContent = "";
    }

    // Validar apellidos
    const apellidosRegex = /^[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+$/;
    if (
      apellidos.value.trim().length < 2 ||
      !apellidosRegex.test(apellidos.value.trim())
    ) {
      apellidosError.textContent =
        "Los apellidos deben tener al menos 2 caracteres y no pueden contener números.";
      valid = false;
    } else {
      apellidosError.textContent = "";
    }

    // Validar teléfono
    const telefonoRegex = /^\d{9}$/;
    const telefonoNumerico = /^\d+$/;
    if (!telefonoNumerico.test(telefono.value.trim())) {
      telefonoError.textContent = "El teléfono solo puede contener números.";
      valid = false;
    } else if (!telefonoRegex.test(telefono.value.trim())) {
      telefonoError.textContent =
        "Introduce un número de teléfono válido (9 dígitos).";
      valid = false;
    } else {
      telefonoError.textContent = "";
    }

    // Validar correo electrónico
    const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correoRegex.test(correo.value.trim())) {
      correoError.textContent = "Introduce un correo electrónico válido.";
      valid = false;
    } else {
      correoError.textContent = "";
    }

    // Validar dirección
    if (direccion.value.trim().length === 0) {
      direccionError.textContent = "Introduce tu dirección.";
      valid = false;
    } else {
      direccionError.textContent = "";
    }
  validarCampo(passInput, passError, "Por favor, ingresa una contraseña.");

  // Si algún campo tiene un mensaje de error, no enviar el formulario
  if (
    nombreError.textContent ||
    apellidosError.textContent ||
    telefonoError.textContent ||
    correoError.textContent ||
    passError.textContent
  ) {
    return false;
  }

  event.target.submit();
}

var formulario = document.getElementById("registroFormulario");
formulario.addEventListener("submit", validarFormulario);

var campos = document.querySelectorAll("input, textarea");
campos.forEach(function (campo) {
  campo.addEventListener("blur", function () {
    var errorId = campo.id + "-error";
    var error = document.getElementById(errorId);
    validarCampo(campo, error);
  });
});
