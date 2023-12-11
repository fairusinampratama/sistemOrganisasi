<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Extension</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Suggestion</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Suggestion
                    <a href="view-suggestion.php" class="btn btn-warning float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="col-md-4">
                        <form action="code-suggestion.php" method="post">
                            <div class="input-group mb-3">
                                <input type="text" name="insertTotal" class="form-control"
                                    placeholder="Enter the number of suggestions to insert">
                                <button type="submit" class="btn btn-success">Insert</button>
                            </div>
                        </form>
                    </div>
                    <form action="code-suggestion.php" method="post">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sender</th>
                                    <th>Subject</th>
                                    <th>Content</th>
                                    <th>Check</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tb_saran";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="text" name="sender[]" value="<?= $row['pengirim_saran']; ?>" class="form-control">
                                                <input type="hidden" name="id_suggestion[]" value="<?= $row['no_saran']; ?>">
                                            </td>
                                            <td>
                                                <input type="text" name="subject[]" value="<?= $row['subjek_saran']; ?>"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <textarea name="content[]" class="form-control"><?= $row['isi_saran']; ?></textarea>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="checkbox<?= $row['no_saran']; ?>" name="checkboxes[]"
                                                        value="<?= $row['no_saran']; ?>">
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
