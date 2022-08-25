<style>
.vertical-alignment-helper {
    display: table;
    height: 100%;
    width: 100%;
    pointer-events: none;
}

.vertical-align-center {
    /* To center vertically */
    display: table-cell;
    vertical-align: middle;
    pointer-events: none;
}

.modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width: inherit;
    max-width: inherit;
    /* For Bootstrap 4 - to avoid the modal window stretching 
full width */
    height: inherit;
    /* To center horizontally */
    margin: 0 auto;
    pointer-events: all;
}
</style>

<!-- Modal -->
<div class="modal fade" id="viewHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">TRANSACTION RECORD INVOICE #TEST</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/ledger/addExpenses.php" id='myform' method="POST">
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="row">
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-md-12">Invoice</label>
                                                    <div class="col-md-12">
                                                        <input type="text" name='invoice' id='invoice'
                                                            class="form-control form-control-line" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-md-12">Date</label>
                                                    <div class="col-md-12 ">
                                                        <input type="text" class='datepicker' id="date" name="date"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="col-md-12">Contract</label>
                                                    <input type="text" name='contract' id='contract'
                                                        class="form-control form-control-line" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label class="col-md-12">Seller </label>
                                                    <input type="text" name='name' id='name'
                                                        class="form-control form-control-line" readonly>
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
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
                                                                name='noSack' readonly />
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
                                                                name='gross' readonly />
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
                                                                name='tare' readonly />
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
                                                            <input type="text" class="form-control" aria-label="Default"
                                                                id="dust" name='dust' readonly>
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
                                                            <input type="text" class="form-control" id='new-dust' name='new-dust'
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
                                                                    style='color:black;font-weight: bold;'> :
                                                                </span>
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
                                                                id='moisture' aria-label="Default" readonly>
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
                                                                    style='color:black;font-weight: bold;'> :
                                                                </span>
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
                                                                id='total-res' name='total-res' />
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
                                                            <input type="text" class="form-control" name='1resecada'
                                                                id='1resecada' readonly />
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
                                                            <input type="text" style='text-align:right' id='total_1res'
                                                            name='total_1res'
                                                                class="form-control" readonly>
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
                                                            <input type="text" class="form-control" id='2resecada'
                                                                name='2resecada' readonly />
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
                                                                name='total_2res' id='total_2res' class="form-control"
                                                                readonly>
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
                                                            <input type="text" class="form-control" id='total-amount'
                                                                name='total-amount' readonly />

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
                                                            <input type="text" style='text-align:left' id='less'
                                                                name='less' class="form-control" readonly />

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
                                                                name='amount-paid' id='amount-paid' class="form-control"
                                                                readonly />

                                                        </div>
                                                        <hr>
                                                     
                                                        <!--  -->
                                                    </div>
                                                    <input type="text" style='text-align:center'
                                                            name='total-words' id='total-words'
                                                            class="form-control" readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END BALANCE -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>