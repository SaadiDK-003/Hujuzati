<?php
session_start();
$config_path = $_SERVER['DOCUMENT_ROOT'] . '/Hujuzati/';
require_once '' . $config_path . 'config.php';
$db = mysqli_connect(HOST, DB_USER, DB_PWD, DB_NAME);
include_once 'functions.php';
$userID = '';
$userName = '';
$userEmail = '';
$userPhone = '';
$userRole = '';
$cafeOwner_CafeID = '';
if (isset($_SESSION['user'])) {
    $userID = $_SESSION['user'];
    $getUserQ = $db->query("SELECT * FROM `users` WHERE `id`='$userID'");
    $userData = mysqli_fetch_object($getUserQ);
    $userName = $userData->name;
    $userEmail = $userData->email;
    $userPhone = $userData->phone;
    $userRole = $userData->role;

    if ($userRole == 'cafe_owner') {
        $getCafeQ = $db->query("SELECT * FROM `cafe` WHERE `users_id`='$userID'");
        if (mysqli_num_rows($getCafeQ) > 0) {
            $getCafeData = mysqli_fetch_object($getCafeQ);
            $cafeOwner_CafeID = $getCafeData->id;
        }
    }
}
