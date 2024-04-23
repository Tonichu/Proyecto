const tarjeta = document.querySelector('#payment-card'),
    btnAbrirFormulario = document.querySelector('#btn-open-form'),
    formulario = document.querySelector('#payment-form'),
    numeroTarjeta = document.querySelector('#payment-card .number'),
    nombreTarjeta = document.querySelector('#payment-card .name'),
    logoMarca = document.querySelector('#brand-logo'),
    firma = document.querySelector('#payment-card .signature p'),
    mesExpiracion = document.querySelector('#payment-card .month'),
    yearExpiracion = document.querySelector('#payment-card .year'),
    ccv = document.querySelector('#payment-card .cvv');

// Volteamos la tarjeta para mostrar el frente.
const mostrarFrente = () => {
    if (tarjeta.classList.contains('active')) {
        tarjeta.classList.remove('active');
    }
};

// Rotacion de la tarjeta
tarjeta.addEventListener('click', () => {
    tarjeta.classList.toggle('active');
});

// Boton de abrir formulario
btnAbrirFormulario.addEventListener('click', () => {
    btnAbrirFormulario.classList.toggle('active');
    formulario.classList.toggle('active');
});

// Select del mes generado dinamicamente.
for (let i = 1; i <= 12; i++) {
    let opcion = document.createElement('option');
    opcion.value = i;
    opcion.innerText = i;
    formulario.querySelector('#selectMonth').appendChild(opcion);
}

// Select del año generado dinamicamente.
const yearActual = new Date().getFullYear();
for (let i = yearActual; i <= yearActual + 8; i++) {
    let opcion = document.createElement('option');
    opcion.value = i;
    opcion.innerText = i;
    formulario.querySelector('#selectYear').appendChild(opcion);
}

// Input numero de tarjeta
formulario.querySelector('#inputCardNumber').addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    formulario.querySelector('#inputCardNumber').value = valorInput
        // Eliminamos espacios en blanco
        .replace(/\s/g, '')
        // Eliminar las letras
        .replace(/\D/g, '')
        // Ponemos espacio cada cuatro numeros
        .replace(/([0-9]{4})/g, '$1 ')
        // Elimina el ultimo espaciado
        .trim();

    numeroTarjeta.textContent = valorInput;

    if (valorInput == '') {
        numeroTarjeta.textContent = '#### ####';

        logoMarca.innerHTML = '';
    }

    if (valorInput[0] == 4) {
        logoMarca.innerHTML = '';
        const imagen = document.createElement('img');
        imagen.src = 'img/logos/visa.png';
        logoMarca.appendChild(imagen);
    } else if (valorInput[0] == 5) {
        logoMarca.innerHTML = '';
        const imagen = document.createElement('img');
        imagen.src = 'img/logos/mastercard.png';
        logoMarca.appendChild(imagen);
    }

    // Volteamos la tarjeta para que el usuario vea el frente.
    mostrarFrente();
});

// Input nombre de tarjeta
formulario.querySelector('#inputCardHolder').addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    formulario.querySelector('#inputCardHolder').value = valorInput.replace(/[0-9]/g, '');
    nombreTarjeta.textContent = valorInput;
    firma.textContent = valorInput;

    if (valorInput == '') {
        nombreTarjeta.textContent = 'Jhon Doe';
    }

    mostrarFrente();
});

// Select mes
formulario.querySelector('#selectMonth').addEventListener('change', (e) => {
    mesExpiracion.textContent = e.target.value;
    mostrarFrente();
});

// Select Año
formulario.querySelector('#selectYear').addEventListener('change', (e) => {
    yearExpiracion.textContent = e.target.value.slice(2);
    mostrarFrente();
});

// CCV
formulario.querySelector('#inputCVV').addEventListener('keyup', () => {
    if (!tarjeta.classList.contains('active')) {
        tarjeta.classList.toggle('active');
    }

    formulario.querySelector('#inputCVV').value = formulario.querySelector('#inputCVV').value
        // Eliminar los espacios
        .replace(/\s/g, '')
        // Eliminar las letras
        .replace(/\D/g, '');

    ccv.textContent = formulario.querySelector('#inputCVV').value;
});