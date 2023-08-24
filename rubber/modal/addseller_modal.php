<?php
$loc = str_replace(' ', '', $_SESSION['loc']);
$get = mysqli_query($con, "SELECT  COUNT(*) from rubber_seller where loc='$loc'  ");
$sellerCount = mysqli_fetch_array($get);

$generate = sprintf("%'03d", $sellerCount[0] + 1);
$today = date("Y");
$code = $today . '-' . $generate;
?>

<div class="modal fade" id="add_seller" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NEW SUPPLIER</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/newSeller.php" id="myForm"  method="POST">
                    <!-- ... START -->
                    <center>
                        <div class="form-group">
                            <label class="col-md-12">ID</label>
                            <div class="col-md-8">
                                <input type="text" value="<?php echo $generate; ?>" name='code' class="form-control form-control-line" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="col-md-12">Supplier Name</label>
                                <div class="col-md-8">
                                    <input type="text" name='name' class="form-control form-control-line">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-8">
                                        <input type="text" name='address' class="form-control form-control-line">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-md-12">Contact No.</label>
                                        <div class="col-md-8">
                                            <input type="text" name='contact' class="form-control form-control-line">
                                        </div>
                    </center>
                    <!-- END -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='add' class="btn btn-success text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- transaction -->

<div class="modal fade" id="add_seller1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NEW SELLER</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="function/transaction_new.php" method="POST">
                    <!-- ... START -->
                    <center>
                        <div class="form-group">
                            <label class="col-md-12">CODE</label>
                            <div class="col-md-8">
                                <input type="text" value="<?php echo $generate; ?>" name='code' class="form-control form-control-line" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="col-md-12">Name</label>
                                <div class="col-md-8">
                                    <input type="text" name='name' class="form-control form-control-line">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-8">
                                        <input type="text" name='address' class="form-control form-control-line">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-md-12">Contact No.</label>
                                        <div class="col-md-8">
                                            <input type="text" name='contact' class="form-control form-control-line">
                                        </div>
                    </center>
                    <!-- END -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name='new_seller' class="btn btn-success text-white">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
    $('#myForm').submit(function(){
        $('#submitButton').prop('disabled', true);
    });
});
</script>