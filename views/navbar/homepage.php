<?php
function getPath()
{
  // Obtiene el nombre del archivo actual
  $patch = basename($_SERVER['PHP_SELF']);

  // Determina la ruta de las imágenes en función del nombre del archivo

  if ($patch === 'index.php') {
    return 'public/img/icons/';
  } else {
    return '../../public/img/icons/';
  }
}
$patch = getPath();

//echo $patch; 

if ($patch === '../../public/img/icons/') {
?>
  <li><a href="../../index.php">Inicio</a></li>
  <li><a href="know_us.php">Conócenos</a></li>
  <li><a href="events.php">Eventos</a></li>
  <li><a href="prices.php">Precios</a></li>

<?php

} else {
?>
  <li><a href="index.php">Inicio</a></li>
  <li><a href="views/common/know_us.php">Conócenos</a></li>
  <li><a href="views/common/events.php">Eventos</a></li>
  <li><a href="views/common/prices.php">Precios</a></li>
<?php
}
?>