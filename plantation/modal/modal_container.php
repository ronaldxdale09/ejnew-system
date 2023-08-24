<?php
$today = date('Y-m-d');
?>

<!-- Add New Container Modal -->
<div class="modal fade" id="newContainer" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">New Container</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/container.php" method="POST">

                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Van No.</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='van_no' id='n_van' tabindex="2" autocomplete='off' style="width: 100px;" require />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Withdrawal
                                Date</label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' id="date" tabindex="3" value="<?php echo $today; ?>" name="n_date" require>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Particulars (Buyer)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='remarks' id='n_remarks' tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Recorded by</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='recorded' id='n_recorded' value="<?php echo $name; ?>" tabindex="7" autocomplete='off' style="width: 100px;" require />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Quality</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="quality" id="n_quality" tabindex="7" required>
                                    <option disabled selected>Select quality...</option>
                                    <option value="SPR5">5L</option>
                                    <option value="SPR5">SPR-5</option>
                                    <option value="SPR10">SPR-10</option>
                                    <option value="SPR20">SPR-20</option>
                                    <option value="Offcolor">Off Color</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Kilo per
                                Bale</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="kilo_bale" id="n_kilo_bale" tabindex="7" required>
                                    <option disabled selected>Select kilo...</option>
                                    <option value="35kg">35.00 kg</option>
                                    <option value="33.33kg">33.33 kg</option>
                                </select>
                            </div>
                        </div>
                    </div> <br>
                    <div class="alert alert-success alert-dismissible">
                        <strong>Reminder:</strong> Please double-check all data for accuracy before proceeding. Thank you.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name='new'>Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- 
<script>
document.getElementById("proceedButton").addEventListener("click", function() {
    window.location.href = "container.php";
});
</script> -->


<!-- Add  Container Modal -->
<div class="modal fade" id="viewContainer" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel"> Container Details</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/container.php" method="POST">
                <input type="text" class="form-control" id='v_id' name='id' readonly hidden />
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Van No.</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_van' tabindex="7" autocomplete='off' style="width: 100px;" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Withdrawal
                                Date</label>
                            <div class="col-md-12">
                                <input type="text" class='form-control' id="v_date" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Particulars</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_remarks' tabindex="7" autocomplete='off' style="width: 100px;" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Recorded by</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_recorded' tabindex="7" autocomplete='off' style="width: 100px;" readonly />
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Quality</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_quality' tabindex="7" autocomplete='off' style="width: 100px;" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Kilo per
                                Bale</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id='v_kilo' tabindex="7" autocomplete='off' style="width: 100px;" readonly />
                            </div>
                        </div>
                    </div>



                    <div id='bales_container_record'> </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" id='editButton' name='edit'> <i class="fas fa-pen"></i> Edit</button>
                    <button type="submit" class="btn btn-primary " id='releaseButton' name='released'> <i class="fas fa-shipping-fast"></i> Release</button>
                </div>
            </form>
        </div>
    </div>
</div>