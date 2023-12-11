<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Main Work</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Logistics</li>
            <li class="breadcrumb-item">Loan</li>
        </ol>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Loan</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['no'])) {
                            $no_peminjaman = $_GET['no'];
                            $users = "SELECT * FROM tb_peminjaman WHERE no_peminjaman='$no_peminjaman'";
                            $users_run = mysqli_query($con, $users);

                            if (mysqli_num_rows($users_run) > 0) {
                                foreach ($users_run as $user) {
                                    ?>
                                    <form action="code-logistics-loan.php" method="post" enctype="multipart/form-data">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Logistics Name</label>
                                            <input type="text" id="name" name="name" value="<?php
                                            $id_logistics = $user['no_barang'];
                                            $query = "SELECT nama_barang FROM tb_barang WHERE no_barang ='$id_logistics'";
                                            $result = mysqli_query($con, $query);
                                            if ($result && mysqli_num_rows($result) > 0) {
                                                $row = mysqli_fetch_assoc($result);
                                                echo $row['nama_barang'];
                                            }
                                            ?>" class="form-control" disabled>
                                        </div>
                                        <input type="hidden" name="id_loan" value="<?= $user['no_peminjaman']; ?>">
                                        <div class="col-md-6 mb-3">
                                            <label for="qty">Quantity</label>
                                            <input type="number" min="0" id="qty" name="qty"
                                                value="<?= $user['jumlah_peminjaman']; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="identity">Identity</label>
                                            <input type="text" id="identity" name="identity" value="<?= $user['identitas']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="institution">Institution</label>
                                            <input type="text" id="institution" name="institution"
                                                value="<?= $user['institusi']; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <button type="submit" name="update_loan-logistics" class="btn btn-primary">Edit
                                                Loan</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>