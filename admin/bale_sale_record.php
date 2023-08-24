<?php
include('include/header.php');
include "include/navbar.php";


?>

<style>
    .number-cell {
        text-align: right;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">

            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">BALES </font>
                                <font color="#046D56"> SALE </font>
                            </b>
                        </h2>

                        <?php
                        include('statistical_card/bale_sales_card.php');
                        ?>
                        <div style="background-color: #2452af; height: 6px;"></div><!-- This is the blue bar -->
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">

                            <hr>
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover table-striped" id='sales_rec_table'>
                                    <?php
                                    $results  = mysqli_query($con, "SELECT  * FROM bales_sales_record"); ?>
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Contract No.</th>
                                            <th scope="col">Buyer </th>
                                            <th scope="col">Bale Quality</th>
                                            <th scope="col">No. of Bales</th>
                                            <th scope="col" hidden>No. of Containers</th>
                                            <th scope="col">Kilo Price</th>
                                            <th scope="col">Kilo Cost</th>
                                            <th scope="col" hidden>Sale Proceed</th>
                                            <th scope="col" hidden>Overall Cost </th>
                                            <th scope="col">Balance</th>
                                            <th scope="col" hidden>Profit/Loss</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php while ($row = mysqli_fetch_array($results)) {
                                                $status_color = '';
                                                switch ($row['status']) {
                                                    case "Draft":
                                                        $status_color = 'bg-info';
                                                        break;
                                                    case "In Progress":
                                                        $status_color = 'bg-warning text-dark';
                                                        break;
                                                    case "Complete":
                                                        $status_color = 'bg-success';
                                                        break;
                                                }





                                            ?>
                                            <tr>

                                                <td> <span class="badge <?php echo $status_color; ?>">
                                                        <?php echo $row['status'] ?>
                                                    </span>
                                                </td>
                                                <td class="text-center"> <?php echo $row['bales_sales_id'] ?> </td>
                                                <td><?php echo date('M j, Y', strtotime($row['transaction_date'])); ?></td>
                                                <td class="text-center"><?php echo $row['sale_contract'] ?> |
                                                    <?php echo $row['purchase_contract'] ?> </td>
                                                <td> <?php echo $row['sale_type'] ?> | <?php echo $row['buyer_name'] ?>
                                                </td>
                                                <td> <?php echo $row['contract_quality'] ?> @
                                                    <?php echo $row['contract_kiloPerBale'] ?> kg</td>
                                                <td> <?php echo $row['total_num_bales'] ?> pcs</td>
                                                <td class="text-center" hidden><?php echo $row['contract_container_num'] ?>/<?php echo $row['no_containers'] ?>
                                                </td>
                                                <td><?php echo $row['currency'] ?>
                                                    <?php echo number_format($row['contract_price'], 2) ?> </td>
                                                <td hidden>₱ <?php echo number_format($row['total_sales'], 0) ?> </td>
                                                <td hidden>₱ <?php echo number_format($row['overall_cost'], 0) ?> </td>
                                                <td>₱<?php echo number_format($row['overall_ave_cost_kilo'], 2) ?> </td>
                                                <td>₱<?php echo number_format($row['unpaid_balance'], 2) ?> </td>
                                                <td hidden>₱ <?php echo number_format($row['gross_profit'], 0) ?> </td>

                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-sm btnViewRecord" data-status="<?php echo $row['status']; ?>" data-bale='<?php echo json_encode($row); ?>'>
                                                        <i class="fas fa-book"></i>
                                                    </button>
                                                </td>


                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <script>
                                var table = $('#sales_rec_table').DataTable({
                                    dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
                                    order: [
                                        [1, 'desc']
                                    ],
                                    buttons: [
                                        'excelHtml5',
                                        'pdfHtml5',
                                        'print'
                                    ],
                                    columnDefs: [{
                                        orderable: false,
                                        targets: -1
                                    }],
                                    lengthChange: false,
                                    orderCellsTop: true,
                                    paging: false,
                                    info: false,
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>


<script>
    $('.btnViewRecord').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        var bale = $(this).data('bale');

        console.log(bale);
        $('#v_contract_quality').val(bale.contract_quality);
        $('#v_sale_id').val(bale.bales_sales_id);
        $('#v_sale_contract').val(bale.sale_contract);
        $('#v_purchase_contract').val(bale.purchase_contract);
        $('#v_sale_type').val(bale.sale_type);
        $('#v_trans_date').val(bale.transaction_date);
        $('#v_sale_buyer').val(bale.buyer_name); // Assuming buyer_name is a column in your table
        $('#v_shipping_date').val(bale.shipping_date);
        $('#v_sale_source').val(bale.source);
        $('#v_sale_destination').val(bale.destination);
        $('#v_contract_container').val(parseFloat(bale.contract_container_num).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));

        $('#v_total_milling_cost').val(parseFloat(bale.total_milling_cost).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));


        $('#v_contract_quantity').val(parseFloat(bale.contract_quantity).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_currency').val(bale.currency);
        $('#v_contract_price').val(parseFloat(bale.contract_price).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_tax_rate').val(parseFloat(bale.tax_rate).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_tax_amount').val(parseFloat(bale.tax_amount).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_other_terms').val(bale.other_terms);
        $('#v_number_container').val(bale.no_containers);
        $('#v_total_num_bales').val(parseFloat(bale.total_num_bales));
        $('#v_total_bale_weight').val(parseFloat(bale.total_bale_weight).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_overall_ave_kiloCost').val(parseFloat(bale.overall_ave_cost_kilo).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_total_sale').val(parseFloat(bale.total_sales).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_amount_paid').val(parseFloat(bale.amount_paid).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_unpaid_balance').val(parseFloat(bale.unpaid_balance).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_sales_proceeds').val(parseFloat(bale.sales_proceed).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_total_bale_cost').val(parseFloat(bale.total_bale_cost).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_total_ship_exp').val(parseFloat(bale.total_ship_expense).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_over_all_cost').val(parseFloat(bale.overall_cost).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        $('#v_gross_profit').val(parseFloat(bale.gross_profit).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));






        $('#other_terms').val(bale.other_terms);

        // var status = $(this).data('status');

        // if (status == "Draft" || status == "In Progress") {
        //     $('#editBtn').show();
        // } else {
        //     $('#editBtn').hide();
        // }



        sales_id = data[1];

        function fetch_container() {


            $.ajax({
                url: "table/bales_sales_container.php",
                method: "POST",
                data: {
                    sales_id: sales_id,
                },
                success: function(data) {

                    $('#container_selected').html(data);
                    $('#print_content input').prop('readonly', true);
                    $('#print_content textarea').prop('readonly', true);
                    $('#print_content select').prop('disabled',
                        true); //use 'disabled' for select elements
                    $("#print_content button").each(function() {
                        if (this.id !== 'btnPrint') {
                            $(this).hide();
                        }
                    });
                }
            });
        }
        fetch_container();


        function fetch_payment() {

            $.ajax({
                url: "table/bales_sales_payment.php",
                method: "POST",
                data: {
                    sales_id: sales_id,
                },
                success: function(data) {

                    //Your code to remove the box goes here
                    $('#payment_list_table').html(data);
                    $('#print_content input').prop('readonly', true);
                    $('#print_content textarea').prop('readonly', true);
                    $('#print_content select').prop('disabled',
                        true); //use 'disabled' for select elements
                    $("#print_content button").each(function() {
                        if (this.id !== 'btnPrint') {
                            $(this).hide();
                        }
                    });
                }
            });
        }
        fetch_payment();


        $("#currency_selected_sales").text(bale.currency);
        $("#currency_selected_sales").text(bale.currency);
        $("#currency_selected_paid").text(bale.currency);
        $("#currency_selected_balance").text(bale.currency);
        $("#currency_selected_price").text(bale.currency);
        // Update currency symbol in each payment row
        $(".payment-currency-symbol").text(bale.currency);


        $('#viewSalesRecord').modal('show');

    });


    $(document).on('click', '.btnPrint', function(e) {
        // Check if 'sale_buyer' input is readonly
        if (!$('#sale_buyer').prop('readonly')) {
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
</script>

<?php include "modal/bales_sales_modal.php"; ?>