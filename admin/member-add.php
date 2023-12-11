<?php
include('authentication.php');
include('includes/header.php');

?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Members</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">List of Members</li>
            <li class="breadcrumb-item">Add Member</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Member
                            <a href="view-member.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code-member.php" method="post">
                            <div class="col-md-6 mb-3">
                                <label for="fullname">Full Name</label>
                                <textarea name="fullname" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="birth">Birth Place, Date</label>
                                <textarea name="birth" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <select name="status" required class="form-control">
                                    <option value="">Choose the option...</option>
                                    <option value="Anggota Muda">Anggota Muda</option>
                                    <option value="Anggota Biasa">Anggota Biasa</option>
                                    <option value="Anggota Kehormatan">Anggota Kehormatan</option>
                                    <option value="Anggota Luar Biasa">Anggota Luar Biasa</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="level">Level</label>
                                <select name="level" required class="form-control">
                                    <option value="">Choose the level...</option>
                                    <option value="admin">Admin</option>
                                    <option value="anggota">Anggota</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="add_member" class="btn btn-primary">Add Member</button>
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