<?php
include 'include/header.php';
include 'include/navbar.php';

rubber_page_begin('EJN Rubber Transactions', 'EJN rubber transfers from planta', 'Transfer Records');
?>
<style>
.number-cell {
    text-align: right;
}
</style>
<div class="rubber-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createNew">
        <i class="fas fa-plus me-1"></i> Create Transfer
    </button>
</div>
<div class="table-responsive">
    <table class="table table-hover w-100" id="inventory-table">
        <?php
        $results = mysqli_query($con, "SELECT * FROM `ejn_rubber_transfer` where source='$loc'");
        ?>
        <thead class="table-dark">
            <tr>
                <th scope="col">Status</th>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Supplier</th>
                <th scope="col">Location</th>
                <th scope="col">Purchase Weight</th>
                <th scope="col">Purchase Cost</th>
                <th scope="col">Average Cost</th>
                <th scope="col">Remarks</th>
                <th scope="col">Recorded by</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Record</h5>
            </div>
            <form method="POST" action="function/newEjnRubber.php">
                <div class="modal-body">
                    <input type="hidden" name="id" id="u_id">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" id="u_date" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Supplier</label>
                                <input type="text" class="form-control" name="supplier" id="u_supplier" readonly required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" name="loc" id="u_loc" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="total_buying_weight" class="form-label">Total Buying Weight</label>
                                <input type="text" class="form-control" name="weight" id="u_weight" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="total_purchase_cost" class="form-label">Total Purchase Cost</label>
                                <input type="text" class="form-control" name="cost" id="u_cost" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="ave_kiloCost" class="form-label">Average Kilo Cost</label>
                                <input type="text" class="form-control" name="aveCost" id="u_aveCost" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <input type="text" class="form-control" name="remarks" id="u_remarks">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="recorded_by" class="form-label">Recorded By</label>
                            <input type="text" class="form-control" name="recorded_by" id="u_recorded" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- create Table Row -->
<div class="modal fade" id="createNew" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> EJN RUBBER | TRANSFER</h5>
            </div>
            <form method="POST" action="function/newEjnRubber.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Supplier</label>
                                <input type="text" class="form-control" name="supplier" value="EJN RUBBER" readonly required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Location</label>
                                <input type="location" class="form-control" name="loc" value="LAMITAN CITY" required placeholder="Date of Transaction">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="product_name" class="form-label">Total Buying Weight</label>
                            <div class="input-group mb-3">
                                <input type="text" style="text-align:right" id="net_weight" name="net_weight" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label for="product_name" class="form-label">Total Purchase Cost</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" id="purchase_cost" name="purchase_cost" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" required>
                            </div>
                        </div>
                        <div class="col">
                            <label for="product_name" class="form-label">Average Kilo Cost</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" name="ave_cost" id="ave_cost" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Remarks (Optional)</label>
                            <input type="text" class="form-control" name="remarks" placeholder="Enter Remark">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Recorded By</label>
                            <input type="text" class="form-control" name="recorded_by" placeholder="Recorded By" value="JANE">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add" class="btn btn-success">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="function/newEjnRubber.php">
                <div class="modal-body">
                    <input type="text" class="form-control" id="d_id" name="id" hidden>
                    <p class="text-center text-danger"><i class="fa fa-exclamation-triangle" style="font-size: 2em;"></i></p>
                    <p class="text-center">Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('net_weight').addEventListener('keyup', calculateAverageKiloCost);
document.getElementById('purchase_cost').addEventListener('keyup', calculateAverageKiloCost);

function calculateAverageKiloCost() {
    var netWeight = parseFloat(document.getElementById('net_weight').value.replace(/,/g, ''));
    var purchaseCost = parseFloat(document.getElementById('purchase_cost').value.replace(/,/g, ''));
    if (isNaN(netWeight) || isNaN(purchaseCost)) {
        document.getElementById('ave_cost').value = '';
    } else if (netWeight === 0) {
        document.getElementById('ave_cost').value = '';
    } else {
        var averageKiloCost = purchaseCost / netWeight;
        document.getElementById('ave_cost').value = formatCurrency(averageKiloCost.toFixed(2));
    }
}

document.getElementById('u_weight').addEventListener('keyup', updateCalculateAverageKiloCost);
document.getElementById('u_cost').addEventListener('keyup', updateCalculateAverageKiloCost);

function updateCalculateAverageKiloCost() {
    var netWeight = parseFloat(document.getElementById('u_weight').value.replace(/,/g, ''));
    var purchaseCost = parseFloat(document.getElementById('u_cost').value.replace(/,/g, ''));
    if (isNaN(netWeight) || isNaN(purchaseCost)) {
        document.getElementById('u_aveCost').value = '';
    } else if (netWeight === 0) {
        document.getElementById('u_aveCost').value = '';
    } else {
        var averageKiloCost = purchaseCost / netWeight;
        document.getElementById('u_aveCost').value = (averageKiloCost.toFixed(2));
    }
}

function formatCurrency(number) {
    return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(number);
}
</script>
<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-ejn-record.js"></script>
<?php rubber_page_end(); ?>
