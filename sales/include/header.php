<?php
include __DIR__ . '/../../function/db.php';
require_once __DIR__ . '/sales-helpers.php';

$sales_loc = sales_require_auth();
$name = $_SESSION['user'] ?? '';
$userDisplay = htmlspecialchars($_SESSION['full_name'] ?? $name ?: 'User', ENT_QUOTES, 'UTF-8');
$locDisplay = htmlspecialchars(trim($_SESSION['loc'] ?? $_SESSION['source'] ?? ''), ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/icon.png" type="image/png">
    <title>EJN Rubber — Sales</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chosen.min.css">
    <link rel="stylesheet" href="../admin/css/admin-theme.css?v=<?php echo filemtime(__DIR__ . '/../../admin/css/admin-theme.css'); ?>">
    <link rel="stylesheet" href="css/sales-theme.css?v=<?php echo file_exists(__DIR__ . '/../css/sales-theme.css') ? filemtime(__DIR__ . '/../css/sales-theme.css') : '1'; ?>">

    <?php include __DIR__ . '/jquery.php'; ?>
    <script src="js/sales-modals.js?v=<?php echo file_exists(__DIR__ . '/../js/sales-modals.js') ? filemtime(__DIR__ . '/../js/sales-modals.js') : '1'; ?>"></script>

    <script src="assets/js/numberFormat.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <?php include __DIR__ . '/datatables_buttons_css.php'; ?>
    <?php include __DIR__ . '/datatables_buttons_js.php'; ?>

    <script>
    const setFormattedValue = (elementId, value) => {
        var el = document.getElementById(elementId);
        if (!el) return;
        el.value = Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    };
    </script>
</head>
<body class="admin-body sales-module">
