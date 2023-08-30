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
                                <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                    data-target="#add_inventory">
                                    <i class="fa fa-plus" aria-hidden="true"></i> ADD INVENTORY
                                </button>


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
                                                <th scope="col">Date Added</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Pieces per Box</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Unit Cost</th>
                                                <th scope="col">Produced</th>
                                                <th scope="col">Inventory</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($results)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['coffee_id'] . "</td>";
                                                echo "<td>" . $row['coffee_name'] . "</td>";
                                                echo "<td>" . $row['coffee_name'] . "</td>";
                                                echo "<td>" . $row['coffee_name'] . "</td>";
                                                echo "<td>" . $row['coffee_name'] . "</td>";
                                                echo "<td>" . $row['coffee_name'] . "</td>";    
                                                echo "<td>&#8369;" . $row['coffee_price'] . "</td>";
                                                echo "<td>&#8369;" . $row['coffee_price'] . "</td>";
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
    include "modal/coffee_inventory.php";
    ?>


    <script>
    $('.btnUpdate').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#coffee_id').val(data[0]);
        $('#coffee_name').val(data[1]);
        $('#coffee_price').val(data[2].replace(/[^0-9.]/g, ''));

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