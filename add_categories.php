<?php
require_once './core/database.php';
if (isLoggedin() === true && $userRole != 'admin') {
    header('Location: ./');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITLE ?> | Categories</title>
    <?php include './includes/css_links.php'; ?>
    <link rel="stylesheet" href="./css/style.min.css">
</head>

<body class="add_categories_page">
    <?php include_once './includes/header.php'; ?>
    <main>
        <section class="add_categories">
            <div class="container my-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1><?= TITLE ?> | Categories</h1>
                    </div>
                    <div class="col-10 col-md-3 mx-auto">
                        <?php
                        if (isset($_POST['submit'])) :
                            echo add_category($_POST);
                        ?>
                        <?php endif; ?>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" name="category_name" id="category_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group d-flex justify-content-center justify-content-md-end">
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Add Category</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-md-6 mx-auto">
                        <table id="example" class="table table-bordered table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cat_filter_ = $db->query("SELECT * FROM `categories`");
                                while ($cat_ = mysqli_fetch_object($cat_filter_)) :
                                ?>
                                    <tr>
                                        <td><?= $cat_->id ?></td>
                                        <td><?= $cat_->category_name ?></td>
                                        <td>
                                            <a href="edit_category.php?id=<?= $cat_->id ?>" class="btn btn-primary">Edit</a>
                                            <a href="#!" data-id="<?= $cat_->id ?>" class="btn btn-danger del-cat">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                endwhile;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
            $(document).on('click', '.del-cat', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: 'ajax/del_cat.php',
                    method: 'post',
                    data: {
                        del_cat: id
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        $('.toast-body').html(res.msg);
                        $('.toast').toast('show');
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                });
            });
        });
    </script>
</body>

</html>