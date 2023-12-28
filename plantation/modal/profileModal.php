<!-- MODAL OF UPDATE PROFILE -->
<div class="modal fade" id="updateProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-edit"></span> UPDATE PROFILE</h5>
      </div>
      <form action="./function/updateProfile.php" method="POST">
        <div class="modal-body">
            <input type="text" name="my_id" id="my_id" style="display: none">
            <input type="text" name="view_code" id="<?php echo $id ?>" value="<?php echo $id ?>" style="display: none">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Full name:</label>
                <input type="text" name="full_name" class="form-control" id="full_name" required>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Address:</label>
                <input type="text" name="address" class="form-control" id="address" required>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Contact:</label>
                <input type="text" maxlength=11 placeholder="09*****1234" name="contact" class="form-control" id="contact" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-success">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  $('#contact').keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
        a.push(i);

    if (!($.inArray(k,a)>=0))
        e.preventDefault();
})

  const exampleModalRemove = document.getElementById('updateProfile')
  exampleModalRemove.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const id = button.getAttribute('data-bs-id')
      const fullname = button.getAttribute('data-bs-full_name')
      const address = button.getAttribute('data-bs-address')
      const contact = button.getAttribute('data-bs-contact')
      //
      // Update the modal's content.
      const modalTitleRemove = exampleModalRemove.querySelector('.modal-title')
      const showId = exampleModalRemove.querySelector('.modal-body #my_id')
      const showFullname = exampleModalRemove.querySelector('.modal-body #full_name')
      const showAddress = exampleModalRemove.querySelector('.modal-body #address')
      const showContact = exampleModalRemove.querySelector('.modal-body #contact')

      showId.value = id
      showFullname.value = fullname
      showAddress.value = address
      showContact.value = contact

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