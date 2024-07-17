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
            <div class="text"><span class="d-block fw-bold">Store Open</span><?= $cafe_data->store_open ?></div>
            <div class="text"><span class="d-block fw-bold">Store Close</span><?= $cafe_data->store_close ?></div>
            <input type="hidden" id="store_open_time" value="<?= $cafe_data->store_open ?>">
            <input type="hidden" id="store_close_time" value="<?= $cafe_data->store_close ?>">
            <input type="hidden" name="cafe_owner_id" id="cafe_owner_id" value="<?=$cafe_data->user_id?>">
        </div>
    </div>

<?php
    $cafe_Q->close();
    $db->next_result();
endif;
?>