<?php
include('authentication.php');

// Retrieve the loan ID from the query parameter
if (isset($_GET['no'])) {
    $meetingID = $_GET['no'];

    // Fetch the file path from the database based on the loan ID
    $query = "SELECT laporan FROM tb_rapat WHERE no_rapat = '$meetingID'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $filePath = $row['laporan'];

        // Validate the file path
        if (file_exists($filePath)) {
            // Set the appropriate headers for file download
            header("Content-Type: application/pdf");
            header("Content-Disposition: attachment; filename=" . basename($filePath));
            header("Content-Length: " . filesize($filePath));

            // Clear output buffer
            ob_clean();
            flush();

            // Read the file and output its contents to the browser
            readfile($filePath);
            exit();
        } else {
            $_SESSION['message'] = "File not found.";
        }
    } else {
        $_SESSION['message'] = "Meeting not found.";
    }
} else {
    $_SESSION['message'] = "Invalid request.";
}

// Redirect back to the loan view page
header('location: view-workprogram-meeting.php');
exit(0);
?>
