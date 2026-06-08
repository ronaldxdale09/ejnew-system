<div class="modal fade copra-modal" id="updateProfile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-user-pen me-1"></i> Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/updateProfile.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="my_id" id="my_id">
                    <input type="hidden" name="view_code" id="view_code" value="<?php echo htmlspecialchars($id ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="mb-2">
                        <label for="full_name" class="form-label">Full name</label>
                        <input type="text" name="full_name" class="form-control form-control-sm" id="full_name" required>
                    </div>
                    <div class="mb-2">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control form-control-sm" id="address" required>
                    </div>
                    <div class="mb-2">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" maxlength="11" placeholder="09*****1234" name="contact" class="form-control form-control-sm" id="contact" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-success btn-sm">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('updateProfile');
    if (!modal) return;

    $('#contact').keypress(function (e) {
        var allowed = [];
        for (var i = 48; i < 58; i++) allowed.push(i);
        if ($.inArray(e.which, allowed) < 0) e.preventDefault();
    });

    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        if (!button) return;
        modal.querySelector('#my_id').value = button.getAttribute('data-bs-id') || '';
        modal.querySelector('#full_name').value = button.getAttribute('data-bs-full_name') || '';
        modal.querySelector('#address').value = button.getAttribute('data-bs-address') || '';
        modal.querySelector('#contact').value = button.getAttribute('data-bs-contact') || '';
    });
});
</script>
