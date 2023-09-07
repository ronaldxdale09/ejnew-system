<?php
include('include/header.php');
include('include/navbar.php');


?>

<body>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-12">
                        <br>
                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">COFFEE </font>
                                <font color="#046D56"> INVENTORY </font>
                            </b>
                        </h2>
                        <br>
                        <div class="card">
                            <div class="card-body">


                                <div class="col-sm-4">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#newProduction">
                                            <i class="fa fa-add" aria-hidden="true"></i> NEW PRODUCTION
                                        </button>
                                    </div>
                                </div>
                                <hr>
                                <?php

                                // Prepare SQL statement
                                $sql = "SELECT * FROM coffee_products";
                                $results = mysqli_query($con, $sql);

                                // Check for SQL errors
                                if (!$results) {
                                    die("SQL error: " . mysqli_error($con));
                                }
                                ?>
                                <div class="table-responsive">
                                    <table class="table" id='customerTable'>
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Coffee Name</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Case Qty</th>
                                                <th scope="col">Case Price</th>

                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($results)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['coffee_id'] . "</td>";
                                                echo "<td>" . $row['coffee_name'] . "</td>";
                                                echo "<td>" . $row['description'] . "</td>";
                                                echo "<td>&#8369;" . $row['case_price'] . "</td>";
                                                echo "<td>&#8369;" . $row['case_quantity'] . "</td>";
                                                echo "<td>&#8369;" . $row['unit_price'] . "</td>";

                                                echo "<td class='text-center'> 
                                                        <button class='btn btn-primary btn-sm btnUpdate' >Update</button>
                                                        <button class='btn btn-danger btn-sm confirmDelete' >Delete</button>
                                                    </td>";
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

    <?php
    include "modal/production_modal.php";
    ?>


    <script>
        $(document).ready(function() {


            $('.btnUpdate').on('click', function() {
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                $('#u_coffee_id').val(data[0]);
                $('#prod_name').val(data[1]);
                $('#description').val(data[2]);
                $('#unit_price').val(data[3].replace(/[^0-9.]/g, ''));
                $('#qty_case').val(data[4].replace(/[^0-9.]/g, ''));
                $('#case_price').val(data[5].replace(/[^0-9.]/g, ''));

                $('#update_product').modal('show');
            });

            $('.confirmDelete').on('click', function() {
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                $('#d_coffee_id').val(data[0]);

                $('#deleteProductModal').modal('show'); // Close the modal
            });



            $("#addProduct").click(function() {
                // Append the row
                var newRow = `
                    <tr>
                        <td>
                        <div class="input-group mb-3">

                                <select class="form-select product-dropdown" name="product[]" style="width: 100px;">
                                    <option value="">Select...</option>
                                    <?php
                                    $sql = "SELECT coffee_name,coffee_id,description  FROM coffee_products";
                                    $result = mysqli_query($con, $sql);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $coffeeName = $row['coffee_name'];
                                            $coffee_id = $row['coffee_id'];
                                            $description = $row['description'];

                                            echo "<option value='$coffee_id'>$coffeeName- $description </option>";
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" name="price[]"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" style="width: 100px;">
                                </div>
                            </td>
                            <td>
                            <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="qty[]" style="width: 100px;">
                                    </div>
                                </td>
                            <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
                            </td>
                        </tr>
                            `;

                $("#new_sale_table tbody").append(newRow);
            });

            // Handle the 'Remove' button for dynamically added rows
            $("#new_sale_table tbody").on("click", ".remove-item-line", function() {
                $(this).closest('tr').remove();
            });
        });
    </script>



</body>

</html>