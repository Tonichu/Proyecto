<?php
class LogoutController
{
  public function logout($session)
  {
    // Destruir todas las variables de sesión
    $session = array();

    // Destruir la sesión
    session_destroy();
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: ../index.php");
    exit;
  }
}

// Crear una instancia del controlador
$logoutController = new LogoutController();

// Llamar al método de cierre de sesión pasando la sesión como parámetro
$logoutController->logout($_SESSION);
