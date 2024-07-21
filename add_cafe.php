<?php
require_once './core/database.php';
if (isLoggedin() === true && $userRole == 'visitor') {
    header('Location: ./');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Add Cafe</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="add_cafe_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="add_cafe">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1><?= TITLE ?> | Add Cafe</h1>
                    </div>
                    <div class="col-10 col-md-6 mx-auto">
                        <?php
                        if (isset($_POST['submit'])) :
                            echo Add_Cafe($_POST, $userID);
                        ?>
                        <?php endif; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="store_name">Store Name</label>
                                        <input type="text" name="store_name" id="store_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="store_open">Store Open</label>
                                        <input type="time" name="store_open" id="store_open" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="store_close">Store Close</label>
                                        <input type="time" name="store_close" id="store_close" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="store_location">Store Location</label>
                                        <input type="text" name="store_location" id="store_location" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center justify-content-md-end">
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Add Store</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <?php include './includes/js_links.php'; ?>
</body>

</html>