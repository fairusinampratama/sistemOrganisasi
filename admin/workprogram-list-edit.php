<?php
include('authentication.php');
include('includes/header.php');

?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Main Work</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Work Program</li>
            <li class="breadcrumb-item">List</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Work Program</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['no'])) {
                            $no_workprogram = $_GET['no'];
                            $users = "SELECT * FROM tb_proker WHERE no_proker='$no_workprogram'";
                            $users_run = mysqli_query($con, $users);

                            if (mysqli_num_rows($users_run) > 0) {
                                foreach ($users_run as $user) {
                                    ?>
                                    <form action="code-workprogram-list.php" method="post">
                                        <input type="hidden" name="no_proker" value="<?=$user['no_proker'];?>">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" value="<?=$user['nama_proker'];?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" rows="4"><?= $user['deskripsi']; ?></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="target">Target</label>
                                            <textarea name="target" class="form-control" rows="4"><?= $user['target']; ?></textarea>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <button type="submit" name="update_workprogram-list" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                    <?php
                                }
                            } else {
                                ?>
                                <h4>No Record Found</h4>
                                <?php
                            }
                        }
                            ?>
                    </div>
                </div>
            </div>

        </div>
</div>


<?php
include('includes/footer.php');
include('includes/scripts.php');
?>