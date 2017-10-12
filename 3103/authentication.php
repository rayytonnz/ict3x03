<?php

/** This file does the session management and misc functions* */
session_start();
include "constant.php";

function session_cashier_role_check() {
    if ($_SESSION['userRole'] == CASHIER) {
        //ok
        
    } else {
        header("Location:../Error/unauthorizedPage.php");
    }
}

function session_customer_role_check() {
    if ($_SESSION['userRole'] == CUSTOMER) {
        //ok
    } else {
        header("Location:../Error/unauthorizedPage.php");
    }
}

function session_admin_role_check() {
    if ($_SESSION['userRole'] == ADMIN) {
        //ok
    } else {
        header("Location:../Error/unauthorizedPage.php");
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
