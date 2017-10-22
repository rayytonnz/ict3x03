<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include_once "userInformation.php";
include "config.php";
?>

<!-- email function -->
<?php

function send_mail($email, $message, $subject) {
    require_once('PhpMailer/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->AddAddress($email);
    $mail->Username = "baballoon95@gmail.com";
    $mail->Password = "fangyu0804";
    $mail->SetFrom('you@yourdomain.com', 'Password Recovery');
    $mail->AddReplyTo("you@yourdomain.com", "Reply: Password Recovery");
    $mail->Subject = $subject;
    $mail->MsgHTML($message);
    $mail->Send();
}

//generate random temporary password
//TODO: SET EXPIRY
function generate_random_password($length = 10) {
    $alphabets = range('A', 'Z');
    $numbers = range('0', '9');
    $additional_characters = array('_', '.');
    $final_array = array_merge($alphabets, $numbers, $additional_characters);

    $password = '';

    while ($length--) {
        $key = array_rand($final_array);
        $password .= $final_array[$key];
    }

    return $password;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="Js/checkCapsLock.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Validator -->
        <script src="https://code.jquery.com/jquery-1.12.4.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js">
        </script>
        <script src="sweetalert/dist/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
        <script src="Js/alertMessage.js"></script>

        <link rel="stylesheet" type="text/css" href="css/login.css">
        <title>Shopping Credits</title>
    </head>
    <body>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <!--login-->
                    <h1>Welcome to this site </h1>
                    <form data-toggle="validator" id="login-form" method="post" role="form" action="doLogin.php" style="display: block;">
                        <div class="form-group col-md-12">
                            <input class="form-control" data-error="Please enter email." type="text" name="username" id="username" tabindex="1"  placeholder="Email" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-12">
                            <input class="form-control" data-error="Please enter password." type="password" name="password" id="password" tabindex="2"  placeholder="Password" onkeypress="capLock(event)" required>
                            <div class="help-block with-errors"></div>
                            <span><div id="divMayus" style="visibility:hidden; color: red;">Caps Lock is ON</div></span>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-blue" value="Log In">
                                </div>
                            </div>
                        </div>
                        <!--Modal forgot password-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <a href="#" data-target="#pwdModal" data-toggle="modal" tabindex="5" class="forgot-password">Forgot Password?</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--login end-->

                </div>
            </div>
        </div>
        <!--modal-->
        <div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <div class="col-lg-12">
                            <i class="glyphicon glyphicon-lock"></i>
                            <h1 class="text-center">Forgot Password?</h1>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="text-center"  style="margin-top: 10px; margin-bottom: 20px;">
                            <p>If you have forgotten your password you can reset it here.</p>
                        </div>
                        <!--forget Password-->
                        <form data-toggle="validator" method="post" action="index.php" class="form-horizontal" role="form" >
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input class="form-control" data-error="Please enter your email." type="text" name="email" id="email" tabindex="1" placeholder="Email" value="" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <input type="submit" name="password-submit" tabindex="4" class="form-control btn btn-blue" value="Send Password">
                                        <?php
                                        if (isset($_POST['password-submit'])) {
                                            if (!empty($_POST['email'])) {
                                                $email = $_POST['email'];
//                                                $email = "fangyu95@hotmail.sg";
                                                $get_user_id_query = "SELECT * FROM users WHERE userEmail ='$email'";
                                                $result = mysqli_query($db, $get_user_id_query);
                                                if (mysqli_num_rows($result) == 1) {
                                                    $row = mysqli_fetch_array($result);
                                                    $userID = $row['userID'];
                                                    $name = $row['name'];
                                                    $tempPassword = generate_random_password();
                                                    //email content
                                                    $message = "
                                                            Hi $name, 
                                                            <br /><br />
                                                            This is from Shopping Credits. We notice that you have asked for a password reset.
                                                            If this was not your intended action, ignore this email.
                                                            <br /><br />
                                                            Your temporary password is $tempPassword. Login with it to reset your account's password.
                                                            <br /><br />
                                                            Thank you! Continue buying credits and save more!
                                                            ";
                                                    $subject = "Shopping Credit - Password Reset";

                                                    send_mail($email, $message, $subject);
                                                    $updatePassword = "UPDATE users SET userPassword = '" . $tempPassword . "', resetPassword = 1 WHERE userID = '" . $userID . "'";
                                                    $updateResult = mysqli_query($db, $updatePassword);
                                                    //redirect back 
                                                    header("Location: ../index.php");
                                                } else {
                                                    echo'<script>';
                                                    echo 'alert("Invalid email")';
                                                    echo '</script>';
                                                }
                                            }
                                        } else {
//                                            header("Location:../index.php");
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--forget Password end-->
                    </div>
                    <div class="modal-footer">
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="col-sm-offset-8 col-sm-4">
                                    <input data-dismiss="modal" aria-hidden="true" class="form-control btn btn-default" value="Clear">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

    </body>
</html>

