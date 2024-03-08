<?php
require_once(__DIR__ . "/../../ConexionBdd/conexionBdd.Php");
require_once(__DIR__ . "/../../librerias/utils/usuario_admin.php");
session_start();
$tipo_usuario = $_SESSION["tipo_usuarios"];
$id_usuarios = $_SESSION["id_usuarios"];
usuarioAdmin();
// Verifica si el tipo de usuario es 0 (admin)
echo "Bienvenido al panel de administrador " . $_SESSION['nombre'];
// Si el usuario no ha iniciado sesión de administrador, se redirige a index.php

$conexion = mysqli_connect($host, $user, $password, $database, $port);

$queryLimit = "LIMIT 3";
// Consulta para obtener los usuarios quitando a la persona que este logeada
if(isset($_SESSION["numero_filas"])) {
  // Obtener el valor ingresado en el campo numero_filas
  $numeroFilas = $_SESSION['numero_filas'];
  // Verificar si el valor es un número válido entre 1 y 10
  if(is_numeric($numeroFilas) && $numeroFilas >= 1 && $numeroFilas <= 10) {
      // Actualizar el valor de $queryLimit con el nuevo límite
      $queryLimit = "LIMIT $numeroFilas";
  } else {
      // En caso de que el valor ingresado no sea válido, puedes manejarlo de acuerdo a tus necesidades
      echo "Por favor ingrese un número válido entre 1 y 10.";
  }
}

$queryUser = "SELECT * FROM usuarios where id_usuarios != $id_usuarios $queryLimit";
$resultUser = mysqli_query($conexion, $queryUser);

if (!$resultUser) {
  die("Error en la consulta: " . mysqli_error($conexion));
}

$queryClases = "SELECT * FROM clases $queryLimit" ;
$resultClases = mysqli_query($conexion, $queryClases);

if (!$resultClases) {
  die("Error en la consulta: " . mysqli_error($conexion));
}


$querySalas = "SELECT * FROM salas $queryLimit";
$resultSalas = mysqli_query($conexion, $querySalas);

if (!$resultSalas) {
  die("Error en la consulta: " . mysqli_error($conexion));
}


$queryMaquinas = "SELECT maquinas.id_maquina, maquinas.nombre, maquinas.descripcion, maquinas.fecha_adquisicion, maquinas.ultima_revision, salas.nombre AS nombre_sala
                  FROM maquinas
                  INNER JOIN salas ON maquinas.id_sala = salas.id_salas
                  $queryLimit";
$resultMaquinas = mysqli_query($conexion, $queryMaquinas);

if (!$resultMaquinas) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

$querySesiones = "SELECT sesiones.id, clases.nombre AS nombre_clase, salas.nombre AS nombre_sala, sesiones.fecha_hora 
                  FROM sesiones 
                  INNER JOIN clases ON sesiones.id_clases = clases.id_clases 
                  INNER JOIN salas ON sesiones.id_salas = salas.id_salas $queryLimit";
$resultSesiones = mysqli_query($conexion, $querySesiones);

if (!$resultSesiones) {
  die("Error en la consulta: " . mysqli_error($conexion));
}
$sqlUserSesiones = "SELECT sesiones.id AS id_sesion, clases.nombre AS nombre_sesion, usuarios.nombre AS nombre_usuario
        FROM sesiones 
        INNER JOIN clases ON sesiones.id_clases = clases.id_clases
        INNER JOIN usuarios_sesiones ON sesiones.id = usuarios_sesiones.id_sesion
        INNER JOIN usuarios ON usuarios_sesiones.id_usuario = usuarios.id_usuarios";

// La consulta funciona ^^
$resultSesionesUser = mysqli_query($conexion, $sqlUserSesiones);

if (!$resultSesionesUser) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de control</title>
</head>

<body>
  
  <form action="../../Handlers/logout.php" method="post">
    <input type="submit" value="Cerrar sesión">
  </form>
  <form method="post" action="../../Handlers/filas_user.php">
  <label for="numero_filas">Selecciona el número de filas que quieres ver (1-10:)</label>
  <input type="number" id="numero_filas" name="numero_filas" min="1" max="10">
  <button type="submit" name="mostrar">Mostrar</button>
</form>
<form method="post" action="busqueda.php">
        <label for="tabla">Tabla:</label>
        <select name="tabla" id="tabla">
            <option value="usuarios">Usuarios</option>
            <option value="clases">Clases</option>
            <option value="salas">Salas</option>
            <option value="maquinas">Máquinas</option>
        </select><br><br>
        <label for="busqueda">Buscar por nombre en la tabla:</label>
        <input type="text" id="busqueda" name="busqueda">
        <input type="submit" value="Buscar">
    </form>
  <h2>Tabla de Usuarios</h2>
  <a href="formulario_nuevo_user.html"><button>Crear usuario</button></a>
<table class="tabla">
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Tipo de usuario</th>
    <th>Teléfono</th>
    <th>Correo electrónico</th>
    <th>Dirección</th>
    <th>Acciones</th>
  </tr>
  <?php while ($row = mysqli_fetch_assoc($resultUser)) { ?>
    <tr>
      <td><?php echo $row['id_usuarios']; ?></td>
      <td><?php echo $row['nombre']; ?></td>
      <td><?php echo $row['apellidos']; ?></td>
      <td><?php
          if ($row['tipo_usuarios'] == 0) {
            echo 'Admin';
          } elseif ($row['tipo_usuarios'] == 1) {
            echo 'Profesor';
          } else {
            echo 'Usuario normal';
          }
          ?></td>
      <td><?php echo $row['telefono']; ?></td>
      <td><?php echo $row['correo_electronico']; ?></td>
      <td><?php echo $row['direccion']; ?></td>
      <td>
        <!-- Botón para eliminar el usuario -->
        
        <?php echo "<input type='hidden' name='id' value='" . $row['id_usuarios'] . "'>"; ?>
        <a href="eliminar_usuario.php?id=<?php echo $row['id_usuarios']; ?>"><button>Eliminar</button></a>

        <!-- Botón para modificar el usuario -->
        <a href="formulario_modificar_user.php?id=<?php echo $row['id_usuarios']; ?>"><button>Modificar</button></a>
      </td>
    </tr>
  <?php } ?>
</table>
  <h2>Tabla de Clases</h2>
  <a href="../clases/formulario_nuevo_clase.html"><button>Crear clases</button></a>
  <table class="tabla">
  <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Descripcion</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($resultClases)) { ?>
      <tr>
        <td><?php echo $row['id_clases']; ?></td>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['descripcion']; ?></td>
        <td>
          <!-- Botón para eliminar la clase -->
          <?php echo "<input type='hidden' name='id' value='" . $row['id_clases'] . "'>"; ?>
          <a href="../clases/eliminar_clase.php?id=<?php echo $row['id_clases']; ?>"><button>Eliminar</button></a>

          <!-- Botón para modificar la clase -->
          <a href="../clases/modificar_clase.php?id=<?php echo $row['id_clases']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>

  <h2>Tabla de Salas</h2>
  <a href="../salas/formulario_nueva_sala.html"><button>Crear sala</button></a>
  <table class="tabla">
  <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Aforo</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($resultSalas)) { ?>
      <tr>
        <td><?php echo $row['id_salas']; ?></td>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['aforo']; ?></td>
        <td>
          <!-- Botón para eliminar la sala -->
          <?php echo "<input type='hidden' name='id' value='" . $row['id_salas'] . "'>"; ?>
          <a href="../salas/eliminar_sala.php?id=<?php echo $row['id_salas']; ?>"><button>Eliminar</button></a>

          <!-- Botón para modificar la sala -->
          <a href="../salas/modificar_sala.php?id=<?php echo $row['id_salas']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <h2>Tabla de maquinas</h2>
  <a href="../maquinas/formulario_nueva_maquina.php"><button>Crear Máquina</button></a>
  <table class="tabla">
  <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Fecha de adquisición</th>
      <th>Ultima revisión</th>
      <th>Sala en la que se encuentra</th>

    </tr>
    <?php while ($row = mysqli_fetch_assoc($resultMaquinas)) { ?>
      <tr>
        <td><?php echo $row['id_maquina']; ?></td>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['descripcion']; ?></td>
        <td><?php echo $row['fecha_adquisicion']; ?></td>
        <td><?php echo $row['ultima_revision']; ?></td>
        <td><?php echo $row['nombre_sala']; ?></td>
        <td>
          <!-- Botón para eliminar la maquina -->
          <?php echo "<input type='hidden' name='id' value='" . $row['id_maquina'] . "'>"; ?>
          <a href="../maquinas/eliminar_maquina.php?id=<?php echo $row['id_maquina']; ?>"><button>Eliminar</button></a>
          <!-- Botón para modificar la maquina -->
          <a href="../maquinas/modificar_maquina.php?id=<?php echo $row['id_maquina']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <h2>Tabla de sesiones</h2>
  <a href="../sesiones/formulario_nueva_sesion.php"><button>Crear Sesión</button></a>
  <table class="tabla">
  <tr>
      <th>ID</th>
      <th>Nombre clases</th>
      <th>Nombre salas</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($resultSesiones)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nombre_clase']; ?></td>
        <td><?php echo $row['nombre_sala']; ?></td>
        <td><?php echo $row['fecha_hora']; ?></td>
        <td>
          <!-- Botón para eliminar la sesion -->
          <?php echo "<input type='hidden' name='id' value='" . $row['id'] . "'>"; ?>
          <a href="../sesiones/eliminar_sesion.php?id=<?php echo $row['id']; ?>"><button>Eliminar</button></a>
          <!-- Botón para modificar la sesion -->
          <a href="../sesiones/modificar_sesion.php?id=<?php echo $row['id']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
    </table>














































  <h2>Tabla de user sesiones</h2>
  <a href="../sesiones/formulario_nueva_sesion.php"><button>Crear Sesión</button></a>
    <table class="tabla">
  <tr>
      <th>Nombre Sesión</th>
      <th>Nombre Usuario</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($resultSesiones)) { ?>
      <tr>
        <td><?php echo $row['nombre_sesion']; ?></td>
        <td><?php echo $row['nombre_usuario']; ?></td>
        <td>
          <!-- Botón para eliminar la sesión -->
          <?php echo "<input type='hidden' name='id_sesion' value='" . $row['id_sesion'] . "'>"; ?>
          <a href="../sesiones/eliminar_sesion.php?id=<?php echo $row['id_sesion']; ?>"><button>Eliminar</button></a>
          <!-- Botón para modificar la sesión -->
          <a href="../sesiones/modificar_sesion.php?id=<?php echo $row['id_sesion']; ?>"><button>Modificar</button></a>
        </td>
      </tr>
    <?php } ?>
</table>

</body>

</html>