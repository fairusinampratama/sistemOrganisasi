<?php
include('authentication.php');

if (isset($_POST['update_member'])) {
    $id_anggota = $_POST['id_anggota'];
    $fullname = $_POST['fullname'];
    $birth = $_POST['birth'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $query = "UPDATE tb_anggota SET namalengkap='$fullname', ttl='$birth', alamat='$address', status='$status', email='$email', username='$username', password='$password', level='$level' 
    WHERE id_anggota='$id_anggota'";

    try {
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Profile updated Successfully";
            header('location: view-member.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-member.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e;
        header('location: view-member.php');
        exit(0);
    }
}
?>