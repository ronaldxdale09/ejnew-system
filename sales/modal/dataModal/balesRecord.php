<?php  
include('../../../function/db.php');
  
    $invoice = $_POST['invoice'];
    $record  = mysqli_query($con, "SELECT * from bales_transaction WHERE id='$invoice' ");
    $arr = mysqli_fetch_array($record);
    $output='';

 $output .= '  
 <div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm">
        <label> Date </label>
        <br>
        <input name="p_voucher" class="form-control" style="font-size:18px;border: none;font-weight:bold" value="'.($arr['date']).'" readonly>
      </div>
      <div class="col-sm">
      <label> Invoice # :</label>
      <br>
      <input class="form-control" style="font-size:18px;border: none;font-weight:bold" value="'.($arr['invoice']).'" readonly>
    </div>
      <div class="col-sm">
        <label> Contract :</label>
        <br>
        <input id="p_date" class="form-control" style="font-size:18px;border: none;font-weight:bold" value="'.($arr['contract']).'" readonly>
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
              <input type="text" class="form-control"  value='.number_format($arr['entry']).' readonly />
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
              <input type="text" class="form-control" value='.number_format($arr['net_weight_1']).' readonly />
              <div class="input-group-append">
                <span class="input-group-text">Kg</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-2">
            <label class="col-md-12">Kilo Per Bale</label>
            <input type="text" class="form-control" value='.number_format($arr['kilo_bales_1']).' readonly />
          </div>
          <div class="col-6 col-md-3">
            <label class="col-md-12">Bales</label>
            <input type="text" class="form-control" value="'.($arr['total_bales_1']).'" readonly />
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
              <input type="text" class="form-control"  value='.number_format($arr['net_weight_2']).'  disabled readonly />
              <div class="input-group-append">
                <span class="input-group-text">Kg</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-2">
            <label class="col-md-12">Kilo Per Bale</label>
            <input type="text" class="form-control"  value='.number_format($arr['kilo_bales_2']).'   readonly />
          </div>
          <div class="col-6 col-md-3">
            <label class="col-md-12">Bales</label>
            <input type="text" class="form-control" value='.($arr['total_bales_2']).' readonly />
          </div>
          <!--  end-->
        </div>
      </div>
      <div class="form-group">
        <div class="row no-gutters">
          <div class="col-12 col-md-3">
            <label style="font-size:15px" class="col-md-12">DRC</label>
            <div class="input-group mb-1">
              <input type="text" style="text-align:right" value='.$arr['drc'].'  class="form-control" readonly>
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-4">
            <label style="font-size:15px" class="col-md-12">Total Net Weight</label>
            <div class="input-group mb-1">
              <input type="text" style="text-align:right" value='.number_format($arr['total_net_weight']).'  class="form-control" readonly>
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
                <input type="text" class="form-control" value='.number_format($arr['price_1'],2).' readonly />
              </div>
            </div>
            <!--  -->
            <div class="col-6 col-md-4">
              <!-- new column -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">₱</span>
                </div>
                <input type="text" style="text-align:right" value="'.number_format($arr['first_total'],2).'" class="form-control" readonly>
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
                <input type="text" class="form-control" value="'.number_format($arr['price_2'],2).'" tabindex="4" readonly disabled />
              </div>
            </div>
            <!--  -->
            <div class="col-6 col-md-4">
              <!-- new column -->
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">₱</span>
                </div>
                <input type="text" style="text-align:right" value="'.number_format($arr['second_total'],2).'" class="form-control" readonly>
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
                <input type="text" class="form-control" value="'.number_format($arr['total_amount'],2).'" readonly />
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
                <input type="text" style="text-align:left" value='.number_format($arr['less'],2).' class="form-control" tabindex="9" readonly readonly />
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
                <input type="text" style="text-align:left" value="'.number_format($arr['amount_paid'],2).'" class="form-control" readonly />
              </div>
              <hr>
              <input type="text" style="text-align:center" value="'.($arr['words_amount']).'" class="form-control" readonly>
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