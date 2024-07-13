<?php
require_once 'core/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-2 content-center">
                    <img src="./img/logo_bg_black.png" class="w-25" alt="logo-1">
                    <!-- <h3>LOGO</h3> -->
                </div>
                <div class="col-7 content-center">
                    <ul class="navigation list-unstyled d-flex gap-5">
                        <li><a href="#!">Home</a></li>
                        <li><a href="#!">About</a></li>
                        <li><a href="#!">Services</a></li>
                        <li><a href="#!">Gallery</a></li>
                    </ul>
                </div>
                <div class="col-3 content-center">
                    <a class="btn btn-primary border border-3" href="#!">Reservation</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="hero">
            <div class="container">
                <div class="content hero-content">
                    <h1>COFFEE LATERA</h1>
                    <h1 class="smoke-text">COFFEE LATERA</h1>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>





    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('.hero-content h1.smoke-text').addClass('smoke');
                // document.querySelector('body').style.setProperty('--orange', 'green');
            }, 2800);
        });
    </script>
</body>

</html>