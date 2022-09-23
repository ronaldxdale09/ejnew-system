<?php
include "include/header.php";
include "include/navbar.php";



if (isset($_GET['view'])) {
    $_SESSION['transaction'] ='ONGOING';
    $view = $_GET['view'];

    $sql = mysqli_query($con, "SELECT  * from rubber_transaction where invoice='$view'  ");
    $record = mysqli_fetch_array($sql);

    $invoiceCount = $record['invoice'];
    $today= $record['date'];

    $contract = "SELECT * FROM rubber_contract where type='BALES' AND status='PENDING' OR status='UPDATED' ";
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


    $seller = "SELECT * FROM rubber_seller ";
    $result = mysqli_query($con, $seller);
    $sellerList = "";
    while ($arr = mysqli_fetch_array($result)) {
        $sellerList .=
            '<option value="' .$arr["name"] .'">[ '.$arr["name"] ."</option>";
    }

  }
  
  else {
$_SESSION['transaction'] ='ONGOING';
//seller list

$contract = "SELECT * FROM rubber_contract where type='BALES' AND  status='PENDING' OR status='UPDATED' ";
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


$seller = "SELECT * FROM rubber_seller ";
$result = mysqli_query($con, $seller);
$sellerList = "";
while ($arr = mysqli_fetch_array($result)) {
    $sellerList .=
        '<option value="' .$arr["name"] .'">'.$arr["name"] ."</option>";
}

$invoice = mysqli_query($con, "SELECT  COUNT(*) from rubber_transaction  ");
$getinvoice = mysqli_fetch_array($invoice);

$invoiceCount = sprintf("%'03d", $getinvoice[0]+1);

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
                                        <font color="#0C0070"> BALES RUBBER </font>
                                        <font color="#046D56"> PURCHASING </font>
                                    </b></h2>

                            </div>
                            <div class="col-7">
                                <div class="text-end upgrade-btn">
                                    <!-- CONTENT -->
                                    <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                        data-target="#add_seller1"><span class="fa fa-plus text-white"></span>
                                        Add Seller</button>
                                    <button type="button" class="btn btn-info text-white" data-toggle="modal"
                                        data-target="#copraCashAdvance1"><span class="fa fa-plus text-white"></span>
                                        New Cash Advance</button>
                                    <button type="button" class="btn btn-dark text-white" data-toggle="modal"
                                        data-target="#newContract1"><span class="fa fa-plus text-white"></span>
                                        New Contract</button>


                                </div>
                            </div>
                            <div class="row">
                                <!-- Column -->
                                <div class="col-lg-3 col-xlg-3 col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <h4>Status : </h4>
                                                    </td>
                                                    <td>
                                                        <h5><span id='trans_status'
                                                                class="badge alert-danger">ONGOING</span></h5>

                                                    </td>

                                                </tr>
                                            </table>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Reference #</label>
                                                        <div class="col-md-12">
                                                            <input type="number" name='invoice' id='invoice'
                                                                value="<?php echo "$invoiceCount"; ?>"
                                                                class="form-control form-control-line" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <label class="col-md-12"></label>
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn btn-primary text-white"
                                                                data-toggle="modal"
                                                                data-target="#modal_new_transact">New
                                                                Transaction</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Date</label>
                                                <div class="col-md-12 ">
                                                    <input type="date" class='datepicker' id="date"
                                                        value="<?php echo $today; ?>" name="date">
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
                                                    <select name="address" id="address" class="form-control"
                                                        disabled></select>
                                                </div>
                                            </div>
                                            <hr>
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
                                                                <input type="text" style='text-align:right'
                                                                    name='quantity' id='quantity' class="form-control"
                                                                    readonly>
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
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'>Balance</span>
                                                                </div>
                                                                <input type="text" style='text-align:right'
                                                                    name='balance' id='balance' class="form-control"
                                                                    readonly>
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
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'>₱</span>
                                                                </div>
                                                                <input type="text" style='text-align:right'
                                                                    name='total_ca' id='total_ca' class="form-control"
                                                                    readonly>
                                                            </div>
                                                            <!--  -->
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-success text-white confirm"
                                                id='confirm'>Confirm Transaction</button>
                                            <button type="button" class="btn btn-dark text-white receiptBtn"
                                                id='receiptBtn'>
                                                <span class="fa fa-print"></span> Print Receipt </button>
                                            <button type="button" class="btn btn-secondary text-white vouchBtn"
                                                id='vouchBtn'>
                                                <span class="fa fa-print"></span> Print Voucher </button>

                                        </div>

                                    </div>
                                </div>

                                <!-- Column -->
                                <div class="col-lg-9 col-xlg-9 col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container">
                                                <!-- -->
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-md-3">
                                                            <label style='font-size:15px' class="col-md-12">Entry Weight
                                                                (WET)</label>
                                                            <!-- new column -->
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id='entry'
                                                                    name='entry' onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" tabindex="1"
                                                                    autocomplete='off' />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end  -->
                                                        <div class="col-6 col-md-4">
                                                            <label style='font-size:15px' class="col-md-12"> </label>
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black'>Net
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    id='net_weight_1' name='net_weight_1'
                                                                    onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" tabindex="2"
                                                                    autocomplete='off' />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-6 col-md-2">
                                                            <label class="col-md-12">Kilo Per Bale</label>
                                                            <select class='form-select' name='kilo_bales_1'
                                                                id='kilo_bales_1'>
                                                                <option value="35" selected="selected">35 KG </option>
                                                                <option value="33.33">33.33 KG </option>

                                                            </select>
                                                        </div>

                                                        <div class="col-6 col-md-3">
                                                            <label class="col-md-12">Bales</label>
                                                            <input type="text" class="form-control" id='total_bales_1'
                                                                name='total_bales_1' readonly />
                                                        </div>
                                                        <!--  end-->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-md-3">

                                                        </div>
                                                        <!--end  -->
                                                        <div class="col-6 col-md-4">
                                                            <label style='font-size:15px' class="col-md-12"> </label>
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black'>Net
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    id='net_weight_2' name='net_weight_2'
                                                                    onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" tabindex="2" disabled
                                                                    autocomplete='off' />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-6 col-md-2">
                                                            <label class="col-md-12">Kilo Per Bale</label>
                                                            <select class='form-select' name='kilo_bales_2'
                                                                id='kilo_bales_2' disabled>
                                                                <option value="35">35 KG </option>
                                                                <option value="33.33" selected="selected">33.33 KG
                                                                </option>

                                                            </select>
                                                        </div>

                                                        <div class="col-6 col-md-3">
                                                            <label class="col-md-12">Bales</label>
                                                            <input type="text" class="form-control" id='total_bales_2'
                                                                name='total_bales_2' readonly />
                                                        </div>
                                                        <!--  end-->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-md-3">
                                                            <label style='font-size:15px' class="col-md-12">DRC</label>
                                                            <div class="input-group mb-1">

                                                                <input type="text" style='text-align:right' name='drc'
                                                                    id='drc' class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <label style='font-size:15px' class="col-md-12">Total Net
                                                                Weight</label>
                                                            <div class="input-group mb-1">

                                                                <input type="text" style='text-align:right'
                                                                    name='total_net_weight' id='total_net_weight'
                                                                    class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-6 col-md-2">

                                                            <!--  end-->
                                                        </div>
                                                    </div>
                                                    <hr>





                                                    <!--  -->

                                                    <!-- RASE-->
                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <label style='font-size:15px' class="col-md-12">SPOT Price
                                                                :</label>
                                                            <div class="col-12 col-sm-5 col-md-3">
                                                                <!--  -->
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">₱</span>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        name='price_1' id='price_1'
                                                                        onkeypress="return CheckNumeric()"
                                                                        onkeyup="FormatCurrency(this)" tabindex="4"
                                                                        autocomplete='off' />
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                            <div class="col-6 col-md-4">
                                                                <!-- new column -->
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">₱</span>
                                                                    </div>
                                                                    <input type="text" style='text-align:right'
                                                                        id='first_total' class="form-control" readonly>

                                                                </div>
                                                                <!--  -->
                                                            </div>


                                                        </div>
                                                    </div>
                                                    <!-- RASE 2-->
                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <label style='font-size:15px' class="col-md-12">Contact
                                                                Price
                                                                :</label>
                                                            <div class="col-12 col-sm-5 col-md-3">
                                                                <!--  -->
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">₱</span>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        name='price_2' id='price_2'
                                                                        onkeypress="return CheckNumeric()"
                                                                        onkeyup="FormatCurrency(this)" tabindex="4"
                                                                        autocomplete='off' disabled />
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                            <div class="col-6 col-md-4">
                                                                <!-- new column -->
                                                                <div class="input-group mb-4">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">₱</span>
                                                                    </div>
                                                                    <input type="text" style='text-align:right'
                                                                        id='second_total' class="form-control" readonly>

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
                                                            <div class="col-12 col-sm-7 col-md-8">
                                                                <!--  -->
                                                                <div class="input-group mb-1">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="inputGroup-sizing-default"
                                                                            style='color:black;font-weight: bold;'>Total
                                                                            Amount ₱</span>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        id='total_amount' name='total_amount'
                                                                        onkeypress="return CheckNumeric()"
                                                                        onkeyup="FormatCurrency(this)" readonly />

                                                                </div>
                                                                <!--  -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <div class="col-12 col-sm-7 col-md-8">
                                                                <!--  -->
                                                                <div class="input-group mb-1">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="inputGroup-sizing-default"
                                                                            style='color:black;font-weight: bold;'>Less/CA
                                                                            ₱</span>
                                                                    </div>
                                                                    <input type="text" style='text-align:left'
                                                                        id='cash_advance' name='cash_advance'
                                                                        onkeypress="return CheckNumeric()"
                                                                        onkeyup="FormatCurrency(this)"
                                                                        class="form-control" tabindex="9"
                                                                        autocomplete='off' readonly />

                                                                </div>
                                                                <!--  -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--  end-->
                                                    <!-- start-->
                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <div class="col-12 col-sm-7 col-md-8">
                                                                <!--  -->
                                                                <div class="input-group mb-1">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="inputGroup-sizing-default"
                                                                            style='color:black;font-weight: bold;'>Amount
                                                                            Paid ₱</span>
                                                                    </div>
                                                                    <input type="text" style='text-align:left'
                                                                        name='amount_paid' id='amount_paid'
                                                                        onkeypress="return CheckNumeric()"
                                                                        onkeyup="FormatCurrency(this)"
                                                                        class="form-control" readonly />

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


<script type="text/javascript" src="js/bales_rubber.js"></script>
<script type="text/javascript" src="js/getWords.js"></script>
<?php

include "modal/balesModal.php";
include "modal/balesModalScript.php";

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