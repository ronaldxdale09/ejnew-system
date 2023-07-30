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

    // Ensure the database connection is successful
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

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

    include "modal/coffee_sales.php"; // Include the modal file
    include('modal/coffee_sales_update.php');
    ?>

    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">COFFEE </font>
                                <font color="#046D56"> SALE </font>
                            </b>
                        </h2>
                        <br>
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#newCoffeeSale">NEW SALE</button>
                            <hr>
                            <div class="table-responsive">
                                <?php
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
                                                        <?php echo $row['coffee_status']; ?>
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
                                                        <button type="button"
                                                        data-coffee_sale='<?php echo json_encode($row)?>'
                                                        class="btn btn-success btn-sm btnSaleUpdate">Update</button>
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

    <script>
        $(document).ready(function () {
            $(document).on('click', '.btnSaleUpdate', function () {
                $tr = $(this).closest('tr');

                var data = $tr.find("td").map(function () {
                    return $(this).text();
                }).get();

                var coffee_data=  $(this).data('coffee_sale');

                coffeeId = coffee_data.coffee_sale_id ;
                coffeeNo = coffee_data.sale_voucher;
                coffeeCustomer = coffee_data.coffee_customer;
                coffeeDate = coffee_data.coffee_date;
                coffeeTotalAmount =coffee_data.coffee_total_amount;
                coffeePaid = coffee_data.coffee_paid;
                coffeeBalance = coffee_data.coffee_balance;

  
                $.ajax({
                    url: "table/coffee_sale_fetch.php",
                    method: "POST",
                    data: {
                        coffee_sale_id: coffeeId,
                    },
                    success: function (data) {
                        $('#itemLinesUpdate').html(data);
                    }
                });
                const formattedDate = coffeeDate.split("/").reverse().join("-");
                $("#updateCoffeeSale input[name='coffee_date_update']").val(formattedDate);

                //$("#updateCoffeeSale input[name=coffee_sale_id']").val(coffeeId);
                $("#updateCoffeeSale input[name='coffee_no_update']").val(coffeeNo);
                $("#updateCoffeeSale input[name='coffee_customer_update']").val(coffeeCustomer);
                //$("#updateCoffeeSale input[name='coffee_date_update']").val(new Date(coffeeDate).toISOString().split("T")[0]);
                $("#updateCoffeeSale input[name='coffee_total_amount_update']").val(coffeeTotalAmount.replace(/[^0-9\.]/g, ''));
                $("#updateCoffeeSale input[name='coffee_paid_update']").val(coffeePaid.replace(/[^0-9\.]/g, ''));
                $("#updateCoffeeSale input[name='coffee_balance_update']").val(coffeeBalance.replace(/[^0-9\.]/g, ''));

                // Show the modal
                $("#updateCoffeeSale").modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function () {
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

        });


    </script>


</body>

</html>