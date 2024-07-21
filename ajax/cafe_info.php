<?php
require_once '../core/database.php';
if (isset($_POST['cafeID'])) :
    $cafeID = $_POST['cafeID'];

    $cafe_Q = $db->query("CALL `get_cafe_info`($cafeID)");

    $cafe_data = mysqli_fetch_object($cafe_Q); ?>

    <div class="grid-box">
        <div class="item">
            <div class="text"><span class="d-block fw-bold">Owner Name</span><?= $cafe_data->name ?></div>
            <div class="text"><span class="d-block fw-bold">Owner Phone</span><?= $cafe_data->phone ?></div>
        </div>
        <div class="item">
            <div class="text"><span class="d-block fw-bold">Store Name</span><?= $cafe_data->store_name ?></div>
        </div>
        <div class="item">
            <div class="text"><span class="d-block fw-bold">Store Location</span><?= $cafe_data->store_location ?></div>
        </div>
        <div class="item">
            <div class="text"><span class="d-block fw-bold">Store Open</span><?= date('h:i A', strtotime($cafe_data->store_open)) ?></div>
            <div class="text"><span class="d-block fw-bold">Store Close</span><?= date('h:i A', strtotime($cafe_data->store_close)) ?></div>
            <input type="hidden" id="store_open_time" value="<?= $cafe_data->store_open ?>">
            <input type="hidden" id="store_close_time" value="<?= $cafe_data->store_close ?>">
            <input type="hidden" name="cafe_owner_id" id="cafe_owner_id" value="<?= $cafe_data->user_id ?>">
        </div>
    </div>

<?php
    $cafe_Q->close();
    $db->next_result();
endif;


if (isset($_POST['cafeID_modal'])) :
    $cafeID = $_POST['cafeID_modal'];

    $cafe_Q = $db->query("CALL `get_cafe_info`($cafeID)");
    $response = array();
    $cafe_data = mysqli_fetch_object($cafe_Q);
    $store_open = date('h:i A', strtotime($cafe_data->store_open));
    $store_close = date('h:i A', strtotime($cafe_data->store_close));
    $response = ["cafeName" => $cafe_data->store_name, "ownerName" => $cafe_data->name, "ownerPhone" => $cafe_data->phone, "shopLocation" => $cafe_data->store_location, "shopOpen" => $store_open, "shopClose" => $store_close];
    echo json_encode($response);
    $cafe_Q->close();
    $db->next_result();
endif;
?>