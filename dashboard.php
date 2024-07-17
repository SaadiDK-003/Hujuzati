<?php
require_once './core/database.php';
if (isLoggedin() === false && $userRole != 'visitor') {
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

<body class="visitor_dashboard">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="dashboard">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Dashboard</h1>
                        <h5>Welcome, <?= $userName ?></h5>
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
                                    <th>Cafe Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $date = '';
                                $getR_Q = $db->query("CALL `get_reservation_for_visitor`($userID)");
                                while ($getRow = mysqli_fetch_object($getR_Q)) :
                                    $date = date('d-M-Y h:i:s', strtotime($getRow->start_time));
                                ?>
                                    <tr>
                                        <td><?= $getRow->r_id ?></td>
                                        <td><?= $date ?></td>
                                        <td><?= $getRow->total_members ?></td>
                                        <td><?= $getRow->total_tables ?></td>
                                        <td><?= $getRow->table_location ?></td>
                                        <td><a href="#!" class="btn btn-secondary" data-id="<?= $getRow->cafe_id ?>">Cafe Info</a></td>
                                        <td><a href="#!" data-id="<?= $getRow->r_id ?>" class="btn btn-primary btn-sm">Edit</a></td>
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
                                    <th>Cafe Info</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <?php include './includes/js_links.php'; ?>
</body>

</html>