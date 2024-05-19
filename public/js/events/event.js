function actualizarContador() {
    const cuentaRegresiva = document.getElementById('cuenta-regresiva');
    const diasElemento = cuentaRegresiva.querySelector('.dias');
    const horasElemento = cuentaRegresiva.querySelector('.horas');
    const minutosElemento = cuentaRegresiva.querySelector('.minutos');
    const segundosElemento = cuentaRegresiva.querySelector('.segundos');
  
    let dias = parseInt(diasElemento.textContent);
    let horas = parseInt(horasElemento.textContent);
    let minutos = parseInt(minutosElemento.textContent);
    let segundos = parseInt(segundosElemento.textContent);
  
    segundos--;
  
    if (segundos < 0) {
      segundos = 59;
      minutos--;
  
      if (minutos < 0) {
        minutos = 59;
        horas--;
  
        if (horas < 0) {
          horas = 23;
          dias--;
  
          if (dias < 0) {
            dias = 0;
            horas = 0;
            minutos = 0;
            segundos = 0;
          }
        }
      }
    }
  
    diasElemento.textContent = dias < 10 ? '0' + dias : dias;
    horasElemento.textContent = horas < 10 ? '0' + horas : horas;
    minutosElemento.textContent = minutos < 10 ? '0' + minutos : minutos;
    segundosElemento.textContent = segundos < 10 ? '0' + segundos : segundos;
  
    setTimeout(actualizarContador, 1000);
  }
  
  actualizarContador();
  