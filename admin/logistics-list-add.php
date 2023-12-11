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
                        <h4>Add Logistics
                            <a href="view-logistics-list.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code-logistics-list.php" method="post">
                            <div class="col-md-6 mb-3">
                                <label for="category">Category</label>
                                <input type="text" name="category"class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name"class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="qty">Quantity</label>
                                <input type="number" min="0" name="qty" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="add_list-logistics" class="btn btn-primary">Add Logistic</button>
                            </div>
                        </form>
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