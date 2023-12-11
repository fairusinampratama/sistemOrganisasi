<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "organisasi");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $category = $_POST['category'];
    $item = $_POST['item'];

    // Perform any required actions with the selected category and item
    // ...

    // Display the selected category and item in the text field
    $selectedText = "Category: " . $category . ", Item: " . $item;
} else {
    $selectedText = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Combobox Example</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Event listener for category select change
            document.getElementById('categorySelect').addEventListener('change', function() {
                var category = this.value;
                var itemSelect = document.getElementById('itemSelect');

                // Clear existing options
                itemSelect.innerHTML = '<option value="">Select Item</option>';

                if (category !== '') {
                    // Make an AJAX request to fetch items based on the selected category
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'get-items.php?category=' + category, true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var items = JSON.parse(xhr.responseText);

                            if (items.length > 0) {
                                // Populate the item select with options
                                items.forEach(function(item) {
                                    var option = document.createElement('option');
                                    option.value = item;
                                    option.textContent = item;
                                    itemSelect.appendChild(option);
                                });
                            } else {
                                // No items found for the selected category
                                var option = document.createElement('option');
                                option.textContent = 'No Items Found';
                                itemSelect.appendChild(option);
                            }
                        } else {
                            console.error('Request failed. Status: ' + xhr.status);
                        }
                    };
                    xhr.send();
                }
            });
        });
    </script>
</head>
<body>
    <form method="POST">
        <label for="categorySelect">Select Category:</label>
        <select id="categorySelect" name="category">
            <option value="">Select Category</option>
            <!-- PHP code to populate categories -->
            <?php
            $query = "SELECT DISTINCT kategori_barang FROM tb_barang";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['kategori_barang'] . "'>" . $row['kategori_barang'] . "</option>";
            }
            ?>
        </select>

        <label for="itemSelect">Select Item:</label>
        <select id="itemSelect" name="item">
            <option value="">Select Category First</option>
        </select>

        <button type="submit">Submit</button>
    </form>

    <label for="selectedText">Selected:</label>
    <input type="text" id="selectedText" name="selectedText" value="<?php echo $selectedText; ?>" readonly>
</body>
</html>

<?php
// Close database connection
mysqli_close($con);
?>
