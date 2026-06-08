<?php
include __DIR__ . '/../../function/db.php';
require_once __DIR__ . '/ledger-helpers.php';
ledger_require_location();

$loc = $_SESSION['loc'] ?? '';
$userDisplay = htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['user'] ?? 'User', ENT_QUOTES, 'UTF-8');
$locDisplay = htmlspecialchars(trim($loc), ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <link rel="icon" href="assets/img/logo.svg" type="image/svg+xml">
    <title>EJN General Ledger</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php include __DIR__ . '/bootstrap.php'; ?>

    <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chosen.min.css">
    <link rel="stylesheet" href="../admin/css/admin-theme.css?v=<?php echo filemtime(__DIR__ . '/../../admin/css/admin-theme.css'); ?>">
    <link rel="stylesheet" href="css/ledger-theme.css?v=<?php echo file_exists(__DIR__ . '/../css/ledger-theme.css') ? filemtime(__DIR__ . '/../css/ledger-theme.css') : '1'; ?>">

    <?php include __DIR__ . '/jquery.php'; ?>
    <script src="js/ledger-modals.js?v=<?php echo file_exists(__DIR__ . '/../js/ledger-modals.js') ? filemtime(__DIR__ . '/../js/ledger-modals.js') : '1'; ?>"></script>

    <script src="assets/js/numberFormat.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body class="admin-body">
<?php
include __DIR__ . '/datatables_buttons_css.php';
include __DIR__ . '/datatables_buttons_js.php';
?>
<script>
function formatWithComma(value) {
    var parsedValue = parseFloat(value);
    if (isNaN(parsedValue)) return '0.00';
    return parsedValue.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}
</script>
