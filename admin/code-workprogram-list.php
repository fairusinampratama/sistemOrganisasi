<?php
include('../admin/authentication.php');

if (isset($_POST['delete_workprogram-list'])) {
    $no_proker = $_POST['delete_workprogram-list'];

    $query = "DELETE FROM tb_proker WHERE no_proker='$no_proker'";
    
    try {
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Work program deleted Succesfully";
            header('location: view-workprogram-list.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-workprogram-list.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e;
        header('location: view-workprogram-list.php');
        exit(0);
    }
}

if (isset($_POST['add_workprogram-list'])) {
    $no_proker = $_POST['no_proker'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $target = $_POST['target'];

    $query = "INSERT INTO tb_proker (nama_proker, deskripsi, target) 
    VALUES ('$name', '$description', '$target')";

    try {
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Work program added Successfully";
            header('location: view-workprogram-list.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-workprogram-list.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e;
        header('location: view-workprogram-list.php');
        exit(0);
    }
}

if (isset($_POST['update_workprogram-list'])) {
    $no_proker = $_POST['no_proker'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $target = $_POST['target'];

    $query = "UPDATE tb_proker SET nama_proker='$name', deskripsi='$description', target='$target' 
    WHERE no_proker='$no_proker'";
    $query_run = mysqli_query($con, $query);

    try {
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Work program updated Successfully";
            header('location: view-workprogram-list.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-workprogram-list.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e;
        header('location: view-workprogram-list.php');
        exit(0);
    }
}
?>