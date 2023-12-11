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
                        <h4>Add Loan
                            <a href="view-logistics-loan.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code-logistics-loan.php" method="post" enctype="multipart/form-data">
                            <div class="col-md-6 mb-3">
                                <label for="category_logistics">Category</label>
                                <select class="form-select" name="category_logistics" id="category_logistics">
                                    <option selected>Choose category</option>
                                    <?php
                                    $query = "SELECT DISTINCT kategori_barang FROM tb_barang";
                                    $query_run = mysqli_query($con, $query);
                                    if ($query_run) {
                                        while ($row = $query_run->fetch_assoc()) {
                                            echo '<option value="' . $row['kategori_barang'] . '">' . $row['kategori_barang'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">Category not available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name_logistics">Name</label>
                                <select class="form-select" name="name_logistics" id="name_logistics">
                                    <option selected>Choose logistic's name...</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="qty">Quantity</label>
                                <input type="number" min="0"  id="qty" name="qty" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="identity">Identity</label>
                                <input type="text" id="identity" name="identity" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="institution">Institution</label>
                                <input type="text" id="institution" name="institution" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="receipt">Upload receipt</label>
                                <input type="file" id="receipt" name="receipt" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="add_loan-logistics" class="btn btn-primary">Add
                                    Loan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#category_logistics').on('change', function () {
            var categoryLogistics = $(this).val();
            if (categoryLogistics) {
                $.ajax({
                    type: 'POST',
                    url: 'logistics-loan-add-auto.php',
                    data: 'category_logistics=' + categoryLogistics,
                    success: function (html) {
                        $('#name_logistics').html(html); // Update the select element with received options
                    }
                });
            } else {
                $('#name_logistics').html('<option selected>Choose logistic\'s name...</option>'); // Reset the select element
            }
        });
    });
</script>


<?php
include('includes/footer.php');
include('includes/scripts.php');
?>