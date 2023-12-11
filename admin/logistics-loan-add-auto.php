<?php
include('authentication.php');

if (!empty($_POST["category_logistics"])) {
    // Fetch logistics names based on the selected category
    $categoryLogistics = $_POST['category_logistics'];
    $query = "SELECT * FROM tb_barang WHERE kategori_barang = '$categoryLogistics'";
    $result = mysqli_query($con, $query);

    // Generate HTML for logistics name options
    if (mysqli_num_rows($result) > 0) {
        echo '<option value="">Select logistics name</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['nama_barang'] . '">' . $row['nama_barang'] . '</option>';
        }
    } else {
        echo '<option value="">Logistics name is not available</option>';
    }
}
?>