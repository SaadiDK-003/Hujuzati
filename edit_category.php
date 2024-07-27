<?php
require_once './core/database.php';
if (isLoggedin() === true && $userRole != 'admin') {
    header('Location: ./');
}
$edit_cat_id = 0;
if (isset($_GET['id'])) {
    $edit_cat_id = $_GET['id'];
}
$editCat_Q = $db->query("SELECT * FROM `categories` WHERE `id`='$edit_cat_id'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Edit Category</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="edit_category_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="edit_category">
            <div class="container my-5">
                <?php if (mysqli_num_rows($editCat_Q) > 0) :
                    $editCat_ = mysqli_fetch_object($editCat_Q);
                ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1><?= TITLE ?> | Edit Category</h1>
                        </div>
                        <div class="col-10 col-md-3 mx-auto">
                            <?php
                            if (isset($_POST['submit'])) :
                                echo edit_category($_POST);
                            ?>
                            <?php endif; ?>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">Category Name</label>
                                            <input type="text" name="category_name" value="<?= $editCat_->category_name ?>" id="category_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="form-group d-flex justify-content-center justify-content-md-end">
                                            <input type="hidden" name="editCat_ID" value="<?= $editCat_->id ?>">
                                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Edit Category</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>No Category Found.</h1>
                            <a href="javascript:history.go(-1);" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>


    <?php include './includes/js_links.php'; ?>
</body>

</html>