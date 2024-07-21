<?php
require_once './core/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Login</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="menu_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="menu">
            <div class="container my-5">
                <div class="row">
                    <div class="col-3">
                        <div class="card border rounded-2 p-3 d-flex justify-content-between">
                            <div class="img w-75 mx-auto">
                                <img src="./img/prod/abc.png" class="mx-auto" alt="">
                            </div>
                            <div class="content">
                                <h5>Shad Perkins</h5>
                                <span class="reg-price">$200.00</span>
                                <span class="disc-price">$150.00</span>
                                <p class="line-clamp-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo porro, soluta dolor quas temporibus atque.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <?php include './includes/js_links.php'; ?>
</body>

</html>