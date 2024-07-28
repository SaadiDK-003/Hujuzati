<?php
require_once './core/database.php';
if (isLoggedin() === false || $userRole == 'cafe_owner') {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Dashboard</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="visitor_dashboard_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="visitor_dashboard">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Dashboard</h1>
                        <h5>Welcome, <?= $userName ?></h5>
                    </div>
                    <!-- Reservation Table Start -->
                    <div class="col-12">
                        <h3>Reservation Table</h3>
                    </div>
                    <div class="col-12">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Start Time</th>
                                    <th>Total Members</th>
                                    <th>Total Tables</th>
                                    <th>Table Location</th>
                                    <th>Events</th>
                                    <th>Status</th>
                                    <th>Cafe Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $date = '';
                                $getR_Q = $db->query("CALL `get_reservation_for_visitor`($userID)");
                                while ($getRow = mysqli_fetch_object($getR_Q)) :
                                    $date = date('d-M-Y h:i A', strtotime($getRow->start_time));
                                ?>
                                    <tr>
                                        <td><?= $getRow->r_id ?></td>
                                        <td><?= $date ?></td>
                                        <td><?= $getRow->total_members ?></td>
                                        <td><?= $getRow->total_tables ?></td>
                                        <td><?= $getRow->table_location ?></td>
                                        <td><?= ($getRow->events == '') ? '-' : $getRow->events ?></td>
                                        <td><?php
                                            if ($getRow->r_status == 'pending') : ?>
                                                <span class="btn btn-warning"><?= $getRow->r_status ?></span>
                                            <?php elseif ($getRow->r_status == 'reserved') : ?>
                                                <span class="btn btn-info"><?= $getRow->r_status ?></span>
                                            <?php else : ?>
                                                <span class="btn btn-success"><?= $getRow->r_status ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><a href="#!" class="btn btn-secondary cafe-id" data-id="<?= $getRow->cafe_id ?>">Cafe Info</a></td>
                                        <td>
                                            <?php if ($getRow->r_status == 'completed') : ?>
                                                <?php if ($getRow->reviewed == 1) : ?>
                                                    -
                                                <?php else : ?>
                                                    <a href="./add_reviews.php?cafe_id=<?= $getRow->cafe_id ?>&res_id=<?= $getRow->r_id ?>" class="btn btn-primary">Review</a>
                                                <?php endif; ?>
                                            <?php elseif ($getRow->r_status == 'reserved') : ?>
                                                -
                                            <?php else : ?>
                                                <a href="edit_reservation.php?id=<?= $getRow->r_id ?>" class="btn btn-primary btn-sm edit-info">Edit</a>
                                                <a href="#!" data-id="<?= $getRow->r_id ?>" class="btn btn-danger btn-sm del-info">Delete</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile;
                                $getR_Q->close();
                                $db->next_result();
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Start Time</th>
                                    <th>Total Members</th>
                                    <th>Total Tables</th>
                                    <th>Table Location</th>
                                    <th>Events</th>
                                    <th>Status</th>
                                    <th>Cafe Info</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Reservation Table End -->

                    <!-- Completed Reservations Start -->
                    <div class="col-12 mt-5">
                        <h3>Completed Reservations</h3>
                    </div>
                    <div class="col-12">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Start Time</th>
                                    <th>Total Members</th>
                                    <th>Total Tables</th>
                                    <th>Table Location</th>
                                    <th>Events</th>
                                    <th>Status</th>
                                    <th>Cafe Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $date = '';
                                $getR_Q = $db->query("CALL `get_reservation_for_visitor_completed`($userID)");
                                while ($getRow = mysqli_fetch_object($getR_Q)) :
                                    $date = date('d-M-Y h:i A', strtotime($getRow->start_time));
                                ?>
                                    <tr>
                                        <td><?= $getRow->r_id ?></td>
                                        <td><?= $date ?></td>
                                        <td><?= $getRow->total_members ?></td>
                                        <td><?= $getRow->total_tables ?></td>
                                        <td><?= $getRow->table_location ?></td>
                                        <td><?= ($getRow->events == '') ? '-' : $getRow->events ?></td>
                                        <td><?php
                                            if ($getRow->r_status == 'pending') : ?>
                                                <span class="btn btn-warning"><?= $getRow->r_status ?></span>
                                            <?php elseif ($getRow->r_status == 'reserved') : ?>
                                                <span class="btn btn-info"><?= $getRow->r_status ?></span>
                                            <?php else : ?>
                                                <span class="btn btn-success"><?= $getRow->r_status ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><a href="#!" class="btn btn-secondary cafe-id" data-id="<?= $getRow->cafe_id ?>">Cafe Info</a></td>
                                        <td>
                                            <?php if ($getRow->r_status == 'completed') : ?>
                                                <?php if ($getRow->reviewed == 1) : ?>
                                                    -
                                                <?php else : ?>
                                                    <a href="./add_reviews.php?cafe_id=<?= $getRow->cafe_id ?>&res_id=<?= $getRow->r_id ?>" class="btn btn-primary">Review</a>
                                                <?php endif; ?>
                                            <?php elseif ($getRow->r_status == 'reserved') : ?>
                                                -
                                            <?php else : ?>
                                                <a href="edit_reservation.php?id=<?= $getRow->r_id ?>" class="btn btn-primary btn-sm edit-info">Edit</a>
                                                <a href="#!" data-id="<?= $getRow->r_id ?>" class="btn btn-danger btn-sm del-info">Delete</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile;
                                $getR_Q->close();
                                $db->next_result();
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Start Time</th>
                                    <th>Total Members</th>
                                    <th>Total Tables</th>
                                    <th>Table Location</th>
                                    <th>Events</th>
                                    <th>Status</th>
                                    <th>Cafe Info</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Completed Reservations End -->
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

    <div class="toast-container position-absolute p-3 bottom-0 end-0">
        <div class="toast align-items-center text-white bg-danger border-0" data-bs-animation="true" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    User has been deleted.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <?php include './includes/js_links.php'; ?>

    <script>
        $(document).ready(function() {
            $(document).on("click", ".cafe-id", function(e) {
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

            $(document).on('click', '.del-info', function(e) {
                e.preventDefault();
                let id = $(this).data('id');

                $.ajax({
                    url: 'ajax/reservationForm.php',
                    method: 'post',
                    data: {
                        del_res: id
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        $('.toast').toast('show');
                        $('.toast-body').html(res.msg);
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                })
            });
        });
    </script>
</body>

</html>