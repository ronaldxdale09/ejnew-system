<?php
include '../function/db.php';

$purchase_id = (int) ($_POST['purchase_id'] ?? 0);
if ($purchase_id <= 0) {
    echo '<p class="text-muted small mb-0">No inventory selected yet.</p>';
    exit;
}

$sql = "SELECT * FROM bales_purchase_inventory WHERE purchase_id='$purchase_id' ORDER BY bales_id ASC";
$result = mysqli_query($con, $sql);
if (!$result) {
    echo 'Error loading inventory.';
    exit;
}

$total_bales_count = 0;
$total_excess = 0;
$output = '
<div class="row no-gutters">
    <div class="col-4"></div>
    <div class="col">
        <label style="font-size:15px" class="col-md-12">Total Bales</label>
        <div class="input-group">
            <input type="text" style="text-align:right" name="bales_count" id="bales_count" class="form-control" readonly>
            <div class="input-group-append">
                <span class="input-group-text">pcs</span>
            </div>
        </div>
    </div>
    <div class="col">
        <label style="font-size:15px" class="col-md-12">Excess</label>
        <div class="input-group">
            <input type="text" style="text-align:right" name="excess" id="excess" class="form-control" readonly>
            <div class="input-group-append">
                <span class="input-group-text"> kg</span>
            </div>
        </div>
    </div>
</div>
<br>
<table class="table table-bordered" id="rubber-record">
<thead class="table-dark" style="font-weight:bold;">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Quality</th>
        <th scope="col">Kilo per Bale</th>
        <th scope="col">Bale Quantity</th>
        <th scope="col">Weight.</th>
        <th scope="col">Excess</th>
    </tr>
</thead>
<tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($arr = mysqli_fetch_assoc($result)) {
        $total_bales_count += (int) ($arr['number_bales'] ?? 0);
        $total_excess += (float) ($arr['excess'] ?? 0);
        $output .= '
        <tr>
            <td>' . htmlspecialchars((string) $arr['bales_id'], ENT_QUOTES, 'UTF-8') . '</td>
            <td>' . htmlspecialchars((string) $arr['type'], ENT_QUOTES, 'UTF-8') . '</td>
            <td>' . number_format((float) $arr['kilo_bale'], 0, '.', ',') . ' kg</td>
            <td>' . number_format((int) $arr['number_bales'], 0, '.', ',') . ' pcs</td>
            <td>' . number_format((float) $arr['weight'], 0, '.', ',') . ' kg</td>
            <td>' . number_format((float) $arr['excess'], 0, '.', ',') . ' kg</td>
        </tr>';
    }
}

$output .= '
    </tbody>
</table>
<script>
(function () {
    var balesCount = document.getElementById("bales_count");
    var excessEl = document.getElementById("excess");
    if (balesCount) balesCount.value = ' . (int) $total_bales_count . ';
    if (excessEl) excessEl.value = ' . (float) $total_excess . ';
})();
</script>';

echo $output;
