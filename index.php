
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
                </div>
                <div class="menu">
                    <nav>
                        <ul>
                            <?php include 'views/navbar/homepage.php'; ?>
                            <?php include 'views/navbar/customer_area.php'; ?>
                            <?php include 'views/navbar/user_registration.php'; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'views/index/description.html'; ?>

    <?php include 'views/index/hours.html'; ?>

    <?php include 'views/index/carousel.html'; ?>

    <?php include 'views/index/slider_carousel.html'; ?>

    <?php include 'views/index/teachers.html'; ?>

    <?php include 'views/navbar/footer.php'; ?>

    <script src="public/js/homepage/homepage_carrusel.js"></script>
    <script src="public/js/homepage/inscription_index.js"></script>
</body>

</html>