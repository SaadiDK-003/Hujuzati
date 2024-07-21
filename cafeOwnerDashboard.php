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
                        <a href="./add_cafe.php" class="btn btn-primary">Add Cafe</a>
                        <?php if ($cafeOwner_CafeID != '') : ?>
                            <a href="./add_products.php" class="btn btn-primary">Add Products</a>
                        <?php endif; ?>
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
                                        <td><a href="#!" class="btn btn-secondary visitor-id" data-id="<?= $getRow->visitor_id ?>">Visitor Info</a></td>
                                        <td><a href="#!" data-id="<?= $getRow->r_id ?>" class="btn btn-primary btn-sm edit-info">Edit</a></td>
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
                                    <th>Visitor Info</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal -->
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


    <?php include './includes/js_links.php'; ?>

    <script>
        $(document).ready(function() {
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
                        // $("#shopOpen").html(res.shopOpen);
                        // $("#shopClose").html(res.shopClose);
                    }
                });
            });
        });
    </script>
</body>

</html>