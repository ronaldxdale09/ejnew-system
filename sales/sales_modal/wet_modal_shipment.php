
<div class="modal fade" id="newWetExport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> NEW | CUPLUMP SHIPMENT</h5>
            </div>
            <form method='POST' action='cuplump_shipment.php'>

                <div class="modal-body">

                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Date of Transaction</label>
                                <input type="date" class="form-control" name="date"
                                    placeholder="Date of Transaction">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Recorded By</label>
                                <input type="text" class="form-control" name="user">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Remarks</label>
                            <input type="text" class="form-control" name="remarks">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name='new' class="btn btn-success">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>