<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Main Work</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item">Logistics</li>
            <li class="breadcrumb-item">Loan</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Loan
                            <a href="logistics-loan-add.php" class="btn btn-primary float-end">Add Loan</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Logistics Name</th>
                                    <th>Quantity</th>
                                    <th>Identity</th>
                                    <th>Institution</th>
                                    <th>Receipt</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tb_peminjaman";
                                $query_run = mysqli_query($con, $query);
                                $no=1;

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td><?= $no++?>
                                            </td>
                                            <td>
                                            <?php
                                                $id_barang = $row['no_barang'];
                                                $queryName = "SELECT nama_barang FROM tb_barang WHERE no_barang='$id_barang'";
                                                $query_run2 = mysqli_query($con, $queryName);
                                                if (mysqli_num_rows($query_run2) > 0) {
                                                    $row2 = mysqli_fetch_assoc($query_run2);
                                                    echo $row2['nama_barang'];
                                                } else {
                                                    echo "Item not found";
                                                }
                                            ?>
                                            </td>
                                            <td><?= $row['jumlah_peminjaman']; ?>
                                            </td>
                                            <td><?= $row['identitas']; ?>
                                            </td>
                                            <td><?= $row['institusi']; ?>
                                            </td>
                                            <td><a href="logistics-loan-download.php?no=<?= $row['no_peminjaman']; ?>" 
                                            class="btn btn-warning"><i class="bi bi-download"></i></a>
                                            </td>
                                            <td><a href="logistics-loan-edit.php?no=<?= $row['no_peminjaman']; ?>"
                                                    class="btn btn-success">Edit</a></td>
                                            <td>
                                                <form action="code-logistics-loan.php" method="post">
                                                    <input type="hidden" name="logistics_id" value="<?=$id_barang?>">
                                                    <input type="hidden" name="qty" value="<?=$row['jumlah_peminjaman']?>">
                                                    <button type="submit" name="delete_loan-logistics" value="<?= $row['no_peminjaman'] ?>"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="8">No record found</td>
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