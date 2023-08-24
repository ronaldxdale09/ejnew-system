<?php

include('include/header.php');
include('include/navbar.php');

// Prepare SQL statement
$sql = "SELECT * FROM coffee_customer";
$results = mysqli_query($con, $sql);

// Check for SQL errors
if (!$results) {
    die("SQL error: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html>

<body>

    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-12">
                        <br>
                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">CUSTOMER </font>
                                <font color="#046D56"> LIST </font>
                            </b>
                        </h2>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#addCustomer">
                                    <i class="fa fa-add" aria-hidden="true"></i> NEW CUSTOMER
                                </button>
                                <hr>

                                <?php
                                if (isset($_SESSION['new_customer_added'])) {
                                    echo '<div class="alert alert-success">New customer added successfully!</div>';
                                    unset($_SESSION['new_customer_added']);
                                }
                                ?>

                                <div class="table-responsive">
                                    <table class="table" id='customerTable'>
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($results)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['cof_customer_id'] . "</td>";
                                                echo "<td>" . $row['cof_customer_name'] . "</td>";
                                                echo "<td>" . $row['cof_customer_address'] . "</td>";
                                                echo "<td>" . $row['cof_customer_contact'] . "</td>";
                                                echo "<td>₱ " . number_format($row['cof_customer_balance'], 2) . "</td>";
                                                echo "<td width='25%'> <button class='btn btn-success btn-sm')'>Transactions</button>
                                                <button class='btn btn-primary btn-sm btnUpdate' >Update</button>
                                                <button class='btn btn-danger btn-sm confirmDelete' >Delete</button>  </td>";

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
        $('.btnUpdate').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#customer_id').val(data[0]);
            $('#name').val(data[1]);
            $('#address').val(data[2]);
            $('#contact').val(data[3].replace(/[^0-9.]/g, ''));

            $('#updateCustomer').modal('show');


        });

        $('.confirmDelete').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#d_customer_id').val(data[0]);

            $('#deleteCustomer').modal('show'); // Close the modal
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

    <?php
    include "modal/coffee_customer.php";
    ?>

</body>

</html>