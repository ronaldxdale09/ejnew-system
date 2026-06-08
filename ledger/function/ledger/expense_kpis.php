<?php
header('Content-Type: application/json');
include '../../../function/db.php';
require_once __DIR__ . '/../../expense/data.php';

if (!isset($_SESSION['loc'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$kpis = ledger_expense_kpis($con, $_SESSION['loc']);
echo json_encode(['success' => true, 'kpis' => $kpis]);
