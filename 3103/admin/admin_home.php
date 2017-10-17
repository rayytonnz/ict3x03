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

$query = "SELECT * FROM customers";


$result = mysqli_query($db, $query);
mysqli_close($db);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <script src="Js/checkCapsLock.js"></script>
        <link rel="stylesheet" href="../css/navigation.css" type="text/css"/>
          <link rel="stylesheet" href="../css/table.css" type="text/css"/>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/content.css">
        <!-- Validator -->
        <script src="https://code.jquery.com/jquery-1.12.4.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js">
        </script>
        <title></title>
    </head>
    <body>
        <div class="topnav">
            <a class="active" href="admin_home.php">Customer Account</a>
            <a id="right" href="../doLogout.php" class="btn-logout">Logout</a>
            <a id="right" href="admin_profile.php">Profile</a>
        </div>

          <div style="padding:60px;">
            <h2 class="text-center white">Customer Account</h2><br>
            <table class="table" border="1">
                <tr class="tableheader">
                    <th class="th">MOBILE</th>    
                    <th class="th">EMAIL</th>
                    <th class="th">NAME</th>
                    <th class="th">CREDIT PRICE</th>

                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n";
                    echo "  <td  class='td'>" . $row['custMobile'] . "  </td>" . "\n";
                    echo "  <td  class='td'>" . $row['custEmail'] . "  </td>" . "\n";
                    echo "  <td  class='td'>" . $row['custName'] . "  </td>" . "\n";
                    echo "  <td  class='td'>" . $row['custCredit'] . "  </td>" . "\n";
                    echo "</tr>\n";
                }
                ?>
            </table>

        </div>


    </body>
</html>
