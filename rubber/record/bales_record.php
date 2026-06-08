<?php

include '../include/header.php';

include '../include/navbar.php';



$seller = "SELECT * FROM rubber_seller WHERE loc='$loc' ";

$result = mysqli_query($con, $seller);

$sellerList = '';

while ($arr = mysqli_fetch_array($result)) {

    $sellerList .= '<option value="' . $arr["name"] . '">' . $arr["name"] . '</option>';

}



rubber_page_begin('Bale Purchase Record', 'Historical bale purchase records', 'Purchase Records');

?>

<div class="row mb-3 align-items-end">

    <div class="col-md-4">

        <label class="form-label">Supplier</label>

        <select class="form-select" id="seller_filter">

            <option disabled="disabled" selected>Select Supplier</option>

            <option value="">All</option>

            <?php echo $sellerList; ?>

        </select>

    </div>

    <div class="col-md-4">

        <label class="form-label">From Date</label>

        <input type="text" id="min2" name="min" class="form-control" placeholder="From Date" />

    </div>

    <div class="col-md-4">

        <label class="form-label">To Date</label>

        <input type="text" id="max2" name="max" class="form-control" placeholder="To Date" />

    </div>

</div>

<div class="table-responsive">

    <table class="table table-striped table-hover table-bordered w-100" id="bales_table">

        <thead class="table-dark">

            <tr>

                <th scope="col">Invoice</th>

                <th scope="col">Date</th>

                <th scope="col">Contract</th>

                <th scope="col">Seller</th>

                <th scope="col">LOT #</th>

                <th scope="col">Entry Weight</th>

                <th scope="col">Net Weight</th>

                <th scope="col">First Price</th>

                <th scope="col">Second Price</th>

                <th scope="col">Cash Advance</th>

                <th scope="col">Amount Paid</th>

                <th scope="col">Action</th>

            </tr>

        </thead>

        <tbody></tbody>

    </table>

</div>



<div class="modal fade" id="viewBalesRecord" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Bale Purchase Record</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body"><div id="bales_rec"></div></div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="deleteRec" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Delete Record</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <form action="../function/records_delete.php" method="POST">

                <div class="modal-body text-center">

                    <p>Confirm to delete record</p>

                    <input type="text" name="d_bales_id" id="d_bales_id" class="form-control" readonly />

                </div>

                <div class="modal-footer">

                    <button type="submit" name="bales_remove" class="btn btn-danger">Confirm</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>

            </form>

        </div>

    </div>

</div>



<script src="../js/rubber-datatables-common.js"></script>

<script src="../js/rubber-bales-record-history.js"></script>

<?php if (isset($_SESSION['deleted'])) : ?>
<script>Swal.fire({ icon: 'success', title: 'Record deleted', timer: 1800, showConfirmButton: false });</script>
<?php unset($_SESSION['deleted']); endif; ?>

<?php rubber_page_end(); ?>

