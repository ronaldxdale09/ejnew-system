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

                        <br>


                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#newWetExport">NEW SALE </button>
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
                                                <?php echo number_format($row['contract_price'],2 )?> </td>
                                            <td hidden>₱ <?php echo number_format($row['total_sales'],0 )?> </td>
                                            <td hidden>₱ <?php echo number_format($row['overall_cost'],0 )?> </td>
                                            <td><i>Updating</i></td>
                                            <td><i>Updating</i></td>
                                            <td hidden>₱ <?php echo number_format($row['gross_profit'],0 )?> </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm btnViewRecord"
                                                    data-status="<?php echo $row['status']; ?>"
                                                    data-bale='<?php echo json_encode($row); ?>'>
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

    console.log(bale); // Log the data to the console to see what it looks like
    $('#sales_id').val(bale.bales_sales_id);
    $('#sale_contract').val(bale.sale_contract);
    $('#purchase_contract').val(bale.purchase_contract);
    $('#sale_type').val(bale.sale_type);
    $('#contract_quality').val(bale.contract_quality);
    $('#trans_date').val(bale.transaction_date);
    $('#sale_buyer').val(bale.buyer_name); // Assuming buyer_name is a column in your table
    $('#shipping_date').val(bale.shipping_date);
    $('#sale_source').val(bale.source);
    $('#sale_destination').val(bale.destination);
    $('#contract_contaier').val(bale.contract_container_num);
    $('#contract_quantity').val(bale.contract_quantity);
    $('#sale_currency').val(bale.currency);
    $('#contract_price').val(bale.contract_price);
    $('#other_terms').val(bale.other_terms);


    var status = $(this).data('status');

    if (status == "Draft" || status == "In Progress") {
        $('#editBtn').show();
    } else {
        $('#editBtn').hide();
    }



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

<?php include "sales_modal/bales_sales_modal.php"; ?>