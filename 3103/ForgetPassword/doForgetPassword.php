<?php

/* this file does the generate out the link for the user to reset the password */
include ("config.php");
include("ForgetPassword/emailFunctions.php");

$email = $_POST['email'];
$get_user_id_query = "SELECT * FROM users WHERE userEmail ='$email'";
$result = mysqli_query($db, $get_user_id_query);
echo $email;
echo 'adsasd';
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $userID = $row['userID'];
    $name = $row['name'];

    //email content
    $message = "
       Hi $name, 
       <br /><br />
       This is from Shopping Credits. We notice that you have asked for a password reset.
       If this was not your intended action, ignore this email.
       <br /><br />
       Click the link below to reset your password.
       <br /><br />
       //
       <a href='http://localhost:1234/3103/ForgetPassword/confirmPasswordResetPage.php?id=$userID'>Click here to reset your password</a>
       <br /><br />
       Thank you! Continue buying credits and save more!
       ";
    $subject = "Shopping Credit - Password Reset";

    send_mail($email, $message, $subject);
    //redirect back 
//    header("Location:../index.php?msg=email_ok");
} else {
    echo '<script language="javascript">';
    echo 'alert("ERRRRRRRRRROOOOOOOORRRRRRRRR")';
    echo '</script>';
    header("Location:../index.php?msg=invaild_email");
}
?>