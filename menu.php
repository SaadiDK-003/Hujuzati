<?php
require_once './core/database.php';

$cat_filter_d = $db->query("SELECT * FROM `categories`");
$cat_filter_m = $db->query("SELECT * FROM `categories`");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Menu</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="menu_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="menu">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center mb-5 d-none d-md-block">
                        <div class="filter-buttons d-flex gap-3 justify-content-center">
                            <a href="./menu.php" class="btn border-primary border-2">All</a>
                            <?php while ($cat_filter_ = mysqli_fetch_object($cat_filter_d)) : ?>
                                <a href="#!" data-filter="<?= $cat_filter_->id ?>" class="btn btn-primary filter_btn"><?= $cat_filter_->category_name ?></a>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="col-12 mb-5 d-block d-md-none">
                        <a href="./menu.php" class="btn btn-primary w-100 text-center">All</a>
                        <div class="form-group mt-2">
                            <label for="filter_">Select Category</label>
                            <select name="filter_" id="filter_" class="form-select">
                                <?php while ($cat_filter_ = mysqli_fetch_object($cat_filter_m)) : ?>
                                    <option value="<?= $cat_filter_->id ?>"><?= $cat_filter_->category_name ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row filter_container position-relative">
                </div>
            </div>
        </section>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="cafeInfoModal" tabindex="-1" aria-labelledby="cafeInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title cafeName" id="cafeInfoModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-12">
                            <h4 class="bg-secondary text-white pt-2 pb-1 text-uppercase rounded-2">Owner Info</h4>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text">
                                <h5>Name</h5>
                                <h6 id="ownerName"></h6>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text">
                                <h5>Phone</h5>
                                <h6 id="ownerPhone"></h6>
                            </div>
                        </div>
                        <div class="col-12">
                            <h4 class="bg-secondary text-white pt-2 pb-1 text-uppercase rounded-2">Cafe Info</h4>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text">
                                <h5>Location</h5>
                                <h6 id="shopLocation"></h6>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text">
                                <h5>Cafe Timing</h5>
                                <h6 id="shopOpen"></h6>
                                <h6 id="shopClose"></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-none">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <?php include './includes/js_links.php'; ?>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'ajax/products_by_category.php',
                beforeSend: function() {
                    $('.filter_container').addClass('loading');
                },
                success: function(response) {
                    $('.filter_container').removeClass('loading');
                    $(".filter_container").html(response);
                }

            });

            // filter by ID
            $(document).on('click', '.filter_btn', function(e) {
                let filter_id = $(this).data('filter');
                $.ajax({
                    url: 'ajax/products_by_category.php',
                    method: 'post',
                    data: {
                        filter_id: filter_id
                    },
                    beforeSend: function() {
                        $('.filter_container').addClass('loading');
                    },
                    success: function(response) {
                        $('.filter_container').removeClass('loading');
                        $(".filter_container").html(response);
                    }

                });
            });

            // filter by dropDown
            $(document).on('change', 'select[name="filter_"]', function(e) {
                let filter_id = $(this).val();
                $.ajax({
                    url: 'ajax/products_by_category.php',
                    method: 'post',
                    data: {
                        filter_id: filter_id
                    },
                    beforeSend: function() {
                        $('.filter_container').addClass('loading');
                    },
                    success: function(response) {
                        $('.filter_container').removeClass('loading');
                        $(".filter_container").html(response);
                    }

                });
            });

            $(document).on("click", ".cafe-info", function(e) {
                e.preventDefault();
                $('#cafeInfoModal').modal('show');
                let cafeID = $(this).data("id");
                $.ajax({
                    url: 'ajax/cafe_info.php',
                    method: 'post',
                    data: {
                        cafeID_modal: cafeID
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        $(".cafeName").html(res.cafeName);
                        $("#ownerName").html(res.ownerName);
                        $("#ownerPhone").html(res.ownerPhone);
                        $("#shopLocation").html(res.shopLocation);
                        $("#shopOpen").html('open: ' + res.shopOpen);
                        $("#shopClose").html('close: ' + res.shopClose);
                    }
                });
            });
        });
    </script>
</body>

</html>