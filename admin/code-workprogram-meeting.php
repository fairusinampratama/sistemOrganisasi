<?php
include('../admin/authentication.php');

if (isset($_POST['delete_workprogram-meeting'])) {
    $id_meeting = $_POST['delete_workprogram-meeting'];

    $query = "DELETE FROM tb_rapat WHERE no_rapat='$id_meeting'";
    $queryFKAttendance = "DELETE FROM tb_kehadiran WHERE id_rapat='$id_meeting'";

    try {
        $queryFKAttendance_run = mysqli_query($con, $queryFKAttendance);
        $query_run = mysqli_query($con, $query);
        if ($queryFKAttendance_run && $query_run) {
            $_SESSION['message'] = "Meeting Deleted Successfully";
            header('location: view-workprogram-meeting.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-workprogram-meeting.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e->getMessage();
        header('location: view-workprogram-meeting.php');
        exit(0);
    }
}

if (isset($_POST['add_workprogram-meeting'])) {
    $id_program = $_POST['id_program'];
    $subject = $_POST['subject'];
    $formattedDate = $_POST['formatted_date'];

    $query = "INSERT INTO tb_rapat (no_proker, subjek, tgl_rapat) 
    VALUES ('$id_program', '$subject', '$formattedDate')";

    try {
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $id_meeting = mysqli_insert_id($con);
            uploadFile($id_meeting);
            $_SESSION['message'] = "Work Program added Successfully";
            header('location: view-workprogram-meeting.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-workprogram-meeting.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e->getMessage();
        header('location: view-workprogram-meeting.php');
        exit(0);
    }
}

if (isset($_POST['update_workprogram-meeting'])) {
    $id_meeting = $_POST['id_meeting'];
    $id_program = $_POST['id_program'];
    $subject = $_POST['subject'];
    $formattedDate = $_POST['formatted_date'];

    $query = "UPDATE tb_rapat SET no_proker='$id_program', subjek='$subject', tgl_rapat='$formattedDate'
    WHERE no_rapat='$id_meeting'";
    try {
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            uploadFile($id_meeting);
            $_SESSION['message'] = "Meeting updated Successfully";
            header('location: view-workprogram-meeting.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-workprogram-meeting.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e->getMessage();
        header('location: view-workprogram-meeting.php');
        exit(0);
    }
}

function uploadFile($id_meeting)
{
    global $con;

    $uploadDirectory = "C:/laragon/www/sistemOrganisasi/databases/work-program/";

    // Handle invitation file upload
    if (!empty($_FILES["invitation"]) && $_FILES["invitation"]["error"] == UPLOAD_ERR_OK) {
        $invitation = $_FILES['invitation'];
        $fileName = $invitation['name'];
        $fileSize = $invitation["size"];
        $fileType = $invitation["type"];

        if ($fileType !== 'application/pdf') {
            $_SESSION['message'] = "Invalid file type. Please upload a PDF file.";
            header('location: view-workprogram-meeting.php');
            exit(0);
        }

        $maxFileSize = 2 * 1024 * 1024;
        if ($fileSize > $maxFileSize) {
            $_SESSION['message'] = "File size exceeds the maximum limit of 2MB.";
            header('location: view-workprogram-meeting.php');
            exit(0);
        }

        $timestamp = time();
        $randomNumber = rand(1000, 9999);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqueFilename = $timestamp . '_' . $randomNumber . '.' . $fileExtension;

        $uploadPath = $uploadDirectory . "invitation/" . $uniqueFilename;

        try {
            if (move_uploaded_file($invitation["tmp_name"], $uploadPath)) {
                $updateQuery = "UPDATE tb_rapat SET undangan='$uploadPath' WHERE no_rapat = $id_meeting";
                mysqli_query($con, $updateQuery);
                $_SESSION['message'] = "Invitation file uploaded and record updated successfully.";
            } else {
                $_SESSION['message'] = "Failed to upload invitation file.";
            }
        } catch (mysqli_sql_exception $e) {
            $_SESSION['message'] = $e->getMessage();
        }
    }

    // Handle reports file upload
    if (!empty($_FILES["reports"]) && $_FILES["reports"]["error"] == UPLOAD_ERR_OK) {
        $reports = $_FILES['reports'];
        $fileName = $reports['name'];
        $fileSize = $reports["size"];
        $fileType = $reports["type"];

        if ($fileType !== 'application/pdf') {
            $_SESSION['message'] = "Invalid file type. Please upload a PDF file.";
            header('location: view-workprogram-meeting.php');
            exit(0);
        }

        $maxFileSize = 2 * 1024 * 1024;
        if ($fileSize > $maxFileSize) {
            $_SESSION['message'] = "File size exceeds the maximum limit of 2MB.";
            header('location: view-workprogram-meeting.php');
            exit(0);
        }

        $timestamp = time();
        $randomNumber = rand(1000, 9999);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqueFilename = $timestamp . '_' . $randomNumber . '.' . $fileExtension;

        $uploadPath = $uploadDirectory . "reports/" . $uniqueFilename;

        try {
            if (move_uploaded_file($reports["tmp_name"], $uploadPath)) {
                $updateQuery = "UPDATE tb_rapat SET laporan='$uploadPath' WHERE no_rapat = $id_meeting";
                mysqli_query($con, $updateQuery);
                $_SESSION['message'] = "Reports file uploaded and record updated successfully.";
            } else {
                $_SESSION['message'] = "Failed to upload reports file.";
            }
        } catch (mysqli_sql_exception $e) {
            $_SESSION['message'] = $e->getMessage();
        }
    }

    header('location: view-workprogram-meeting.php');
    exit(0);
}

?>
