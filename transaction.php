
<?php 
   include('include/header.php');
   include "include/navbar.php";
   $seller = "SELECT * FROM seller ";
   $result = mysqli_query($con, $seller);
   $sellerList='';
   while($arr = mysqli_fetch_array($result))
   {
   $sellerList .= '<option value="'.$arr["name"].'">[ '.$arr["code"].' ]      '.$arr["name"].'</option>';
   }
   

   $invoice = mysqli_query($con, "SELECT  COUNT(*) from transaction_record  "); 
   $getinvoice = mysqli_fetch_array($invoice);

   $invoiceCount= sprintf("%'03d", $getinvoice[0]);

   $month = date('m');
    $day = date('d');
    $year = date('Y');

    $today = $year . '-' . $month . '-' . $day;



   ?>
<body>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
        <div class="container-fluid">
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                    <br> 
                        <h4 class="page-title">Purchase</h4>
                       
                    </div>
                    <div class="col-6">
                        <div class="text-end upgrade-btn">
                            <!-- CONTENT -->
                            <button type="button" class="btn btn-success text-white confirm" id='confirm'>Confirm
                                Transaction</button>
                            <button type="button" class="btn btn-info vouchBtn" id='vouchBtn'><span
                                    class="fa fa-print"></span> Print Voucher</button>
                          
                            <button type="button" class="btn btn-danger text-white confirm" id='confirm'>Clear</button>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-xlg-3 col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-md-12">Invoice</label>
                                        <div class="col-md-8">
                                            <input type="text" name='invoice' id='invoice'
                                                value="<?php   echo "$invoiceCount" ?>"
                                                class="form-control form-control-line" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Date</label>
                                        <div class="col-md-12">
                                            <input type="date" id="date" value="<?php echo $today; ?>" name="date">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Contract</label>
                                        <div class="col-md-12">
                                            <input type="text" value="SPOT" class="form-control form-control-line"
                                                readonly>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Seller </label>
                                        <select class='select_seller' name='name' id='name'>
                                            <option disabled="disabled" selected="selected">Select Seller</option>
                                            <?php echo $sellerList; ?>
                                        </select>
                                    </div>

                                    <!-- select seller -->
                                    <div class="form-group">
                                        <label class="col-md-12">Address</label>
                                        <div class="col-md-12">
                                            <select name="address" id="address" class="form-control" disabled>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <label style='font-size:15px;font-weight: bold;' class="col-md-12">Balance:
                                            </label>
                                            <div class="col-12 col-sm-5 col-md-7">
                                                <!--  -->
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" style='text-align:right' class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                            <!-- end -->
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- Column -->
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
                                                    <label style='font-size:15px' class="col-md-12">No. of Sack
                                                        :</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='noSack'
                                                            name='noSack' onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                    </div>
                                                    <!--  -->
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <label style='font-size:15px' class="col-md-12">Gross Weight
                                                        (Kilos)</label>
                                                    <!-- new column -->
                                                    <div class="input-group mb-3">
                                                        <!-- <div class="input-group-prepend">
                                       <span class="input-group-text">₱</span>
                                       </div> -->
                                                        <input type="text" class="form-control" id='gross' name='gross'
                                                            onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end  -->
                                                <div class="col-6 col-md-4">
                                                    <label style='font-size:15px' class="col-md-12">Deductable Tare
                                                        Kilos</label>
                                                    <!-- new column -->
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='tare' name='tare'
                                                            onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" />
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
                                                                style='color:black;font-weight: bold;'>Net Weight</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='net' id='net'
                                                            class="form-control" readonly>
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
                                                        <input type="text" class="form-control" aria-label="Default"
                                                            id="dust" name='dust'>
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
                                                        <input type="text" class="form-control" id='new' name='new'
                                                            readonly>
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
                                                                style='color:black;font-weight: bold;'> : </span>
                                                        </div>
                                                        <input type="text" class="form-control" id='total-dust'
                                                            name='total-dust' aria-label="Default"
                                                            aria-describedby="inputGroup-sizing-default" readonly>
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
                                                            onkeyup="GetDetail(this.value)" value="">
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
                                                                style='color:black;font-weight: bold;'>P / D</span>
                                                        </div>
                                                        <input type="text" class="form-control" name='discount_reading'
                                                            id='discount_reading' aria-label="Default"
                                                            aria-describedby="inputGroup-sizing-default" readonly>
                                                    </div>
                                                    <!--  -->
                                                </div>
                                                <!--  total moisture-->
                                                <div class="col-6 col-md-4">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroup-sizing-default"
                                                                style='color:black;font-weight: bold;'> : </span>
                                                        </div>
                                                        <input type="text" class="form-control" id='total-moisture'
                                                            name='total-moisture' readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end -->
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <div class="col-12 col-sm-5 col-md-9">
                                                <!--  -->
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                                            style='color:black;font-weight: bold;'>Net Resecada Weight
                                                            (Total)</span>
                                                    </div>
                                                    <input type="text" class="form-control" readonly id='total-res'
                                                        name='total-res' onkeypress="return CheckNumeric()"
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
                                    <!-- RASE-->
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <label style='font-size:15px' class="col-md-12">1st Rese :</label>
                                            <div class="col-12 col-sm-5 col-md-6">
                                                <!--  -->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name='first-res'
                                                        id='first-rese' onkeypress="return CheckNumeric()"
                                                        onkeyup="FormatCurrency(this)" />
                                                </div>
                                            </div>
                                            <!--  -->
                                            <div class="col-6 col-md-6">
                                                <!-- new column -->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" style='text-align:right' id='total-1res'
                                                        class="form-control" readonly>
                                                </div>
                                                <!--  -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- RASE 2-->
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <label style='font-size:15px' class="col-md-12">2nd Rese :</label>
                                            <div class="col-12 col-sm-5 col-md-6">
                                                <!--  -->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" id='second-res'
                                                        name='second-rese' onkeypress="return CheckNumeric()"
                                                        onkeyup="FormatCurrency(this)" />
                                                </div>
                                                <!--  -->
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <!-- new column -->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" style='text-align:right' name='total-2res'
                                                        id='total-2res' class="form-control" readonly>
                                                </div>
                                                <!--  -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- RASE 3-->
                                    <div class="form-group">
                                        <div class="row no-gutters">
                                            <label style='font-size:15px' class="col-md-12">3rd Rese :</label>
                                            <div class="col-12 col-sm-5 col-md-6">
                                                <!--  -->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" id='third-res'
                                                        name='third-res' onkeypress="return CheckNumeric()"
                                                        onkeyup="FormatCurrency(this)" />
                                                </div>
                                                <!--  -->
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <!-- new column -->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" style='text-align:right' name='total-3res'
                                                        id='total-3res' class="form-control" readonly>
                                                </div>
                                            </div>
                                            <!--  end-->
                                            <hr>
                                            <br>
                                            <!-- start-->
                                            <!-- RASE 3-->
                                            <div class="form-group">
                                                <div class="row no-gutters">
                                                    <div class="col-12 col-sm-5 col-md-6">
                                                        <!--  -->
                                                        <label style='font-size:15px;font-weight: bold;'
                                                            class="col-md-12">Total Amount:</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text" class="form-control" id='total-amount'
                                                                name='total-amount' onkeypress="return CheckNumeric()"
                                                                onkeyup="FormatCurrency(this)" />
                                                        </div>
                                                        <!--  -->
                                                    </div>
                                                    <div class="col-6 col-md-6">
                                                        <!-- new column -->
                                                        <label style='font-size:15px;font-weight: bold;'
                                                            class="col-md-12">Less:</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">₱</span>
                                                            </div>
                                                            <input type="text" style='text-align:right' id='less'
                                                                name='less' onkeypress="return CheckNumeric()"
                                                                onkeyup="FormatCurrency(this)" class="form-control">
                                                        </div>
                                                    </div>
                                                    <!--  end-->
                                                    <hr>
                                                    <br>
                                                    <!-- start-->
                                                    <div class="form-group">
                                                        <div class="row no-gutters">
                                                            <label style='font-size:15px;font-weight: bold;'
                                                                class="col-md-12">Amount Paid: </label>
                                                            <div class="col-12 col-sm-5 col-md-6">
                                                                <!--  -->
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">₱</span>
                                                                    </div>
                                                                    <input type="text" style='text-align:right'
                                                                        name='amount-paid' id='amount-paid'
                                                                        onkeypress="return CheckNumeric()"
                                                                        onkeyup="FormatCurrency(this)"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <input type="text" style='text-align:center'
                                                                name='amount-paid-words' id='amount-paid-words'
                                                                class="form-control" readonly>
                                                            <!-- end -->
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


<?php
include('modal/modal.php');
include('modal/modalScript.php');
include('include/script.php');
?>

