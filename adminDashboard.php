<?php
require_once './core/database.php';
if (isLoggedin() === false || $userRole != 'admin') {
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

<body class="admin_dashboard_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="admin_dashboard">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Dashboard</h1>
                        <h5>Welcome, <?= $userName ?></h5>
                    </div>
                    <div class="col-12 my-5">
                        <div class="d-flex justify-content-center gap-3">
                            <a href="#!" class="btn btn-secondary">Add Users</a>
                            <a href="#!" class="btn btn-primary">Add Categories</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $date = '';
                                $getR_Q = $db->query("CALL `get_all_users`()");
                                while ($getRow = mysqli_fetch_object($getR_Q)) :
                                ?>
                                    <tr>
                                        <td><?= $getRow->id ?></td>
                                        <td><?= $getRow->name ?></td>
                                        <td><?= $getRow->email ?></td>
                                        <td><?= $getRow->role ?></td>
                                        <td><a href="#!" class="btn btn-secondary btn-sm edit-id" data-id="<?= $getRow->id ?>">Edit</a>
                                            <a href="#!" class="btn btn-danger btn-sm del-id" data-id="<?= $getRow->id ?>">Delete</a>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
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
                            <h4 class="bg-secondary text-white pt-2 pb-1 text-uppercase rounded-2">Shop Info</h4>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text">
                                <h5>Location</h5>
                                <h6 id="shopLocation"></h6>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="text">
                                <h5>Shop Timing</h5>
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
        });
    </script>
</body>

</html>