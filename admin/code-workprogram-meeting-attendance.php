<?php
include('authentication.php');

if (isset($_POST['process-attendance'])) {
    $meeting_id = $_POST['meeting_id'];
    $member_ids = $_POST['member_id'];

    // Delete existing attendance records for the meeting
    $delete_query = "DELETE FROM tb_kehadiran WHERE id_rapat = '$meeting_id'";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {
        // Loop through each member ID and attendance status
        foreach ($member_ids as $index => $member_id) {
            // Only insert records for members who attended
            if (isset($_POST['attendance_status'][$member_id])) {
                // Get the reason for attendance
                $reason = $_POST['reason'][$member_id];

                // Insert a new attendance record
                $insert_query = "INSERT INTO tb_kehadiran (id_anggota, id_rapat) VALUES ('$member_id', '$meeting_id')";
                $insert_result = mysqli_query($con, $insert_query);

                if ($insert_result) {
                    $_SESSION['message'] = "Attendance added successfully";
                } else {
                    $_SESSION['message'] = "Failed to add attendance";
                }
            }
        }

        $_SESSION['message'] = "Attendance records updated successfully";
    } else {
        $_SESSION['message'] = "Failed to update attendance records";
    }

    // Redirect after processing attendance
    header('location: workprogram-meeting-attendance.php?no=' . $meeting_id);
    exit();
}
?>
