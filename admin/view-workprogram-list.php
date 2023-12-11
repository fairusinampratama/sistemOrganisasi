<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Main Work</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item">Work Program</li>
            <li class="breadcrumb-item">List</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>List of Work Program
                            <a href="workprogram-list-add.php" class="btn btn-primary float-end">Add Work Program</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Target</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tb_proker";
                                $query_run = mysqli_query($con, $query);
                                $no=1;

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?>
                                            </td>
                                            <td><?= $row['nama_proker']; ?>
                                            </td>
                                            <td><?= $row['deskripsi']; ?>
                                            </td>
                                            <td><?= $row['target']; ?>
                                            </td>
                                            <td><a href="workprogram-list-edit.php?no=<?= $row['no_proker']; ?>"
                                                    class="btn btn-success">Edit</a></td>
                                            <td>
                                                <form action="code-workprogram-list.php" method="post">
                                                    <button type="submit" name="delete_workprogram-list" value="<?= $row['no_proker']; ?>"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
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
?>s