<!DOCTYPE html>
<html>

<head>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <style>
        .number-cell {
            text-align: right;
        }

        /* Adjust the width and remove padding and margin to remove spaces */
        .form-control-wide {
            width: 100%;
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>
    <?php
    include('include/header.php');
    include('include/navbar.php');


    $sql = "SELECT * FROM coffee_customer ";
    $res = mysqli_query($con, $sql);
    $customer_name = '';
    while ($array = mysqli_fetch_array($res)) {
        $customer_name .= '
        <option value="' . $array["cof_customer_name"] .'">' . $array["cof_customer_name"] . '</option>';
            }



            
    include "modal/coffee_sales.php"; // Include the modal file



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
                        </h1> <hr>
                        <?php   include('statistical_card/coffee_sale_card.php'); ?>
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#newCoffeeSale">NEW SALE</button>
                            <hr>
                            <div class="table-responsive">
                                <?php

                                $stmt = mysqli_prepare($con, "SELECT 
                                        coffee_sale_id,
                                        coffee_status,
                                        sale_voucher,
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
                                                <th scope="col">Ref No.</th>
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
                                                        <?php echo $row['sale_voucher']; ?>
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
                                                        <button type="button" data-coffee='<?php echo json_encode($row); ?>' class="btn btn-success btn-sm btnViewRecord">Update</button>
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

<?php     include "modal/coffee_sales_update.php"; // Include the modal file ?>
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

            $('.btnViewRecord').on('click', function() {

                var coffee = $(this).data('coffee');

                sale_id = coffee.coffee_sale_id;
                $('#u_sale_id').val(coffee.coffee_sale_id);
                $('#coffee_no').val(coffee.sale_voucher);
                $('#customer_name').val(coffee.coffee_customer);
                $('#coffee_date').val(coffee.coffee_date);
                $('#coffee_total_amount').val(formatWithComma(coffee.coffee_total_amount));
                $('#total_amount_paid').val(formatWithComma(coffee.coffee_paid));
                $('#coffee_balance').val(formatWithComma(coffee.coffee_balance));

                function fetch_product() {

                    $.ajax({
                        url: "table/coffee_product_listing.php",
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
                        url: "table/coffee_sale_payment.php",
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

                $('#updateCoffeeModal').modal('show');


            });



        });
    </script>


</body>

</html>