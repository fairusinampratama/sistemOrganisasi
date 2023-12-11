<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Main Work</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item">Work Program</li>
            <li class="breadcrumb-item">Meeting</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Meeting
                            <a href="workprogram-meeting-add.php" class="btn btn-primary float-end">Add Work Program</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Program</th>
                                    <th>Meet Subject</th>
                                    <th>Meeting Date</th>
                                    <th>Invitation</th>
                                    <th>Reports</th>
                                    <th>Attendance</th>
                                    <th>Edit</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tb_rapat ORDER BY no_proker";
                                $query_run = mysqli_query($con, $query);
                                $no=1;

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td><?= $no++?>
                                            </td>
                                            </td>
                                            <td>                                            
                                                <?php
                                                    $no_proker = $row['no_proker'];
                                                    $queryName = "SELECT nama_proker FROM tb_proker WHERE no_proker='$no_proker'";
                                                    $query_run2 = mysqli_query($con, $queryName);
                                                    if (mysqli_num_rows($query_run2) > 0) {
                                                        $row2 = mysqli_fetch_assoc($query_run2);
                                                        echo $row2['nama_proker'];
                                                    } else {
                                                        echo "Item not found";
                                                    }
                                                ?>
                                            </td>
                                            <td><?= $row['subjek']; ?>
                                            </td>
                                            <td><?= $row['tgl_rapat']; ?>
                                            </td>
                                            <td><a href="workprogram-meeting-download-invitation.php?no=<?= $row['no_rapat']; ?>" 
                                            class="btn btn-warning"><i class="bi bi-download"></i></a>
                                            </td>
                                            <td><a href="workprogram-meeting-download-reports.php?no=<?= $row['no_rapat']; ?>" 
                                            class="btn btn-warning"><i class="bi bi-download"></i></a>
                                            </td>
                                            <td><a href="workprogram-meeting-attendance.php?no=<?= $row['no_rapat']; ?>" 
                                            class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                            </td>
                                            <td><a href="workprogram-meeting-edit.php?no=<?= $row['no_rapat']; ?>"
                                                    class="btn btn-success">Edit</a></td>
                                            <td>
                                                <form action="code-workprogram-meeting.php" method="post">
                                                    <button type="submit" name="delete_workprogram-meeting" value="<?= $row['no_rapat']; ?>"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="10">No record found</td>
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
?>s