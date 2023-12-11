<?php
include('authentication.php');
include('includes/header.php');

?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Extension</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Agenda</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Agenda</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Subject</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tb_agenda";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $tanggal = $row['tanggal'];
                                                if ($tanggal === NULL) {
                                                    echo "NULL"; // Assign NULL or a default value as per your requirements
                                                } else {
                                                    $date = new DateTime($tanggal);
                                                    $formattedDate = $date->format('l, d F Y');
                                                    echo $formattedDate;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $waktu = $row['waktu'];
                                                if ($waktu === NULL) {
                                                    echo "NULL";
                                                } else {
                                                    $time = DateTime::createFromFormat('H:i:s', $waktu);
                                                    $formattedTime = $time->format('H:i');
                                                    echo $formattedTime;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?= $row['subjek']; ?>
                                            </td>
                                            <td>
                                                <?= $row['deskripsi']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6">No record found</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
</div>


<?php
include('includes/footer.php');
include('includes/scripts.php');
?>