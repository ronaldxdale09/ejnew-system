<?php
require_once __DIR__ . '/../function/db.php';
require_once __DIR__ . '/copra-helpers.php';

copra_require_auth();
$user_name = $_SESSION['full_name'] ?? $_SESSION['user'] ?? '';
$name = $_SESSION['user'] ?? '';
$userDisplay = htmlspecialchars($user_name ?: 'User', ENT_QUOTES, 'UTF-8');
$copra_base = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo $copra_base; ?>assets/img/logo.png" type="image/png">
    <title>EJN Copra</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="<?php echo $copra_base; ?>../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $copra_base; ?>css/chosen.min.css">
    <link rel="stylesheet" href="<?php echo $copra_base; ?>../admin/css/admin-theme.css?v=<?php echo filemtime(__DIR__ . '/../../admin/css/admin-theme.css'); ?>">
    <link rel="stylesheet" href="<?php echo $copra_base; ?>css/copra-theme.css?v=<?php echo file_exists(__DIR__ . '/../css/copra-theme.css') ? filemtime(__DIR__ . '/../css/copra-theme.css') : '1'; ?>">
    <link rel="stylesheet" href="<?php echo $copra_base; ?>css/statistic-card.css">

    <script src="<?php echo $copra_base; ?>assets/jquery/jquery.min.js"></script>
    <script src="<?php echo $copra_base; ?>../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $copra_base; ?>assets/js/chosen.jquery.min.js"></script>
    <script src="<?php echo $copra_base; ?>assets/js/numberFormat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <?php include __DIR__ . '/datatables_buttons_css.php'; ?>
    <?php include __DIR__ . '/datatables_buttons_js.php'; ?>

    <script src="<?php echo $copra_base; ?>js/copra-modals.js?v=<?php echo file_exists(__DIR__ . '/../js/copra-modals.js') ? filemtime(__DIR__ . '/../js/copra-modals.js') : '1'; ?>"></script>

    <script>
    window.COPRA_BASE = <?php echo json_encode($copra_base, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
    const setFormattedValue = (elementId, value) => {
        var el = document.getElementById(elementId);
        if (!el) return;
        el.value = Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    };
    </script>
</head>
<body class="admin-body copra-module">
