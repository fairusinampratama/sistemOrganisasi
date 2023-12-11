<?php
include('../admin/authentication.php');

if (isset($_POST['delete_list-logistics'])) {
    $no_barang = $_POST['delete_list-logistics'];

    $query = "DELETE FROM tb_barang WHERE no_barang='$no_barang'";

    try {
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Logistics Deleted Successfully";
            header('location: view-logistics-list.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-logistics-list.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e;
        header('location: view-logistics-list.php');
        exit(0);
    }
}

if (isset($_POST['add_list-logistics'])) {
    $no_barang = $_POST['no_barang'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $qty = $_POST['qty'];

    $query = "INSERT INTO tb_barang (kategori_barang, nama_barang, jumlah_barang) 
    VALUES ('$category', '$name', '$qty')";

    try {
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Logistics added Successfully";
            header('location: view-logistics-list.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-logistics-list.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e;
        header('location: view-logistics-list.php');
        exit(0);
    }
}

if (isset($_POST['update_list-logistics'])) {
    $no_barang = $_POST['no_barang'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];

    $query = "UPDATE tb_barang SET kategori_barang='$category', nama_barang='$name', jumlah_barang='$qty' 
    WHERE no_barang='$no_barang'";

    try {
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Logistics updated Successfully";
            header('location: view-logistics-list.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-logistics-list.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e;
        header('location: view-logistics-list.php');
        exit(0);
    }
}
?>