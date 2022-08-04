<!-- Modal -->
<div class="modal fade" id="modalBuahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">BUAHAN TOPPERS</h5>
                <button type="button" class="btn btn-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/ledger/addBuahan.php" id='myform' method="POST">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">DATE</label>
                                            <div class="col-md-12">
                                                <input class='datepicker' value="<?php echo $today; ?>" type="date"
                                                    id="date" name="date" autocomplete='off' required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">VOUCHER #</label>
                                            <div class="col-md-8">
                                                <input type="text" name='voucher' autocomplete='off' class="form-control form-control-line"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group mb-12">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"
                                                        style='color:black;font-weight: bold;'>Net Kilos</span>
                                                </div>
                                                <input type="text" style='text-align:right' name='net_kilos'
                                                    id='net_kilos' class="form-control"
                                                    onkeypress="return CheckNumeric()" autocomplete='off'  onkeyup="FormatCurrency(this)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Kg</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;'
                                                    class="col-md-12">Price: </label>
                                                <div class="col-md-12">
                                                    <!--  -->
                                                    <div class="input-group mb-5">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='price' id='price'
                                                            class="form-control" onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" autocomplete='off' required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;'
                                                    class="col-md-12">Total: </label>
                                                <div class="col-md-12">
                                                    <!--  -->
                                                    <div class="input-group mb-5">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='total'  id='total' 
                                                            class="form-control" onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" autocomplete='off' required>
                                                    </div>
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
                    <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<!-- MODAL OF REMOVE BUAHAN -->
<div class="modal fade" id="removeBuahan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REMOVE BUAHAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../function/ledger/removeBuahan.php" method="POST">
                    <input type="text" id="my_id" name="my_id" style="display: none">
                    <!--hide from uder, for db locate id only -->
                    <p>Please confirm to remove this row data of <b id="vouch_name" style="text-transform: capitalize;"></b>.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- MODAL OF UPDATE BUAHAN -->
<div class="modal fade" id="updateBuahan" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">UPDATE BUAHAN</h5>
            </div>
            <form action="../function/ledger/updateBuahan.php" id='submitPurchase' method="POST">
                <div class="modal-body">
                    <!--this input is to locate id purposes only -->
                    <input type="text" name="my_id" id="my_id" style="display: none">
                    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">DATE</label>
                                            <div class="col-md-12">
                                                <input class='datepicker' value="<?php echo $today; ?>" type="date"
                                                    id="date" name="date" autocomplete='off' required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">VOUCHER #</label>
                                            <div class="col-md-8">
                                                <input type="text" name='voucher' id="voucher" autocomplete='off' class="form-control form-control-line"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group mb-12">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default"
                                                        style='color:black;font-weight: bold;'>Net Kilos</span>
                                                </div>
                                                <input type="text" style='text-align:right' name='net_kilos'
                                                    id='update_net_kilos' class="form-control"
                                                    onkeypress="return CheckNumeric()" autocomplete='off'  onkeyup="FormatCurrency(this)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Kg</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;'
                                                    class="col-md-12">Price: </label>
                                                <div class="col-md-12">
                                                    <!--  -->
                                                    <div class="input-group mb-5">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='price' id='update_price'
                                                            class="form-control" onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" autocomplete='off' required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px;font-weight: bold;'
                                                    class="col-md-12">Total: </label>
                                                <div class="col-md-12">
                                                    <!--  -->
                                                    <div class="input-group mb-5">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='total'  id='update_total' 
                                                            class="form-control" onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" autocomplete='off' required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END BALANCE -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name='submit' class="btn btn-success">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<script>
    $(function() {
        $("#update_price").keyup(function() {

            $("#update_total").val(((+$("#update_net_kilos").val().replace(/,/g, '') * +$("#update_price").val().replace(/,/g, ''))).toLocaleString());
        });
    });
  //scripts to get the value from expenses.php to remove
  const exampleModalRemove = document.getElementById('removeBuahan')
  exampleModalRemove.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const idRemove = button.getAttribute('data-bs-id')
      const voucherRemove = button.getAttribute('data-bs-voucher')
      //
      // Update the modal's content.
      const modalTitleRemove = exampleModalRemove.querySelector('.modal-title')
      const my_idRemove = exampleModalRemove.querySelector('.modal-body #my_id')
      const voucher = exampleModalRemove.querySelector('.modal-body #vouch_name')

      my_idRemove.value = idRemove
      voucher.textContent = voucherRemove

  })

  //scripts to get the value from expenses.php to update

  const exampleModal = document.getElementById('updateBuahan')
  exampleModal.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const id = button.getAttribute('data-bs-id')
      const date = button.getAttribute('data-bs-date')
      const voucher = button.getAttribute('data-bs-voucher')
      const net_kilos = button.getAttribute('data-bs-net_kilos')
      const price = button.getAttribute('data-bs-price')
      const total = button.getAttribute('data-bs-total')
      
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      const myID = exampleModal.querySelector('.modal-body #my_id')
      const dateID = exampleModal.querySelector('.modal-body #date')
      const voucherID = exampleModal.querySelector('.modal-body #voucher')
      const net_kilosID = exampleModal.querySelector('.modal-body #update_net_kilos')
      const priceID = exampleModal.querySelector('.modal-body #update_price')
      const totalID = exampleModal.querySelector('.modal-body #update_total')

      
      myID.value = id
      dateID.value = date
      voucherID.value = voucher
      net_kilosID.value = net_kilos
      priceID.value = price
      totalID.value = total

  })
</script>