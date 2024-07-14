<?php
require_once 'database.php';

function login($email, $pwd)
{
    global $db;
    $result = '';
    $pwd = md5($pwd);
    $loginQ = $db->query("SELECT id FROM users WHERE `email`='$email' AND `password`='$pwd'");
    if (mysqli_num_rows($loginQ) > 0) {
        $fetchID = mysqli_fetch_object($loginQ);
        $_SESSION['user'] = $fetchID->id;
        $result = '<h6 class="text-center alert alert-success">Login Success, Redirecting...</h6>
        <script>
            setTimeout(function(){
                window.location.href = "./";
            },1800);
        </script>
        ';
    } else {
        $result = '<h6 class="text-center alert alert-danger">Incorrect Credentials, please check them.</h6>';
    }
    return $result;
}


function isLoggedin()
{
    return isset($_SESSION['user']) ? true : false;
}
