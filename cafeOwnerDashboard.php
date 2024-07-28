<?php
require_once './core/database.php';
if (isLoggedin() === false || $userRole == 'visitor') {
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

<body class="cafe_owner_dashboard_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="cafe_owner_dashboard">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Dashboard</h1>
                        <h5>Welcome, <?= $userName ?></h5>
                    </div>
                    <div class="col-12 text-center d-flex gap-3 justify-content-center mt-2">
                        <?= ($cafeOwner_CafeID == '') ? '<a href="./add_cafe.php" class="btn btn-primary">Add Cafe</a>' : '' ?>
                        <?php if ($cafeOwner_CafeID != '') : ?>
                            <a href="./add_products.php" class="btn btn-primary">Add Products</a>
                        <?php endif; ?>
                    </div>
                    <!-- RESERVATION TABLE START -->
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
                                    <th>Visitor Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $date = '';
                                $getR_Q = $db->query("CALL `get_reservation_for_cafe_owner`($userID)");
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
                                        <td><a href="#!" class="btn btn-secondary visitor-id" data-id="<?= $getRow->visitor_id ?>">Visitor Info</a></td>
                                        <td><a href="#!" data-id="<?= $getRow->r_id ?>" class="btn btn-primary btn-sm update-info">Update</a></td>
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
                                    <th>Visitor Info</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- RESERVATION TABLE END -->

                    <!-- COMPLETED RESERVATIONS START -->
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
                                    <th>Visitor Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $date = '';
                                $getR_Q = $db->query("CALL `get_reservation_for_cafe_owner_completed`($userID)");
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
                                        <td><a href="#!" class="btn btn-secondary visitor-id" data-id="<?= $getRow->visitor_id ?>">Visitor Info</a></td>
                                        <td>
                                            <?php if ($getRow->r_status == 'completed') : ?>
                                                -
                                            <?php else : ?>
                                                <a href="#!" data-id="<?= $getRow->r_id ?>" class="btn btn-primary btn-sm update-info">Update</a>
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
                                    <th>Visitor Info</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- COMPLETED RESERVATIONS END -->

                    <!-- PRODUCTS TABLE START -->
                    <?php if ($cafeOwner_CafeID != '') : ?>
                        <div class="col-12 mt-5">
                            <h3>Products Table</h3>
                        </div>
                        <div class="col-12">
                            <table id="example1" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Prod Name</th>
                                        <th>Reg price</th>
                                        <th>Disc Price</th>
                                        <th>Prod Desc</th>
                                        <th>Prod Img</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $date = '';
                                    $getPR_Q = $db->query("CALL `get_all_products_by_cafe_id`($cafeOwner_CafeID)");
                                    while ($getPRow = mysqli_fetch_object($getPR_Q)) :
                                    ?>
                                        <tr>
                                            <td><?= $getPRow->p_id ?></td>
                                            <td><?= $getPRow->prod_name ?></td>
                                            <td><?= $getPRow->prod_reg_price ?></td>
                                            <td><?= $getPRow->prod_disc_price ?></td>
                                            <td><?= $getPRow->prod_desc ?></td>
                                            <td><img width="60" height="60" class="rounded-2 mx-auto" src="<?= $getPRow->prod_img ?>" alt=""></td>
                                            <td><?= $getPRow->category_name ?></td>
                                            <td>
                                                <a href="edit_product.php?id=<?= $getPRow->p_id ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="#!" data-id="<?= $getPRow->p_id ?>" class="btn btn-danger btn-sm del-prod">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endwhile;
                                    $getPR_Q->close();
                                    $db->next_result();
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Prod Name</th>
                                        <th>Reg price</th>
                                        <th>Disc Price</th>
                                        <th>Prod Desc</th>
                                        <th>Prod Img</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php endif; ?>
                    <!-- PRODUCTS TABLE END -->
                </div>
            </div>
        </section>
    </main>

    <!-- Modal Visitor Info -->
    <div class="modal fade" id="visitorInfoModal" tabindex="-1" aria-labelledby="visitorInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visitorInfoModalLabel">Visitor Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-12 col-md-4">
                            <div class="text">
                                <h5>Name</h5>
                                <h6 id="visitorName"></h6>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="text">
                                <h5>Email</h5>
                                <h6 id="visitorEmail"></h6>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="text">
                                <h5>Phone</h5>
                                <h6 id="visitorPhone"></h6>
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


    <!-- Modal Update Reservation -->
    <div class="modal fade" id="updateReservationModal" tabindex="-1" aria-labelledby="updateReservationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateReservationLabel">Visitor Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="update-reservation-form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 msg-show"></div>
                            <div class="col-12">
                                <label for="r_status">Status</label>
                                <select name="r_status" id="r_status" class="form-select" required>
                                    <option value="" selected hidden>Select Status</option>
                                    <option value="reserved">Reserved</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancel">Cancel</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="update_res_id" id="update_res_id" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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
            // Get Visitor Information
            $(document).on("click", ".visitor-id", function(e) {
                e.preventDefault();
                $('#visitorInfoModal').modal('show');
                let visitorID = $(this).data("id");
                $.ajax({
                    url: 'ajax/visitor_info.php',
                    method: 'post',
                    data: {
                        visitorID_modal: visitorID
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        $("#visitorName").html(res.visitorName);
                        $("#visitorEmail").html(res.visitorEmail);
                        $("#visitorPhone").html(res.visitorPhone);
                    }
                });
            });

            // On-Click open modal to update status
            $(document).on('click', '.update-info', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $("#update_res_id").val(id);
                $('#updateReservationModal').modal('show');
            });

            // Update Reservation Status ~ Form
            $(document).on('submit', '#update-reservation-form', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    url: 'ajax/update_reservation.php',
                    method: 'post',
                    data: formData,
                    success: function(response) {
                        $('.msg-show').append(response);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1800);
                    }
                });
            });

            // Delete Product
            $(document).on('click', '.del-prod', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: 'ajax/prod_req.php',
                    method: 'post',
                    data: {
                        del_prod: id
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        $('.toast-body').html(res.msg);
                        $(".toast").toast('show');
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