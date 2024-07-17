<?php
require_once 'core/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Home</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="home_page">

    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="hero">
            <div class="container">
                <div class="content hero-content">
                    <h1>COFFEE LATERA</h1>
                    <h1 class="smoke-text">COFFEE LATERA</h1>
                </div>
            </div>
        </section>
        <section class="calendar">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 position-relative">
                        <div class="content_">
                            <h2 class="text-center">Book Your Reservation</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab necessitatibus ipsa velit molestiae, illo nam itaque doloremque modi quibusdam reiciendis at, quidem ratione illum qui adipisci atque deleniti reprehenderit quas.</p>
                            <a href="reservation.php" class="btn btn-primary">Book Your Reservation</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div data-bs-toggle="calendar" id="calendar_inline" class="col shadow rounded"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>


    <?php include './includes/js_links.php'; ?>
    <script src="js/jquery.bs.calendar.min.js"></script>
    <script src="js/calendar.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('.hero-content h1.smoke-text').addClass('smoke');
            }, 2800);
        });
    </script>
</body>

</html>