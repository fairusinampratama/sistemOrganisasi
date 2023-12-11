<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Extension</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Agenda</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Agenda
                    <a href="view-agenda.php" class="btn btn-warning float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="col-md-4">
                        <form action="code-agenda.php" method="post">
                            <div class="input-group mb-3">
                                <input type="text" name="insertTotal" class="form-control"
                                    placeholder="Enter the number of agendas to insert">
                                <button type="submit" class="btn btn-success">Insert</button>
                            </div>
                        </form>
                    </div>
                    <form action="code-agenda.php" method="post">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Check</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tb_agenda";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="date" name="tanggal[]" value="<?= $row['tanggal']; ?>"
                                                    class="form-control">
                                                <input type="hidden" name="id_agenda[]" value="<?= $row['id_agenda']; ?>">
                                            </td>
                                            <td>
                                                <input type="time" name="jam[]" value="<?= $row['waktu']; ?>"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="subjek[]" value="<?= $row['subjek']; ?>"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="deskripsi[]" value="<?= $row['deskripsi']; ?>"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkbox<?= $row['id_agenda']; ?>" name="checkboxes[]"
                                                        value="<?= $row['id_agenda']; ?>">
                                                </div>
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
                            </tbody>
                        </table>
                        <div class="text-end">
                            <button type="submit" name="update" class="btn btn-primary me-2">Save</button>
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
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
