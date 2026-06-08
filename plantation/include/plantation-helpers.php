<?php
/**
 * Plantation UI helpers — extends admin design system
 */
require_once __DIR__ . '/../../admin/include/adm-helpers.php';

if (!function_exists('plantation_loc_sql')) {
    function plantation_loc_sql(): string
    {
        return str_replace(' ', '', (string) ($_SESSION['loc'] ?? ''));
    }
}

if (!function_exists('plantation_require_auth')) {
    function plantation_require_auth(): string
    {
        if (empty($_SESSION['loc'])) {
            header('Location: function/logout.php');
            exit();
        }
        if (!empty($_SESSION['type']) && $_SESSION['type'] !== 'planta') {
            header('Location: function/logout.php');
            exit();
        }
        return plantation_loc_sql();
    }
}

if (!function_exists('plantation_nav_active')) {
    function plantation_nav_active($pages, string $currentPage): string
    {
        return in_array($currentPage, (array) $pages, true) ? ' active' : '';
    }
}

if (!function_exists('plantation_topbar_title')) {
    function plantation_topbar_title(string $title): void
    {
        $GLOBALS['plantation_topbar_title'] = $title;
    }

    function plantation_resolve_topbar_title(string $currentPage): string
    {
        if (!empty($GLOBALS['plantation_topbar_title'])) {
            return (string) $GLOBALS['plantation_topbar_title'];
        }
        $map = [
            'dashboard.php' => 'Home',
            'recording.php' => 'Rubber Processing',
            'record_allrubber.php' => 'Transaction Record',
            'inventory_bale.php' => 'Bales Record',
            'container_record.php' => 'Container',
            'container.php' => 'Container Detail',
        ];
        return $map[$currentPage] ?? 'Plantation';
    }
}

function plantation_shell_open(string $title, string $subtitle = '', array $badges = []): void
{
    echo '<div class="main-content admin-page plantation-page">';
    adm_page_header($title, $subtitle, $badges);
}

function plantation_shell_close(): void
{
    echo '</div></body></html>';
}

if (!function_exists('plantation_inventory_kpis')) {
    function plantation_inventory_kpis(mysqli $con, string $loc): array
    {
        $locEsc = mysqli_real_escape_string($con, $loc);

        $cuplump = mysqli_fetch_array(mysqli_query($con, "SELECT COALESCE(SUM(reweight),0) AS v FROM planta_recording WHERE status='Field' AND source='{$locEsc}'"));
        $crumb = mysqli_fetch_array(mysqli_query($con, "SELECT COALESCE(SUM(crumbed_weight),0) AS v FROM planta_recording WHERE status='Milling' AND source='{$locEsc}'"));
        $blanket = mysqli_fetch_array(mysqli_query($con, "SELECT COALESCE(SUM(dry_weight),0) AS v FROM planta_recording WHERE status='Drying' AND source='{$locEsc}'"));
        $baleKg = mysqli_fetch_array(mysqli_query($con, "SELECT COALESCE(SUM(remaining_bales * kilo_per_bale),0) AS v FROM planta_bales_production p LEFT JOIN planta_recording r ON p.recording_id=r.recording_id WHERE p.remaining_bales != 0 AND r.source='{$locEsc}'"));
        $balePcs = mysqli_fetch_array(mysqli_query($con, "SELECT COALESCE(SUM(p.remaining_bales),0) AS v FROM planta_bales_production p LEFT JOIN planta_recording r ON p.recording_id=r.recording_id WHERE p.remaining_bales != 0 AND r.source='{$locEsc}' AND p.status='Produced'"));

        return [
            'cuplump' => (float) ($cuplump['v'] ?? 0),
            'crumb' => (float) ($crumb['v'] ?? 0),
            'blanket' => (float) ($blanket['v'] ?? 0),
            'bale_kg' => (float) ($baleKg['v'] ?? 0),
            'bale_pcs' => (float) ($balePcs['v'] ?? 0),
        ];
    }
}

function plantation_render_inventory_kpis(array $kpis): void
{
    ?>
    <div class="adm-kpi-grid adm-kpi-grid--strip plantation-kpi-grid">
        <div class="adm-kpi">
            <div class="adm-kpi__label">Cuplump Inventory</div>
            <div class="adm-kpi__value"><?php echo number_format($kpis['cuplump'], 0); ?> <small>kg</small></div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label">Crumb Inventory</div>
            <div class="adm-kpi__value"><?php echo number_format($kpis['crumb'], 0); ?> <small>kg</small></div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label">Blanket Inventory</div>
            <div class="adm-kpi__value"><?php echo number_format($kpis['blanket'], 0); ?> <small>kg</small></div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label">Bale Inventory</div>
            <div class="adm-kpi__value"><?php echo number_format($kpis['bale_kg'], 0); ?> <small>kg</small></div>
        </div>
        <div class="adm-kpi">
            <div class="adm-kpi__label">Bale Count</div>
            <div class="adm-kpi__value"><?php echo number_format($kpis['bale_pcs'], 0); ?> <small>pcs</small></div>
        </div>
    </div>
    <?php
}
