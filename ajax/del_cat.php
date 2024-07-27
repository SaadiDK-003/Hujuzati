<?php

require_once '../core/database.php';

if (isset($_POST['del_cat'])) :
    $del_id = $_POST['del_cat'];
    $del_c_Q = $db->query("DELETE FROM `categories` WHERE `id`='$del_id'");
    if ($del_c_Q) :
        echo json_encode(["msg" => "Category has been deleted."]);
    else :
        echo json_encode(["msg" => "Something went wrong."]);
    endif;
endif;
