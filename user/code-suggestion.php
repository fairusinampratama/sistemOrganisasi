<?php
include('authentication.php');

if (isset($_POST['add_suggestion'])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    $query = "INSERT INTO tb_saran (pengirim_saran, subjek_saran, isi_saran) VALUES ('$name', '$subject', '$content')";

    try {
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            $_SESSION['message'] = "Sended succesfully! Thank you for your suggestion. '$content'";
            header('location: view-suggestion.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Something Went Wrong";
            header('location: view-suggestion.php');
            exit(0);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['message'] = $e;
        header('location: view-suggestion.php');
        exit(0);
    }
}
?>