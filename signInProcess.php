<?php

session_start();
include "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberMe = $_POST["r"];

if (empty($email)) {
    echo ("Please Enter Your Email Address.");
} else if (strlen($email) > 100) {
    echo ("Email Address Must contain LOWER THAN 100 Characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address.");
}else if(empty($password)) {
    echo ("Please Enter Your Password.");
}else if(strlen($password)<5 || strlen($password)>20){
    echo ("Password Must contain BETWEEN 5 AND 20 Characters.");
}else{
    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' AND `password`='".$password."' ");
    $num = $rs->num_rows;

    if ($num == 1) {
        echo("success");
        $data =$rs->fetch_assoc();
        $_SESSION["u"] = $data;

        if($rememberMe == "true"){
            setcookie("email", $email, time() + (60*60*24*365)); // 365 day
            setcookie("password", $password, time() + (60*60*24*365)); // 365 day
        }
    }else{
        echo ("Invalid Email Address or Password.");
    }
}

?>