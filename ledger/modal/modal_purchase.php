<!-- Modal -->
<div class="modal fade" id="purchase-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">PURCHASE</h5>
                <button type="button" class="btn btn-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/ledger/addPurchase.php" id='submitPurchase' method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-12">DATE</label>
                        <div class="col-md-12">
                            <input class='datepicker' value="<?php echo $today; ?>" type="date" id="date" name="date"
                                required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Voucher</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_voucher' id='p_voucher'
                                        class="form-control" style='background-color:white;border:0px solid #ffffff;'>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-6 col-md-6">
                                <select class='pur_category' name='pur_category' id='pur_category' style='width:200px'
                                    required>
                                    <option disabled="disabled" selected="selected">Select Category</option>
                                    <?php echo $purCatList; ?>
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Customer Name</label>
                        <div class="col-md-8">
                            <input type="text" name='p_name' id='p_name' class="form-control form-control-line"
                                required>
                        </div>
                    </div>
                    <!-- net kilos -->
                    <br>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-12 col-md-12">
                                <!--  -->
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Net Kilos</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_net-kilos' id='p_net-kilos'
                                        class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- end net kilos -->
                    <!-- price -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <label style='font-size:15px;font-weight: bold;' class="col-md-12">Price: </label>
                            <div class="col-12 col-sm-5 col-md-7">
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_price' id='p_price'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end price -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-5 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Adjustment Price :</label>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id='p_adjustprice' name='p_adjustprice'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>
                                <!--  -->
                            </div>
                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Less :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_less' id='p_less'
                                        class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)">
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- END Partial Payment -->
                    <!-- price -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <label style='font-size:15px;font-weight: bold;' class="col-md-12">Partial Payment: </label>
                            <div class="col-12 col-sm-5 col-md-7">
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_partial_payment'
                                        id='p_partial_payment' onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end partial payment -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-5 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Net Total :</label>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" readonly class="form-control" id='p_net_total' name='p_net_total'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>
                                <!--  -->
                            </div>
                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Total Amount :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_total_amount'
                                        id='p_total_amount' class="form-control" readonly>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- END Price -->
                    <!-- end net total and amount -->
                </div>
                <div class="modal-footer">
                    <button type="submit" name='submit' id='submit' class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>



<!-- MODAL OF REMOVE EXPENSES -->
<div class="modal fade" id="removePurchase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REMOVE PURCHASE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../function/ledger/removePurchase.php" method="POST">
                    <input type="text" id="my_id" name="my_id" style="display: none">
                    <!--hide from uder, for db locate id only -->
                    <p>Please confirm to remove this row data...</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MODAL OF UPDATE PURCHASE -->
<div class="modal fade" id="updatePurchase" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">UPDATE PURCHASE</h5>
            </div>
            <form action="../function/ledger/updatePurchase.php" id='submitPurchase' method="POST">
                <div class="modal-body">
                    <!--this input is to locate id purposes only -->
                    <input type="text" name="my_id" id="my_id" style="display: none">

                    <div class="form-group">
                        <label class="col-md-12">DATE</label>
                        <div class="col-md-12">
                            <input class='datepicker' value="<?php echo $today; ?>" type="date" id="update_date" name="date"
                                required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-6 col-md-6">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Voucher</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_voucher' id='update_p_voucher'
                                        class="form-control" style='background-color:white;border:0px solid #ffffff;'>
                                </div>
                            </div>
                            <!--end  -->
                            <div class="col-6 col-md-6">
                                <select class='pur_category' name='pur_category' id='update_pur_category' style='width:200px'
                                    required>
                                    <option disabled="disabled" selected="selected">Select Category</option>
                                    <?php echo $purCatList; ?>
                                </select>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Customer Name</label>
                        <div class="col-md-8">
                            <input type="text" name='p_name' id='update_p_name' class="form-control form-control-line"
                                required>
                        </div>
                    </div>
                    <!-- net kilos -->
                    <br>
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-12 col-md-12">
                                <!--  -->
                                <div class="input-group mb-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"
                                            style='color:black;font-weight: bold;'>Net Kilos</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_net-kilos' id='update_p_net-kilos'
                                        class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- end net kilos -->
                    <!-- price -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <label style='font-size:15px;font-weight: bold;' class="col-md-12">Price: </label>
                            <div class="col-12 col-sm-5 col-md-7">
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_price' id='update_p_price'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end price -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-5 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Adjustment Price :</label>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" class="form-control" id='update_p_adjustprice' name='p_adjustprice'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>
                                <!--  -->
                            </div>
                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Less :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_less' id='update_p_less'
                                        class="form-control" onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)">
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- END Partial Payment -->
                    <!-- price -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <label style='font-size:15px;font-weight: bold;' class="col-md-12">Partial Payment: </label>
                            <div class="col-12 col-sm-5 col-md-7">
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_partial_payment'
                                        id='update_p_partial_payment' onkeypress="return CheckNumeric()"
                                        onkeyup="FormatCurrency(this)" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end partial payment -->
                    <div class="form-group">
                        <div class="row no-gutters">
                            <div class="col-12 col-sm-5 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Net Total :</label>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" readonly class="form-control" id='update_p_net_total' name='p_net_total'
                                        onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" />
                                </div>
                                <!--  -->
                            </div>
                            <div class="col-6 col-md-6">
                                <label style='font-size:15px' class="col-md-12">Total Amount :</label>
                                <!-- new column -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" style='text-align:right' name='p_total_amount'
                                        id='update_p_total_amount' class="form-control" readonly>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- END Price -->
                    <!-- end net total and amount -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name='submit' id='submit' class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<script>

    $(function() {
        $("#update_p_price").keyup(function() {

            $("#update_p_total_amount").val(((+$("#update_p_net-kilos").val().replace(/,/g, '') * +$("#update_p_price").val().replace(/,/g, ''))).toLocaleString());
        });
    });

    $(function() {
        $("#update_p_adjustprice").keyup(function() {

            $("#update_p_net_total").val(((+$("#update_p_net-kilos").val().replace(/,/g, '') * +$("#update_p_adjustprice").val().replace(/,/g, ''))).toLocaleString());
        });
    });


    $(function() {
        $("#update_p_less").keyup(function() {

            $("#update_p_total_amount").val(((+$("#update_p_total_amount").val().replace(/,/g, '') - (+$("#update_p_less").val().replace(/,/g, ''))).toLocaleString()));
        });
    });

    $(function() {
        $("#update_p_partial_payment").keyup(function() {

            var total_amount = $("#update_p_total_amount").val().replace(/,/g, '').toLocaleString();
            var partial = $("#update_p_partial_payment").val().replace(/,/g, '').toLocaleString();

            $("#update_p_total_amount").val(total_amount - partial);

        });
    });
  //scripts to get the value from expenses.php to remove
  const exampleModalRemove = document.getElementById('removePurchase')
  exampleModalRemove.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const idRemove = button.getAttribute('data-bs-id')
      //
      // Update the modal's content.
      const modalTitleRemove = exampleModalRemove.querySelector('.modal-title')
      const my_idRemove = exampleModalRemove.querySelector('.modal-body #my_id')

      my_idRemove.value = idRemove

  })

  //scripts to get the value from expenses.php to update

  const exampleModal = document.getElementById('updatePurchase')
  exampleModal.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const id = button.getAttribute('data-bs-id')
      const date = button.getAttribute('data-bs-date')
      const category = button.getAttribute('data-bs-category')
      const voucher = button.getAttribute('data-bs-voucher')
      const customer_name = button.getAttribute('data-bs-customer_name')
      const net_kilos = button.getAttribute('data-bs-net_kilos')
      const price = button.getAttribute('data-bs-price')
      const adjustment_price = button.getAttribute('data-bs-adjustment_price')
      const less = button.getAttribute('data-bs-less')
      const partial_payment = button.getAttribute('data-bs-partial_payment')
      const net_total = button.getAttribute('data-bs-net_total')
      const total_amount = button.getAttribute('data-bs-total_amount')
      
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      const modalTitle = exampleModal.querySelector('.modal-title')
      const myID = exampleModal.querySelector('.modal-body #my_id')
      const dateID = exampleModal.querySelector('.modal-body #update_date')
      const categoryID = exampleModal.querySelector('.modal-body #update_pur_category')
      const voucherID = exampleModal.querySelector('.modal-body #update_p_voucher')
      const customer_nameID = exampleModal.querySelector('.modal-body #update_p_name')
      const net_kilosID = exampleModal.querySelector('.modal-body #update_p_net-kilos')
      const priceID = exampleModal.querySelector('.modal-body #update_p_price')
      const adjustment_priceID = exampleModal.querySelector('.modal-body #update_p_adjustprice')
      const lessID = exampleModal.querySelector('.modal-body #update_p_less')
      const partial_paymentID = exampleModal.querySelector('.modal-body #update_p_partial_payment')
      const net_totalID = exampleModal.querySelector('.modal-body #update_p_net_total')
      const total_amountID = exampleModal.querySelector('.modal-body #update_p_total_amount')

      
      modalTitle.textContent = `Update Purchase ID #${id}`
      myID.value = id
      dateID.value = date
      categoryID.value = category
      voucherID.value = voucher
      customer_nameID.value = customer_name
      net_kilosID.value = net_kilos
      priceID.value = price
      adjustment_priceID.value = adjustment_price
      lessID.value = less
      partial_paymentID.value = partial_payment
      net_totalID.value = net_total
      total_amountID.value = total_amount

  })
</script>