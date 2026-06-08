<?php
include 'include/header.php';
include 'include/navbar.php';

$id = $_GET['view'] ?? '';
$nameEsc = mysqli_real_escape_string($con, $id);
$results = mysqli_query($con, "SELECT * from copra_seller WHERE code='$nameEsc'");
$row = mysqli_fetch_array($results);

if (!$row) {
    copra_page_begin('Seller Profile', 'Seller not found', 'Profile');
    echo '<div class="alert alert-warning">Seller not found.</div>';
    copra_page_end();
    exit;
}

$sellerID = $row['id'];
$name = $row['name'];
$nameSql = mysqli_real_escape_string($con, $name);

$pendingContract_count = mysqli_query($con, "SELECT * FROM copra_contract WHERE (status='PENDING' OR status='UPDATED') AND seller='$nameSql'");
$contract = mysqli_num_rows($pendingContract_count);

$copraCa = 0;
$ntcCa = 0;
$truckCa = 0;
$otherCa = 0;
$caQueries = [
    ['copra', &$copraCa],
    ['ntc', &$ntcCa],
    ['trucking', &$truckCa],
    ['other', &$otherCa],
];
foreach ($caQueries as [$cat, &$total]) {
    $q = mysqli_query($con, "SELECT SUM(amount) as total FROM copra_cashadvance WHERE seller='$nameSql' AND category='$cat'");
    $r = mysqli_fetch_array($q);
    $total = floatval($r['total'] ?? 0);
}

$month = [];
$amount = [];
$currentYear = date('Y');
$purchased_count = mysqli_query($con, "SELECT year(date) as year, MONTHNAME(date) as monthname, sum(net_res) as month_total from copra_transaction WHERE year(date)='$currentYear' AND seller='$nameSql' group by month(date) ORDER BY date");
if ($purchased_count && $purchased_count->num_rows > 0) {
    while ($data = mysqli_fetch_assoc($purchased_count)) {
        $month[] = $data['monthname'];
        $amount[] = $data['month_total'];
    }
}

include 'modal/profileModal.php';

copra_page_begin(htmlspecialchars($name, ENT_QUOTES, 'UTF-8'), 'Seller profile & purchase history', 'Profile');
?>
<div class="row g-3">
    <div class="col-lg-4">
        <div class="adm-card">
            <div class="adm-card__body text-center">
                <img src="assets/img/avatar.png" alt="" class="rounded-circle mb-2" width="96" height="96">
                <h5 class="mb-0"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h5>
                <p class="text-muted small mb-3"><?php echo htmlspecialchars($row['code'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="text-start small mb-3">
                    <div class="d-flex justify-content-between py-1 border-bottom"><span class="text-muted">Address</span><span><?php echo htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8'); ?></span></div>
                    <div class="d-flex justify-content-between py-1 border-bottom"><span class="text-muted">Contact</span><span><?php echo htmlspecialchars($row['contact'] ?? '—', ENT_QUOTES, 'UTF-8'); ?></span></div>
                    <div class="d-flex justify-content-between py-1 border-bottom"><span class="text-muted">Pending Contracts</span><span><?php echo $contract; ?></span></div>
                    <div class="d-flex justify-content-between py-1"><span class="text-muted">Cash Advance</span><span>₱ <?php echo number_format(floatval($row['cash_advance'] ?? 0), 2); ?></span></div>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateProfile"
                    data-bs-id="<?php echo (int) $sellerID; ?>"
                    data-bs-full_name="<?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-bs-address="<?php echo htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8'); ?>"
                    data-bs-contact="<?php echo htmlspecialchars($row['contact'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    <i class="fas fa-pen me-1"></i> Edit Profile
                </button>
            </div>
        </div>
        <div class="adm-card mt-3">
            <div class="adm-card__head"><h3>CA by Category</h3></div>
            <div class="adm-card__body"><canvas id="ca_pie" height="200"></canvas></div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="adm-card mb-3">
            <div class="adm-card__head"><h3>Contracts</h3></div>
            <div class="adm-card__body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0" id="contractTable">
                        <thead class="table-dark">
                            <tr>
                                <th>Date</th>
                                <th>Contract No.</th>
                                <th>Quantity</th>
                                <th>Balance</th>
                                <th>₱/KG</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contracts = mysqli_query($con, "SELECT * from copra_contract WHERE seller='$nameSql'");
                            while ($c = mysqli_fetch_array($contracts)) :
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($c['date'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($c['contract_no'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo number_format(floatval($c['contract_quantity'])); ?> kg</td>
                                <td><?php echo number_format(floatval($c['balance'])); ?> kg</td>
                                <td>₱ <?php echo htmlspecialchars($c['price_kg'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo copra_contract_status_badge($c['status'] ?? ''); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="adm-card mb-3">
            <div class="adm-card__head"><h3>Recent Purchases</h3></div>
            <div class="adm-card__body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0" id="seller_copraTransaction">
                        <thead class="table-dark">
                            <tr>
                                <th>Invoice</th>
                                <th>Date</th>
                                <th>Contract</th>
                                <th>Net Res.</th>
                                <th class="text-end">Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tx = mysqli_query($con, "SELECT * from copra_transaction WHERE seller='$nameSql' ORDER BY id DESC LIMIT 20");
                            while ($t = mysqli_fetch_array($tx)) :
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($t['invoice'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($t['date'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($t['contract'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo number_format(floatval($t['net_res'])); ?> kg</td>
                                <td class="text-end">₱ <?php echo number_format(floatval($t['amount_paid']), 2); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="adm-card">
            <div class="adm-card__head"><h3>Monthly Purchase Trend</h3></div>
            <div class="adm-card__body"><canvas id="copra_bar" height="220"></canvas></div>
        </div>
    </div>
</div>

<script src="js/seller_profile.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Chart === 'undefined') return;
    var pie = document.getElementById('ca_pie');
    if (pie) {
        new Chart(pie, {
            type: 'doughnut',
            data: {
                labels: ['Copra', 'NTC', 'Trucking', 'Others'],
                datasets: [{
                    data: [<?php echo "$copraCa,$ntcCa,$truckCa,$otherCa"; ?>],
                    backgroundColor: ['#6b4f2a', '#009688', '#c9922a', '#dc3545']
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } } }
        });
    }
    var bar = document.getElementById('copra_bar');
    if (bar) {
        new Chart(bar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($month); ?>,
                datasets: [{
                    label: 'Purchased (kg)',
                    data: <?php echo json_encode($amount); ?>,
                    backgroundColor: '#c9922a'
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });
    }
});
</script>

<?php copra_consume_flashes(); ?>
<?php copra_page_end(); ?>
