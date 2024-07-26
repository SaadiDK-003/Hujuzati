<?php
require_once './core/database.php';
if (isLoggedin() === true && $userRole == 'visitor') {
    header('Location: ./');
}
$prod_edit_id = 0;
if (isset($_GET['id'])) {
    $prod_edit_id = $_GET['id'];
}
$edit_p_Q = $db->query("SELECT * FROM `products` WHERE `id`='$prod_edit_id'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Edit Product</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="edit_products_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="edit_products">
            <div class="container my-5">
                <?php
                if (mysqli_num_rows($edit_p_Q) > 0) :
                    $get_prod_ = mysqli_fetch_object($edit_p_Q);
                    $c_id = $get_prod_->id;
                    $cat_id_ = $get_prod_->prod_category_id;
                    $getCatQ = $db->query("SELECT category_name FROM `categories` WHERE `id`='$cat_id_'");
                    $getCat = mysqli_fetch_object($getCatQ);
                ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1><?= TITLE ?> | Edit Product</h1>
                        </div>
                        <div class="col-10 col-md-6 mx-auto">
                            <?php
                            if (isset($_POST['submit'])) :
                                echo Edit_Product($_POST, $_FILES);
                            ?>
                            <?php endif; ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="prod_name">Product Name</label>
                                            <input type="text" value="<?= $get_prod_->prod_name ?>" name="prod_name" id="prod_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="prod_reg_price">Regular Price</label>
                                            <input type="text" value="<?= $get_prod_->prod_reg_price ?>" name="prod_reg_price" id="prod_reg_price" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="prod_disc_price">Discount Price</label>
                                            <input type="text" value="<?= $get_prod_->prod_disc_price ?>" name="prod_disc_price" id="prod_disc_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="prod_img">Product Image</label>
                                            <input type="file" name="prod_img" id="prod_img" class="form-control">
                                            <code>leave, if don't wanna change it.</code>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="category_id">Select Category</label>
                                            <select name="category_id" id="category_id" class="form-select" required>
                                                <option value="<?= $get_prod_->prod_category_id ?>" selected hidden><?= $getCat->category_name ?></option>
                                                <?php $cat_Q = $db->query("CALL `get_all_categories`()");
                                                while ($get_c = mysqli_fetch_object($cat_Q)) :
                                                ?>
                                                    <option value="<?= $get_c->id ?>"><?= $get_c->category_name ?></option>
                                                <?php endwhile;
                                                $cat_Q->close();
                                                $db->next_result();
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="form-group">
                                            <label for="prod_desc">Product Description</label>
                                            <textarea name="prod_desc" id="prod_desc" class="form-control" rows="5" required><?= $get_prod_->prod_desc ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center justify-content-md-end">
                                        <input type="hidden" name="c_id" value="<?=$c_id?>">
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Edit Product</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4>No Product Found.</h4>
                            <a href="javascript:history.go(-1)" class="btn btn-primary">Home</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>


    <?php include './includes/js_links.php'; ?>
</body>

</html>