<?php
    include('include/header.php');
    include('include/navbar.php');
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
                                <font color="#046D56"> SALES </font>
                            </b>
                        </h2>
                        <br>
                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                data-target="#newWetExport">NEW SALE</button>
                            <hr>
                            <div class="table-responsive">
                                <?php
                                    $results = mysqli_query($con, "SELECT 
                                        id,
                                        en_sale_contract_no,
                                        buyer_purchase_contract_no,
                                        wet_sale_type,
                                        wet_ship_date,
                                        wet_sale_buyer,
                                        shipping_date,
                                        wet_quantity,
                                        wet_price,
                                        sale_destination,
                                        info_lading,
                                        container,
                                        packing,
                                        contact_information,
                                        destination,
                                        remarks
                                    FROM sales_contract");

                                    if ($results) {
                                ?>
                                <table class="table table-bordered table-hover table-striped"
                                    id='recording_table-receiving'>
                                    <thead class="table-dark text-center" style="font-size: 14px !important">
                                        <tr>
                                            <th scope="col">Action</th>
                                            <th scope="col">Transaction Date</th>
                                            <th scope="col">EN Contract</th>
                                            <th scope="col">Purchase Contract</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Shipping Date</th>
                                            <th scope="col">Buyer</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            <!-- <th scope="col">Info Lading</th> 
                                            <th scope="col">Container</th>
                                            <th scope="col">Packing</th>
                                            <th scope="col">Contact Information</th> -->
                                            <th scope="col">Destination</th>
                                            <th scope="col">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($row = mysqli_fetch_array($results)) {
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <button type="button"
                                                    class="btn btn-success btn-sm btnViewRecord">Update</button>
                                            </td>
                                            <td><?php echo $row['wet_ship_date']; ?></td>
                                            <td><?php echo $row['en_sale_contract_no']; ?></td>
                                            <td><?php echo $row['buyer_purchase_contract_no']; ?></td>
                                            <td><?php echo $row['wet_sale_type']; ?></td>
                                            <td><?php echo $row['shipping_date']; ?></td>
                                            <td><?php echo $row['wet_sale_buyer']; ?></td>
                                            <td class="number-cell"><?php echo $row['wet_quantity']; ?> kg</td>
                                            <td class="number-cell">₱<?php echo $row['wet_price']; ?></td>
                                            <td><?php echo $row['info_lading']; ?></td>
                                            <td><?php echo $row['container']; ?></td>
                                            <td><?php echo $row['packing']; ?></td>
                                            <td><?php echo $row['contact_information']; ?></td>
                                            <td><?php echo $row['destination']; ?></td>
                                            <td><?php echo $row['remarks']; ?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                                    }
                                    else {
                                        echo "Error: " . mysqli_error($con);
                                    }
                                ?>
                            </div>
                            <?php include "sales_modal/wet_modal_sales.php"; ?>

                            <script>
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

        var en_sale_contract_no = data[1]; // Index 1 contains the EN Sale Contract No.
        console.log(en_sale_contract_no);

        // Fetch additional data using AJAX
        $.ajax({
            url: 'fetch/fetch_sales_contract.php',
            type: 'POST',
            data: {
                en_sale_contract_no: en_sale_contract_no
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(data);

                // Fill in the modal with the data from the table row and additional data
                document.getElementById('m_en_sale_contract_no').value = data
                    .en_sale_contract_no;
                document.getElementById('m_buyer_purchase_contract_no').value = data
                    .buyer_purchase_contract_no;
                document.getElementById('m_wet_sale_type').value = data.wet_sale_type;
                document.getElementById('m_wet_ship_date').value = data.wet_ship_date;
                document.getElementById('m_wet_sale_buyer').value = data.wet_sale_buyer;
                document.getElementById('m_shipping_date').value = data.shipping_date;
                document.getElementById('m_wet_quantity').value = data.wet_quantity;
                document.getElementById('m_wet_price').value = data.wet_price;
                document.getElementById('m_sale_destination').value = data.sale_destination;
                document.getElementById('m_info_lading').value = data.info_lading;
                document.getElementById('m_container').value = data.container;
                document.getElementById('m_packing').value = data.packing;
                document.getElementById('m_contact_information').value = data
                    .contact_information;
                document.getElementById('m_destination').value = data.destination;
                document.getElementById('m_remarks').value = data.remarks;

                $('#modalSalesRecord').modal('show');
            }
        });
    });

});
</script>