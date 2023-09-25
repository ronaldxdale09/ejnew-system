<?php


include('include/header.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $id =  preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM coffee_sale WHERE coffee_sale_id = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $record = $result->fetch_assoc();

        $coffee_customer = isset($record['coffee_customer']) ? $record['coffee_customer'] : '';
        $sale_buyer = isset($record['buyer_name']) ? htmlspecialchars($record['buyer_name'], ENT_QUOTES, 'UTF-8') : '';
        $trans_date = isset($record['coffee_date']) ? htmlspecialchars($record['coffee_date'], ENT_QUOTES, 'UTF-8') : '';

        echo "
                <script>
                    $(document).ready(function() {
                        $('#trans_sale_id').val('" . $id . "');
                        $('#coffee_customer').val('" . $coffee_customer . "');
                        $('#coffee_date').val('" . $trans_date . "');

    
            
    
                    });
                    </script>
                ";
    }
}
?>





<body>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">

                <br>
                <h2 class="page-title">
                    <b>
                        <font color="#0C0070">COFFEE </font>
                        <font color="#046D56"> SALE </font>
                    </b>
                </h2>
                <span class="badge bg-warning text-dark">
                    SALE ID: <?php echo $id ?></span>
                <br> <br>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <button type="button" class="btn trans-btn btn-primary btnReturn">
                                    <span class="fas fa-arrow-left"></span> Return
                                </button>
                                <button type="button" class="btn trans-btn btn-danger btnVoid"> <span class="fas fa-times"></span>
                                    Void</button>
                                <button type="button" class="btn trans-btn btn-warning confirmSales" id="confirmSales"><span class="fas fa-check"></span>
                                    Confirm
                                    Sales</button>
                            </div>
                            <div class="col"></div>
                            <div class="col">

                                <button type="button" class="btn btn-dark btnPrint"><span class="fas fa-print"></span> Print
                                </button>

                            </div>
                        </div>
                    </div>
                </div> <br>
                <form id="salesForm" action="" method="post">
                    <div id='print_content'>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <label>Invoice No.</label>
                                        <input type="text" class="form-control" name="sale_id" id="trans_sale_id" readonly>
                                    </div>
                                    <div class="col-5">
                                        <label>Customer Name</label>

                                        <select class="form-control" name="coffee_customer" id="coffee_customer" required>
                                            <option value="" selected disabled hidden>Select...</option>
                                            <?php
                                            // Retrieve customer names from the coffee_customer table
                                            $sql = "SELECT cof_customer_name FROM coffee_customer";
                                            $result = mysqli_query($con, $sql);
                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $customerName = $row['cof_customer_name'];
                                                    echo "<option value='$customerName'>$customerName</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label>Transaction Date</label>
                                        <input type="date" class="form-control" id="coffee_date" name="coffee_date" required>
                                    </div>
                                </div>
                                <br>
                                <div class="card">
                                    <div class="card-body">
                                        <h4> Product List</h4>
                                        <div id="product_list_table"></div>



                                    </div>


                                </div>
                                <br>
                                <div class="card">
                                    <div class="card-body">
                                        <h4> Payment Details</h4>
                                        <div id="payment_list_table"></div>
                                    </div>
                                </div>


                                <br>
                                <div class="row">
                                    <div class="col">
                                        <label>Total Amount Due</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" name="coffee_total_amount" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Total Amount Paid</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" name="total_amount_paid" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label>Remaining Balance</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" name="coffee_balance" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    </div>

    </form>

    <!-- Confirm Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Sales Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to complete the sales record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="confirmButton">Yes, Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Return Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="confirmReturnModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to return?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="confirmReturn">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            sale_id = <?php echo $id ?>;

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


            //RETURN JS
            $('.btnReturn').on('click', function() {
                $('#confirmReturnModal').modal('show');
            });
            $('#confirmReturn').on('click', function() {
                window.location.href = "coffee_sale_record.php";
            })

            $(document).on('click', '.confirmSales', function(e) {
                // Check if 'sale_buyer' input is readonly
                if ($('#sale_buyer').prop('readonly')) {
                    // If readonly, show alert and return
                    Swal.fire({
                        icon: 'warning',
                        title: 'Form Completed',
                        text: 'This action is not allowed after the form is completed.',
                    });
                    return;
                }

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                var sales_id = <?php echo  $id ?>;

                if ($(this).hasClass('confirmSales')) {
                    $('#confirmModal').modal('show');
                } else if ($(this).hasClass('btnDraft')) {
                    $('#draftModal').modal('show');
                }
                // add similar if conditions for other buttons if needed
            });




            $(document).on('click', '#confirmButton', function(e) {
                // Prevent the default form submission
                e.preventDefault();

                // Set the form action to the desired URL
                $('#salesForm').attr('action', 'function/coffee_sale_transaction.php');

                // Submit the form asynchronously using AJAX
                $.ajax({
                    type: "POST",
                    url: $('#salesForm').attr('action'),
                    data: $('#salesForm').serialize(),
                    success: function(response) {
                        if (response.trim() === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Sale transaction completed!',
                            });

                            // Set all inputs to readonly
                            $('#salesForm input').prop('readonly', true);
                            $('#salesForm textarea').prop('readonly', true);
                            $('#salesForm select').prop('disabled', true); //use 'disabled' for select elements
                            // Disable all buttons inside the form
                            // Temporarily hide the buttons
                            $("#print_content button").hide();
                            $('#confirmModal').modal('hide');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        // Display SweetAlert error popup
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Form submission failed!',
                        });
                    }
                });
            });

            $(document).on('click', '.btnPrint', function(e) {
                // Check if 'sale_buyer' input is readonly
                if (!$('#coffee_date').prop('readonly')) {
                    // If not readonly, show alert and return
                    Swal.fire({
                        icon: 'warning',
                        title: 'Incomplete Form',
                        text: 'Please complete the form before printing.',
                    });
                    return;
                }

                console.log('hello');

                // Temporarily hide the buttons
                $("#print_content button").hide();

                html2canvas(document.querySelector("#print_content")).then(canvas => {
                    var myImage = canvas.toDataURL("image/png");
                    var tWindow = window.open("");
                    $(tWindow.document.body)
                        .html("<img id='Image' src=" + myImage + " style='width:100%;'></img>")
                        .ready(function() {
                            tWindow.focus();
                            tWindow.print();
                        });

                    // Show the buttons again
                    $("#print_content button").show();
                });
            });




        });
    </script>


</body>

</html>