<?php
$today = date('Y-m-d');
?>

<!-- Add  Container Modal -->
<div class="modal fade" id="viewContainer" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel"> Container Details</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="text" class="form-control" id='v_id' name='id' readonly hidden />
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Van No.</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id='v_van' tabindex="7" autocomplete='off'
                                style="width: 100px;" readonly />
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
                            <input type="text" class="form-control" id='v_remarks' tabindex="7" autocomplete='off'
                                style="width: 100px;" readonly />
                        </div>
                    </div>
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Bale Quality</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id='v_kilo' tabindex="7" autocomplete='off'
                                style="width: 100px;" readonly />
                        </div>
                    </div>
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Recorded by</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id='v_recorded' tabindex="7" autocomplete='off'
                                style="width: 100px;" readonly />
                        </div>
                    </div>
                </div>
                <hr>



                <div id='bales_container_record'> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>