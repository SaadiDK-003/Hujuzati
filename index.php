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
                    <div class="col-12 col-md-8 mx-auto position-relative">
                        <div class="text-center">
                            <h2 class="text-center">Book Your Reservation</h2>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi, qui inventore veritatis iusto non ex quia eum porro, harum dolores tenetur. Repellendus distinctio, ea fuga recusandae architecto consectetur et nulla autem exercitationem harum quidem aperiam, deserunt perspiciatis adipisci ducimus laborum laboriosam. Numquam nemo optio eaque possimus esse tenetur accusamus obcaecati.</p>
                            <a href="reservation.php" class="btn btn-primary">Book Your Reservation</a>
                        </div>
                    </div>
                    <!-- Calender -->
                    <div class="col-12 col-md-6 d-none">
                        <div data-bs-toggle="calendar" id="calendar_inline" class="col shadow rounded"></div>
                    </div>
                    <div class="col-12 mt-4 mb-2">
                        <h3 class="text-center">Reviews</h3>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="cafe-reviews owl-carousel">
                            <!-- item start -->
                            <?php
                            $get_r_Q = $db->query("CALL `get_last_five_reviews`()");
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
                            <?php endwhile;
                            $get_r_Q->close();
                            $db->next_result(); ?>
                            <!-- item start end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>


    <?php include './includes/js_links.php'; ?>
    <!-- <script src="js/jquery.bs.calendar.min.js"></script> -->
    <!-- <script src="js/calendar.js"></script> -->
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                $('.hero-content h1.smoke-text').addClass('smoke');
            }, 2800);

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