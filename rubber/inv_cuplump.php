<?php
include 'include/header.php';
include 'include/navbar.php';

$sql = mysqli_query($con, "SELECT SUM(reweight) as inventory from  planta_recording where status='Field'  and source='$loc'  ");
$cuplumps = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(crumbed_weight) as inventory from  planta_recording where status='Milling' and source='$loc'  ");
$milling = mysqli_fetch_array($sql);

$sql = mysqli_query($con, "SELECT SUM(dry_weight) as inventory from  planta_recording where status='Drying' and source='$loc'  ");
$drying = mysqli_fetch_array($sql);

rubber_page_begin('Cuplump Inventory', 'Cuplump stock summary', 'Inventory');
?>
<style>
.number-cell {
    text-align: right;
}
</style>
<div class="row">
                            <div class="col">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>CUPLUMP</b> INVENTORY</p>
                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($cuplumps['inventory'] ?? 0, 0) ?> kg
                                        </h3>
                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--danger">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-weight" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>CRUMB</b> INVENTORY</p>

                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($milling['inventory'] ?? 0, 0) ?> kg
                                        </h3>

                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--secondary">
                                        <div class="stat-card__icon-circle">
                                            <i class="fas fa-tint"></i><i class="fas fa-wind"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="stat-card">
                                    <div class="stat-card__content">
                                        <p class="text-uppercase mb-1 text-muted"><b>BLANKET</b> INVENTORY</p>

                                        <h3>
                                            <i class="text-danger font-weight-bold mr-1"></i>
                                            <?php echo number_format($drying['inventory'] ?? 0, 0) ?> kg
                                        </h3>

                                        <div>
                                            <span class="text-muted">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="stat-card__icon stat-card__icon--warning">
                                        <div class="stat-card__icon-circle">
                                            <i class="fa fa-weight" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

<div class="table-responsive mt-3">
                                <table class="table table-bordered table-hover table-striped" id='inventory-table'>
                                    <thead class="table-dark">
                                        <tr>

                                            <th scope="col">Status</th>
                                            <th scope="col">Wet ID</th>
                                            <th scope="col">Date Received</th>
                                            <th scope="col">Supplier</th>
                                            <th scope="col">Lot No.</th>
                                            <th scope="col">Driver</th>
                                            <th scope="col">Truck No.</th>
                                            <th scope="col">Weight</th>
                                            <th scope="col">Reweight</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

<script src="js/rubber-datatables-common.js"></script>
<script src="js/rubber-cuplump-inventory.js"></script>
<?php rubber_page_end(); ?>