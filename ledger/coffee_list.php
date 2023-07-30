<?php
include('function/coffee_products.php');
include('include/header.php');
include('include/navbar.php');
include ('function/db.php');
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
                                <font color="#046D56"> PRODUCTS </font>
                            </b>
                        </h2>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                    data-target="#add_product">
                                    <i class="fa fa-add" aria-hidden="true"></i> NEW PRODUCT
                                </button>
                                <hr>

                                <div class="table-responsive">
                                    <table class="table" id='customerTable'>
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Coffee Name</th>
                                                <th scope="col">Coffee Category</th>
                                                <th scope="col">Coffee Price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($results)) {
                                                echo "<tr>";
                                                echo "<td>" . $row['coffee_id'] . "</td>";
                                                echo "<td>" . $row['coffee_name'] . "</td>";
                                                echo "<td>" . $row['coffee_category'] . "</td>";
                                                echo "<td>&#8369;" . $row['coffee_price'] . "</td>";
                                                echo "<td class='text-center'> 
                                                        <button class='btn btn-primary' data-toggle='modal' data-target='#updateModal' onclick='populateUpdateForm(" . $row['coffee_id'] . ")'>Update</button>
                                                        <button class='btn btn-danger' onclick='deleteCoffee(" . $row['coffee_id'] . ")'>Delete</button>
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
    include "modal/coffee_product.php";
    include "modal/coffee_product_update.php";
    ?>


    <script>
        function populateUpdateForm(coffeeId) {
            $.ajax({
                url: 'function/coffee_fetch.php',
                type: 'POST',
                data: { coffee_id: coffeeId },
                dataType: 'json',
                success: function (response) {
                    $('#updateCoffeeId').val(response.coffee_id);
                    $('#updateCoffeeName').val(response.coffee_name);
                    $('#updateCoffeeCategory').val(response.coffee_category);
                    $('#updateCoffeePrice').val(response.coffee_price);
                },
                error: function (xhr, status, error) {
                    console.log(error); // Handle the error gracefully
                }
            });
        }

        function deleteCoffee(coffeeId) {
            $.ajax({
                url: 'function/coffee_transaction.php?coffee_id=' + coffeeId,
                type: 'POST',
                data: { coffee_id: coffeeId },
                cache: false,
                success: function (response) {
                    console.log("Delete operation completed");
                    // Refresh the page
                    location.reload();
                }
            });
        }

        $(document).ready(function () {
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
                infoCallback: function (settings, start, end, max, total, pre) {
                    return total + ' entries';
                }
            });
        });
    </script>

    

</body>

</html>