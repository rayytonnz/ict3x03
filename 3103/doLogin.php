<?php
session_start();

/** This file does the login function* */
include ("config.php");
include ("constant.php");

$username = $_POST['username'];
$password = $_POST['password'];

$match_query = "SELECT * FROM users WHERE userEmail='" . $username. "' AND userPassword='" . $password. "'";


$result = mysqli_query($db, $match_query);
$resultrow = mysqli_num_rows($result);
//echo $match_query;
//echo $resultrow;
// User credential pass
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    session_login_save( $row['userRole'], $row['userEmail'],$row['userID']);
    echo session_login_save($row['userRole'],$row['userEmail'], $row['userID']);

    if ($row['userRole'] == CASHIER) {
        header("Location: cashier/cashier_home.php");
        exit();

    } 
    if ($row['userRole'] == CUSTOMER) {
        header("Location: customer/customer_home.php");
        exit();

    } if ($row['userRole'] == ADMIN) {
        header("Location: admin/admin_home.php");
        exit();

    } 
    
}
else {
    $_SESSION['err'] = "Wrong credentials, Please try again.";
    echo "<script>";
    echo "alert('Wrong Credentials')";
    echo "</script>";
    header("Location: index.php");
    exit();
}

 

function session_login_save($sessionSystemRoles, $sessionEmail,  $sessionID) {
    $_SESSION['userRole'] = $sessionSystemRoles;
    $_SESSION['userEmail'] = $sessionEmail;
    $_SESSION['userID'] = $sessionID;
}

?>