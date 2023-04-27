<?php  
include('../../../function/db.php');

    $record  = mysqli_query($con, "SELECT * from bales_transaction WHERE invoice='002' ");
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
<div class="col-lg-12 col-xlg-12 col-md-12">
<div class="card">
  <div class="card-body">
    <div class="container">
      <!-- -->
      <div class="form-group">
        <div class="row no-gutters">
          <div class="col-12 col-md-3">
            <label style="font-size:15px" class="col-md-12">Entry Weight (WET)</label>
            <!-- new column -->
            <div class="input-group mb-3">
              <input type="text" class="form-control"  value='.number_format($row['entry']).' readonly />
              <div class="input-group-append">
                <span class="input-group-text">Kg</span>
              </div>
            </div>
          </div>
          <!--end  -->
          <div class="col-6 col-md-4">
            <label style="font-size:15px" class="col-md-12"></label>
            <div class="input-group mb-1">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default" style="color:black">Net </span>
              </div>
              <input type="text" class="form-control" value='.number_format($row['net_weight_1']).' readonly />
              <div class="input-group-append">
                <span class="input-group-text">Kg</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-2">
            <label class="col-md-12">Kilo Per Bale</label>
            <input type="text" class="form-control" value='.number_format($row['kilo_bales_1']).' readonly />
          </div>
          <div class="col-6 col-md-3">
            <label class="col-md-12">Bales</label>
            <input type="text" class="form-control" value="'.($row['total_bales_1']).'" readonly />
          </div>
          <!--  end-->
        </div>
      </div>
      <div class="form-group">
        <div class="row no-gutters">
          <div class="col-12 col-md-3"></div>
          <!--end  -->
          <div class="col-6 col-md-4">
            <label style="font-size:15px" class="col-md-12"></label>
            <div class="input-group mb-1">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default" style="color:black">Net </span>
              </div>
              <input type="text" class="form-control"  value='.number_format($row['net_weight_2']).'  disabled readonly />
              <div class="input-group-append">
                <span class="input-group-text">Kg</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-2">
            <label class="col-md-12">Kilo Per Bale</label>
            <input type="text" class="form-control"  value='.number_format($row['kilo_bales_2']).'   readonly />
          </div>
          <div class="col-6 col-md-3">
            <label class="col-md-12">Bales</label>
            <input type="text" class="form-control" value='.($row['total_bales_2']).' readonly />
          </div>
          <!--  end-->
        </div>
      </div>
      <div class="form-group">
        <div class="row no-gutters">
          <div class="col-12 col-md-3">
            <label style="font-size:15px" class="col-md-12">DRC</label>
            <div class="input-group mb-1">
              <input type="text" style="text-align:right" value='.$row['drc'].'  class="form-control" readonly>
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-4">
            <label style="font-size:15px" class="col-md-12">Total Net Weight</label>
            <div class="input-group mb-1">
              <input type="text" style="text-align:right" value='.number_format($row['total_net_weight']).'  class="form-control" readonly>
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
            <label style="font-size:15px" class="col-md-12">SPOT Price :</label>
            <div class="col-12 col-sm-5 col-md-3">
              <!--  -->
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">₱</span>
                </div>
                <input type="text" class="form-control" value='.number_format($row['price_1'],2).' readonly />
              </div>
            </div>
            <!--  -->
            <div class="col-6 col-md-4">
              <!-- new column -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">₱</span>
                </div>
                <input type="text" style="text-align:right" value="'.number_format($row['first_total'],2).'" class="form-control" readonly>
              </div>
              <!--  -->
            </div>
          </div>
        </div>
        <!-- RASE 2-->
        <div class="form-group">
          <div class="row no-gutters">
            <label style="font-size:15px" class="col-md-12">Contact Price :</label>
            <div class="col-12 col-sm-5 col-md-3">
              <!--  -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">₱</span>
                </div>
                <input type="text" class="form-control" value="'.number_format($row['price_2'],2).'" tabindex="4" readonly disabled />
              </div>
            </div>
            <!--  -->
            <div class="col-6 col-md-4">
              <!-- new column -->
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">₱</span>
                </div>
                <input type="text" style="text-align:right" value="'.number_format($row['second_total'],2).'" class="form-control" readonly>
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
                <input type="text" class="form-control" value="'.number_format($row['total_amount'],2).'" readonly />
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
                <input type="text" style="text-align:left" value='.number_format($row['less'],2).' class="form-control" tabindex="9" readonly readonly />
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
                <input type="text" style="text-align:left" value="'.number_format($row['amount_paid'],2).'" class="form-control" readonly />
              </div>
              <hr>
              <input type="text" style="text-align:center" value="'.($row['words_amount']).'" class="form-control" readonly>
              <!--  -->
            </div>
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