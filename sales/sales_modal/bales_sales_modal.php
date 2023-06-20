<!-- create Table Row -->
<div class="modal fade" id="newWetExport" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> NEW BALES EXPORT TRANSACTION</h5>
            </div>
            <form method='POST' action='function/bale_sales.php'>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Date of Transaction</label>
                                <input type="date" class="form-control" name="date" required placeholder="Date of Transaction">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Recorded By</label>
                                <input type="text" class="form-control" name="recorded_by" placeholder="Recorded By" value='<?php echo $name ?>' required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">EN Sale Contract</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='contract' autocomplete='off' style="width: 100px;">
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Buyer Purchase Contract</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='purchase_contract' style="width: 100px;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Sale Type</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="sale_type" style="width: 100px;">
                                    <option selected disabled>Choose...</option>
                                    <option value="EXPORT">Dry Export</option>
                                    <option value="LOCAL">Bale Local</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Quality</label>
                            <div class="input-group mb-3">
                                <select class="form-select" name="quality" tabindex="7" required>
                                    <option disabled selected>Select quality...</option>
                                    <option value="SPR5">5L</option>
                                    <option value="SPR5">SPR-5</option>
                                    <option value="SPR10">SPR-10</option>
                                    <option value="SPR20">SPR-20</option>
                                    <option value="Offcolor">Off Color</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Remarks</label>
                            <input type="text" class="form-control" name="remarks" placeholder="Enter Remark">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" name='new' class="btn btn-success">Proceed</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>