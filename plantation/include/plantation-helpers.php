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

if (!function_exists('plantation_require_post_auth')) {
    function plantation_require_post_auth(): string
    {
        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            http_response_code(405);
            exit('Method not allowed');
        }
        if (empty($_SESSION['loc'])) {
            http_response_code(401);
            exit('Unauthorized');
        }
        if (!empty($_SESSION['type']) && $_SESSION['type'] !== 'planta') {
            http_response_code(403);
            exit('Forbidden');
        }
        return plantation_loc_sql();
    }
}

if (!function_exists('plantation_tr_attrs')) {
    function plantation_tr_attrs(array $attrs): string
    {
        $parts = [];
        foreach ($attrs as $key => $value) {
            $name = strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim((string) $key, '-')));
            $parts[] = 'data-' . $name . '="' . adm_esc((string) $value) . '"';
        }
        return implode(' ', $parts);
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
    $tiles = [
        ['key' => 'cuplump', 'label' => 'Cuplump', 'unit' => 'kg', 'icon' => 'fa-truck-ramp-box', 'tone' => 'field'],
        ['key' => 'crumb', 'label' => 'Crumb', 'unit' => 'kg', 'icon' => 'fa-gears', 'tone' => 'milling'],
        ['key' => 'blanket', 'label' => 'Blanket', 'unit' => 'kg', 'icon' => 'fa-sun', 'tone' => 'drying'],
        ['key' => 'bale_kg', 'label' => 'Bale Inv.', 'unit' => 'kg', 'icon' => 'fa-box-open', 'tone' => 'bale'],
        ['key' => 'bale_pcs', 'label' => 'Bale Count', 'unit' => 'pcs', 'icon' => 'fa-cubes', 'tone' => 'bale'],
    ];

    $excess = isset($kpis['excess_kg']) ? (float) $kpis['excess_kg'] : null;
    ?>
    <div class="plantation-kpi-strip" role="list">
        <?php foreach ($tiles as $tile) :
            $value = (float) ($kpis[$tile['key']] ?? 0);
            ?>
        <article class="plantation-kpi-tile plantation-kpi-tile--<?php echo adm_esc($tile['tone']); ?>" role="listitem">
            <span class="plantation-kpi-tile__icon" aria-hidden="true"><i class="fas <?php echo adm_esc($tile['icon']); ?>"></i></span>
            <div class="plantation-kpi-tile__main">
                <span class="plantation-kpi-tile__label"><?php echo adm_esc($tile['label']); ?></span>
                <span class="plantation-kpi-tile__value"><?php echo number_format($value, 0); ?><small><?php echo adm_esc($tile['unit']); ?></small></span>
            </div>
        </article>
        <?php endforeach; ?>

        <?php if ($excess !== null) :
            $excessClass = $excess < 0 ? 'is-negative' : ($excess > 0 ? 'is-positive' : '');
            ?>
        <article class="plantation-kpi-tile plantation-kpi-tile--excess <?php echo $excessClass; ?>" role="listitem"
            <?php if (!empty($kpis['excess_sub'])) : ?>title="<?php echo adm_esc($kpis['excess_sub']); ?>"<?php endif; ?>>
            <span class="plantation-kpi-tile__icon" aria-hidden="true"><i class="fas fa-scale-balanced"></i></span>
            <div class="plantation-kpi-tile__main">
                <span class="plantation-kpi-tile__label">Bale Excess</span>
                <span class="plantation-kpi-tile__value"><?php echo number_format($excess, 0); ?><small>kg</small></span>
                <?php if (!empty($kpis['excess_sub'])) : ?>
                <span class="plantation-kpi-tile__meta"><?php echo adm_esc($kpis['excess_sub']); ?></span>
                <?php endif; ?>
            </div>
        </article>
        <?php endif; ?>
    </div>
    <?php
}

if (!function_exists('plantation_workflow_counts')) {
    function plantation_workflow_counts(mysqli $con, string $loc): array
    {
        $locEsc = mysqli_real_escape_string($con, $loc);
        $counts = [
            'receiving' => 0,
            'milling' => 0,
            'drying' => 0,
            'pressing' => 0,
            'produced' => 0,
        ];

        foreach (['Field' => 'receiving', 'Milling' => 'milling', 'Drying' => 'drying', 'Pressing' => 'pressing'] as $status => $key) {
            $row = mysqli_fetch_assoc(mysqli_query(
                $con,
                "SELECT COUNT(*) AS total FROM planta_recording WHERE status='{$status}' AND source='{$locEsc}'"
            ));
            $counts[$key] = (int) ($row['total'] ?? 0);
        }

        $row = mysqli_fetch_assoc(mysqli_query(
            $con,
            "SELECT COUNT(*) AS total
             FROM planta_bales_production p
             LEFT JOIN planta_recording r ON p.recording_id = r.recording_id
             WHERE p.status='Produced'
               AND COALESCE(p.rubber_weight, 0) != 0
               AND COALESCE(p.remaining_bales, 0) != 0
               AND r.source='{$locEsc}'"
        ));
        $counts['produced'] = (int) ($row['total'] ?? 0);

        return $counts;
    }
}

if (!function_exists('plantation_excess_stats')) {
    function plantation_excess_stats(mysqli $con, string $loc): array
    {
        $locEsc = mysqli_real_escape_string($con, $loc);

        $row = mysqli_fetch_assoc(mysqli_query(
            $con,
            "SELECT COALESCE(SUM(p.bales_excess), 0) AS total_excess
             FROM planta_bales_production p
             LEFT JOIN planta_recording r ON p.recording_id = r.recording_id
             WHERE r.source='{$locEsc}'"
        )) ?: [];

        $usedRow = mysqli_fetch_assoc(mysqli_query(
            $con,
            "SELECT COALESCE(SUM(p.rubber_weight), 0) AS used_excess
             FROM planta_bales_production p
             LEFT JOIN planta_recording r ON p.recording_id = r.recording_id
             WHERE p.source_type = 'Excess' AND r.source='{$locEsc}'"
        )) ?: [];

        $total = (float) ($row['total_excess'] ?? 0);
        $used = (float) ($usedRow['used_excess'] ?? 0);

        return [
            'total' => $total,
            'used' => $used,
            'remaining' => $total - $used,
        ];
    }
}

if (!function_exists('plantation_container_status_badge')) {
    function plantation_container_status_badge(string $status): string
    {
        $class = match ($status) {
            'Draft' => 'bg-info',
            'In Progress' => 'bg-warning text-dark',
            'Awaiting Release' => 'bg-secondary',
            'Released' => 'bg-primary',
            'Shipped Out' => 'bg-dark',
            'Sold', 'Sold-Update' => 'bg-success',
            'Void' => 'bg-danger',
            default => 'bg-secondary',
        };
        return '<span class="badge ' . $class . '">' . adm_esc($status) . '</span>';
    }
}

if (!function_exists('plantation_container_editable')) {
    function plantation_container_editable(string $status): bool
    {
        return in_array($status, ['Draft', 'In Progress', 'Sold-Update'], true);
    }
}

if (!function_exists('plantation_container_status_sort_rank')) {
    function plantation_container_status_sort_rank(string $status): int
    {
        if (in_array($status, ['Draft', 'In Progress', 'Awaiting Release', 'Sold-Update'], true)) {
            return 1;
        }
        if (in_array($status, ['Released', 'Shipped Out'], true)) {
            return 2;
        }
        if ($status === 'Sold') {
            return 3;
        }
        return 4;
    }
}

if (!function_exists('plantation_container_load')) {
    function plantation_container_load(mysqli $con, int $id, string $loc): ?array
    {
        if ($id <= 0) {
            return null;
        }
        $locEsc = mysqli_real_escape_string($con, $loc);
        $idEsc = (int) $id;
        $row = mysqli_fetch_assoc(mysqli_query(
            $con,
            "SELECT * FROM bales_container_record WHERE container_id = {$idEsc} AND source = '{$locEsc}' LIMIT 1"
        ));
        return $row ?: null;
    }
}

if (!function_exists('plantation_restore_bale_from_container')) {
    function plantation_restore_bale_from_container(mysqli $con, int $balesId): bool
    {
        $balesId = (int) $balesId;
        $sel = mysqli_query(
            $con,
            "SELECT bcs.num_bales, p.remaining_bales, p.number_bales, p.recording_id
             FROM bales_container_selection bcs
             INNER JOIN planta_bales_production p ON p.bales_prod_id = bcs.bales_id
             WHERE bcs.bales_id = {$balesId} LIMIT 1"
        );
        $row = mysqli_fetch_assoc($sel);
        if (!$row) {
            return false;
        }

        $returnQty = (float) ($row['num_bales'] ?? 0);
        $newRemaining = (float) ($row['remaining_bales'] ?? 0) + $returnQty;
        $maxBales = (float) ($row['number_bales'] ?? 0);
        if ($maxBales > 0 && $newRemaining > $maxBales) {
            $newRemaining = $maxBales;
        }

        mysqli_query(
            $con,
            "UPDATE planta_bales_production SET remaining_bales = '{$newRemaining}', status = 'Produced' WHERE bales_prod_id = {$balesId}"
        );

        $recordingId = (int) ($row['recording_id'] ?? 0);
        if ($recordingId > 0) {
            mysqli_query($con, "UPDATE planta_recording SET status = 'For Sale' WHERE recording_id = {$recordingId}");
        }

        mysqli_query($con, "DELETE FROM bales_container_selection WHERE bales_id = {$balesId}");
        return true;
    }
}

if (!function_exists('plantation_clean_numeric')) {
    function plantation_clean_numeric($value): string
    {
        return preg_replace('/[^0-9.]/', '', str_replace(',', '', (string) $value));
    }
}

if (!function_exists('plantation_format_kilo_bale')) {
    function plantation_format_kilo_bale($value): string
    {
        $n = plantation_clean_numeric($value);
        if ($n === '' || (float) $n <= 0) {
            return '—';
        }
        return rtrim(rtrim(number_format((float) $n, 2), '0'), '.') . ' kg';
    }
}

if (!function_exists('plantation_container_record_stats')) {
    function plantation_container_record_stats(mysqli $con, string $loc): array
    {
        $locEsc = mysqli_real_escape_string($con, $loc);
        $stats = [
            'total' => 0,
            'draft' => 0,
            'in_progress' => 0,
            'awaiting' => 0,
            'released' => 0,
            'sold' => 0,
            'total_bales' => 0,
            'total_weight' => 0,
        ];

        $q = mysqli_query(
            $con,
            "SELECT status, COUNT(*) AS cnt,
                    COALESCE(SUM(num_bales), 0) AS bales,
                    COALESCE(SUM(total_bale_weight), 0) AS weight
             FROM bales_container_record
             WHERE source = '{$locEsc}' AND status != 'Void'
             GROUP BY status"
        );
        if ($q) {
            while ($row = mysqli_fetch_assoc($q)) {
                $cnt = (int) ($row['cnt'] ?? 0);
                $stats['total'] += $cnt;
                $stats['total_bales'] += (float) ($row['bales'] ?? 0);
                $stats['total_weight'] += (float) ($row['weight'] ?? 0);
                switch ($row['status']) {
                    case 'Draft':
                        $stats['draft'] = $cnt;
                        break;
                    case 'In Progress':
                        $stats['in_progress'] = $cnt;
                        break;
                    case 'Awaiting Release':
                        $stats['awaiting'] = $cnt;
                        break;
                    case 'Released':
                    case 'Shipped Out':
                        $stats['released'] += $cnt;
                        break;
                    case 'Sold':
                    case 'Sold-Update':
                        $stats['sold'] += $cnt;
                        break;
                }
            }
        }

        return $stats;
    }
}

if (!function_exists('plantation_consume_flashes')) {
    function plantation_consume_flashes(): void
    {
        $messages = [
            'receiving' => ['success', 'Cuplumps received'],
            'update_success' => ['success', 'Record updated'],
            'delete_success' => ['success', 'Record deleted'],
            'container_saved' => ['success', 'Container saved'],
            'container_complete' => ['success', 'Container completed'],
            'container_void' => ['success', 'Container voided'],
        ];

        foreach ($messages as $key => [$icon, $title]) {
            if (!isset($_SESSION[$key])) {
                continue;
            }
            unset($_SESSION[$key]);
            $iconJs = json_encode($icon, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
            $titleJs = json_encode($title, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
            echo '<script>Swal.fire({ position: "top-end", icon: ' . $iconJs . ', title: ' . $titleJs . ', showConfirmButton: false, timer: 1800 });</script>';
        }
    }
}
