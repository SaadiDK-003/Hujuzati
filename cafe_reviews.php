<?php
require_once './core/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Cafe Reviews</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="cafe_reviews_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="cafe_reviews">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center mb-4">
                        <h1><?= TITLE ?> | Cafe Reviews</h1>
                    </div>
                    <div class="col-12">
                        <div class="cafe-reviews owl-carousel">
                            <!-- item start -->
                            <?php
                            $get_r_Q = $db->query("CALL `get_all_reviews`()");
                            while ($reviews = mysqli_fetch_object($get_r_Q)) :
                            ?>
                                <div class="item">
                                    <div class="review-card border border-2 rounded-2 p-4">
                                        <div class="users-name position-relative">
                                            <h6><?= $reviews->visitor_name ?></h6>
                                            <h5 class="position-absolute btn btn-secondary"><?= $reviews->store_name ?></h5>
                                        </div>
                                        <div class="ratings mb-2 <?= 'rate-' . $reviews->stars ?>">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="text">
                                            <p><?= $reviews->comments ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <!-- item start end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <?php include './includes/js_links.php'; ?>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                autoplay: true,
                nav: false,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        });
    </script>
</body>

</html>