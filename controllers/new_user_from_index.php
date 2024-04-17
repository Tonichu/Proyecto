<?php
session_start();

require_once(__DIR__."/../models/user_models/user_queries.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];
  $direccion = $_POST['direccion'];
  $pass = $_POST['pass'];
  // Insertar el nuevo usuario en la base de datos
  // Verificar si el usuario ya existe
  $userQueries = new UserQueries();

  $result = $userQueries->userExistsByEmail($correo);
  if ($result === null) {
    // Si hay un error en la consulta SQL, mostrar el mensaje de error
    echo "Error en la consulta SQL: No se pudo ejecutar la consulta.";
} else {
    if ($result) {
        // Si el usuario ya existe, mostrar un mensaje de error y volver a intentarlo
        echo "El usuario ya existe. Por favor, intenta con otro nombre de usuario o reinicia la contraseña.";
    } else {
        // Crear un hash de la contraseña
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        // Insertar los datos del nuevo usuario en la tabla "usuarios"
        $success = $userQueries->insertNewUser($nombre, $apellidos, $telefono, $correo, $direccion, $pass_hash);
        header("refresh:2; ../index.php");
        if ($success) {
            echo "Usuario creado con éxito, ya puedes acceder desde <strong>área clientes.</strong>";
            
        } else {
            echo "Error al crear usuario.";
        }
    }
  }}
