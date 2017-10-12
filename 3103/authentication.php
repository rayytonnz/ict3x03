<?php

/** This file does the session managment and misc functions* */
session_start();
include "constant.php";

function session_admin_role_check() {
    if ($_SESSION['role'] == CASHIER) {
        //ok
    } else {
//        header("Location:../Error/unauthorizedPage.php");
        echo '<script language="javascript">';
        echo 'alert("Unauthorised Access!")';
        echo '</script>';
    }
}

function session_trainer_role_check() {
    if ($_SESSION['role'] == CUSTOMER) {
        //ok
    } else {
//        header("Location:../Error/unauthorizedPage.php");
        echo '<script language="javascript">';
        echo 'alert("Unauthorised Access!")';
        echo '</script>';
    }
}

function check_password($cPass, $pass) {
    if ($cPass == $pass) {
        return TRUE;
    }
    return False;
}

function CheckPassword() {
    if (preg_match('/[^A-Za-z0-9]+/', $password) && strlen($password) > 8) {
        return TRUE;
    }
    return FALSE;
}

function noHTML($str) {
    $str = trim($str);
    $str = htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    return $str;
}

?>
