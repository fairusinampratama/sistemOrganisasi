<?php
include('../admin/authentication.php');

if (isset($_POST['delete_loan-logistics'])) {
    $loan_id = $_POST['delete_loan-logistics'];
    $id_logistics = $_POST['logistics_id'];
    $qty = $_POST['qty'];

    $query = "DELETE FROM tb_peminjaman WHERE no_peminjaman='$loan_id'";
    $queryQtyPrev = "SELECT jumlah_barang FROM tb_barang WHERE no_barang = '$id_logistics'";
    $queryQtyPrev_run = mysqli_query($con, $queryQtyPrev);
    try {
        if ($queryQtyPrev_run && mysqli_num_rows($queryQtyPrev_run) > 0) {
            $row = mysqli_fetch_assoc($queryQtyPrev_run);
            $quantityTrigger = $row['jumlah_barang'] + $qty;
            $triggerQuery = "UPDATE tb_barang SET jumlah_barang='$quantityTrigger' WHERE no_barang='$id_logistics'";

            $query_run = mysqli_query($con, $query);
            $triggerQuery_run = mysqli_query($con, $triggerQuery);
            if ($query_run && $triggerQuery_run) {
                $_SESSION['message'] = "Loan Deleted Successfully";
                header('location: view-logistics-loan.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Something Went Wrong";
                header('location: view-logistics-loan.php');
                exit(0);
            }
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e;
        header('location: view-logistics-loan.php');
        exit(0);
    }
}

if (isset($_POST['add_loan-logistics'])) {
    $category_logistics = $_POST['category_logistics'];
    $name_logistics = $_POST['name_logistics'];
    $qty = $_POST['qty'];
    $identity = $_POST['identity'];
    $institution = $_POST['institution'];

    try {
        $query = "SELECT no_barang, jumlah_barang FROM tb_barang WHERE kategori_barang = '$category_logistics' AND nama_barang = '$name_logistics'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id_logistics = $row['no_barang'];
            $prevQuantity = $row['jumlah_barang'];

            $insertQuery = "INSERT INTO tb_peminjaman (no_barang, jumlah_peminjaman, identitas, institusi) VALUES ('$id_logistics', '$qty', '$identity', '$institution')";
            $quantityTrigger = $prevQuantity - $qty;

            $triggerQuery = "UPDATE tb_barang SET jumlah_barang='$quantityTrigger' WHERE no_barang='$id_logistics'";

            $query_run = mysqli_query($con, $insertQuery);
            $triggerQuery_run = mysqli_query($con, $triggerQuery);
            if ($query_run && $triggerQuery_run) {
                $id_query = "SELECT LAST_INSERT_ID()";
                $result = mysqli_query($con, $id_query);
                $row = mysqli_fetch_assoc($result);
                $id_loan = $row['LAST_INSERT_ID()'];
                uploadFile($id_loan, $con);
                $_SESSION['message'] = "Loan added Successfully";
                header('location: view-logistics-loan.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Something Went Wrong";
                header('location: view-logistics-loan.php');
                exit(0);
            }

        } else {
            $_SESSION['message'] = "Invalid kategori_barang or nama_barang";
            header('location: view-logistics-loan.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e;
        header('location: view-logistics-loan.php');
        exit(0);
    }
}



if (isset($_POST['update_loan-logistics'])) {
    $id_loan = $_POST['id_loan'];
    $qty = $_POST['qty'];
    $identity = $_POST['identity'];
    $institution = $_POST['institution'];

    // Retrieve previous loan details
    $prevLoanQuery = "SELECT no_barang, jumlah_peminjaman FROM tb_peminjaman WHERE no_peminjaman='$id_loan'";
    $prevLoanResult = mysqli_query($con, $prevLoanQuery);

    if ($prevLoanResult && mysqli_num_rows($prevLoanResult) > 0) {
        $prevLoanData = mysqli_fetch_assoc($prevLoanResult);
        $prevQuantity = $prevLoanData['jumlah_peminjaman'];
        $id_logistics = $prevLoanData['no_barang'];

        // Retrieve current quantity from tb_barang
        $currentQuantityQuery = "SELECT jumlah_barang FROM tb_barang WHERE no_barang='$id_logistics'";
        $currentQuantityResult = mysqli_query($con, $currentQuantityQuery);

        if ($currentQuantityResult && mysqli_num_rows($currentQuantityResult) > 0) {
            $currentQuantityData = mysqli_fetch_assoc($currentQuantityResult);
            $currentQuantity = $currentQuantityData['jumlah_barang'];

            // Adjust current quantity
            $quantityDifference = $qty - $prevQuantity;
            $updatedQuantity = ($currentQuantity + $prevQuantity) - $qty;

            if ($updatedQuantity < 0) {
                $_SESSION['message'] = "Error! Loan exceeds the limit";
                header('location: view-logistics-loan.php');
                exit(0);
            }

            // Update tb_peminjaman with new loan details
            $updateLoanQuery = "UPDATE tb_peminjaman SET no_barang='$id_logistics', jumlah_peminjaman='$qty', identitas='$identity', institusi='$institution' WHERE no_peminjaman='$id_loan'";
            $updateLoanResult = mysqli_query($con, $updateLoanQuery);

            // Update tb_barang with adjusted quantity
            $updateQuantityQuery = "UPDATE tb_barang SET jumlah_barang='$updatedQuantity' WHERE no_barang='$id_logistics'";
            $updateQuantityResult = mysqli_query($con, $updateQuantityQuery);

            if ($updateLoanResult && $updateQuantityResult) {
                // Loan and quantity updated successfully
                
                $_SESSION['message'] = "Loan updated Successfully";
                header('location: view-logistics-loan.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Something Went Wrong";
                header('location: view-logistics-loan.php');
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Failed to retrieve current quantity";
            header('location: view-logistics-loan.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Failed to retrieve previous loan details";
        header('location: view-logistics-loan.php');
        exit(0);
    }
}


function uploadFile($id_loan, $con)
{
    if (isset($_FILES["receipt"]) && $_FILES["receipt"]["error"] == UPLOAD_ERR_OK) {
        $receipt = $_FILES['receipt'];
        $fileName = $receipt['name'];
        $fileSize = $receipt["size"];
        $fileType = $receipt["type"];

        if ($fileType !== 'application/pdf') {
            $_SESSION['message'] = "Invalid file type. Please upload a PDF file.";
            header('location: view-logistics-loan.php');
            exit(0);
        }

        $maxFileSize = 2 * 1024 * 1024;
        if ($fileSize > $maxFileSize) {
            $_SESSION['message'] = "File size exceeds the maximum limit of 2MB.";
            header('location: view-logistics-loan.php');
            exit(0);
        }

        $timestamp = time();
        $randomNumber = rand(1000, 9999);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqueFilename = $timestamp . '_' . $randomNumber . '.' . $fileExtension;

        $uploadDirectory = "C:/laragon/www/sistemOrganisasi/databases/logistics/loan-receipt/";
        $uploadPath = $uploadDirectory . $uniqueFilename;

        try {
            if (move_uploaded_file($receipt["tmp_name"], $uploadPath)) {
                $updateQuery = "UPDATE tb_peminjaman SET bukti='$uploadPath' WHERE no_peminjaman = $id_loan";
                if (mysqli_query($con, $updateQuery)) {
                    $_SESSION['message'] = "File uploaded successfully";
                } else {
                    $_SESSION['message'] = "Error updating the database. Please try again.";
                }
            } else {
                $_SESSION['message'] = "Error uploading the file. Please try again.";
            }
            header('location: view-logistics-loan.php');
            exit(0);
        } catch (mysqli_sql_exception $e) {
            $_SESSION['message'] = $e;
            header('location: view-logistics-loan.php');
            exit(0);
        }
    }
}
