<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/Homepage/Homepage.css">
    <link rel="stylesheet" href="public/css/Homepage/modal.css">
    <link rel="stylesheet" href="public/css/Homepage/card_carousel.css">
    <link rel="stylesheet" href="public/css/Homepage/carousel_images.css">
    <link rel="stylesheet" href="public/css/Homepage/carousel_teacher.css">
</head>

<body>
    <!-- Navbar con los modal incluidos -->
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <h2>BUNKAY</h2>
                    <a href="views/calendario/calendario_trabajador.php">Calendario</a>
                </div>
                <div class="menu">
                    <nav>
                        <ul>
                            <?php
                            session_start();

                            // Ruta base relativa al archivo actual
                            $basePath = dirname($_SERVER['PHP_SELF']);
                            
                            // Almacenamos la ruta base en la sesión
                            $_SESSION['root'] = $basePath;

                            include 'views/navbar/homepage.php';
                            include 'views/navbar/customer_area.php';
                            include 'views/navbar/user_registration.php';
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'views/index/description.html';
    include 'views/index/hours.html';
    include 'views/index/carousel.html';
    include 'views/index/slider_carousel.html';
    include 'views/index/teachers.html';
    include 'views/navbar/footer.php'; 
    ?>

    <script src="public/js/homepage/homepage_carrusel.js"></script>
    <script src="public/js/homepage/inscription_index.js"></script>
</body>

</html>