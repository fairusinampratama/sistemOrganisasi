<?php
include('authentication.php');

try {
    // Check if the form is submitted for inserting new agendas
    if (isset($_POST['insertTotal'])) {
        $insertTotal = $_POST['insertTotal'];

        // Validate the input value
        if (is_numeric($insertTotal) && $insertTotal > 0) {
            $sql = "INSERT INTO tb_agenda (tanggal, waktu, subjek, deskripsi) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ssss", $tanggal, $waktu, $subjek, $deskripsi);

            // Insert multiple rows
            for ($i = 0; $i < $insertTotal; $i++) {
                $tanggal = NULL;
                $waktu = NULL;
                $subjek = "";
                $deskripsi = "";

                // Execute the statement
                mysqli_stmt_execute($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
            header('Location: agenda-edit.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Invalid input. Please enter a valid number for the agendas to insert.";
            header('Location: agenda-edit.php');
            exit(0);
        }
    }

    // Check if the delete button is clicked
    if (isset($_POST['delete'])) {
        // Get the selected agenda IDs to delete
        $selectedAgendas = $_POST['checkboxes'];

        // Loop through the selected agendas and delete them
        foreach ($selectedAgendas as $agendaId) {
            // Perform the delete operation using the agenda ID
            $deleteQuery = "DELETE FROM tb_agenda WHERE id_agenda = '$agendaId'";
            $deleteResult = mysqli_query($con, $deleteQuery);

            // Check if the deletion was successful
            if ($deleteResult) {
                // Deletion successful
                $_SESSION['message'] = "Agenda with ID $agendaId has been deleted successfully.";
            } else {
                // Deletion failed
                $_SESSION['message'] = "Error deleting agenda with ID $agendaId. Please try again.";
            }
        }
        header('Location: agenda-edit.php');
        exit(0);
    }

    // Check if the update button is clicked
    if (isset($_POST['update'])) {
        // Get the values from the form inputs
        $agendaIds = $_POST['id_agenda'];
        $newDates = $_POST['tanggal'];
        $newTimes = $_POST['jam'];
        $newSubjects = $_POST['subjek'];
        $newDescriptions = $_POST['deskripsi'];

        // Loop through the agenda IDs and perform the update operation for each agenda
        foreach ($agendaIds as $index => $agendaId) {
            $newDate = $newDates[$index];
            $newTime = $newTimes[$index];
            $newSubject = $newSubjects[$index];
            $newDescription = $newDescriptions[$index];

            // Perform the update operation using the agenda ID
            $updateQuery = "UPDATE tb_agenda SET tanggal = '$newDate', waktu = '$newTime', subjek = '$newSubject', deskripsi = '$newDescription' WHERE id_agenda = '$agendaId'";
            $updateResult = mysqli_query($con, $updateQuery);

            // Check if the update was successful
            if ($updateResult) {
                // Update successful
                $_SESSION['message'] = "Agenda with ID $agendaId has been updated successfully.";
            } else {
                // Update failed
                $_SESSION['message'] = "Error updating agenda with ID $agendaId. Please try again.";
            }
        }
        header('Location: agenda-edit.php');
        exit(0);
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['message'] = "Error: " . $e;
    header('Location: agenda-edit.php');
}
?>