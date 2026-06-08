<?php
include 'include/header.php';
include 'include/navbar.php';

rubber_page_begin('Cuplump Purchase', 'Wet rubber purchase records', 'Purchase Records');
?>
<style>
.number-cell {
    text-align: right;
}
</style>
<div class="rubber-toolbar">
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createNew">
        <i class="fas fa-plus me-1"></i> New Purchase
    </button>
</div>
<div class="table-responsive">
                                <table class="table" id='wet_record_table'>
                                    <thead class="table-dark" style='font-size:15px'>
                                        <tr>
                                            <th scope="col">Invoice</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Seller</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">First Price</th>
                                            <th scope="col">Second Price</th>
                                            <th scope="col">Net Weight</th>
                                            <th scope="col">Total Amount</th>
                                            <th scope="col">Cash Advance</th>
                                            <th scope="col">Amount Paid</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tfoot>
                                </table>
                            </div>

<div class="modal fade" id="createNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Cuplump Purchase</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/wetPurchasing.php'>
                <div class="modal-body">
                    <input type="text" class="form-control" id="d_id" name='dry_id' hidden>
                    <p class="text-center text-success"><i class="fa fa-plus-circle" style="font-size:3em;"></i>
                    </p>
                    <p class="text-center">Proceed to Cuplump Purchasing</p>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="recorded_by">Recorded By</label>
                        <input type="text" class="form-control" id="recorded_by" name="recorded_by"
                            value="<?php echo $user_name ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name='new'>Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="viewRecord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Purchase Record</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/wetPurchasing.php'>
                <div class="modal-body">
                    <input type="text" class="form-control" id="w_id" name='id' hidden>
                    <div class="row">
                        <div class="col-lg-4 col-xlg-3 col-md-5">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="col-md-12">Reference #</label>
                                                <div class="col-md-12">
                                                    <input type="number" id='v_invoice'
                                                        class="form-control form-control-line" readonly>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Date</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="v_date" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Contract</label>
                                        <input type="text" id='v_contract' class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="col-md-12">Seller</label>
                                                <input type="text" id='v_seller' class="form-control" readonly>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Address</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id='address' name='address'
                                                tabindex="2" autocomplete='off' readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xlg-9 col-md-7">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Gross Weight
                                                        (Kilos)</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='gross' name='gross'
                                                            tabindex="2" autocomplete='off' readonly />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Deductable Tare
                                                        Kilos</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" id='tare' name='tare'
                                                            tabindex="3" readonly autocomplete='off' />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label style='font-size:15px' class="col-md-12">Net Weight</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" style='text-align:right' name='net' id='net'
                                                            class="form-control" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <hr>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px' class="col-md-12">1st Price :</label>
                                                <div class="col-12 col-sm-5 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" class="form-control" name='first_price'
                                                            id='first_price' readonly />
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <input type="text" style='text-align:right' id='first-weight'
                                                            class="form-control" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' id='first_total'
                                                            name='first_total' class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <label style='font-size:15px' class="col-md-12">2nd Price :</label>
                                                <div class="col-12 col-sm-5 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" class="form-control" id='second_price'
                                                            name='second_price' tabindex="8" autocomplete='off'
                                                            readonly />
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <input type="text" style='text-align:right' id='second-weight'
                                                            class="form-control" readonly>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">kg</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:right' name='second_total'
                                                            id='second_total' class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <div class="col-12 ">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroup-sizing-default"
                                                                style='color:black;font-weight: bold;'>Total Amount
                                                                ₱</span>
                                                        </div>
                                                        <input type="text" class="form-control" id='total-amount'
                                                            name='total-amount' readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <div class="col-12">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroup-sizing-default"
                                                                style='color:black;font-weight: bold;'>Less: Cash Adance
                                                                ₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:left' id='cash_advance'
                                                            name='cash_advance' class="form-control" tabindex="9"
                                                            autocomplete='off' readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row no-gutters">
                                                <div class="col-12">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroup-sizing-default"
                                                                style='color:black;font-weight: bold;'>Amount Paid
                                                                ₱</span>
                                                        </div>
                                                        <input type="text" style='text-align:left' name='amount-paid'
                                                            id='amount-paid' class="form-control" readonly>
                                                    </div>
                                                    <hr>
                                                    <input type="text" style='text-align:center' id='amount-paid-words'
                                                        class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name='edit'>Edit</button>
                    <button type="button" class="btn btn-danger" name='remove' id='removeBtn'>Remove</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method='POST' action='function/wetPurchasing.php'>
            <div class="modal-body">
            <input type="text" class="form-control" id="remove_w_id" name='id' hidden>

                <p>Are you sure you want to remove?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger" name="remove">Yes, Remove</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#removeBtn').click(function() {
    var id = $('#w_id').val();
    $('#remove_w_id').val(id);
    $('#confirmationModal').modal('show');
});
</script>
<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-cuplump-purchase.js"></script>
<?php rubber_page_end(); ?>