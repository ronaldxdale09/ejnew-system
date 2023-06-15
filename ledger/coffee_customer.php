<?php
ob_start();
session_start();

include('function/db.php');

if (isset($_POST['add'])) {
    $cof_customer_name = $_POST['cof_customer_name'];
    $cof_customer_address = $_POST['cof_customer_address'];
    $cof_customer_contact = $_POST['cof_customer_contact'];
    $loc = $_SESSION['loc'];
    
    $query = "INSERT INTO coffee_customer (cof_customer_name, cof_customer_address, cof_customer_contact, loc) 
              VALUES ('$cof_customer_name', '$cof_customer_address', '$cof_customer_contact', '$loc')";
              
    $results = mysqli_query($con, $query);
    
    if ($results) {
        $_SESSION['new_customer_added'] = true;
        header("Location: coffee_customer.php");
        exit();
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

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
    <?php 
    include('include/header.php');
    include('include/navbar.php');
    ?>

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
                                <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                    data-target="#add_customer">
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
                                                echo "<td>".$row['cof_customer_id']."</td>";
                                                echo "<td>".$row['cof_customer_name']."</td>";
                                                echo "<td>".$row['cof_customer_address']."</td>";
                                                echo "<td>".$row['cof_customer_contact']."</td>";
                                                echo "<td>₱ " . number_format($row['cof_customer_balance'], 2) . "</td>";
                                                echo "<td> <button class='btn btn-primary' onclick='viewTransactions(".$row['cof_customer_id'].")'>View Transactions</button> </td>";
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
    function viewTransactions(customerId) {
        // Redirect or perform any desired action
        window.location.href = "transactions.php?customer_id=" + customerId;
    }
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
    include "modal/modal_customer.php";
    ?>

</body>

</html>