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
            <form action="function/cuplump_container.php" method='POST'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Container
                                No.</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='container_no' tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Loading
                                Date</label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' name="date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Remarks</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='remarks' autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Recorded by:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='recorded_by' id='ship_user' tabindex="7" autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name='add'>Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <script>
document.getElementById("proceedButton").addEventListener("click", function() {
    window.location.href = "cuplump_container.php";
});
</script> -->