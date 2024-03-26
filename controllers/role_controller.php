<?php
class RoleController
{
  function isTeacher($sesion)
  {

    if (!isset($sesion["tipo_usuarios"]) || !isset($sesion["id_usuarios"])) {
      // Si no ha iniciado sesión, redirige a la página de inicio de sesión
      echo "Acceso denegado. Debes de loguearte.";
      header("refresh:2; ../../index.php"); // Redirige a la página principal después de 2 segundos
      exit;
    }
    if ($sesion["tipo_usuarios"] == 0) {
      // Si el usuario es admin, redirige a la página de admin
      echo "no tienes acceso a esa página, contacta con un administrador";
      require_once "../../index.php";
      header("refresh:2; ../views/admin_panel.php");
      exit;
    } elseif ($sesion["tipo_usuarios"] == 2) {
      // Si el usuario es alumno, redirige a la página
      echo "Acceso denegado. No tienes permiso para acceder a esta página.";
      header("refresh:2; ../views/user_panel.php"); // Redirige a la página principal después de 2 segundos
      exit;
    }
  }
  function isAdmin($sesion){

    if (!isset($sesion["tipo_usuarios"]) || !isset($sesion["id_usuarios"])) {
      echo "Acceso denegado. Debes de loguearte.";
      header("refresh:2; ../../index.php");
      exit;
    }
    if ($sesion["tipo_usuarios"] == 1) {
      echo "no tienes acceso a esa página, contacta con un administrador";
      header("refresh:2; ../views/teacher_panel.php");
      exit;
    } elseif ($sesion["tipo_usuarios"] == 2) {
      echo "Acceso denegado. No tienes permiso para acceder a esta página.";
      header("refresh:2; ../views/user_panel.php");
      exit;
    }
  }
  function isUser($sesion){

    if (!isset($sesion["tipo_usuarios"]) || !isset($sesion["id_usuarios"])) {
      echo "Acceso denegado. Debes de loguearte.";
      header("refresh:2; ../../index.php");
      exit;
    }
    if ($sesion["tipo_usuarios"] == 0) {
      echo "no tienes acceso a esa página, contacta con un administrador";
      header("refresh:2; ../views/admin_panel.php");
      exit;
    } elseif ($sesion["tipo_usuarios"] == 1) {
      echo "Acceso denegado. No tienes permiso para acceder a esta página.";
      header("refresh:2; ../views/teacher_panel.php");
      exit;
    }
  }
}
