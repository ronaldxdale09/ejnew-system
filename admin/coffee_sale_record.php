<link rel='stylesheet' href='css/statistic-card.css'>

<body>
    <?php
    include('include/header.php');
    include('include/navbar.php');

    ?>

    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="page-title">
                            <b>
                                <font color="#0C0070">COFFEE </font>
                                <font color="#046D56"> SALE </font>
                            </b>
                        </h1>
                        <hr>
                        <?php include('statistical_card/coffee.sale.card.php'); ?>
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#newCoffeeSale">NEW SALE</button>
                            <hr>
                            <div class="table-responsive">
                                <?php

                                $stmt = mysqli_prepare($con, "SELECT 
                                        coffee_sale_id,
                                        coffee_status,
                                        coffee_date,
                                        coffee_customer,
                                        coffee_total_amount,
                                        coffee_paid,
                                        coffee_balance
                                        FROM coffee_sale");

                                mysqli_stmt_execute($stmt);
                                $results = mysqli_stmt_get_result($stmt);

                                if ($results) {
                                ?>
                                    <table class="table table-bordered table-hover table-striped coffee-sale-table">

                                        <thead class="table-dark text-center" style="font-size: 14px !important">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Customer Name</th>
                                                <th scope="col">Total Amount</th>
                                                <th scope="col">Paid Amount</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($results)) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['coffee_sale_id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row['coffee_status'] == 'In Progress') {
                                                            echo '<span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half"></i> In Progress</span>';
                                                        } elseif ($row['coffee_status'] == 'Paid') {
                                                            echo '<span class="badge bg-success"><i class="fas fa-check-circle"></i> Paid</span>';
                                                        } else {
                                                            echo $row['coffee_status']; // Default output if the status doesn't match any condition
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php echo date('M d, Y', strtotime($row['coffee_date'])); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['coffee_customer']; ?>
                                                    </td>
                                                    <td class="number-cell">₱
                                                        <?php echo $row['coffee_total_amount']; ?>
                                                    </td>
                                                    <td class="number-cell">₱
                                                        <?php echo $row['coffee_paid']; ?>
                                                    </td>
                                                    <td class="number-cell">₱
                                                        <?php echo $row['coffee_balance']; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" data-coffee='<?php echo json_encode($row); ?>' class="btn btn-success btn-sm btnViewRecord">View</button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php
                                } else {
                                    echo "Error: " . mysqli_error($con);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "modal/coffee_sales_update.php"; // Include the modal file 
    ?>
    <script>
        $(document).ready(function() {
            var table = $('.coffee-sale-table').DataTable({
                dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
                order: [
                    [0, 'desc']
                ],
                buttons: ['excelHtml5', 'pdfHtml5', 'print'],
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }],
                lengthChange: false,
                orderCellsTop: true,
                paging: false,
                info: false,
            });

            function formatWithComma(value) {
                // Ensure value is a number
                let parsedValue = parseFloat(value);

                // Ensure parsed value is a valid number
                if (isNaN(parsedValue)) {
                    return "0.00"; // or some default value, or you can throw an error
                }

                // Convert to string with 2 decimal places
                let fixedValue = parsedValue.toFixed(2);

                // Return with comma as thousands separator
                return parseFloat(fixedValue).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }
            $('.btnViewRecord').on('click', function() {

                var coffee = $(this).data('coffee');

                sale_id = coffee.coffee_sale_id;
                $('#coffee_id').val(coffee.coffee_sale_id);
                $('#customer_name').val(coffee.coffee_customer);
                $('#coffee_date').val(coffee.coffee_date);
                $('#coffee_total_amount').val(formatWithComma(coffee.coffee_total_amount));
                $('#total_amount_paid').val(formatWithComma(coffee.coffee_paid));
                $('#coffee_balance').val(formatWithComma(coffee.coffee_balance));


                function fetch_product() {

                    $.ajax({
                        url: "table/coffee_listing_record.php",
                        method: "POST",
                        data: {
                            sale_id: sale_id,

                        },
                        success: function(data) {
                            $('#product_list_table').html(data);
                        }
                    });
                }
                fetch_product();

                // FETCH PAYMENT

                function fetch_payment() {

                    $.ajax({
                        url: "table/coffee_payment_record.php",
                        method: "POST",
                        data: {
                            sale_id: sale_id,

                        },
                        success: function(data) {
                            $('#payment_list_table').html(data);
                        }
                    });
                }
                fetch_payment();


                $('#record_table input').prop('readonly', true);
                $('#record_table textarea').prop('readonly', true);
                $('#record_table select').prop('disabled', true); //use 'disabled' for select elements
                // Disable all buttons inside the form
                // Temporarily hide the buttons
                $("#record_table button").hide();

                $('#updateCoffeeModal').modal('show');


            });



        });
    </script>


</body>

</html>