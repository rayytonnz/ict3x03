<?php
//unset session variables
session_start();

$_SESSION['ok'] = "You have successfully logged out!";
$_SESSION['logout'] = "logout";

header("Location: index.php");
exit;
/*
header("refresh:3;url=../index.php");*/
?>
<!--<!DOCTYPE html>-->
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--<html>
    <head>
        <meta charset="UTF-8">
        <title>Wing Tai</title>-->
        <!-- Latest compiled and minified CSS -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="col-lg-12">
                <br>
                <center><img src="../images/logo.png" class="img-responsive img-center" alt="Wing Tai Logo" width="404" height="236"></center>
                <br>
                <br>
                <center>
                    <h1>Log Out</h1>
                    <hr style="color: red;">
                    <p style="font-family:'segoe UI semibold'; font-size:190%;">Thank you. You have logged off successfully.</p>
                    <p style="font-family:segoe UI; font-size:130%;">Please wait while you are redirected shortly...</p>

                    <br><br>
                    <div class="copy-right">
                        <p>&#169 All rights Reserved | Wing Tai Retail</p>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>-->

