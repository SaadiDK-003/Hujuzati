<?php

require_once '../core/database.php';

if (isset($_POST['del_prod'])) :
    global $db;
    $del_prod_id =  $_POST['del_prod'];

    $del_Q = $db->query("DELETE FROM `products` WHERE `id`='$del_prod_id'");

    if ($del_Q) {
        echo json_encode(["msg" => "Product has been deleted"]);
    } else {
        echo json_encode(["msg" => "Something went wrong!"]);
    }

endif;
