// Función para validar un campo específico
function validarCampo(input, error, validacionPersonalizada) {
  if (input.value.trim() === "") {
    error.textContent = "Este campo es requerido.";
  } else {
    if (validacionPersonalizada && !validacionPersonalizada(input.value.trim())) {
      error.textContent = "Por favor, ingresa una contraseña válida.";
      error.style.color = "red";
    } else {
      error.textContent = "";
    }
  }
}

// Función para verificar si el valor contiene solo letras
function contieneSoloLetras(value) {
  return /^[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+$/.test(value);
}

// Función para verificar si el valor contiene solo números
function contieneSoloNumeros(value) {
  return /^\d+$/.test(value);
}

// Función para validar el formulario
function validarFormulario(event) {
  event.preventDefault();

  // Obtener referencias a los elementos del formulario y sus errores
  let nombreInput = document.getElementById("nombre");
  let apellidosInput = document.getElementById("apellidos");
  let telefonoInput = document.getElementById("telefono");
  let correoInput = document.getElementById("correo");
  let direccionInput = document.getElementById("direccion");
  let passInput = document.getElementById("pass");
  let fotoInput = document.getElementById("foto");

  let nombreError = document.getElementById("nombre-error");
  let apellidosError = document.getElementById("apellidos-error");
  let telefonoError = document.getElementById("telefono-error");
  let correoError = document.getElementById("correo-error");
  let direccionError = document.getElementById("direccion-error");
  let passError = document.getElementById("pass-error");
  let fotoError = document.getElementById("foto-error");

  let valid = true;

  // Validar nombre
  const nombreRegex = /^[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+$/;
  if (!nombreRegex.test(nombreInput.value.trim())) {
    nombreError.textContent = "El nombre debe tener al menos 2 caracteres y no puede contener números.";
    valid = false;
  } else {
    nombreError.textContent = "";
  }

  // Validar apellidos
  const apellidosRegex = /^[A-Za-záéíóúüñÁÉÍÓÚÜÑ\s]+$/;
  if (!apellidosRegex.test(apellidosInput.value.trim())) {
    apellidosError.textContent = "Los apellidos deben tener al menos 2 caracteres y no pueden contener números.";
    valid = false;
  } else {
    apellidosError.textContent = "";
  }

  // Validar teléfono
  const telefonoRegex = /^\d{9}$/;
  if (!telefonoRegex.test(telefonoInput.value.trim())) {
    telefonoError.textContent = "Introduce un número de teléfono válido (9 dígitos).";
    valid = false;
  } else {
    telefonoError.textContent = "";
  }

  // Validar correo electrónico
  const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!correoRegex.test(correoInput.value.trim())) {
    correoError.textContent = "Introduce un correo electrónico válido.";
    valid = false;
  } else {
    correoError.textContent = "";
  }

  // Validar dirección
  if (direccionInput.value.trim() === "") {
    direccionError.textContent = "Introduce tu dirección.";
    valid = false;
  } else {
    direccionError.textContent = "";
  }

  validarCampo(passInput, passError, function(value) {
    return value.trim() !== ""; // Esta función verifica que el valor no esté vacío
  });

  // Si algún campo tiene un mensaje de error, no enviar el formulario
  if (!valid) {
    return false;
  }

  // Envía el formulario si todos los campos son válidos
  event.target.submit();
}

let formulario = document.getElementById("registroFormulario");
formulario.addEventListener("submit", validarFormulario);

let campos = document.querySelectorAll("input, textarea");
campos.forEach(function (campo) {
  campo.addEventListener("blur", function () {
    let errorId = campo.id + "-error";
    let error = document.getElementById(errorId);
    validarCampo(campo, error, function(value) {
      return value.trim() !== ""; // Esta función verifica que el valor no esté vacío
    });
  });
});
