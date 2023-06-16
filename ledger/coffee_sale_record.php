<!DOCTYPE html>
<html>

<head>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <style>
    .number-cell {
        text-align: right;
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

    $results = mysqli_query($con, "SELECT 
        coffee_id,
        coffee_status,
        coffee_no,
        coffee_date,
        coffee_customer,
        coffee_total_amount,
        coffee_paid,
        coffee_balance
    FROM coffee_sale");

    include "modal/coffee_sales.php"; // Include the modal file
    ?>

    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">COFFEE </font>
                                <font color="#046D56"> SALE </font>
                            </b>
                        </h2>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                    data-target="#newCoffeeSale">
                                    <i class="fa fa-add" aria-hidden="true"></i> NEW SALE</button>
                                <button type="button" class="btn btn-secondary text-white" data-toggle="modal"
                                    data-target="coffee_list.php">View Products</button>
                                <button type="button" class="btn btn-secondary text-white" data-toggle="modal"
                                    data-target="#newCoffeeSale">View Customers</button>
                                <hr>
                                <div class="table-responsive">
                                    <?php
                                    if ($results) {
                                    ?>
                                    <table class="table table-bordered table-hover table-striped"
                                        id='recording_table-receiving'>
                                        <thead class="table-dark text-center" style="font-size: 14px !important">
                                            <tr>
                                                <th scope="col" hidden>ID</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Ref No.</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Customer Name</th>
                                                <th scope="col">Total Amount</th>
                                                <th scope="col" hidden>Amount Paid</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        while ($row = mysqli_fetch_array($results)) {
                                            ?>
                                            <tr>
                                                <td hidden><?php echo $row['coffee_id']; ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    $balance = $row['coffee_balance'];
                                                    if ($balance <= 0) {
                                                        echo '<i class="fas fa-check-circle text-success"></i> Complete ';
                                                    } else {
                                                        echo '<i class="fas fa-exclamation-circle text-warning"></i> On Account';
                                                    }
                                                ?>
                                                </td>

                                                <td class="text-center"><?php echo $row['coffee_no']; ?></td>
                                                <td class="text-center">
                                                    <?php echo date('M d, Y', strtotime($row['coffee_date'])); ?></td>
                                                <td><?php echo $row['coffee_customer']; ?></td>
                                                <td class="number-cell">₱
                                                    <?php echo number_format($row['coffee_total_amount'], 2, '.', ','); ?>
                                                </td>
                                                <td class="number-cell" hidden>₱
                                                    <?php echo number_format($row['coffee_paid'], 2, '.', ','); ?></td>
                                                <td class="number-cell">₱
                                                    <?php echo number_format($row['coffee_balance'], 2, '.', ','); ?>
                                                </td>

                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-primary btn-sm btnViewRecord">Update</button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    } else {
                                        echo "Error: " . mysqli_error($con);} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add the SweetAlert2 and jQuery libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script>
    $(document).ready(function() {
        var table = $('#recording_table-receiving').DataTable({
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

        $('#newCoffeeSaleForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'newCoffeeSale.php',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json', // Expect JSON response from the server
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        didClose: function() {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while submitting the form.',
                    });
                }
            });
        });
    });
    </script>


</body>

</html>