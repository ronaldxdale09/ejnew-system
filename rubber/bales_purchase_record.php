<?php
include('include/header.php');
include "include/navbar.php";
$loc = str_replace(' ', '', $_SESSION['loc']);


$sql = "SELECT * FROM rubber_seller ";
$result = mysqli_query($con, $sql);
$supplierList = '';
while ($arr = mysqli_fetch_array($result)) {
    $supplierList .= '
   
   <option value="' . $arr["name"] . '">' . $arr["name"] . '</option>';
}



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
                        <center>
                            <h1 class="page-title">
                                <b>
                                    <font color="#0C0070">BALE </font>
                                    <font color="#046D56"> PURCHASING </font>
                                </b>
                            </h1>

                        </center>

                        <br>


                        <div class="container-fluid shadow p-3 mb-5 bg-white rounded">


                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#createNew">NEW PURCHASE</button>
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="dropdown">
                                        <button class="btn btn-warning dropdown-toggle" type="button" id="dateDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 200px;">
                                            Select Date
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dateDropdown">
                                            <button class="dropdown-item" id="today">Today</button>
                                            <button class="dropdown-item" id="this-week">This Week</button>
                                            <button class="dropdown-item" id="this-month">This Month</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class='form-control' id="min" name="min" style="width: 150px;" autocomplete="off" placeholder="From Date:">
                                        </div>
                                        <div class="col">
                                            <input type="text" class='form-control' id="max" name="max" style="width: 150px;" autocomplete="off" placeholder="To Date:">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover table-striped" id='bales_purchase_table'>
                                    <?php
                                    $record  = mysqli_query($con, "SELECT * from bales_transaction where loc='$loc' ORDER BY id DESC"); ?>
                                    <thead class="table-dark" style='font-size:15px'>
                                        <tr>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Contract</th>
                                            <th scope="col">Seller</th>
                                            <th scope="col">Lot No.</th>
                                            <th scope="col">Entry Weight</th>
                                            <th scope="col">Net Weight</th>
                                            <th scope="col"> Price</th>
                                            <th scope="col">Cash Advance</th>
                                            <th scope="col">Amount Paid</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style='font-size:17px'> <?php while ($row = mysqli_fetch_array($record)) {


                                                                    ?>
                                            <tr>
                                                <td scope="row"> <?php echo $row['id'] ?> </td>
                                                <td><?php echo date('M j, Y', strtotime($row['date'])); ?></td>
                                                <td> <?php echo $row['contract'] ?> </td>
                                                <td> <?php echo $row['seller'] ?> </td>
                                                <td> <?php echo $row['lot_code'] ?> </td>
                                                <td style="text-align: right"> <?php echo number_format($row['entry']) ?> kg
                                                </td>
                                                <td style="text-align: right"> <?php
                                                                                echo number_format($row['total_net_weight']); ?> kg </td>

                                                <td style="text-align: right">₱
                                                    <?php echo number_format($row['price_1'], 2) ?> </td>
                                                </td>
                                                <td style="text-align: right">₱ <?php echo number_format($row['less'], 0) ?>
                                                </td>
                                                <td style="text-align: right">₱
                                                    <?php echo number_format(($row['amount_paid']), 0); ?> </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary btnView" data-id="<?php echo $row['id']; ?>" data-invoice="<?php echo $row['invoice']; ?>" data-date="<?php echo $row['date']; ?>" data-address="<?php echo $row['address']; ?>" data-contract="<?php echo $row['contract']; ?>" data-seller="<?php echo $row['seller']; ?>" data-delivery_date="<?php echo $row['delivery_date']; ?>" data-lot_code="<?php echo $row['lot_code']; ?>" data-entry="<?php echo $row['entry']; ?>" data-total_net_weight="<?php echo $row['total_net_weight']; ?>" data-drc="<?php echo $row['drc']; ?>" data-price_1="<?php echo $row['price_1']; ?>" data-price_2="<?php echo $row['price_2']; ?>" data-first_total="<?php echo $row['first_total']; ?>" data-second_total="<?php echo $row['second_total']; ?>" data-total_amount="<?php echo $row['total_amount']; ?>" data-less="<?php echo $row['less']; ?>" data-amount_paid="<?php echo $row['amount_paid']; ?>" data-words_amount="<?php echo $row['words_amount']; ?>" data-loc="<?php echo $row['loc']; ?>" data-production_id="<?php echo $row['production_id']; ?>" data-recorded_by="<?php echo $row['recorded_by']; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
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

                                    $.fn.dataTable.ext.search.push(
                                        function(settings, data, dataIndex) {
                                            var min = $('#min').datepicker("getDate");
                                            var max = $('#max').datepicker("getDate");

                                            if (max) {
                                                // set max to the next day at 00:00:00.000
                                                max.setDate(max.getDate() + 1);
                                                max.setHours(0, 0, 0, 0);
                                            }

                                            var startDate = new Date(data[1]);

                                            if (min == null && max == null) return true;
                                            if (min == null && startDate < max) return true; // change <= to <
                                            if (max == null && startDate >= min) return true;
                                            if (startDate < max && startDate >= min) return true; // change <= to <
                                            return false;
                                        }
                                    );

                                    $(document).ready(function() {
                                        $('.dropdown-item').click(function() {
                                            var selected = $(this).text(); // gets the text of the clicked item
                                            $('#dateDropdown').text(selected); // sets the button text
                                        });
                                    });
                                    var table = $('#bales_purchase_table').DataTable({
                                        "order": [
                                            [1, 'desc']
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





                                    $("#min").datepicker({
                                        onSelect: function() {
                                            table.draw();
                                        },
                                        changeMonth: true,
                                        changeYear: true
                                    });
                                    $("#max").datepicker({
                                        onSelect: function() {
                                            table.draw();
                                        },
                                        changeMonth: true,
                                        changeYear: true
                                    });

                                    // Event listener to the two range filtering inputs to redraw on input
                                    $('#min, #max').change(function() {
                                        table.draw();
                                    });

                                    // Quick date filters
                                    $('#today').on('click', function() {
                                        var today = new Date();
                                        $('#min, #max').datepicker('setDate', today);
                                        table.draw();
                                    });

                                    $('#this-week').on('click', function() {
                                        var today = new Date();
                                        var firstDayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today
                                            .getDay());
                                        $('#min').datepicker('setDate', firstDayOfWeek);
                                        $('#max').datepicker('setDate', today);
                                        table.draw();
                                    });

                                    $('#this-month').on('click', function() {
                                        var today = new Date();
                                        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                                        $('#min').datepicker('setDate', firstDayOfMonth);
                                        $('#max').datepicker('setDate', today);
                                        table.draw();
                                    });

                                    $('#category_filter').on('change', function() {
                                        var tosearch = this.value;
                                        table.search(tosearch).draw();
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
                        <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="recorded_by">Recorded By</label>
                        <input type="text" class="form-control" id="recorded_by" name="recorded_by" value="<?php echo $user_name ?>">
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
            <form method='POST' action='function/balesPurchasing.php'>
                <div class="modal-body">
                    <input type="text" class="form-control" id="w_id" name='id' hidden>
                    <div class="row">
                        <div class="col-lg-4 col-xlg-3 col-md-5">
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label style='font-size:15px' class="col-md-12"></label>
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-default" style='color:black'>ID
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id='recording_id' name='recording_id' readonly />
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label class="col-md-12">Date</label>
                                                <div class="col-md-12 ">
                                                    <input type="text" class="form-control" id="v_date" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Contract</label>
                                        <input type="text" class="form-control" id='contract' readonly />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Seller </label>
                                        <input type="text" class="form-control" id='name' readonly />
                                    </div>
                                    <!-- select seller -->
                                    <div class="form-group">
                                        <label class="col-md-12">Address</label>
                                        <div class="col-md-12">
                                            <input type="text" class='form-control' id="address" name="address" readonly>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xlg-9 col-md-7">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">

                                        <!-- -->
                                        <div id='selected_inventory'> </div>
                                        <br>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Entry
                                                        Weight
                                                        (WET)</label>
                                                    <!-- new column -->
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id='entry' name='entry' readonly />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">DRC</label>
                                                    <div class="input-group">

                                                        <input type="text" style='text-align:right' name='drc' id='drc' class="form-control" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Total Net
                                                        Weight</label>
                                                    <div class="input-group">

                                                        <input type="text" style='text-align:right' name='total_net_weight' id='total_net_weight' class="form-control" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col" hidden>
                                                    <input type="text" class="form-control" id='bales_compute' name='bales_compute' hidden />
                                                    <!--  end-->
                                                </div>
                                            </div>
                                            <hr>





                                            <!--  -->

                                            <!-- RASE-->
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <label style='font-size:15px' class="col-md-12">SPOT
                                                        Price
                                                        :</label>
                                                    <div class="col">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text" class="form-control" name='price_1' id='price_1' readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group mb">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text" style='text-align:right' id='first_total' class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <label style='font-size:15px' class="col-md-12">Contact
                                                        Price
                                                        :</label>
                                                    <div class="col">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text" class="form-control" name='price_2' id='price_2' readonly />
                                                        </div>
                                                    </div>
                                                    <!--  -->
                                                    <div class="col">
                                                        <!-- new column -->
                                                        <div class="input-group mb-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text" style='text-align:right' id='second_total' class="form-control" readonly>

                                                        </div>
                                                        <!--  -->
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <!-- start-->
                                            <!-- RASE 3-->

                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col">
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Total
                                                                    Amount ₱</span>
                                                            </div>
                                                            <input type="text" class="form-control" id='total_amount' name='total_amount' readonly />

                                                        </div>
                                                        <!--  -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col">
                                                        <!--  -->
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Less:
                                                                    Cash Advance
                                                                    ₱</span>
                                                            </div>
                                                            <input type="text" style='text-align:left' class="form-control" id='cash_advance' name='cash_advance' readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col">
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Amount
                                                                    Paid ₱</span>
                                                            </div>
                                                            <input type="text" style='text-align:left' name='amount_paid' id='amount_paid' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control" readonly />

                                                        </div>
                                                        <hr>
                                                        <input type="text" style='text-align:center' name='amount-paid-words' id='amount-paid-words' class="form-control" readonly>
                                                        <!--  -->
                                                    </div>
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
<div class="modal fade" id="confirmationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method='POST' action='function/balesPurchasing.php'>
                <div class="modal-body">
                    <input type="text" class="form-control" id="remove_id" name='id' hidden>

                    <p>Are you sure you want to remove?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger" name="remove">Yes, Remove</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.btnView').on('click', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        var id = $(this).data('id');
        var invoice = $(this).data('invoice');
        var date = $(this).data('date');
        var address = $(this).data('address');
        var contract = $(this).data('contract');
        var seller = $(this).data('seller');
        var delivery_date = $(this).data('delivery_date');
        var lot_code = $(this).data('lot_code');
        var entry = $(this).data('entry');
        var net_weight_1 = $(this).data('net_weight_1');
        var net_weight_2 = $(this).data('net_weight_2');
        var total_net_weight = $(this).data('total_net_weight');
        var kilo_bales_1 = $(this).data('kilo_bales_1');
        var kilo_bales_2 = $(this).data('kilo_bales_2');
        var total_bales_1 = $(this).data('total_bales_1');
        var total_bales_2 = $(this).data('total_bales_2');
        var bales_compute = $(this).data('bales_compute');
        var drc = $(this).data('drc');
        var price_1 = $(this).data('price_1');
        var price_2 = $(this).data('price_2');
        var first_total = $(this).data('first_total');
        var second_total = $(this).data('second_total');
        var total_amount = $(this).data('total_amount');
        var less = $(this).data('less');
        var amount_paid = $(this).data('amount_paid');
        var words_amount = $(this).data('words_amount');
        var loc = $(this).data('loc');
        var production_id = $(this).data('production_id');
        var recorded_by = $(this).data('recorded_by');

        function fetch_record() {
            var purchase_id = id;
            $.ajax({
                url: "table/bales_purchase_selection.php",
                method: "POST",
                data: {
                    purchase_id: purchase_id,

                },
                success: function(data) {
                    $('#selected_inventory').html(data);


                }
            });
        }
        fetch_record();





        $('#recording_id').val(id);
        $('#v_date').val(date);
        $('#contract').val(contract);
        $('#name').val(seller);
        $('#address').val(address);
        $('#total_ca').val(total_amount); // I'm not sure which field corresponds to 'total_ca' 
        $('#net_weight_1').val(net_weight_1);
        $('#kilo_bales_1').val(kilo_bales_1);
        $('#total_bales_1').val(total_bales_1);
        $('#net_weight_2').val(net_weight_2);
        $('#kilo_bales_2').val(kilo_bales_2);
        $('#total_bales_2').val(total_bales_2);
        $('#entry').val(entry);
        $('#drc').val(drc);
        $('#total_net_weight').val(total_net_weight);
        $('#bales_compute').val(bales_compute);
        $('#price_1').val(price_1);
        $('#first_total').val(first_total);
        $('#price_2').val(price_2);
        $('#second_total').val(second_total);
        $('#total_amount').val(total_amount);
        $('#cash_advance').val(less); // I'm not sure which field corresponds to 'cash_advance'
        $('#amount_paid').val(amount_paid);
        $('#amount-paid-words').val(words_amount);
        $('#viewRecord').modal('show');
    });

    $('#removeBtn').click(function() {
        var id = $('#recording_id').val(); // get the id from viewRecord modal
        $('#remove_id').val(id); // set the id to the confirmationModal
        $('#confirmationModal').modal('show'); // Open the confirmation modal
    });
</script>