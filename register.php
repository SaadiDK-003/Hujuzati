<?php
require_once './core/database.php';
if (isLoggedin() === true) {
    header('Location: ./');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Registration</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="register_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="registration">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1><?= TITLE ?> | Registration</h1>
                    </div>
                    <div class="col-10 col-md-6 mx-auto">
                        <?php
                        if (isset($_POST['submit'])) :
                            echo register($_POST);
                        ?>
                        <?php endif; ?>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" id="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" id="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="tel" name="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" id="phone" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="re-password">Re-Password</label>
                                        <input type="password" name="re_password" id="re-password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3 d-flex align-items-end">
                                    <div class="form-group d-flex gap-2 justify-content-end w-100">
                                        <a href="./login.php" class="btn btn-secondary order-0 order-md-1">login</a>
                                        <button type="submit" name="submit" id="submit" class="btn btn-success">Register</button>
                                    </div>
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