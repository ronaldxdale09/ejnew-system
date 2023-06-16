<?php
ob_start();
session_start();

include('function/db.php');

if (isset($_POST['add'])) {
    $coffee_product_name = $_POST['coffee_product_name'];
    $coffee_product_description = $_POST['coffee_product_description'];
    $coffee_product_unit = $_POST['coffee_product_unit'];
    $coffee_product_price = $_POST['coffee_product_price'];
    $coffee_product_stock = $_POST['coffee_product_stock'];
    $coffee_product_cost = $_POST['coffee_product_cost'];
    
    $query = "INSERT INTO coffee_products (coffee_product_name, coffee_product_description, coffee_product_unit, coffee_product_price, coffee_product_stock, coffee_product_cost) 
              VALUES ('$coffee_product_name', '$coffee_product_description', '$coffee_product_unit', '$coffee_product_price', '$coffee_product_stock', '$coffee_product_cost')";
              
    $results = mysqli_query($con, $query);
    
    if ($results) {
        $_SESSION['new_product_added'] = true;
        header("Location: coffee_list.php");
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare SQL statement
$sql = "SELECT * FROM coffee_products";
$results = mysqli_query($con, $sql);

// Check for SQL errors
if (!$results) {
    die("SQL error: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html>

<body>
    <?php 
    include('include/header.php');
    include('include/navbar.php');
    ?>

    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">COFFEE </font>
                                <font color="#046D56"> PRODUCTS </font>
                            </b>
                        </h2>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                    data-target="#add_coffee_product">
                                    <i class="fa fa-add" aria-hidden="true"></i> NEW PRODUCT
                                </button>
                                <hr>

                                <?php
                                if (isset($_SESSION['new_product_added'])) {
                                    echo '<div class="alert alert-success">New product added successfully!</div>';
                                    unset($_SESSION['new_product_added']);
                                }
                                ?>

                                <div class="table-responsive">
                                    <table class="table" id='productTable'>
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col" hidden>Description</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            while ($row = mysqli_fetch_array($results)) {
                                                echo "<tr>";
                                                echo "<td>".$row['coffee_product_id']."</td>";
                                                echo "<td>".$row['coffee_product_category']."</td>";
                                                echo "<td>".$row['coffee_product_name']."</td>";
                                                echo "<td>".$row['coffee_product_unit']."</td>";
                                                echo "<td hidden>".$row['coffee_product_description']."</td>";
                                                echo "<td>₱ " . number_format($row['coffee_product_price'], 2) . "</td>";
                                                echo "<td>".$row['coffee_product_stock']."</td>";
                                                echo "<td>₱ " . number_format($row['coffee_product_cost'], 2) . "</td>";
                                                echo "</tr>";
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        var table = $('#productTable').DataTable({
            dom: '<"top"<"left-col"B><"center-col"f>>rti<"bottom"p><"clear">',
            order: [
                [0, 'desc']
            ],
            buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }
            ],
            lengthMenu: [
                [-1],
                ["All"]
            ],
            orderCellsTop: true,
            paging: false, // Disable pagination
            infoCallback: function(settings, start, end, max, total, pre) {
                return total + ' entries';
            }
        });
    });
    </script>

    <?php 
    include "modal/coffee_product.php";
    ?>

</body>

</html>
