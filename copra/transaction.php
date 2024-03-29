<?php
include "include/header.php";
include "include/navbar.php";



if (isset($_GET['view'])) {
    $_SESSION['transaction'] ='ONGOING';
    $view = $_GET['view'];

    $sql = mysqli_query($con, "SELECT  * from copra_transaction where invoice='$view'  ");
    $record = mysqli_fetch_array($sql);

    $invoiceCount = $record['invoice'];
    $today= $record['date'];

    $contract = "SELECT * FROM copra_contract where status='PENDING' OR status='UPDATED' ";
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


    $seller = "SELECT * FROM copra_seller ";
    $result = mysqli_query($con, $seller);
    $sellerList = "";
    while ($arr = mysqli_fetch_array($result)) {
        $sellerList .=
            '<option value="' .
            $arr["name"] .
            '">[ ' .
            $arr["code"] .
            " ]      " .
            $arr["name"] .
            "</option>";
    }

  }
  
  else {
$_SESSION['transaction'] ='ONGOING';
//seller list
$contract = "SELECT * FROM copra_contract where status='PENDING' OR status='UPDATED' ";
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

$seller = "SELECT * FROM copra_seller ";
$result = mysqli_query($con, $seller);
$sellerList = "";
while ($arr = mysqli_fetch_array($result)) {
    $sellerList .=
        '<option value="' .
        $arr["name"] .
        '">[ ' .
        $arr["code"] .
        " ]      " .
        $arr["name"] .
        "</option>";
}

$invoice = mysqli_query($con, "SELECT  COUNT(*) from copra_transaction  ");
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
                                <h4 class="page-title">Purchase</h4>
                            </div>
                            <div class="col-7">
                                <div class="text-end upgrade-btn">
                                    <!-- CONTENT -->
                                    <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                        data-target="#add_seller1"><span class="fa fa-plus text-white"></span>
                                        Add copra_seller</button>
                                    <button type="button" class="btn btn-info text-white" data-toggle="modal"
                                        data-target="#copraCashAdvance1"><span class="fa fa-plus text-white"></span>
                                        New Cash Advance</button>
                                    <button type="button" class="btn btn-dark text-white" data-toggle="modal"
                                        data-target="#newContract1"><span class="fa fa-plus text-white"></span>
                                        New Contract</button>
                                    <button type="button" class="btn btn-secondary text-white" data-toggle="modal"
                                        data-target=".viewTransaction"><span class="fa fa-book text-white"></span>
                                        Transaction History</button>

                                </div>
                            </div>
                            <div class="row">
                                <!-- Column -->
                                <div class="col-lg-4 col-xlg-3 col-md-5">
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
                                                        <label class="col-md-12">Invoice</label>
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
                                                    <option disabled="disabled" selected="selected">Select copra_seller
                                                    </option>
                                                    <?php echo $sellerList; ?>
                                                </select>
                                            </div>
                                            <!-- select copra_seller -->
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
                                <div class="col-lg-8 col-xlg-9 col-md-7">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container">
                                                <!-- -->
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-5 col-md-4">
                                                            <!--  -->
                                                            <label style='font-size:15px' class="col-md-12">No. of
                                                                Sack
                                                                :</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id='noSack'
                                                                    name='noSack' onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" tabindex="1"
                                                                    autocomplete='off' />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Sk</span>
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <label style='font-size:15px' class="col-md-12">Gross
                                                                Weight
                                                                (Kilos)</label>
                                                            <!-- new column -->
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id='gross'
                                                                    name='gross' onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" tabindex="2"
                                                                    autocomplete='off' />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end  -->
                                                        <div class="col-6 col-md-4">
                                                            <label style='font-size:15px' class="col-md-12">Deductable
                                                                Tare Kilos</label>
                                                            <!-- new column -->
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id='tare'
                                                                    name='tare' onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" tabindex="3"
                                                                    autocomplete='off' />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  end-->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-5 col-md-5">
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'>Net
                                                                        Weight</span>
                                                                </div>
                                                                <input type="text" style='text-align:right' name='net'
                                                                    id='net' class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-5 col-md-3">
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        style='color:black;font-weight: bold;'>DUST</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    aria-label="Default" id="dust" name='dust'
                                                                    tabindex="4" autocomplete='off'>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'>NEW</span>
                                                                </div>
                                                                <input type="text" class="form-control" id='new'
                                                                    name='new' tabindex="5">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  total dust-->
                                                        <div class="col-6 col-md-4">
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'> :
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control" id='total-dust'
                                                                    name='total-dust' aria-label="Default"
                                                                    aria-describedby="inputGroup-sizing-default"
                                                                    readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end -->
                                                </div>
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-5 col-md-3">
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'>Moisture</span>
                                                                </div>
                                                                <input type="text" class="form-control" name='moisture'
                                                                    id='moisture' aria-label="Default"
                                                                    onkeyup="GetDetail(this.value)" tabindex="6"
                                                                    autocomplete='off'>
                                                            </div>
                                                            <!--  -->
                                                            <br>
                                                        </div>
                                                        <div class="col-6 col-md-4">
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'>P /
                                                                        D</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name='discount_reading' id='discount_reading'
                                                                    aria-label="Default"
                                                                    aria-describedby="inputGroup-sizing-default"
                                                                    tabindex="7" autocomplete='off'>
                                                            </div>
                                                            <!--  -->
                                                        </div>
                                                        <!--  total moisture-->
                                                        <div class="col-6 col-md-4">
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'> :
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    id='total-moisture' name='total-moisture' readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end -->
                                                </div>

                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <div class="col-12 col-sm-7 col-md-8">
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'>Net
                                                                        Resecada
                                                                        Weight (Total)</span>
                                                                </div>
                                                                <input type="text" class="form-control" readonly
                                                                    id='total-res' name='total-res'
                                                                    onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
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
                                                        <label style='font-size:15px' class="col-md-12">1st Rese
                                                            :</label>
                                                        <div class="col-12 col-sm-5 col-md-4">
                                                            <!--  -->
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">₱</span>
                                                                </div>
                                                                <input type="text" class="form-control" name='first-res'
                                                                    id='first-res' onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" tabindex="8"
                                                                    autocomplete='off' />
                                                            </div>
                                                        </div>
                                                        <!--  -->
                                                        <div class="col-6 col-md-4">
                                                            <!-- new column -->
                                                            <div class="input-group mb-3">

                                                                <input type="text" style='text-align:right'
                                                                    id='1rese-weight' class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                        </div>

                                                        <div class="col-6 col-md-4">
                                                            <!-- new column -->
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">₱</span>
                                                                </div>
                                                                <input type="text" style='text-align:right'
                                                                    id='total-1res' class="form-control" readonly>
                                                            </div>
                                                            <!--  -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- RASE 2-->
                                                <div class="form-group">
                                                    <div class="row no-gutters">
                                                        <label style='font-size:15px' class="col-md-12">2nd Rese
                                                            :</label>
                                                        <div class="col-12 col-sm-5 col-md-4">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">₱</span>
                                                                </div>
                                                                <input type="text" class="form-control" id='second-res'
                                                                    name='second-rese'
                                                                    onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" tabindex="9"
                                                                    autocomplete='off' readonly />
                                                            </div>
                                                        </div>

                                                        <div class="col-6 col-md-4">
                                                            <!-- new column -->
                                                            <div class="input-group mb-3">

                                                                <input type="text" style='text-align:right'
                                                                    id='2rese-weight' class="form-control" readonly>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Kg</span>
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                        </div>

                                                        <div class="col-6 col-md-4">
                                                            <!-- new column -->
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">₱</span>
                                                                </div>
                                                                <input type="text" style='text-align:right'
                                                                    name='total-2res' id='total-2res'
                                                                    class="form-control" readonly>
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
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'>Total
                                                                        Amount ₱</span>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    style='text-align:right' id='total-amount'
                                                                    name='total-amount'
                                                                    onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" readonly />

                                                            </div>
                                                            <!--  -->
                                                        </div>
                                                        <div class="col">
                                                            <!--  -->
                                                            <div class="input-group mb-1">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'>Less : CA
                                                                        ₱</span>
                                                                </div>
                                                                <input type="text" style='text-align:right'
                                                                    id='cash_advance' name='cash_advance'
                                                                    onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" class="form-control" value='0'
                                                                    tabindex="10" autocomplete='off' />

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
                                                                    <span class="input-group-text"
                                                                        id="inputGroup-sizing-default"
                                                                        style='color:black;font-weight: bold;'>Withholding
                                                                        Tax</span>
                                                                </div>
                                                                <input type="text" style='text-align:right' id='tax'
                                                                    name='tax' value='1'
                                                                    onkeypress="return CheckNumeric()"
                                                                    onkeyup="FormatCurrency(this)" class="form-control"
                                                                    tabindex="10" autocomplete='off' />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            <!--  -->
                                                        </div>
                                                        <div class="col">
                                                            <!--  -->
                                                            <div class="input-group mb-1">

                                                                <input type="text" style='text-align:right'
                                                                    name='tax-amount' id='tax-amount'
                                                                    class="form-control" readonly />

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <br>
                                                <div class="col">
                                                    <!--  -->
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroup-sizing-default"
                                                                style='color:black;font-weight: bold;'>Amount
                                                                Paid ₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='amount-paid'
                                                            id='amount-paid' onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" class="form-control"
                                                            readonly />

                                                    </div>
                                                    <input type="text" style='text-align:center'
                                                        name='amount-paid-words' id='amount-paid-words'
                                                        class="form-control" hidden readonly>
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
            <!-- Column -->
        </div>
    </div>
    </div>
</body>
<script type="text/javascript" src="js/copra_transaction.js"></script>
<script type="text/javascript" src="js/transaction_computation.js"></script>

</html>



<?php
include "modal/viewTransactionModal.php";
include "modal/transactionModal.php";
include "modal/TransactionModalScript.php";

include "modal/contractModal.php";
include "modal/copra/copra_cashadvanceModal.php";
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