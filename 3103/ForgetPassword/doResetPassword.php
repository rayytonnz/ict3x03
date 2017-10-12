<?php


include "../config.php";
include "../authentication.php";

$userEmail = $_SESSION['userEmail'];
$getUserId = $_SESSION['userID'];
echo $getUserId;



if (isset($_POST['resetPassword'])) {
    $getUserEmail = $_POST['userEmail'];
    $newPassword = $_POST['inputNew'];
    $confirmPassword = $_POST['inputConfirm'];

    $queryData = "SELECT * 
                FROM users 
                WHERE userID = '" . $getUserId . "'";
    $getResult = mysqli_query($db, $queryData);

//    validate password. If both passwords entered are the same and alphanumeric 8 charac checking.
    if (mysqli_num_rows($getResult) == 1) {
        if (check_password($confirmPassword, $newPassword) && CheckPassword()){
            $queryUpdate = "UPDATE users 
                            SET userPassword = '$confirmPassword' 
                            WHERE userID = '" . $getUserId . "'";
            $updateDB = mysqli_query($db, $queryUpdate);

            header("Location: ../index.php");
            $_SESSION['ok'] = "Password reset!";
        } else { // mismatched
            header("Location: confirmPasswordResetPage.php?id=$getUserId");
            $_SESSION['err'] = "Password not the same!";
        }
    }
}
?>

