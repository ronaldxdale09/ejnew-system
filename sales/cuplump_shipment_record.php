<?php 
   include('include/header.php');
   include "include/navbar.php";
   include "sales_modal/wet_modal_shipment.php";
?>

<style>
.number-cell {
    text-align: right;
}
</style>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <div class='main-content' style='min-height:100vh;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-sm-12">

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">CUPLUMP </font>
                                <font color="#046D56"> SHIPMENT </font>
                            </b>
                        </h2>

                        <br>


                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#newWetExport">NEW EXPORT </button>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped"
                                    id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col" hidden>Shipment Type</th>
                                            <th scope="col">Shipment Date</th>
                                            <th scope="col">Destination</th>
                                            <th scope="col">Source</th>
                                            <th scope="col">Containers</th>
                                            <th scope="col">Total Weight</th>
                                            <th scope="col">Cuplump Cost</th>
                                            <th scope="col">Shipping Expenses</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td> <?php echo $row['ship_id']?> </td>
                                            <td hidden> <?php echo $row['ship_type']?> </td>
                                            <td> <?php echo $row['ship_date']?> </td>
                                            <td> <?php echo $row['buyer']?> </td>
                                            <td> <?php echo $row['destination']?> </td>
                                            <td> <?php echo $row['source']?> </td>
                                            <td class="number-cell">
                                                <?php echo number_format($row['ship_weight'], 0, '.', ',')?> kg
                                            </td>
                                            <td class="number-cell">₱
                                                <?php echo number_format($row['ship_cogs'], 2, '.', ',')?>
                                            </td>
                                            <td class="number-cell">₱
                                                <?php echo number_format($row['ship_expense'], 2, '.', ',')?>
                                            </td>
                                            <td class="text-center">

                                                <button type="button" class="btn btn-success btn-sm btnViewRecord">
                                                    <i class="fas fa-book"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <script>
                            var table = $('#recording_table-receiving').DataTable({
                                dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
                                order: [
                                    [0, 'desc']
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
$(document).ready(function() {


    $('.btnViewRecord').on('click', function() {


        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();


        var sales_id = data[0]
        console.log(sales_id);


        // Fetch additional data using AJAX
        $.ajax({
            url: 'fetch/fetch_wet_record_modal.php',
            type: 'POST',
            data: {
                sales_id: sales_id
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(data);

                // Fill in the modal with the data from the table row and additional data
                document.getElementById('m_sale_id').value = data.sale_id;
                document.getElementById('m_ship_date').value = data.ship_date;
                document.getElementById('m_sale_buyer').value = data.sale_buyer;
                document.getElementById('m_van_no').value = data.van_no;
                document.getElementById('m_sale_type').value = data.sale_type;
                document.getElementById('m_sale_currency').value = data.sale_currency;
                document.getElementById('m_exchange_rate').value = data.exchange_rate;
                document.getElementById('m_wet_kilo_price').value = parseFloat(data
                    .wet_kilo_price).toFixed(2);

                document.getElementById('m_info_lading').value = data.info_lading;
                document.getElementById('m_sale_destination').value = data.sale_destination;
                document.getElementById('m_voyage').value = data.voyage;
                document.getElementById('m_source').value = data.source;
                document.getElementById('m_vessel').value = data.vessel;
                document.getElementById('m_sales').value = parseFloat(data.sales).toFixed(
                    2);
                document.getElementById('m_total_wet_cost').value = parseFloat(data
                    .total_wet_cost).toFixed(2);
                document.getElementById('m_total_ship_exp').value = parseFloat(data
                    .total_ship_exp).toFixed(2);
                document.getElementById('m_net_gain').value = parseFloat(data.net_gain)
                    .toFixed(2);
                document.getElementById('m_payment_sales').value = parseFloat(data
                    .payment_sales).toFixed(2);
                document.getElementById('m_amount_unpaid').value = parseFloat(data
                    .amount_unpaid).toFixed(2);
                document.getElementById('m_pay_date').value = data.pay_date;
                document.getElementById('m_pay_details').value = data.pay_details;
                document.getElementById('m_paid_amount').value = parseFloat(data
                    .paid_amount).toFixed(2);

                document.getElementById('m_ship_exp_freight').value = parseFloat(data
                    .ship_exp_freight).toFixed(2);
                document.getElementById('m_ship_exp_loading').value = parseFloat(data
                    .ship_exp_loading).toFixed(2);
                document.getElementById('m_ship_exp_processing').value = parseFloat(data
                    .ship_exp_processing).toFixed(2);
                document.getElementById('m_ship_exp_trucking').value = parseFloat(data
                    .ship_exp_trucking).toFixed(2);
                document.getElementById('m_ship_exp_cranage').value = parseFloat(data
                    .ship_exp_cranage).toFixed(2);
                document.getElementById('m_ship_exp_misc').value = parseFloat(data
                    .ship_exp_misc).toFixed(2);




                $('#modalSalesRecord').modal('show');
            }
        });

        function fetch_cost_weight() {

            $.ajax({
                url: "table/wSales_cw_record.php",
                method: "POST",
                data: {
                    sales_id: sales_id,

                },
                success: function(data) {
                    $('#m_cost_weight_table').html(data);

                }
            });
        }
        fetch_cost_weight();


    });
    document.getElementById('printButton').addEventListener('click', function() {
        const transactionRecord = document.getElementById('transaction_record');

        html2canvas(transactionRecord).then(function(canvas) {
            const imgData = canvas.toDataURL('image/png');
            const pdf = pdfMake.createPdf({
                content: [{
                    image: imgData,
                    width: 500
                }]
            });

            pdf.download('transaction_record.pdf');
        });
    });



    document.getElementById('editButton').addEventListener('click', function() {
        var sale_id = document.getElementById('m_sale_id').value;

        // Redirect to the sales_wet.php page with the sale_id in the URL
        window.location.href = 'sales_wet.php?id=' + sale_id;
    });

});
</script>