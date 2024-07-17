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

// Registration Visitor

function register($POST)
{
    global $db;
    $name = $POST['name'];
    $email = $POST['email'];
    $phone = $POST['phone'];
    $pwd = $POST['password'];
    $r_pwd = $POST['re_password'];
    $response = '';
    $checkEmail = $db->query("SELECT email FROM `users` WHERE `email`='$email'");

    if (mysqli_num_rows($checkEmail) > 0) :
        $response = '<h6 class="text-center alert alert-danger">Email Already Exist.</h6>';
    else :
        if ($pwd != $r_pwd) :
            $response = '<h6 class="text-center alert alert-danger">Password & Confirm Password do not match.</h6>';
        else :
            $pwd = md5($pwd);
            $insertQ = $db->query("INSERT INTO `users` (name,email,password,phone,role) VALUES('$name','$email','$pwd','$phone','visitor')");
            if ($insertQ) {
                $response = '<h6 class="text-center alert alert-success">Visitor registered successfully.</h6>
                <script>
                    setTimeout(function(){
                        window.location.href = "./login.php";
                    },1800);
                </script>
                ';
            }
        endif;
    endif;

    return $response;
}


function isLoggedin()
{
    return isset($_SESSION['user']) ? true : false;
}
