<?php
include 'include/header.php';
include 'include/navbar.php';

$loc = plantation_loc_sql();
$locEsc = mysqli_real_escape_string($con, $loc);
$stats = plantation_container_record_stats($con, $loc);

$results = mysqli_query(
    $con,
    "SELECT container_id AS con_id, status, withdrawal_date, van_no, quality, kilo_bale,
            num_bales AS total_bales, total_bale_weight AS total_weight,
            total_bale_cost, total_milling_cost, remarks, recorded_by
     FROM bales_container_record
     WHERE status != 'Void' AND source = '{$locEsc}'
     ORDER BY
        CASE
            WHEN status IN ('Draft', 'In Progress', 'Awaiting Release', 'Sold-Update') THEN 1
            WHEN status IN ('Released', 'Shipped Out') THEN 2
            WHEN status = 'Sold' THEN 3
            ELSE 4
        END ASC,
        container_id DESC"
);

plantation_shell_open('Container', 'Bale container withdrawal and release records', [$locDisplay ?: 'Plantation']);
include 'modal/modal_container.php';
?>

<div class="plantation-container-record">
    <div class="plantation-kpi-strip plantation-container-record__kpis">
        <article class="plantation-kpi-tile plantation-kpi-tile--bale">
            <span class="plantation-kpi-tile__icon" aria-hidden="true"><i class="fas fa-boxes-stacked"></i></span>
            <div class="plantation-kpi-tile__main">
                <span class="plantation-kpi-tile__label">Containers</span>
                <span class="plantation-kpi-tile__value"><?php echo number_format($stats['total']); ?></span>
            </div>
        </article>
        <article class="plantation-kpi-tile plantation-kpi-tile--field">
            <span class="plantation-kpi-tile__icon" aria-hidden="true"><i class="fas fa-file-pen"></i></span>
            <div class="plantation-kpi-tile__main">
                <span class="plantation-kpi-tile__label">Draft / Active</span>
                <span class="plantation-kpi-tile__value"><?php echo number_format($stats['draft'] + $stats['in_progress']); ?></span>
            </div>
        </article>
        <article class="plantation-kpi-tile plantation-kpi-tile--drying">
            <span class="plantation-kpi-tile__icon" aria-hidden="true"><i class="fas fa-hourglass-half"></i></span>
            <div class="plantation-kpi-tile__main">
                <span class="plantation-kpi-tile__label">Awaiting Release</span>
                <span class="plantation-kpi-tile__value"><?php echo number_format($stats['awaiting']); ?></span>
            </div>
        </article>
        <article class="plantation-kpi-tile plantation-kpi-tile--bale">
            <span class="plantation-kpi-tile__icon" aria-hidden="true"><i class="fas fa-truck-ramp-box"></i></span>
            <div class="plantation-kpi-tile__main">
                <span class="plantation-kpi-tile__label">Released / Sold</span>
                <span class="plantation-kpi-tile__value"><?php echo number_format($stats['released'] + $stats['sold']); ?></span>
            </div>
        </article>
        <article class="plantation-kpi-tile plantation-kpi-tile--excess">
            <span class="plantation-kpi-tile__icon" aria-hidden="true"><i class="fas fa-weight-hanging"></i></span>
            <div class="plantation-kpi-tile__main">
                <span class="plantation-kpi-tile__label">Total Weight</span>
                <span class="plantation-kpi-tile__value"><?php echo number_format($stats['total_weight'], 0); ?><small>kg</small></span>
            </div>
        </article>
    </div>

    <?php adm_panel_open('Bale Container'); ?>
    <div class="plantation-container-record__toolbar">
        <button type="button" class="plantation-btn plantation-btn--primary" data-bs-toggle="modal" data-bs-target="#newContainer">
            <i class="fas fa-plus"></i> New Container
        </button>
        <div class="plantation-container-record__filters" role="group" aria-label="Filter by status">
            <button type="button" class="plantation-status-chip is-active" data-status-filter="">All</button>
            <button type="button" class="plantation-status-chip" data-status-filter="Draft">Draft</button>
            <button type="button" class="plantation-status-chip" data-status-filter="In Progress">In Progress</button>
            <button type="button" class="plantation-status-chip" data-status-filter="Awaiting Release">Awaiting</button>
            <button type="button" class="plantation-status-chip" data-status-filter="Released">Released</button>
            <button type="button" class="plantation-status-chip" data-status-filter="Sold">Sold</button>
        </div>
    </div>

    <div class="adm-table-wrap plantation-container-record__table-wrap">
        <table class="table table-hover plantation-record-table" id="containerRecordTable" width="100%">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Ref</th>
                    <th>Withdrawal</th>
                    <th>Van No.</th>
                    <th>Quality</th>
                    <th class="text-end">Kilo/Bale</th>
                    <th class="text-end">Bales</th>
                    <th class="text-end">Weight</th>
                    <th class="text-end">Bale Cost</th>
                    <th>Particulars</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_array($results)) :
                $conId = (int) $row['con_id'];
                $status = (string) ($row['status'] ?? '');
                $statusRank = plantation_container_status_sort_rank($status);
                $editable = plantation_container_editable($status);
                $withdrawal = !empty($row['withdrawal_date']) ? date('M d, Y', strtotime($row['withdrawal_date'])) : '—';
                $withdrawalSort = !empty($row['withdrawal_date']) ? strtotime($row['withdrawal_date']) : 0;
                ?>
                <tr <?php echo plantation_tr_attrs([
                    'container-id' => $conId,
                    'status' => $status,
                    'withdrawal-date' => $withdrawal,
                    'van-no' => $row['van_no'] ?? '',
                    'quality' => $row['quality'] ?? '',
                    'kilo-bale' => plantation_format_kilo_bale($row['kilo_bale'] ?? ''),
                    'remarks' => $row['remarks'] ?? '',
                    'recorded-by' => $row['recorded_by'] ?? '',
                ]); ?>>
                    <td data-order="<?php echo $statusRank; ?>" data-search="<?php echo adm_esc($status); ?>"><?php echo plantation_container_status_badge($status); ?></td>
                    <td data-order="<?php echo $conId; ?>">
                        <?php if ($editable) : ?>
                        <a href="container.php?id=<?php echo $conId; ?>" class="plantation-record-link">#<?php echo $conId; ?></a>
                        <?php else : ?>
                        <span class="plantation-record-ref">#<?php echo $conId; ?></span>
                        <?php endif; ?>
                    </td>
                    <td data-order="<?php echo (int) $withdrawalSort; ?>"><?php echo adm_esc($withdrawal); ?></td>
                    <td><?php echo adm_esc($row['van_no'] ?? '—'); ?></td>
                    <td><span class="badge bg-light text-dark border"><?php echo adm_esc($row['quality'] ?? '—'); ?></span></td>
                    <td class="text-end number-cell"><?php echo plantation_format_kilo_bale($row['kilo_bale'] ?? ''); ?></td>
                    <td class="text-end number-cell"><?php echo number_format((float) ($row['total_bales'] ?? 0), 0); ?> <small class="text-muted">pcs</small></td>
                    <td class="text-end number-cell"><?php echo number_format((float) ($row['total_weight'] ?? 0), 0); ?> <small class="text-muted">kg</small></td>
                    <td class="text-end number-cell">₱ <?php echo number_format((float) ($row['total_bale_cost'] ?? 0), 0); ?></td>
                    <td class="plantation-record-particulars"><?php echo adm_esc($row['remarks'] ?? '—'); ?></td>
                    <td class="text-end">
                        <div class="btn-group btn-group-sm plantation-record-actions" role="group">
                            <?php if ($editable) : ?>
                            <a href="container.php?id=<?php echo $conId; ?>" class="btn btn-outline-primary" title="Edit container">
                                <i class="fas fa-pen"></i>
                            </a>
                            <?php endif; ?>
                            <button type="button" class="btn btn-outline-secondary btn-view-container" title="View details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php adm_panel_close(); ?>
</div>

<script src="js/plantation-container-record.js?v=<?php echo filemtime(__DIR__ . '/js/plantation-container-record.js'); ?>"></script>
<?php plantation_consume_flashes(); ?>
<?php plantation_shell_close(); ?>
