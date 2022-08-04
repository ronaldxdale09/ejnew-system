<!-- Modal -->
<div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark" >
        <h5 class="modal-title text-light" id="exampleModalLongTitle">EXPENSES</h5>
        <button type="button" class="btn btn-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="function/ledger/addExpenses.php" id='myform' method="POST">
        <div class="modal-body ">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-12">DATE</label>
                      <div class="col-md-12">
                        <input class='datepicker'  value="<?php echo $today; ?>" type="date" id="date" name="date" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-md-12">VOUCHER #</label>
                      <div class="col-md-8">
                        <input type="text" name='voucher' class="form-control form-control-line" required>
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
                        <input type="text" name='particular' class="form-control form-control-line" required>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-md-12">Category</label>
                      <div class="col-md-12">
                        <input class="form-control" list="datalistOptions" name='category' id="category" placeholder="Search Category">
                        <datalist id="datalistOptions"> <?php echo $exCatList; ?> </datalist>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="row no-gutters">
                        <label style='font-size:15px;font-weight: bold;' class="col-md-12">Amount: </label>
                        <div class="col-md-12">
                          <!--  -->
                          <div class="input-group mb-5">
                            <div class="input-group-prepend">
                              <span class="input-group-text">₱</span>
                            </div>
                            <input type="text" style='text-align:right' name='amount' class="form-control" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
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
      </form>
    </div>
  </div>
</div>
</div>


   
<!-- MODAL OF UPDATE EXPENSES -->
<div class="modal fade" id="updateExpense" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">UPDATE EXPENSE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../function/ledger/updateExpenses.php" method="POST">
                    <input type="text" id="my_id" name="my_id" style="display : none;">
                    <!--hide from uder, for db locate id only -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">DATE</label>
                                            <div class="col-md-12">
                                                <input class='datepicker' type="date" id="update_date"
                                                    name="update_date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12">VOUCHER #</label>
                                            <div class="col-md-8">
                                                <input type="text" name='update_voucher' id="update_voucher"
                                                    class="form-control form-control-line" required>
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
                                                <input type="text" name='update_particular' id="update_particular_name"
                                                    class="form-control form-control-line" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">Category</label>
                                            <div class="col-md-12">
                                                <input class="form-control" list="datalistOptions"
                                                    name='update_category' id="update_category"
                                                    placeholder="Search Category">
                                                <datalist id="datalistOptions"> <?php echo $exCatList; ?> </datalist>
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
                                                        <input type="text" style='text-align:right' name='update_amount'
                                                            id="update_amount" class="form-control"
                                                            onkeypress="return CheckNumeric()"
                                                            onkeyup="FormatCurrency(this)" required>
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
                        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MODAL OF REMOVE EXPENSES -->
<div class="modal fade" id="removeExpense" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REMOVE EXPENSE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../function/ledger/removeExpenses.php" method="POST">
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


<script>

  //scripts to get the value from expenses.php to remove
  const exampleModalRemove = document.getElementById('removeExpense')
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

  const exampleModal = document.getElementById('updateExpense')
  exampleModal.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const id = button.getAttribute('data-bs-id')
      const date = button.getAttribute('data-bs-date')
      const particular_name = button.getAttribute('data-bs-name')
      const voucher = button.getAttribute('data-bs-voucher')
      const category = button.getAttribute('data-bs-category')
      const amount = button.getAttribute('data-bs-amount')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      const modalTitle = exampleModal.querySelector('.modal-title')
      const my_id = exampleModal.querySelector('.modal-body #my_id')
      const update_dateID = exampleModal.querySelector('.modal-body #update_date')
      const update_nameID = exampleModal.querySelector('.modal-body #update_particular_name')
      const update_voucherID = exampleModal.querySelector('.modal-body #update_voucher')
      const update_categoryID = exampleModal.querySelector('.modal-body #update_category')
      const update_amountID = exampleModal.querySelector('.modal-body #update_amount')

      modalTitle.textContent = `Update Expense ID #${id}`
      update_dateID.value = date
      update_nameID.value = particular_name
      update_voucherID.value = voucher
      update_categoryID.value = category
      update_amountID.value = amount
      my_id.value = id

  })
</script>



