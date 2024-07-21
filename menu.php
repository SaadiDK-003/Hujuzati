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
                    <div class="col-10 col-md-3 mx-auto mx-md-0 mb-4">
                        <div class="card border rounded-2 p-2 d-flex justify-content-between">
                            <div class="img overflow-hidden rounded-2">
                                <img src="./img/prod/cold_drink.jpg" class="w-100" alt="product-img">
                            </div>
                            <div class="content">
                                <div class="title d-flex justify-content-between">
                                    <h5>Shad Perkins</h5><span class="category h6 text-secondary">Offers</span>
                                </div>
                                <span class="disc-price fw-bold text-success">$150.00</span>
                                <span class="reg-price text-decoration-line-through text-danger">$200.00</span>
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