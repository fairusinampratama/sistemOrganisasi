<?php
include('authentication.php');
include('includes/header.php');

?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Members</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">List of Members</li>
            <li class="breadcrumb-item">Edit</li>
        </ol>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Member</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $id_anggota = $_GET['id'];
                            $users = "SELECT * FROM tb_anggota WHERE id_anggota='$id_anggota'";
                            $users_run = mysqli_query($con, $users);

                            if (mysqli_num_rows($users_run) > 0) {
                                while ($user = mysqli_fetch_assoc($users_run)) {
                                    ?>
                                    <form action="code-member.php" method="post">
                                        <input type="hidden" name="id_anggota" value="<?= $user['id_anggota']; ?>">
                                        <div class="col-md-6 mb-3">
                                            <label for="fullname">Full Name</label>
                                            <textarea name="fullname" class="form-control"><?= $user['namalengkap']; ?></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="birth">Birth Place, Date</label>
                                            <textarea name="birth" class="form-control"><?= $user['ttl']; ?></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="address">Address</label>
                                            <textarea name="address" class="form-control"><?= $user['alamat']; ?></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="status">Status</label>
                                            <select name="status" required class="form-control">
                                                <option value="">Choose the option...</option>
                                                <option value="Anggota Muda" <?= $user['status'] == 'Anggota Muda' ? 'selected' : '' ?>>Anggota Muda</option>
                                                <option value="Anggota Biasa" <?= $user['status'] == 'Anggota Biasa' ? 'selected' : '' ?>>Anggota Biasa</option>
                                                <option value="Anggota Kehormatan" <?= $user['status'] == 'Anggota Kehormatan' ? 'selected' : '' ?>>Anggota Kehormatan</option>
                                                <option value="Anggota Luar Biasa" <?= $user['status'] == 'Anggota Luar Biasa' ? 'selected' : '' ?>>Anggota Luar Biasa</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email">E-mail</label>
                                            <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" value="<?= $user['username']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" value="<?= $user['password']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="level">Level</label>
                                            <select name="level" required class="form-control">
                                                <option value="">Choose the level...</option>
                                                <option value="admin" <?php if ($user['level'] == 'admin')
                                                    echo ' selected'; ?>>Admin</option>
                                                <option value="anggota" <?php if ($user['level'] == 'anggota')
                                                    echo ' selected'; ?>>Anggota
                                                </option>
                                            </select>

                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <button type="submit" name="update_member" class="btn btn-primary">Update</button>
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
                        $users = "SELECT * FROM tb_login WHERE id_anggota='$id_anggota'"
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