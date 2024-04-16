<?php
function getPath()
{
  // Obtiene el nombre del archivo actual
  $patch = basename($_SERVER['PHP_SELF']);

  //know_us.php
  // Determina la ruta de las imágenes en función del nombre del archivo



  if ($patch === 'index.php') {
    return 'public/img/icons/';
  } else {
    return '../../public/img/icons/';
  }
}
$patch = getPath();
echo $patch;

if ($patch === '../../public/img/icons/') {
?>
  <li><a href="../../index.php">Inicio</a></li>
  <li><a href="precio.php">Precios</a></li>
  <li><a href="">Eventos</a></li>
<?php
  echo "../../index.php";
} else {
?>
  <li><a href="views/common/know_us">Conócenos</a></li>
  <li><a href="precio.php">Precios</a></li>
  <li><a href="">Eventos</a></li>
<?php
  echo "index.php";
}





?>