<?php
 $month = date("m");
 $day = date("d");
 $year = date("Y");
 $dateNow = $year . "-" . $month . "-" . $day;
 
?>
<!-- Modal -->
<div class="modal fade" id="cashadvanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">CASH ADVANCE</h5>
                <button type="button" class="btn btn-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/ledger/addCashAdvance.php" id='myform' method="POST">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">DATE</label>
                                            <div class="col-md-12">
                                                <input class='datepicker' value="<?php echo $dateNow; ?>" type="date"
                                                    id="date" name="date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">VOUCHER #</label>
                                            <div class="col-md-8">
                                                <input type="text" name='voucher' class="form-control form-control-line"
                                                    autocomplete='off' required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">PARTICULARS</label>
                                            <div class="col-md-12">
                                                <input type="text" name='particular'
                                                    class="form-control form-control-line" autocomplete='off' required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">BUYING STATION</label>
                                            <div class="col-md-12">
                                                <input class="form-control" list="datalistOptions" name='station'
                                                    id="station" placeholder="Select Buying Station" autocomplete='off'>
                                                <datalist id="datalistOptions"> <?php echo $buyingStation; ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Subject</label>
                                            <div class="col-md-12">
                                                <input class="form-control" list="typeCA" name='category' id="category"
                                                    placeholder="Select Subject" autocomplete='off'>
                                                <datalist id='typeCA'>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Customer">Customer</option>
                                                    <option value="Karpentero">Karpentero</option>
                                                    <option value="Topper">Topper</option>
                                                    <option value="Maloong Contractual">Maloong Contractual</option>
                                                </datalist>
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
                                                    class="col-md-12">Amount: </label>
                                                <div class="col-md-12">
                                                    <!--  -->
                                                    <div class="input-group mb-5">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='amount'
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



<!-- MODAL OF REMOVE CASH ADVANCE -->
<div class="modal fade" id="removeCashAdvance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REMOVE CASH ADVANCE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../function/ledger/removeCA.php" method="POST">
                    <input type="text" id="my_id" name="my_id" style="display: none">
                    <!--hide from uder, for db locate id only -->
                    <p>Please confirm to remove this row data of <b id="customer_name" style="text-transform: capitalize;"></b>.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- MODAL OF UPDATE CASH ADVANCE -->
<div class="modal fade" id="updateCashAdvance" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">UPDATE CASH ADVANCE</h5>
            </div>
            <form action="../function/ledger/updateCashAdvance.php" id='submitPurchase' method="POST">
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
                                                    id="date" name="date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">VOUCHER #</label>
                                            <div class="col-md-8">
                                                <input type="text" name='voucher' id="voucher" class="form-control form-control-line"
                                                    autocomplete='off' required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">PARTICULARS</label>
                                            <div class="col-md-12">
                                                <input type="text" name='particular' id="particular"
                                                    class="form-control form-control-line" autocomplete='off' required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">BUYING STATION</label>
                                            <div class="col-md-12">
                                                <input class="form-control" list="datalistOptions" name='station'
                                                    id="station" placeholder="Select Buying Station" autocomplete='off'>
                                                <datalist id="datalistOptions"> <?php echo $buyingStation; ?>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Subject</label>
                                            <div class="col-md-12">
                                                <input class="form-control" list="typeCA" name='category' id="category"
                                                    placeholder="Select Subject" autocomplete='off'>
                                                <datalist id='typeCA'>
                                                    <option value="Employee">Employee</option>
                                                    <option value="Customer">Customer</option>
                                                    <option value="Karpentero">Karpentero</option>
                                                    <option value="Topper">Topper</option>
                                                    <option value="Maloong Contractual">Maloong Contractual</option>
                                                </datalist>
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
                                                    class="col-md-12">Amount: </label>
                                                <div class="col-md-12">
                                                    <!--  -->
                                                    <div class="input-group mb-5">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='amount'
                                                            class="form-control" id="amount" onkeypress="return CheckNumeric()"
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

  //scripts to get the value from expenses.php to remove
  const exampleModalRemove = document.getElementById('removeCashAdvance')
  exampleModalRemove.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const idRemove = button.getAttribute('data-bs-id')
      const name = button.getAttribute('data-bs-name')
      //
      // Update the modal's content.
      const modalTitleRemove = exampleModalRemove.querySelector('.modal-title')
      const my_idRemove = exampleModalRemove.querySelector('.modal-body #my_id')
      const customer_name = exampleModalRemove.querySelector('.modal-body #customer_name')

      my_idRemove.value = idRemove
      customer_name.textContent = `${name}`

  })

  //scripts to get the value from expenses.php to update

  const exampleModal = document.getElementById('updateCashAdvance')
  exampleModal.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const id = button.getAttribute('data-bs-id')
      const voucher = button.getAttribute('data-bs-voucher')
      const date = button.getAttribute('data-bs-date')
      const customer = button.getAttribute('data-bs-customer')
      const buying_station = button.getAttribute('data-bs-buying_station')
      const category = button.getAttribute('data-bs-category')
      const amount = button.getAttribute('data-bs-amount')
      
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      const myID = exampleModal.querySelector('.modal-body #my_id')
      const voucherID = exampleModal.querySelector('.modal-body #voucher')
      const dateID = exampleModal.querySelector('.modal-body #date')
      const customerID = exampleModal.querySelector('.modal-body #particular')
      const stationID = exampleModal.querySelector('.modal-body #station')
      const categoryID = exampleModal.querySelector('.modal-body #category')
      const amountID = exampleModal.querySelector('.modal-body #amount')

      
      myID.value = id
      voucherID.value = voucher
      dateID.value = date
      customerID.value = customer
      stationID.value = buying_station
      categoryID.value = category
      amountID.value = amount

  })
</script>