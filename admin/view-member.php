<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Members</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item">List of Members</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php');?>
                <div class="card">
                    <div class="card-header">
                        <h4>List of Member
                            <a href="member-add.php" class="btn btn-primary float-end">Add Member</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Birth Place, Date</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>E-mail</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Level</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tb_anggota";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td><?= $row['id_anggota']; ?></td>
                                            <td><?= $row['namalengkap']; ?></td>
                                            <td><?= $row['ttl']; ?></td>
                                            <td><?= $row['alamat']; ?></td>
                                            <td><?= $row['status']; ?></td>
                                            <td><?= $row['email']; ?></td>
                                            <td><?= $row['username']; ?></td>
                                            <td><?= $row['password']; ?></td>
                                            <td><?= $row['level']; ?></td>
                                            <td><a href="member-edit.php?id=<?= $row['id_anggota']; ?>" class="btn btn-success" >Edit</a></td>
                                            <td>
                                                <form action="code-member.php" method="post">
                                                    <button type="submit" name="delete_member" value="<?=$row['id_anggota']?>" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="11">No record found</td>
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