<?php
function getPathImages()
{
  // Obtiene el nombre del archivo actual
  $patch = basename($_SERVER['PHP_SELF']);
  //echo $nombreArchivo;
  // Determina la ruta de las imágenes en función del nombre del archivo



  if ($patch === 'index.php') {
    return 'public/img/icons/';
  } else {
    return '../../public/img/icons/';
  }
}
$patchImages = getPathImages();
?>
<footer>
  <div class="social-icons">
    <a href="https://www.instagram.com/" target="_blank"><img src="<?php echo $patchImages; ?>instagram.png" alt="Instagram"></a>
    <a href="https://www.facebook.com/" target="_blank"><img src="<?php echo $patchImages; ?>facebook.png" alt="Facebook"></a>
    <a href="https://twitter.com/?lang=es" target="_blank"><img src="<?php echo $patchImages; ?>twitter.png" alt="Twitter"></a>
    <a href="https://www.linkedin.com/" target="_blank"><img src="<?php echo $patchImages; ?>linkedin.png" alt="LinkedIn"></a>
    <a href="https://www.youtube.com/" target="_blank"><img src="<?php echo $patchImages; ?>youtube.png" alt="YouTube"></a>
    <a href="https://www.tiktok.com/" target="_blank"><img src="<?php echo $patchImages; ?>tiktok.png" alt="TikTok"></a>
  </div>
  <div class="divider"></div>
</footer>