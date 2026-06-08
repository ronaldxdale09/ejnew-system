<?php
include('../../function/db.php');

$recording_id = $_POST['recording_id'] ?? '';
$recording_id = mysqli_real_escape_string($con, $recording_id);

$sql = "SELECT * FROM planta_bales_production WHERE recording_id='$recording_id'";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo '<p class="plantation-empty-state mb-0">No bale production records for this transaction.</p>';
    exit;
}
?>
<table class="table table-sm table-bordered plantation-detail-table mb-0">
    <thead>
        <tr>
            <th>Bale ID</th>
            <th>Quality</th>
            <th class="text-end">Kilo/Bale</th>
            <th class="text-end">Weight</th>
            <th class="text-end">No. Bales</th>
            <th class="text-end">Excess</th>
            <th>Buyer / Description</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($arr = mysqli_fetch_array($result)) {
        $kilo = $arr['kilo_per_bale'] == '0' ? '—' : htmlspecialchars($arr['kilo_per_bale'], ENT_QUOTES);
        $weight = $arr['rubber_weight'] == '0' ? '—' : number_format((float) $arr['rubber_weight'], 0);
        $num = $arr['number_bales'] == '0' ? '—' : number_format((float) $arr['number_bales'], 0);
        $excess = $arr['bales_excess'] == '0' ? '—' : number_format((float) $arr['bales_excess'], 0);
        ?>
        <tr>
            <td><?php echo (int) $arr['bales_prod_id']; ?></td>
            <td><?php echo htmlspecialchars($arr['bales_type'], ENT_QUOTES); ?></td>
            <td class="text-end"><?php echo $kilo; ?></td>
            <td class="text-end"><?php echo $weight === '—' ? '—' : $weight . ' kg'; ?></td>
            <td class="text-end"><?php echo $num; ?></td>
            <td class="text-end"><?php echo $excess === '—' ? '—' : $excess . ' kg'; ?></td>
            <td><?php echo htmlspecialchars($arr['description'] ?? '', ENT_QUOTES); ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
