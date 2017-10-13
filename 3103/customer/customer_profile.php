<?php
include "../config.php";
include"../authentication.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$getID = $_SESSION['userID'];
//echo $getID;

$getRole = $_SESSION['userRole'];
$getID = $_SESSION['userID'];

$query = "SELECT * FROM customers where custID = $getID";

$result = mysqli_query($db, $query);
mysqli_close($db);
?>

<html>
    <head>
        <title>View User Calendar List</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <link rel="stylesheet" type="text/css" href="../css/table.css">
        <link rel="stylesheet" href="../css/navigation.css" type="text/css"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="topnav">
            <a href="customer_home.php">Home</a> 
            <a id="right" href="../doLogout.php" class="btn-logout">Logout</a>
            <a  class="active" id="right"href="customer_profile.php">Profile</a>
        </div>

    
            <div style="padding:60px;">
                <h2 class="text-center white">Profile</h2><br>
                <table class="table" border="1">
                    <tr class="tableheader">
                        <th class="th">MOBILE</th>    
                        <th class="th">EMAIL</th>
                        <th class="th">NAME</th>
                        <th class="th">PASSWORD</th>
                       
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>\n";
                        echo "  <td  class='td'>" . $row['custMobile'] . "  </td>" . "\n";
                        echo "  <td  class='td'>" . $row['custEmail'] . "  </td>" . "\n";
                        echo "  <td  class='td'>" . $row['custName'] . "  </td>" . "\n";
                        echo "  <td  class='td'>" . "<form method='post' action='../ForgetPassword/confirmPasswordResetPage.php'> <input class='button' type='submit' name='reset-submit' tabindex='4' class='form-control btn btn-blue' value='Reset Password'>". "</td>" . "\n";

                    }
                    ?>

                </table>

            </div>
    
    </body>

</html>

