<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

    <button onclick="OcultarMannana()"> Mañanas </button>
    <button onclick="OcultarTarde()"> Tardes </button>

    <table class="calendario" >
        <thead>
            <tr> 
                <th>Hora</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sábado</th>
                <th>Domingo</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'generar_calendario_trabajador.php'; ?>
        </tbody>
    
</body>
</html>