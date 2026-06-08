<?php
include '../../../function/db.php';
require_once __DIR__ . '/../../include/plantation-helpers.php';
plantation_require_post_auth();

$bales_id = (int) ($_POST['bales_id'] ?? 0);
if ($bales_id <= 0) {
    http_response_code(400);
    echo 'Invalid bale.';
    exit;
}

if (!plantation_restore_bale_from_container($con, $bales_id)) {
    http_response_code(404);
    echo 'Could not remove bale from container.';
    exit;
}

echo 'Removed';
exit();
