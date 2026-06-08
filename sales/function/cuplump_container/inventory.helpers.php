<?php
/**
 * Shared cuplump container inventory save helpers.
 */

function cuplump_inventory_row_is_empty($supplier, $buyingWeight, $totalCostRow, $paidAmount): bool
{
    return trim((string) $supplier) === ''
        && (float) $buyingWeight <= 0
        && (float) $totalCostRow <= 0
        && (float) $paidAmount <= 0;
}

function cuplump_process_inventory($con, $container_id, $id, $supplier, $buyingWeight, $dryWeight, $drc, $costPerKilo, $totalCost, $paidAmount, $inv_remarks, &$existingRecords): void
{
    $id = trim((string) $id);
    $supplier = mysqli_real_escape_string($con, $supplier);
    $inv_remarks = mysqli_real_escape_string($con, $inv_remarks);

    if ($id !== '' && ctype_digit($id)) {
        $checkSql = "SELECT cuplump_inventory_id FROM cuplump_container_inv WHERE container_id = '$container_id' AND cuplump_inventory_id = '$id' LIMIT 1";
        $checkResult = mysqli_query($con, $checkSql);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            $sql = "UPDATE cuplump_container_inv 
                SET supplier='$supplier', buying_weight='$buyingWeight', dry_weight='$dryWeight', drc='$drc', 
                cost_per_kilo='$costPerKilo', total_cost='$totalCost', amount_paid='$paidAmount', inv_remarks='$inv_remarks'
                WHERE container_id = '$container_id' AND cuplump_inventory_id = '$id'";
            if (!mysqli_query($con, $sql)) {
                die('Error updating inventory record: ' . mysqli_error($con));
            }
            $existingRecords = array_diff($existingRecords, [$id]);
            return;
        }
    }

    $sql = "INSERT INTO cuplump_container_inv 
            (container_id, supplier, buying_weight, dry_weight, drc, cost_per_kilo, total_cost, amount_paid, inv_remarks)
            VALUES ('$container_id', '$supplier', '$buyingWeight', '$dryWeight', '$drc', 
                    '$costPerKilo', '$totalCost', '$paidAmount', '$inv_remarks')";
    if (!mysqli_query($con, $sql)) {
        die('Error inserting inventory record: ' . mysqli_error($con));
    }
}

function cuplump_delete_stale_inventory($con, $container_id, array $existingRecords): void
{
    foreach ($existingRecords as $id) {
        $id = trim((string) $id);
        if ($id === '' || !ctype_digit($id)) {
            continue;
        }
        $deleteSql = "DELETE FROM cuplump_container_inv WHERE container_id = '$container_id' AND cuplump_inventory_id = '$id'";
        if (!mysqli_query($con, $deleteSql)) {
            die('Error deleting old inventory row: ' . mysqli_error($con));
        }
    }
}

function cuplump_save_inventory_rows($con, $container_id): void
{
    if (empty($_POST['inventory_id']) || !is_array($_POST['inventory_id'])) {
        return;
    }

    $existingRecords = [];
    $fetchResult = mysqli_query($con, "SELECT cuplump_inventory_id FROM cuplump_container_inv WHERE container_id = '$container_id'");
    if (!$fetchResult) {
        die('Error fetching existing records: ' . mysqli_error($con));
    }
    while ($row = mysqli_fetch_assoc($fetchResult)) {
        $existingRecords[] = $row['cuplump_inventory_id'];
    }

    $suppliers = $_POST['supplier'] ?? [];
    $buyingWeights = $_POST['buying_weight'] ?? [];
    $drcInputs = $_POST['drc'] ?? [];
    $dryWeights = $_POST['dry_weight'] ?? [];
    $costPerKilos = $_POST['cost_per_kilo'] ?? [];
    $totalCosts = $_POST['total_cost'] ?? [];
    $amountPaid = $_POST['amount_paid'] ?? [];
    $inv_remarks = $_POST['inv_remarks'] ?? [];
    $ids = $_POST['inventory_id'];

    foreach ($ids as $index => $id) {
        $supplier = $suppliers[$index] ?? '';
        $buyingWeight = floatval(str_replace(',', '', $buyingWeights[$index] ?? 0));
        $drc = floatval(str_replace(',', '', $drcInputs[$index] ?? 0));
        $dryWeight = floatval(str_replace(',', '', $dryWeights[$index] ?? 0));
        $costPerKilo = floatval(str_replace(',', '', $costPerKilos[$index] ?? 0));
        $totalCostRow = floatval(str_replace(',', '', $totalCosts[$index] ?? 0));
        $paidAmount = floatval(str_replace(',', '', $amountPaid[$index] ?? 0));
        $remark = $inv_remarks[$index] ?? '';

        if (cuplump_inventory_row_is_empty($supplier, $buyingWeight, $totalCostRow, $paidAmount)) {
            continue;
        }

        cuplump_process_inventory(
            $con,
            $container_id,
            $id,
            $supplier,
            $buyingWeight,
            $dryWeight,
            $drc,
            $costPerKilo,
            $totalCostRow,
            $paidAmount,
            $remark,
            $existingRecords
        );
    }

    cuplump_delete_stale_inventory($con, $container_id, $existingRecords);
}
