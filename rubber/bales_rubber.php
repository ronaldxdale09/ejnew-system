<?php
include "include/header.php";
include "include/navbar.php";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    $trans_id = $_GET['id'];
    $trans_id =  preg_replace('~\D~', '', $trans_id);

    $sql = "SELECT * FROM bales_transaction WHERE id = $trans_id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $record = $result->fetch_assoc();

        $contract = isset($record['contract']) ? $record['contract'] : 'SPOT';
        $seller = isset($record['seller']) ? $record['seller'] : '';
        $date = isset($record['date']) ? $record['date'] : '';
        $address = isset($record['address']) ? $record['address'] : '';
        $entry = isset($record['entry']) ? $record['entry'] : 0;
        $lot_code = isset($record['lot_code']) ? $record['lot_code'] : '';
        $total_net_weight = isset($record['total_net_weight']) ? $record['total_net_weight'] : 0;

        $price_1 = isset($record['price_1']) ? $record['price_1'] : 0;
        $first_total = isset($record['first_total']) ? $record['first_total'] : 0;
        $price_2 = isset($record['price_2']) ? $record['price_2'] : 0;
        $second_total = isset($record['second_total']) ? $record['second_total'] : 0;
        $total_amount = isset($record['total_amount']) ? $record['total_amount'] : 0;
        $cash_advance = isset($record['less']) ? $record['less'] : 0;
        $amount_paid = isset($record['amount_paid']) ? $record['amount_paid'] : 0;
        $amount_words = isset($record['words_amount']) ? $record['words_amount'] : '';
        $recorded_by = isset($record['recorded_by']) ? $record['recorded_by'] : '';
        $drc = isset($record['drc']) ? $record['drc'] : 0; // If drc refers to dry rubber content
        $production_id = isset($record['production_id']) ? $record['production_id'] : 0; // If drc refers to dry rubber content
        
        // Debugging code
        echo "
    <script>
        console.log('contract: " . $contract . "');
        console.log('seller: " . $seller . "');
        console.log('date: " . $date . "');
        console.log('address: " . $address . "');
        console.log('entry: " . $entry . "');

        console.log('total_net_weight: " . $total_net_weight . "');

        console.log('price_1: " . $price_1 . "');
        console.log('first_total: " . $first_total . "');
        console.log('price_2: " . $price_2 . "');
        console.log('second_total: " . $second_total . "');
        console.log('total_amount: " . $total_amount . "');
        console.log('cash_advance: " . $cash_advance . "');
        console.log('amount_paid: " . $amount_paid . "');
        console.log('amount_words: " . $amount_words . "');
        console.log('loc: " . $loc . "');
        console.log('recorded_by: " . $recorded_by . "');
        console.log('drc: " . $drc . "');
    </script>
";
        echo "
            <script>
                $(document).ready(function() {
                    $('#invoice').val('" . $trans_id . "');
                    $('#date').val('" . $date . "');
                    $('#contract').val('" . $contract . "');
                    $('#name').val('" . $seller . "').trigger('chosen:updated');

                    $('#lot_code').val('" . $lot_code . "');
                    $('#prod_id').val('" . $production_id . "');
                    $('#address').val('" . $address . "');
                    $('#entry').val('" . $entry . "');
                    $('#total_net_weight').val('" . $total_net_weight . "');
                    $('#price_1').val('" . $price_1 . "');
                    $('#first_total').val('" . $first_total . "');

                    $('#price_2').val('" . $price_2 . "');
                    $('#second_total').val('" . $second_total . "');
                    $('#total_amount').val('" . $total_amount . "');
                    $('#cash_advance').val('" . $cash_advance . "');
                    $('#amount_paid').val('" . $amount_paid . "');
                    $('#amount-paid-words').val('" . $amount_words . "');
                    $('#drc').val('" . $drc . "');

                });
            </script>
        ";
    }



    $_SESSION['transaction'] = 'ONGOING';
    //seller list

    $contract = "SELECT * FROM rubber_contract where type='BALES' AND loc='$loc' AND status='PENDING' OR status='UPDATED' ";
    $c_result = mysqli_query($con, $contract);
    $contractList = "";
    while ($arr = mysqli_fetch_array($c_result)) {
        $contractList .=
            '
        <option value="' .
            $arr["contract_no"] .
            '">[ ' .
            $arr["contract_no"] .
            " ]  " .
            $arr["seller"] .
            "</option>";
    }


    $seller = "SELECT * FROM rubber_seller WHERE loc='$loc' ";
    $result = mysqli_query($con, $seller);
    $sellerList = "";
    while ($arr = mysqli_fetch_array($result)) {
        $sellerList .=
            '<option value="' . $arr["name"] . '">' . $arr["name"] . "</option>";
    }

    $invoice = mysqli_query($con, "SELECT * FROM bales_transaction WHERE loc='$loc' ORDER BY id DESC LIMIT 1");
    $getinvoice = mysqli_fetch_array($invoice);

    if ($getinvoice) {
        $invoiceCount = $getinvoice[0] + 1;
    } else {
        $invoiceCount = 1; // Default value when table is empty
    }


    $month = date("m");
    $day = date("d");
    $year = date("Y");

    $today = $year . "-" . $month . "-" . $day;
}
?>

<body>

    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="container-fluid">
                <div class="page-wrapper">

                    <div class="page-breadcrumb">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <br>
                                <h2 class="page-title"><B>
                                        <font color="#0C0070"> BALES </font>
                                        <font color="#046D56"> PURCHASE </font>
                                    </b></h2>

                            </div>
                            <div class="col-7">
                                <div class="text-end upgrade-btn">
                                    <!-- CONTENT -->
                                    <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#modal_new_transact">New
                                        Transaction</button>
                                    <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#add_seller1"><span class="fa fa-plus text-white"></span>
                                        Add Seller</button>
                                    <button type="button" class="btn btn-info text-white" data-toggle="modal" data-target="#copraCashAdvance1"><span class="fa fa-plus text-white"></span>
                                        New Cash Advance</button>
                                    <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#newContract1"><span class="fa fa-plus text-white"></span>
                                        New Contract</button>


                                </div>
                            </div>
                            <div class="row">
                                <!-- Column -->
                                <div class="col-lg-4 col-xlg-3 col-md-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-text">Transaction Status: <span id='trans_status' class="badge bg-danger">ONGOING</span></h4>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12"></label>
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-default" style='color:black'>ID
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" id='invoice' name='invoice' readonly />
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label class="col-md-12">Date</label>
                                                        <div class="col-md-12 ">
                                                            <input type="date" class='datepicker' id="date" value="<?php echo $today; ?>" name="date">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Contract</label>
                                                <select class='form-select' name='contract' id='contract'>
                                                    <option disabled="disabled">Select Contract </option>
                                                    <option value="SPOT" selected="selected">SPOT </option>
                                                    <?php echo $contractList; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Seller </label>
                                                <select class='select_seller col-md-10' name='name' id='name'>
                                                    <option disabled="disabled" selected="selected">Select Seller
                                                    </option>
                                                    <?php echo $sellerList; ?>
                                                </select>
                                            </div>
                                            <!-- select seller -->
                                            <div class="form-group">
                                                <label class="col-md-12">Address</label>
                                                <div class="col-md-12">
                                                    <input type="text" class='form-control' id="address" name="address">
                                                </div>
                                            </div>
                                            <div id='contract-form'>
                                                <div class="form-group" id='quantity_textbox'>
                                                    <label class="col-md-12">Contract </label>
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-9 col-md-9">
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Quantity</span>
                                                                </div>
                                                                <input type="text" style='text-align:right' name='quantity' id='quantity' class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="form-group" id='balance_textbox'>
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-9 col-md-9">
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>Balance</span>
                                                                </div>
                                                                <input type="text" style='text-align:right' name='balance' id='balance' class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id='cash_advance-form'>
                                                <div class="form-group" id='quantity_textbox'>
                                                    <label class="col-md-12">Cash Advance </label>
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-9 col-md-9">
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="inputGroup-sizing-default" style='color:black;font-weight: bold;'>₱</span>
                                                                </div>
                                                                <input type="text" style='text-align:right' name='total_ca' id='total_ca' class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-success text-white confirm" id='confirm'>Confirm Transaction</button>
                                            <button type="button" class="btn btn-dark text-white receiptBtn" id='receiptBtn'>
                                                <span class="fa fa-print"></span> Print Receipt </button>
                                            <button type="button" class="btn btn-secondary text-white vouchBtn" id='vouchBtn'>
                                                <span class="fa fa-print"></span> Print Voucher </button>

                                        </div>

                                    </div>
                                </div>

                                <!-- Column -->
                                <div class="col-lg-8 col-xlg-9 col-md-7">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container">
                                                <button type="button" class="btn btn-dark text-white btnSelectTrans" id='receiptBtn'>
                                                    <span class="fa fa-book"></span> Select Inventory</button>
                                                <hr>
                                                <!-- -->
                                                <input type="text" class="form-control" id='lot_code' name='lot_code' hidden />
                                                <input type="text" style='text-align:right' name='prod_id' id='prod_id' hidden>
                                                <br>
                                                <div id='selected_inventory_bales'></div> <br>
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <div class="col">
                                                            <label style='font-size:15px' class="col-md-12">Entry
                                                                Weight
                                                                (WET)</label>
                                                            <!-- new column -->
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id='entry' name='entry' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="1" autocomplete='off' readonly />
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
                                                    </div>
                                                    <hr>





                                                    <!--  -->

                                                    <!-- RASE-->
                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <label style='font-size:15px' class="col-md-12">
                                                                Price :</label>
                                                            <div class="col">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">₱</span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name='price_1' id='price_1' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="4" autocomplete='off' />
                                                                </div>
                                                            </div>
                                                            <div class="col">

                                                                <div class="input-group">
                                                                    <input type="text" style='text-align:right' name='weight_1' id='weight_1' class="form-control" readonly>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Kg</span>
                                                                    </div>
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
                                                                    <input type="text" class="form-control" name='price_2' id='price_2' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" tabindex="4" autocomplete='off' disabled />
                                                                </div>
                                                            </div>
                                                            <div class="col">

                                                                <div class="input-group">
                                                                    <input type="text" style='text-align:right' name='weight_2' id='weight_2' class="form-control" readonly>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Kg</span>
                                                                    </div>
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
                                                                    <input type="text" class="form-control" id='total_amount' name='total_amount' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" readonly />

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
                                                                    <input type="text" style='text-align:left' id='cash_advance' name='cash_advance' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control" tabindex="9" autocomplete='off' />
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
                    </div>
                </div>
                <!-- Column -->
            </div>
        </div>
    </div>
</body>

</html>

<script>
    function fetch_record() {
        var purchase_id = <?php echo $trans_id; ?>;
        $.ajax({
            url: "table/bales_purchase_selection.php",
            method: "POST",
            data: {
                purchase_id: purchase_id,

            },
            success: function(data) {
                $('#selected_inventory_bales').html(data);


            }
        });
    }
    fetch_record();
</script>

<script type="text/javascript" src="js/bales_rubber.js"></script>
<script type="text/javascript" src="js/getWords.js"></script>
<?php

include "modal/balesModal.php";
include "modal/balesModalScript.php";
include "modal/balePurchase.php";
include "modal/contractModal.php";
include "modal/cashadvanceModal.php";
include "modal/addseller_modal.php";
include "include/bales_script.php";
?>


<script>
    $(function() {
        $(".select_seller").chosen({
            search_threshold: 10
        });
    });
</script>