<?php
  session_start();
  usuarioNormal();
?>

<div class="header">
  <div class="container">
    <div class="navbar">
      <div class="logo">
        <h2>BUNKAY</h2>
        <h1>
          Bienvenido
          <?php echo $_SESSION['nombre']; ?>
        </h1>
      </div>
      <div class="menu">
        <nav>
          <ul>
            <?php include 'librerias/navbar/menu_principal.php'; ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>
