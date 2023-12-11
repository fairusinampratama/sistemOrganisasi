<?php
include('authentication.php');
include('includes/header.php');

?>

<div class="container-fluid px-4">
    <h4 class="mt-4">Extension</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Suggestion</li>
        </ol>
        <div class="row">
            <div class="col-md-12">
                <?php include('message.php'); ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Suggestion</h4>
                    </div>
                    <div class="card-body">
                        <form action="code-suggestion.php" method="post">
                            <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" rows=8></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="add_suggestion" class="btn btn-primary">Send</button>
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