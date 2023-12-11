<?php
session_start();
include('config/dbcon.php');

if(!isset($_SESSION['auth'])) {
    $_SESSION['message'] = "Login to access Dashboard";
    header("location: ../login/login.php");
    exit(0);
} else {
    if($_SESSION['auth_role'] != "anggota") {
        $_SESSION['message'] = "You are not authorized as anggota";
        header("location: ../login/login.php");
        exit(0);
    }
}
?>