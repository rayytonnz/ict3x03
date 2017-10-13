<?php
//session_start();
//include_once "../userInformation.php";
include "../config.php";
include"../authentication.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$getID = $_SESSION['userID'];
//echo $getID;
$getEmail = $_SESSION['userEmail'];
//echo $getEmail;

session_admin_role_check();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <script src="Js/checkCapsLock.js"></script>
        <link rel="stylesheet" href="../css/navigation.css" type="text/css"/>
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
        <title></title>
    </head>
    <body>
        <div class="topnav">
            <a class="active" href="admin_home.php">Home</a>            
            <a id="right" href="../doLogout.php" class="btn-logout">Logout</a>
            <a id="right" href="admin_profile.php">Profile</a>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <h3>ADMIN Homepage</h3>
                    <!--TODO: VIEW ALL CREDIT INFORMATION-->
                   
                    
                </div>
            </div>
        </div>

    </body>
</html>
