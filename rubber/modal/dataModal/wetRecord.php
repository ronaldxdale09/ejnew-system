<?php  
include('../../../function/db.php');

    $record  = mysqli_query($con, "SELECT * from rubber_transaction WHERE invoice='001' ");
    $row = mysqli_fetch_array($record);
$output='';


//  $result = mysqli_query($con, $sql);  
 $output .= '  
 <div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm">
        <label> Date </label>
        <br>
        <input id="p_voucher" name="p_voucher" class="form-control" style="font-size:18px;border: none;font-weight:bold" value="'.($row['date']).'" readonly>
      </div>
      <div class="col-sm">
      <label> Invoice # :</label>
      <br>
      <input id="p_remarks" class="form-control" style="font-size:18px;border: none;font-weight:bold" value="'.($row['invoice']).'" readonly>
    </div>
      <div class="col-sm">
        <label> Contract :</label>
        <br>
        <input id="p_date" class="form-control" style="font-size:18px;border: none;font-weight:bold" value="'.($row['contract']).'" readonly>
      </div>
     
    </div>
  </div>
</div>
<br>
<div class="col-lg-12 col-md-12">
  <div class="card">
    <div class="card-body">
      <div class="container">
        <!-- -->
        <div class="form-group">
          <div class="row no-gutters">
            <div class="col-6 col-md-4">
              <label style="font-size:15px" class="col-md-12">Gross Weight (Kilos)</label>
              <!-- new column -->
              <div class="input-group mb-3">
                <input type="text" class="form-control" value="'.number_format($row['gross']).'" readonly />
                <div class="input-group-append">
                  <span class="input-group-text">Kg</span>
                </div>
              </div>
            </div>
            <!--end  -->
            <div class="col-6 col-md-4">
              <label style="font-size:15px" class="col-md-12">Deductable Tare Kilos</label>
              <!-- new column -->
              <div class="input-group mb-3">
                <input type="text" class="form-control" id="tare" value="'.number_format($row['tare']).'" readonly />
                <div class="input-group-append">
                  <span class="input-group-text">Kg</span>
                </div>
              </div>
            </div>
            <div class="col-6 col-md-4">
              <label style="font-size:15px" class="col-md-12">Net Weight</label>
              <!-- new column -->
              <div class="input-group mb-3">
                <input type="text" style="text-align:right" name="net" id="net" class="form-control" value="'.number_format($row['net_weight']).'" readonly>
                <div class="input-group-append">
                  <div class="input-group-append">
                    <span class="input-group-text">Kg</span>
                  </div>
                </div>
              </div>
              <!--  end-->
            </div>
          </div>
          <hr>
          <!--  -->
          <!-- RASE-->
          <div class="form-group">
            <div class="row no-gutters">
              <label style="font-size:15px" class="col-md-12">1st Price :</label>
              <div class="col-12 col-sm-5 col-md-4">
                <!--  -->
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input type="text" class="form-control" name="first_price" id="first_price" value="'.number_format($row['price_1']).'" readonly />
                </div>
              </div>
              <!--  -->
              <div class="col-6 col-md-4">
                <!-- new column -->
                <div class="input-group mb-3">
                  <input type="text" style="text-align:right" id="first-weight" class="form-control" value="'.number_format($row['total_weight_1']).'" readonly>
                  <div class="input-group-append">
                    <span class="input-group-text">Kg</span>
                  </div>
                </div>
                <!--  -->
              </div>
            </div>
          </div>
          <!-- RASE 2-->
          <div class="form-group">
            <div class="row no-gutters">
              <label style="font-size:15px" class="col-md-12">2nd Price :</label>
              <div class="col-12 col-sm-5 col-md-4">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">₱</span>
                  </div>
                  <input type="text" class="form-control" id="second_price" name="second_price" value="'.number_format($row['price_2']).'" readonly />
                </div>
              </div>
              <div class="col-6 col-md-4">
                <!-- new column -->
                <div class="input-group mb-3">
                  <input type="text" style="text-align:right" id="second-weight" class="form-control" value="'.number_format($row['total_weight_2']).'" readonly <div class="input-group-append">
                  <span class="input-group-text">Kg</span>
                </div>
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
                  <span class="input-group-text" id="inputGroup-sizing-default" style="color:black;font-weight: bold;">Total Amount ₱</span>
                </div>
                <input type="text" class="form-control" value="'.number_format($row['total_amount']).'" readonly />
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
                  <span class="input-group-text" id="inputGroup-sizing-default" style="color:black;font-weight: bold;">Less/CA ₱</span>
                </div>
                <input type="text" style="text-align:left" id="cash_advance" name="cash_advance" class="form-control" value="'.number_format($row['less']).'" readonly />
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
                  <span class="input-group-text" id="inputGroup-sizing-default" style="color:black;font-weight: bold;">Amount Paid ₱</span>
                </div>
                <input type="text" style="text-align:left" name="amount-paid" id="amount-paid" class="form-control" value="'.number_format($row['amount_paid']).'" readonly />
              </div>
              <hr>
              <input type="text" style="text-align:center" name="amount-paid-words" id="amount-paid-words" class="form-control" value="'.($row['amount_words']).'" readonly>
              <!--  -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 
 ';
          
 echo $output;  
 ?>