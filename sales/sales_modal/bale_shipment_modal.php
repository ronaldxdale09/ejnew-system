<?php
$today = date('Y-m-d');
?>
<!-- Add New Container Modal -->
<div class="modal fade" id="newShipment" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">New Bales Shipment</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/bale_shipment.php" method="POST">

                <div class="modal-body">
      
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Type</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="type" name="type" style="width: 100px;">
                                    <option>Select</option>
                                    <option value="EXPORT">Export</option>
                                    <option value="LOCAL">Local</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Shipment Date
                                Date</label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' id="date" value="<?php echo $today; ?>"
                                    name="n_date" require>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Destination</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='destination' id='destination'
                                    tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Source</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='source' id='source' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Vessel</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='vessel' id='vessel' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Bill of
                                Lading</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='info_lading' id='info_lading'
                                    tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Remarks</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='remarks' id='remarks'
                                    tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Recorded by:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='recorded_by' id='recorded_by' tabindex="7"
                                    autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
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