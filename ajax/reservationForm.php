<?php

require_once '../core/database.php';

if (isset($_POST['start_time'])) {
    $cafeID = $_POST['cafe'];
    $s_time = $_POST['start_time'];
    $e_time = $_POST['end_time'];
    $t_members = $_POST['total_members'];
    $t_tables = $_POST['total_tables'];
    $t_location = $_POST['table_location'];
    $events = $_POST['events'];
    $res_Q = $db->query("INSERT INTO `reservation` (start_time,total_members,total_tables,table_location,events,end_time,cafe_id,users_id) VALUES('$s_time','$t_members','$t_tables','$t_location','$events','$e_time','$cafeID','$userID')");

    if ($res_Q) {
        echo json_encode(["status" => "success", "msg" => "Reservation request has been submitted."]);
    } else {
        echo json_encode(["status" => "danger", "msg" => "Something went wrong."]);
    }
}
