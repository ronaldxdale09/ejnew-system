<?php
include('include/header.php');
include('include/navbar.php');

include "modal/coffee_category.php";

?>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>

    <div class="container home-section h-100" style="max-width:95%;">
        <div class="page-wrapper">
            <h2 class="page-title">
                <b>
                    <font color="#0C0070">COFFEE </font>
                    <font color="#046D56"> PRODUCTS </font>
                </b>
            </h2>
            <br>
            <?php
            include('statistical_card/coffee_product.card.php');
            ?>

            <div class="card">
                <div class="card-body">


                    <div class="col-sm-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#add_product">
                                <i class="fa fa-add" aria-hidden="true"></i> NEW PRODUCT
                            </button>
                            <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#categoryModal">
                                <i class="fa fa-book" aria-hidden="true"></i> CATEGORY
                            </button>
                        </div>
                    </div>
                    <hr>
                    <?php

                    // Prepare SQL statement
                    $sql = "SELECT *,coffee_products.coffee_id as prod_id FROM coffee_products 
                        LEFT JOIN coffee_inventory on coffee_products.coffee_id = coffee_inventory.coffee_id";
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
                                    <th scope="col">Weight</th>
                                    <th scope="col">Case Price</th>
                                    <th scope="col">Case Qty</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Inventory</th>
                                    <th scope="col">Inv. Value</th>

                                    <th scope="col ">Action</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php while ($row = mysqli_fetch_array($results)) { ?>
                                    <tr>

                                        <td>
                                            <span class="badge bg-warning text-dark">
                                                <?php echo $row['prod_id'] ?></span>
                                        </td>
                                        <td><?php echo $row['coffee_name'] ?> </td>
                                        <td><?php echo $row['weight'] . " " . $row['weight_unit'] ?> </td>
                                        <td>₱<?php echo number_format($row['case_price'], 2) ?> </td>
                                        <td><?php echo number_format($row['case_quantity'], 0) ?> pcs</td>
                                        <td>₱ <?php echo number_format($row['unit_price'], 2) ?></td>
                                        <td><b> <?php echo number_format($row['quantity'], 0) ?> pcs </b></td>
                                        <td><b>₱ <?php echo number_format($row['unit_price'] * $row['quantity'], 2) ?> </b></td> <!-- Calculate Inv. Value -->
                                        <td><button class='btn btn-primary btn-sm btnUpdate' data-coffee='<?php echo json_encode($row); ?>'>Update</button>
                                            <button class='btn btn-danger btn-sm confirmDelete'>Delete</button>
                                        </td>
                                    </tr>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php
    include "modal/coffee_product.php";
    ?>


    <script>
        $('.btnUpdate').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();


            var coffee = $(this).data('coffee');

            $('#u_coffee_id').val(coffee.prod_id);
            $('#prod_name').val(coffee.coffee_name);
            $('#weight').val(coffee.weight);
            $('#weight_unit').val(coffee.weight_unit);

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



        $(document).ready(function() {
            var table = $('#customerTable').DataTable({
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



</body>

</html>