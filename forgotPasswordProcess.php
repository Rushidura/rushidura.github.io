<?php

include"./connection.php";

include"./SMTP.php";
include"./PHPMailer.php";
include"./Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $email = $_GET["e"];

    // echo ($email);
    $user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '".$email."'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        $code = uniqid();
        Database::iud("UPDATE `users` SET `vccode` = '".$code."' WHERE `email`= '".$email."'");

        //EMAIL CODE
        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'durangakarunarathna8@gmail.com';//sender's email
            $mail->Password = 'lilqvixsxilspocq';//app password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('durangakarunarathna8@gmail.com', 'Reset Password');//sender's email,sender' name
            $mail->addReplyTo('durangakarunarathna8@gmail.com', 'Reset Password');//sender,s email,sender'name
            $mail->addAddress($email);//receiver's email
            $mail->isHTML(true);
            $mail->Subject = 'eShop forgot password verification code';//subject of email
            $bodyContent = '<h1 style="color:red;">Your Verification Code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;
        
            if(!$mail->send()){
                echo ("Verification Sending Failed.");
            }else{
                echo("success");
            }
    
    } else {
        echo("invalid email address.");
    }
    

}else{
    echo ("Please enter your Email Address");
}


?>