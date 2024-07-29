<?php
require_once './core/database.php';
if (isLoggedin() === false) {
    header('Location: ./');
}
$cafe_review_id = 0;
$cafe_name = '';
if (isset($_GET['cafe_id'])) {
    $cafe_review_id = $_GET['cafe_id'];
    $cafe_name = $_GET['cafe_name'];
}
$get_r_Q = $db->query("CALL `get_reviews_by_cafe_id`($cafe_review_id)");
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

<body class="cafe_review_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="cafe_review">
            <div class="container my-5">
                <?php if (mysqli_num_rows($get_r_Q) > 0) : ?>
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            <h1><?= $cafe_name ?></h1>
                        </div>
                        <div class="col-12">
                            <div class="cafe-reviews owl-carousel">
                                <!-- item start -->
                                <?php while ($reviews = mysqli_fetch_object($get_r_Q)) : ?>
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
                <?php else : ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>No Reviews Found.</h1>
                            <a href="./dashboard.php" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                <?php endif; ?>
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