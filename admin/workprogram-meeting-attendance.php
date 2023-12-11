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
            <li class="breadcrumb-item">Attendance</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php'); ?>
                <div class="card">

                    <div class="card-header">
                        <h4>Attendance of
                            <?= $_GET['no']; ?>th
                            Meeting
                            <a href="view-workprogram-meeting.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code-workprogram-meeting-attendance.php" method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Full Name</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM tb_anggota";
                                    $query_run = mysqli_query($con, $query);

                                    if (isset($_GET['no'])) {
                                        $meeting_id = $_GET['no'];
                                        if (mysqli_num_rows($query_run) > 0) {
                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                                $id_anggota = $row['id_anggota'];
                                                $attendanceQuery = "SELECT * FROM tb_kehadiran WHERE id_anggota = '$id_anggota' AND id_rapat = '$meeting_id'";
                                                $attendanceResult = mysqli_query($con, $attendanceQuery);
                                                $attendanceRow = mysqli_fetch_assoc($attendanceResult);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $row['id_anggota']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row['namalengkap']; ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="attendance_status<?= $id_anggota; ?>"
                                                                name="attendance_status[<?= $id_anggota; ?>]" value="1" <?php if ($attendanceRow)
                                                                      echo "checked"; ?>>
                                                            <input type="hidden" name="member_id[<?= $id_anggota; ?>]"
                                                                value="<?= $id_anggota; ?>">
                                                            <input type="hidden" name="meeting_id" value="<?= $meeting_id; ?>">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="3">No record found</td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="text-end">
                                <button type="submit" name="process-attendance" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>