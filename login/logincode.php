<?php
session_start();
include('../admin/config/dbcon.php');
if (isset($_POST['login_btn'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM tb_anggota WHERE username = '$username' AND password = '$password' LIMIT 1";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
        foreach ($login_query_run as $data) {
            $id_anggota = $data['id_anggota'];
            $fullname = $data['namalengkap'];
            $username = $data['username'];
            $password = $data['password'];
            $level = $data['level'];
        }
        $_SESSION['auth'] = true;
        $_SESSION['auth_role'] = "$level";
        $_SESSION['auth_user'] = [
            'id_anggota' => $id_anggota,
            'namalengkap' => $fullname,
            'username' => $username,
            'password' => $password,
        ];

        switch ($_SESSION['auth_role']) {
            case 'admin':
                $_SESSION['message'] = "Welcome to the dashboard, Admin!";
                header("location: ../admin/index.php");
                exit(0);
            case 'anggota':
                $_SESSION['message'] = "Welcome to the dashboard, Anggota!";
                header("location: ../user/index.php");
                exit(0);
        }
    } else {
        $_SESSION['message'] = "Invalid username or password";
        header("location: login.php");
        exit(0);
    }
} else {
    $_SESSION['message'] = "You are unable to access";
    header("location: login.php");
    exit(0);
}