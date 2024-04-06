document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function (event) {
    // Variables para los campos del formulario
    const nombre = document.querySelector('input[name="nombre"]');
    const apellidos = document.querySelector('input[name="apellidos"]');
    const telefono = document.querySelector('input[name="telefono"]');
    const correo = document.querySelector('input[name="correo_electronico"]');
    const direccion = document.querySelector('input[name="direccion"]');
    const nuevaPass = document.querySelector('input[name="newPass"]');
    const confirmarPass = document.querySelector(
      'input[name="confirmNewPass"]'
    );

    // Variables para los mensajes de error
    const nombreError = document.getElementById("nombre-error");
    const apellidosError = document.getElementById("apellidos-error");
    const telefonoError = document.getElementById("telefono-error");
    const correoError = document.getElementById("correo-error");
    const direccionError = document.getElementById("direccion-error");
    const passError = document.getElementById("pass-error");

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

    // Validar contraseñas
    if (
      nuevaPass.value.trim().length === 0 ||
      confirmarPass.value.trim().length === 0
    ) {
      passError.textContent = "Introduce y confirma la nueva contraseña.";
      valid = false;
    } else if (nuevaPass.value.trim() !== confirmarPass.value.trim()) {
      passError.textContent = "Las contraseñas no coinciden.";
      valid = false;
    } else {
      passError.textContent = "";
    }

    // Detener el envío del formulario si algún campo no es válido
    if (!valid) {
      event.preventDefault();
    }
  });
});
