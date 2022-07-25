<?php $month = date("m");
$day = date("d");
$year = date("Y");
$today = $year . "-" . $month . "-" . $day;
?>
 <div class="modal fade" id="copraCashAdvance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">CASH AGREEMENT</h5>
                 <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="function/copra/newCA.php" method="POST">
                     <!-- ... START -->
                     <div class="form-group">
                         <div class="row no-gutters">
                             <div class="col-6 col-md-6">
                                 <div class="input-group mb-1">
                                     <input class='datepicker' value="<?php echo $today; ?>" type="date" id="date"
                                         name="date" required>
                                 </div>
                             </div>
                             <!--end  -->
                             <div class="col-6 col-md-6">
                                 <div class="input-group mb-1">
                                     <select class="form-select" name='ca_category' id='ca_category' style='width:200px' required>
                                         <option disabled="disabled" selected="selected"  value="">Select Category</option>
                                         <option value='copra'>Copra</option>
                                         <option value='ntc'>NTC</option>
                                         <option value='trucking'>Trucking</option>
                                         <option value='others'>Others</option>
                                     </select>

                                 </div>
                             </div>
                             <!--  end-->
                         </div>
                     </div>
                     <hr>
                     <div class="form-group">
                         <label class="col-md-12">Seller</label>
                         <div class="col-md-12">
                             <select class='select_seller' name='seller' id='seller' required>
                                 <option disabled="disabled" selected="selected">Select Seller</option>
                                 <?php echo $sellerList; ?>
                             </select>
                         </div>
                      </div>
                         <hr>
                         <div class="form-group">
                             <div class="row no-gutters">
                                 <div class="col-12 col-sm-5 col-md-12">
                                     <!--  -->
                                     <div class="input-group mb-1">
                                         <div class="input-group-prepend">
                                             <span class="input-group-text" id="inputGroup-sizing-default"
                                                 style='color:black;font-weight: bold;'>₱</span>
                                         </div>
                                         <input type="text" style='text-align:right' name='ca_amount' id='ca_amount' required
                                             class="form-control" onkeypress="return CheckNumeric()"
                                             onkeyup="FormatCurrency(this)">
                                     </div>
                                     <!--  -->
                                 </div>
                             </div>
                         </div>
                         <!-- END -->
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" name='submit' class="btn btn-success text-white">Submit</button>
                 </form>
             </div>
         </div>
     </div>
 </div>

 <script>
$('#copraCashAdvance').on('shown.bs.modal', function() {
    $('.select_seller', this).chosen();
});
 </script>