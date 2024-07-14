<?php
session_start();
$config_path = $_SERVER['DOCUMENT_ROOT'].'/Hujuzati/';
require_once ''.$config_path.'config.php';
$db = mysqli_connect(HOST, DB_USER, DB_PWD, DB_NAME);
include_once 'functions.php';
$userID = '';
if (isset($_SESSION['user'])) {
    $userID = $_SESSION['user'];
}
