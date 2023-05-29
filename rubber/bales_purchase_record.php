<?php 
   include('include/header.php');
   include "include/navbar.php";




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

                        <h1 class="page-title">
                            <b>
                                <font color="#0C0070">BALE </font>
                                <font color="#046D56"> PURCHASE </font>
                            </b>
                        </h1>

                        <br>


                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">
                            <button type="button" class="btn btn-primary text-white" data-toggle="modal"
                                data-target="#createNew">NEW PURCHASE</button>
                            <hr>

                            <div class="table-responsive">
                                <table class="table" id='bales_table'>
                                    <?php
                                    $record  = mysqli_query($con, "SELECT * from bales_transaction   "); ?>
                                    <thead class="table-dark" style='font-size:15px'>
                                        <tr>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Contract</th>
                                            <th scope="col">Mill ID</th>
                                            <th scope="col">Seller</th>
                                            <th scope="col">Lot No.</th>
                                            <th scope="col">Entry Weight</th>
                                            <th scope="col">Net Weight</th>
                                            <th scope="col">First Price</th>
                                            <th scope="col">Second Price</th>
                                            <th scope="col">Cash Advance</th>
                                            <th scope="col">Amount Paid</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style='font-size:17px'> <?php while ($row = mysqli_fetch_array($record)) { ?>
                                        <tr>
                                            <td scope="row"> <?php echo $row['id']?> </td>
                                            <td><?php echo date('M j, Y', strtotime($row['date'])); ?></td>
                                            <td> <?php echo $row['contract']?> </td>
                                            <td scope="row"> </td>
                                            <td> <?php echo $row['seller']?> </td>
                                            <td> <?php echo $row['lot_code']?> </td>
                                            <td style="text-align: right"> <?php echo number_format($row['entry'])?> kg
                                            </td>
                                            <td style="text-align: right"> <?php 
                                                    $total_weight = $row['net_weight_1'] +  $row['net_weight_2'];          
                                                    echo number_format($total_weight);?> kg </td>
                                            <td style="text-align: right">₱
                                                <?php echo number_format($row['price_1'],2)?> </td>
                                            <td style="text-align: right">₱
                                                <?php echo number_format($row['price_2'],2)?> </td>
                                            <td style="text-align: right">₱ <?php echo number_format($row['less'],0)?>
                                            </td>
                                            <td style="text-align: right">₱
                                                <?php echo number_format(($row['amount_paid']),0); ?> </td>
                                            <td> <button type="button" class="btn btn-dark btnView"><i
                                                        class="fa fa-eye"></i></button>
                                                <button type="button" class="btn btn-danger btnBalesDelete"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr> <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tfoot>

                                </table>
                            </div>

                            <script>
                            $(document).ready(function() {
                                var table = $('#wet_record_table').DataTable({
                                    "order": [
                                        [1, 'asc']
                                    ],
                                    "pageLength": -1,
                                    "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                                        "<'row'<'col-sm-12'tr>>" +
                                        "<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",
                                    "responsive": true,
                                    "buttons": [{
                                            extend: 'excelHtml5',
                                            text: 'Excel',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            text: 'PDF',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        },
                                        {
                                            extend: 'print',
                                            text: 'Print',
                                            exportOptions: {
                                                columns: ':visible'
                                            }
                                        }
                                    ]
                                });
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
<div class="modal fade" id="createNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Bales Purchase</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/balesPurchasing.php'>
                <div class="modal-body">
                    <input type="text" class="form-control" id="d_id" name='dry_id' hidden>
                    <p class="text-center text-success"><i class="fa fa-plus-circle" style="font-size:3em;"></i>
                    </p>
                    <p class="text-center">Proceed to Cuplump Purchasing</p>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="recorded_by">Recorded By</label>
                        <input type="text" class="form-control" id="recorded_by" name="recorded_by"
                            value="<?php echo $user_name ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name='new'>Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="viewRecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Purchase Record</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/wetPurchasing.php'>
                <div class="modal-body">
                    <input type="text" class="form-control" id="w_id" name='id' hidden>
                    <div class="row">
                        <div class="col-lg-4 col-xlg-3 col-md-5">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="col-md-12">Reference #</label>
                                                <div class="col-md-12">
                                                    <input type="number" id='v_invoice'
                                                        class="form-control form-control-line" readonly>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Date</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="v_date" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Contract</label>
                                        <input type="text" id='v_contract' class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-md-12">Seller</label>
                                                <input type="text" id='v_seller' class="form-control" readonly>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Address</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id='address' name='address'
                                                tabindex="2" autocomplete='off' readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xlg-9 col-md-7">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Gross Weight
                                                        (Kilos)</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='gross' name='gross'
                                                            tabindex="2" autocomplete='off' readonly />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Deductable Tare
                                                        Kilos</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='tare' name='tare'
                                                            tabindex="3" readonly autocomplete='off' />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Net Weight</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" style='text-align:right' name='net' id='net'
                                                            class="form-control" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <hr>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px' class="col-md-12">1st Price :</label>
                                                <div class="col-12 col-sm-5 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" class="form-control" name='first_price'
                                                            id='first_price' readonly />
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <input type="text" style='text-align:right' id='first-weight'
                                                            class="form-control" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' id='first_total'
                                                            name='first_total' class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px' class="col-md-12">2nd Price :</label>
                                                <div class="col-12 col-sm-5 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" class="form-control" id='second_price'
                                                            name='second_price' tabindex="8" autocomplete='off'
                                                            readonly />
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <input type="text" style='text-align:right' id='second-weight'
                                                            class="form-control" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='second_total'
                                                            id='second_total' class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <div class="col-12 ">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroup-sizing-default"
                                                                style='color:black;font-weight: bold;'>Total Amount
                                                                ₱</span>
                                                        </div>
                                                        <input type="text" class="form-control" id='total-amount'
                                                            name='total-amount' readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <div class="col-12">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroup-sizing-default"
                                                                style='color:black;font-weight: bold;'>Less: Cash Adance
                                                                ₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:left' id='cash_advance'
                                                            name='cash_advance' class="form-control" tabindex="9"
                                                            autocomplete='off' readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <div class="col-12">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroup-sizing-default"
                                                                style='color:black;font-weight: bold;'>Amount Paid
                                                                ₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:left' name='amount-paid'
                                                            id='amount-paid' class="form-control" readonly>
                                                    </div>
                                                    <hr>
                                                    <input type="text" style='text-align:center' id='amount-paid-words'
                                                        class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name='edit'>Edit</button>
                    <button type="button" class="btn btn-danger" name='remove' id='removeBtn'>Remove</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Confirmation Modal -->
<div class="modal" id="confirmationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="confirmRemoveBtn">Yes, Remove</button>
            </div>
        </div>
    </div>
</div>

<script>
$('.wetBtnView').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    var id = $(this).data('id');
    var contract = $(this).data('contract');
    var date = $(this).data('date');
    var seller = $(this).data('seller');
    var address = $(this).data('address');
    var gross = $(this).data('gross');
    var tare = $(this).data('tare');
    var net_weight = $(this).data('net_weight');
    var price_1 = $(this).data('price_1');
    var price_2 = $(this).data('price_2');
    var total_weight_1 = $(this).data('total_weight_1');
    var total_weight_2 = $(this).data('total_weight_2');
    var total_amount = $(this).data('total_amount');
    var less = $(this).data('less');
    var amount_paid = $(this).data('amount_paid');
    var amount_words = $(this).data('amount_words');

    $('#v_invoice').val(id.toLocaleString());
    $('#w_id').val(id.toLocaleString());
    $('#v_contract').val(contract);
    $('#v_date').val(date);
    $('#v_seller').val(seller);
    $('#address').val(address);
    $('#gross').val(gross.toLocaleString());
    $('#tare').val(tare.toLocaleString());
    $('#net').val(net_weight.toLocaleString());
    $('#first_price').val(price_1.toLocaleString());
    $('#first-weight').val(total_weight_1.toLocaleString());
    $('#first_total').val((price_1 * total_weight_1).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#second_price').val(price_2.toLocaleString());
    $('#second-weight').val(total_weight_2.toLocaleString());
    $('#second_total').val((price_2 * total_weight_2).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
    $('#total-amount').val(total_amount.toLocaleString());
    $('#cash_advance').val(less.toLocaleString());
    $('#amount-paid').val(amount_paid.toLocaleString());
    $('#amount-paid-words').val(amount_words);

    $('#viewRecord').modal('show');
});

$('#removeBtn').click(function() {
    $('#confirmationModal').modal('show'); // Open the confirmation modal
});
</script>