<?php
include('authentication.php');
include('includes/header.php');

?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Main Work</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Logistics</li>
            <li class="breadcrumb-item">List</li>
        </ol>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Logistic</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['no'])) {
                            $no_barang = $_GET['no'];
                            $users = "SELECT * FROM tb_barang WHERE no_barang='$no_barang'";
                            $users_run = mysqli_query($con, $users);

                            if (mysqli_num_rows($users_run) > 0) {
                                while ($user = mysqli_fetch_assoc($users_run)) {
                                    ?>
                                    <form action="code-logistics-list.php" method="post">
                                        <input type="hidden" name="no_barang" value="<?= $user['no_barang']; ?>">
                                        <div class="col-md-6 mb-3">
                                            <label for="category">Category</label>
                                            <input type="text" name="category" value=<?=$user['kategori_barang'];?> class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" value=<?=$user['nama_barang'];?> class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="qty">Quantity</label>
                                            <input type="number" min="0"  name="qty" value=<?=$user['jumlah_barang'];?> class="form-control">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <button type="submit" name="update_list-logistics" class="btn btn-primary">Update</button>
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