<?php
include('authentication.php');

try {
    // Check if the form is submitted for inserting new suggestions
    if (isset($_POST['insertTotal'])) {
        $insertTotal = $_POST['insertTotal'];

        // Validate the input value
        if (is_numeric($insertTotal) && $insertTotal > 0) {
            $sql = "INSERT INTO tb_saran (pengirim_saran, subjek_saran, isi_saran) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sss", $sender, $subject, $content);

            // Insert multiple rows
            for ($i = 0; $i < $insertTotal; $i++) {
                $sender = "";
                $subject = "";
                $content = "";

                // Execute the statement
                mysqli_stmt_execute($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
            header('Location: suggestion-edit.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Invalid input. Please enter a valid number for the suggestions to insert.";
            header('Location: suggestion-edit.php');
            exit(0);
        }
    }

    // Check if the delete button is clicked
    if (isset($_POST['delete'])) {
        // Get the selected suggestion IDs to delete
        $selectedsuggestions = $_POST['checkboxes'];

        // Loop through the selected suggestions and delete them
        foreach ($selectedsuggestions as $suggestionId) {
            // Perform the delete operation using the suggestion ID
            $deleteQuery = "DELETE FROM tb_saran WHERE no_saran = '$suggestionId'";
            $deleteResult = mysqli_query($con, $deleteQuery);

            // Check if the deletion was successful
            if ($deleteResult) {
                // Deletion successful
                $_SESSION['message'] = "Suggestion with ID $suggestionId has been deleted successfully.";
            } else {
                // Deletion failed
                $_SESSION['message'] = "Error deleting suggestion with ID $suggestionId. Please try again.";
            }
        }
        header('Location: suggestion-edit.php');
        exit(0);
    }

    // Check if the update button is clicked
    if (isset($_POST['update'])) {
        // Get the values from the form inputs
        $suggestionIds = $_POST['id_suggestion'];
        $newSenders = $_POST['sender'];
        $newSubjects = $_POST['subject'];
        $newContents = $_POST['content'];

        // Loop through the suggestion IDs and perform the update operation for each suggestion
        foreach ($suggestionIds as $index => $suggestionId) {
            $newSender = $newSenders[$index];
            $newSubject = $newSubjects[$index];
            $newContent = $newContents[$index];

            // Perform the update operation using the suggestion ID
            $updateQuery = "UPDATE tb_saran SET pengirim_saran = '$newSender', subjek_saran = '$newSubject', isi_saran = '$newContent' WHERE no_saran = '$suggestionId'";
            $updateResult = mysqli_query($con, $updateQuery);

            // Check if the update was successful
            if ($updateResult) {
                // Update successful
                $_SESSION['message'] = "Suggestion with ID $suggestionId has been updated successfully.";
            } else {
                // Update failed
                $_SESSION['message'] = "Error updating suggestion with ID $suggestionId. Please try again.";
            }
        }
        header('Location: suggestion-edit.php');
        exit(0);
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['message'] = "Error: " . $e;
    header('Location: suggestion-edit.php');
}
?>