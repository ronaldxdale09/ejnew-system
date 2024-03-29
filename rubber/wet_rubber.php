<?php
include "include/header.php";
include "include/navbar.php";


if (isset($_GET['id'])) {
  
    $trans_id = $_GET['id'];
    $trans_id=  preg_replace('~\D~', '', $trans_id);

    $sql = "SELECT * FROM rubber_transaction WHERE id = $trans_id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $record = $result->fetch_assoc();
        
            
        $invoice = isset($record['id']) ? $record['id'] : '';
        $contract = isset($record['contract']) && !empty($record['contract']) ? $record['contract'] : 'SPOT';
        $seller = isset($record['seller']) ? $record['seller'] : '';
        $date = isset($record['date']) ? $record['date'] : '';

        $address = isset($record['address']) ? $record['address'] : '';
        $gross = isset($record['gross']) ? $record['gross'] : 0;
        $tare = isset($record['tare']) ? $record['tare'] : 0;
        $net_weight = isset($record['net_weight']) ? $record['net_weight'] : 0;
        $price_1 = isset($record['price_1']) ? $record['price_1'] : 0;
        $price_2 = isset($record['price_2']) ? $record['price_2'] : 0;
        $total_weight_1 = isset($record['total_weight_1']) ? $record['total_weight_1'] : 0;
        $total_weight_2 = isset($record['total_weight_2']) ? $record['total_weight_2'] : 0;
        $total_amount = isset($record['total_amount']) ? $record['total_amount'] : 0;
        $less = isset($record['less']) ? $record['less'] : 0;
        $amount_paid = isset($record['amount_paid']) ? $record['amount_paid'] : 0;
        $amount_words = isset($record['amount_words']) ? $record['amount_words'] : '';
        $type = isset($record['type']) ? $record['type'] : '';
        $loc = isset($record['loc']) ? $record['loc'] : '';
        $planta_status = isset($record['planta_status']) ? $record['planta_status'] : '';
        $supplier_type = isset($record['supplier_type']) ? $record['supplier_type'] : '';
        $recorded_by = isset($record['recorded_by']) ? $record['recorded_by'] : '';

        $first_total = $total_weight_1 * $price_1;
        $sec_total = $total_weight_2 * $price_2;
      
        echo "
            <script>
                $(document).ready(function() {
                    
                    $('#invoice').val('" . $invoice . "');
                    $('#name').val('" . $seller . "').trigger('chosen:updated');
                    $('#contract').val('" . $contract . "');
                    $('#address').val('" . $address . "');

                    $('#gross').val('" . $gross . "');
                    $('#tare').val('" . $tare . "');
                    $('#net').val('" . $net_weight . "');
                    $('#first_price').val('" . $price_1 . "');
                    $('#first-weight').val('" . $total_weight_1 . "');
                    $('#first_total').val('" . $first_total . "');

                    $('#second_price').val('" . $price_2 . "');
                    $('#second-weight').val('" . $total_weight_2 . "');
                    $('#second_total').val('" . $sec_total . "');

                    
                    $('#total-amount').val('" . $total_amount . "');
                    $('#cash_advance').val('" . $less . "');
                    $('#amount-paid').val('" . $amount_paid . "');
                    $('#amount-paid-words').val('" . $amount_words . "');


                });
            </script>
        ";
    } 


$_SESSION['transaction'] ='ONGOING';
//seller list

$contract = "SELECT * FROM rubber_contract where loc='$loc' and type='WET' AND status='PENDING' OR status='UPDATED' ";
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


$seller = "SELECT * FROM rubber_seller   where loc='$loc'";
$result = mysqli_query($con, $seller);
$sellerList = "";
while ($arr = mysqli_fetch_array($result)) {
    $sellerList .=
        '<option value="' .$arr["name"] .'">'.$arr["name"] ."</option>";
}



$month = date("m");
$day = date("d");
$year = date("Y");

$today = $year . "-" . $month . "-" . $day;


}
?>
<style>
.border-box {
    border: 1px solid #000;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.big-checkbox .form-check-input {
    transform: scale(1.5);
    /* Adjust size as needed */
}
</style>

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
                                        <font color="#0C0070"> CUPLUMP </font>
                                        <font color="#046D56"> PURCHASE </font>
                                    </b></h2>
                            </div>
                            <div class="text-end col">
                                <button type="button" class="btn btn-dark text-white receiptBtn" id='receiptBtn'>
                                    <span class="fa fa-print"></span> Print Receipt </button>
                                <button type="button" class="btn btn-secondary text-white vouchBtn" id='vouchBtn'>
                                    <span class="fa fa-print"></span> Print Voucher </button>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-4 col-xlg-3 col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-text">Transaction Status: <span id='trans_status'
                                                        class="badge bg-danger">ONGOING</span></h4>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-md-12">Purchase ID</label>
                                                    <div class="col-md-12">
                                                        <input type="number" name='invoice' id='invoice'
                                                            class="form-control form-control-line" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-md-12">Date</label>
                                                    <div class="col-md-12 ">
                                                        <input type="date" class='datepicker' id="date"
                                                            value="<?php echo isset($record['date']) ? $record['date'] : $today ?>"
                                                            name="date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label class="col-md-12">Contract</label>
                                            <select class='form-select' name='contract' id='contract'>
                                                <option disabled="disabled">Select Contract </option>
                                                <option value="SPOT" selected="selected">SPOT </option>
                                                <?php echo $contractList; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="col-md-12">Seller </label>
                                                    <select class='select_seller col-md-12' name='name' id='name'>
                                                        <option disabled="disabled" selected="selected">
                                                            Select
                                                            Seller
                                                        </option>
                                                        <?php echo $sellerList; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="col-md-12"> </label>
                                                    <div class="form-check big-checkbox  ">
                                                        <input class="form-check-input" type="checkbox"
                                                            id='supplier_check'>
                                                        <label class="form-check-label" for="exampleCheckbox">
                                                            <b>EJN RUBBER </b> <i>(Check only if inventory is EJN
                                                                Rubber)</i></label>
                                                        <input type="text" name='supplier_type' id='supplier_type'
                                                            hidden>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- select seller -->
                                        <div class="form-group">
                                            <label class="col-md-12">Address</label>
                                            <div class="col-md-12">
                                                <input name="address" id="address" class="form-control" readonly>
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
                                                                <span class="input-group-text"
                                                                    id="inputGroup-sizing-default"
                                                                    style='color:black;font-weight: bold;'>Quantity</span>
                                                            </div>
                                                            <input type="text" style='text-align:right' name='quantity'
                                                                id='quantity' class="form-control" readonly>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">kg</span>
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
                                                                <span class="input-group-text"
                                                                    id="inputGroup-sizing-default"
                                                                    style='color:black;font-weight: bold;'>Balance</span>
                                                            </div>
                                                            <input type="text" style='text-align:right' name='balance'
                                                                id='balance' class="form-control" readonly>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">kg</span>
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
                                                        <!--  -->
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="inputGroup-sizing-default"
                                                                    style='color:black;font-weight: bold;'>₱</span>
                                                            </div>
                                                            <input type="text" style='text-align:right' name='total_ca'
                                                                id='total_ca' class="form-control" readonly>
                                                        </div>
                                                        <!--  -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div> <br>
                                <div class="col">
                                    <div class="text-center upgrade-btn">
                                        <!-- CONTENT -->
                                        <button type="button" class="btn btn-secondary text-white" data-toggle="modal"
                                            data-target="#add_seller1"><span class="fa fa-plus text-white"></span>
                                            New Seller</button>
                                        <button type="button" class="btn btn-info text-white" data-toggle="modal"
                                            data-target="#copraCashAdvance1"><span class="fa fa-plus text-white"></span>
                                            New CA</button>
                                        <button type="button" class="btn btn-dark text-white" data-toggle="modal"
                                            data-target="#newContract1"><span class="fa fa-plus text-white"></span>
                                            New Contract</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Column -->
                            <div class="col-lg-8 col-xlg-9 col-md-7">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="container">
                                            <!-- -->
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12">Gross Weight
                                                            (Kilos)</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id='gross'
                                                                name='gross' required onkeypress="return CheckNumeric()"
                                                                onkeyup="FormatCurrency(this)" tabindex="2"
                                                                autocomplete='off' />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">kg</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12">Deductable
                                                            Tare Kilos</label>
                                                        <!-- new column -->
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id='tare'
                                                                name='tare' onkeypress="return CheckNumeric()"
                                                                onkeyup="FormatCurrency(this)" tabindex="3" value='0'
                                                                autocomplete='off' />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">kg</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <label style='font-size:15px' class="col-md-12">
                                                            Net Weight</label>
                                                        <div class="input-group mb-1">
                                                            <input type="text" style='text-align:right' name='net'
                                                                id='net' class="form-control" readonly>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">kg</span>
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>


                                            <!--  -->

                                            <!-- RASE-->
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <label style='font-size:15px' class="col-md-12">1st
                                                        Price
                                                        :</label>
                                                    <div class="col-12 col-sm-5 col-md-4">
                                                        <!--  -->
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text" class="form-control" name='first_price'
                                                                id='first_price' onkeypress="return CheckNumeric()"
                                                                onkeyup="FormatCurrency(this)" tabindex="7"
                                                                autocomplete='off' required />
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-4">
                                                        <div class="input-group mb-3">

                                                            <input type="text" style='text-align:right'
                                                                id='first-weight' class="form-control" readonly>
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
                                                    <label style='font-size:15px' class="col-md-12">2nd
                                                        Price
                                                        :</label>
                                                    <div class="col-12 col-sm-5 col-md-4">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text" class="form-control" id='second_price'
                                                                name='second_price' onkeypress="return CheckNumeric()"
                                                                onkeyup="FormatCurrency(this)" tabindex="8"
                                                                autocomplete='off' readonly />
                                                        </div>
                                                    </div>

                                                    <div class="col-6 col-md-4">
                                                        <div class="input-group mb-3">
                                                            <input type="text" style='text-align:right'
                                                                id='second-weight' class="form-control" readonly>
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
                                                            <input type="text" style='text-align:right'
                                                                name='second_total' id='second_total'
                                                                class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <!-- start-->
                                            <!-- RASE 3-->
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col-12">
                                                        <!--  -->
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="inputGroup-sizing-default"
                                                                    style='color:black;font-weight: bold;'>Total
                                                                    Amount ₱</span>
                                                            </div>
                                                            <input type="text" class="form-control" id='total-amount'
                                                                name='total-amount' onkeypress="return CheckNumeric()"
                                                                onkeyup="FormatCurrency(this)" readonly />

                                                        </div>
                                                        <!--  -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col-12 ">
                                                        <!--  -->
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="inputGroup-sizing-default"
                                                                    style='color:black;font-weight: bold;'>Less:
                                                                    Cash Advance
                                                                    ₱</span>
                                                            </div>
                                                            <input type="text" style='text-align:left' id='cash_advance'
                                                                name='cash_advance' onkeypress="return CheckNumeric()"
                                                                onkeyup="FormatCurrency(this)" class="form-control"
                                                                tabindex="9" autocomplete='off' value='0' />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col-12 ">
                                                        <div class="input-group mb-1">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="inputGroup-sizing-default"
                                                                    style='color:black;font-weight: bold;'>Amount
                                                                    Paid ₱</span>
                                                            </div>
                                                            <input type="text" style='text-align:left'
                                                                name='amount-paid' id='amount-paid'
                                                                onkeypress="return CheckNumeric()"
                                                                onkeyup="FormatCurrency(this)" class="form-control"
                                                                readonly />
                                                        </div>
                                                        <hr>
                                                        <input type="text" style='text-align:center'
                                                            name='amount-paid-words' id='amount-paid-words'
                                                            class="form-control" readonly>
                                                        <!--  -->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div> <br>
                                <div class="row">
                                    <div class="text-end col-12">
                                        <button type="button" class="btn btn-success text-white confirm"
                                            id='confirm'>Confirm Transaction</button>
                                        <button type="button" class="btn btn-primary text-white" data-toggle="modal"
                                            data-target="#modal_new_transact">New
                                            Transaction</button>
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
</body>
<script type="text/javascript" src="js/wet_rubber.js"></script>

</html>

<script>
$(document).ready(function() {
    $('#supplier_check').on('change', function() {
        var supplierType = $(this).prop('checked') ? "1" : "0";
        $('#supplier_type').val(supplierType);
    });
});
</script>

<?php

include "modal/transactionModal.php";
include "modal/wetModalScript.php";

include "modal/contractModal.php";
include "modal/cashadvanceModal.php";
include "modal/addseller_modal.php";
include "include/script.php";
?>


<script>
$(function() {
    $(".select_seller").chosen({
        search_threshold: 10
    });
});
</script>