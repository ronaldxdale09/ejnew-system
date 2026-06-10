<?php
include __DIR__ . '/../function/db.php';
require_once __DIR__ . '/rubber-helpers.php';

rubber_nocache_headers();

$rubber_loc = rubber_require_auth();
$loc = $rubber_loc;
$user_name = $_SESSION['full_name'] ?? $_SESSION['user'] ?? '';
$name = $_SESSION['user'] ?? '';
$userDisplay = htmlspecialchars($user_name ?: 'User', ENT_QUOTES, 'UTF-8');
$locDisplay = htmlspecialchars(trim($_SESSION['loc'] ?? ''), ENT_QUOTES, 'UTF-8');
$rubber_base = '';
$script = $_SERVER['SCRIPT_NAME'] ?? '';
if (str_contains($script, '/record/') || str_contains($script, 'bales_inventory')) {
    $rubber_base = '../';
}
$adminThemeVer = rubber_mtime(__DIR__ . '/../../admin/css/admin-theme.css');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="icon" href="<?php echo $rubber_base; ?>assets/img/icon.png" type="image/png">
    <title>EJN Rubber</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="<?php echo $rubber_base; ?>../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo rubber_asset('css/chosen.min.css', $rubber_base); ?>">
    <link rel="stylesheet" href="<?php echo $rubber_base; ?>../admin/css/admin-theme.css?v=<?php echo $adminThemeVer; ?>">
    <link rel="stylesheet" href="<?php echo rubber_asset('css/rubber-theme.css', $rubber_base); ?>">
    <link rel="stylesheet" href="<?php echo rubber_asset('css/statistic-card.css', $rubber_base); ?>">
    <link rel="stylesheet" href="<?php echo rubber_asset('css/inventory.tab.css', $rubber_base); ?>">
    <link rel="stylesheet" href="<?php echo rubber_asset('css/record-tab.css', $rubber_base); ?>">
    <link rel="stylesheet" href="<?php echo rubber_asset('css/seller_profile.css', $rubber_base); ?>">

    <script src="<?php echo rubber_asset('assets/jquery/jquery.min.js', $rubber_base); ?>"></script>
    <script src="<?php echo $rubber_base; ?>../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo rubber_asset('assets/js/chosen.jquery.min.js', $rubber_base); ?>"></script>
    <script src="<?php echo rubber_asset('assets/js/numberFormat.js', $rubber_base); ?>"></script>
    <script src="<?php echo rubber_asset('js/sweetalert2@11.js', $rubber_base); ?>"></script>

    <?php include __DIR__ . '/datatables_buttons_css.php'; ?>
    <?php include __DIR__ . '/datatables_buttons_js.php'; ?>

    <script src="<?php echo rubber_asset('js/rubber-modals.js', $rubber_base); ?>"></script>

    <script>
    window.RUBBER_BASE = <?php echo json_encode($rubber_base, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
    const setFormattedValue = (elementId, value) => {
        var el = document.getElementById(elementId);
        if (!el) return;
        el.value = Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    };
    </script>
</head>
<body class="admin-body rubber-module">
