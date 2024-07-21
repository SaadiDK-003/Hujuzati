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
    <title><?= TITLE ?> | Add Product</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="add_products_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="add_products">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1><?= TITLE ?> | Add Product</h1>
                    </div>
                    <div class="col-10 col-md-6 mx-auto">
                        <?php
                        if (isset($_POST['submit'])) :
                            echo Add_Product($_POST, $_FILES, $userID, $cafeOwner_CafeID);
                        ?>
                        <?php endif; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="prod_name">Product Name</label>
                                        <input type="text" name="prod_name" id="prod_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="prod_reg_price">Regular Price</label>
                                        <input type="text" name="prod_reg_price" id="prod_reg_price" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="prod_disc_price">Discount Price</label>
                                        <input type="text" name="prod_disc_price" id="prod_disc_price" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="prod_img">Product Image</label>
                                        <input type="file" name="prod_img" id="prod_img" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="category_id">Select Category</label>
                                        <select name="category_id" id="category_id" class="form-select" required>
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
                                        <textarea name="prod_desc" id="prod_desc" class="form-control" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center justify-content-md-end">
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Add Product</button>
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