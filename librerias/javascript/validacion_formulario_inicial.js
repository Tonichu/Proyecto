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

  // Validar cada campo individualmente
  validarCampo(
    nombreInput,
    nombreError,
    "Por favor, ingresa un nombre válido (mín. 2 caracteres y solo letras).",
    contieneSoloLetras
  );
  validarCampo(
    apellidosInput,
    apellidosError,
    "Por favor, ingresa apellidos válidos (mín. 2 caracteres y solo letras).",
    contieneSoloLetras
  );
  validarCampo(
    telefonoInput,
    telefonoError,
    "Por favor, ingresa un número de teléfono válido (solo números y 9 dígitos).",
    contieneSoloNumeros
  );
  validarCampo(
    correoInput,
    correoError,
    "Por favor, ingresa un correo electrónico válido."
  );
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

var formulario = document.querySelector("form");
formulario.addEventListener("submit", validarFormulario);

var campos = document.querySelectorAll("input, textarea");
campos.forEach(function (campo) {
  campo.addEventListener("blur", function () {
    var errorId = campo.id + "-error";
    var error = document.getElementById(errorId);
    validarCampo(campo, error);
  });
});
