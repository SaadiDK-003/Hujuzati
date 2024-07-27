<?php
require_once '../core/database.php';
if (isset($_POST['filter_id'])) {
    $filter_id = $_POST['filter_id'];
    $prod_Q = $db->query("CALL `get_all_products_by_cat_id`($filter_id)");
} else {
    $prod_Q = $db->query("CALL `get_all_products`()");
}
$echo_data = '';
while ($list_p = mysqli_fetch_object($prod_Q)) :

    $echo_data .= '<div class="col-10 col-md-3 mx-auto mx-md-0 mb-4">
        <div class="card border rounded-2 p-2 d-flex justify-content-between">
            <div class="img overflow-hidden rounded-2">
                <img src="' . $list_p->prod_img . '" class="w-100" alt="product-img">
            </div>
            <div class="content position-relative">
                <div class="title d-flex align-items-center justify-content-between">
                    <h5>' . $list_p->prod_name . '</h5><span class="bg-secondary text-white px-2 py-1 rounded-2 category h6">' . $list_p->category_name . '</span>
                </div>'; ?>
                <?php if ($list_p->prod_disc_price != 0.00) : ?>
                <?php $echo_data .=  '<span class="disc-price fw-bold text-success">' . CURRENCY . $list_p->prod_disc_price . '</span>
                    <span class="reg-price text-decoration-line-through text-danger">' . CURRENCY . $list_p->prod_reg_price . '</span>'; ?>
                <?php else :
                    $echo_data .= '<span class="reg-price fw-bold">' . CURRENCY . $list_p->prod_reg_price . '</span>';
                ?>
                <?php endif;
                $echo_data .= '<p class="line-clamp-2">' . $list_p->prod_desc . '</p>
                <a href="#!" data-id="' . $list_p->cafe_id . '" class="btn btn-primary btn-sm cafe-info">Cafe Info</a>
            </div>
        </div>
    </div>';

            endwhile;
            echo $echo_data;
            $prod_Q->close();
            $db->next_result();
