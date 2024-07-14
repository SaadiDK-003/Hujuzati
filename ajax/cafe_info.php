<?php
require_once '../core/database.php';
if (isset($_POST['cafeID'])) :
    $cafeID = $_POST['cafeID'];

    echo $cafeID;

endif;
