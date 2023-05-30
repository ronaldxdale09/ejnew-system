<!-- Add New Container Modal -->
<div class="modal fade" id="newContainer" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">New Container</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Container
                            No.</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='ship_destination' id='ship_destination'
                                tabindex="7" autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Withdrawal
                            Date</label>
                        <div class="col-md-12">
                            <input type="date" class='form-control' id="ship_date" value="<?php echo $today; ?>"
                                name="ship_date">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Quality</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='ship_info_lading' id='ship_info_lading'
                                tabindex="7" autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Kilo per
                            Bale</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='ship_info_lading' id='ship_info_lading'
                                tabindex="7" autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Remarks</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='ship_remarks' id='ship_remarks' tabindex="7"
                                autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Recorded by:</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name='ship_user' id='ship_user' tabindex="7"
                                autocomplete='off' style="width: 100px;" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="proceedButton">Proceed</button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("proceedButton").addEventListener("click", function() {
    window.location.href = "container.php";
});
</script>