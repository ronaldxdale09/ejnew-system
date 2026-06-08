<?php
if (!function_exists('sales_render_filters')) {
    function sales_render_filters(array $options = []): void
    {
        global $con;
        $showLocation = !empty($options['location']);
        $buyerSql = $options['buyerSql'] ?? "SELECT DISTINCT buyer_name AS val FROM bales_sales_record WHERE buyer_name IS NOT NULL AND buyer_name != ''";
        $buyerCol = $options['buyerCol'] ?? 'val';
        $statusOptions = $options['statusOptions'] ?? ['In Progress', 'Complete', 'Draft'];
        ?>
        <div class="sales-filters">
            <div>
                <label for="filterBuyer">Particular</label>
                <select class="form-select form-select-sm" id="filterBuyer">
                    <option value="">All</option>
                    <?php
                    if (!empty($options['buyerOptions'])) {
                        foreach ($options['buyerOptions'] as $opt) {
                            echo '<option value="' . htmlspecialchars($opt, ENT_QUOTES) . '">' . htmlspecialchars($opt, ENT_QUOTES) . '</option>';
                        }
                    } else {
                        $res = mysqli_query($con, $buyerSql);
                        while ($res && ($row = mysqli_fetch_assoc($res))) {
                            $v = htmlspecialchars($row[$buyerCol] ?? $row['buyer_name'] ?? $row['remarks'] ?? '', ENT_QUOTES);
                            if ($v !== '') echo '<option value="' . $v . '">' . $v . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="filterStatus">Status</label>
                <select class="form-select form-select-sm" id="filterStatus">
                    <option value="">All</option>
                    <?php foreach ($statusOptions as $st): ?>
                        <option value="<?php echo htmlspecialchars($st, ENT_QUOTES); ?>"><?php echo htmlspecialchars($st, ENT_QUOTES); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="filterMonth">Month</label>
                <select class="form-select form-select-sm" id="filterMonth">
                    <option value="">All</option>
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo date('F', mktime(0, 0, 0, $i, 10)); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div>
                <label for="filterYear">Year</label>
                <select class="form-select form-select-sm" id="filterYear">
                    <option value="">All</option>
                    <?php for ($y = (int) date('Y'), $s = 2022; $y >= $s; $y--): ?>
                        <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div>
                <label for="startDate">Start Date</label>
                <input type="date" class="form-control form-control-sm" id="startDate">
            </div>
            <div>
                <label for="endDate">End Date</label>
                <input type="date" class="form-control form-control-sm" id="endDate">
            </div>
            <?php if ($showLocation): ?>
            <div>
                <label for="filterLocation">Location</label>
                <select class="form-select form-select-sm" id="filterLocation">
                    <option value="">All</option>
                    <option value="Basilan">Basilan</option>
                    <option value="Kidapawan">Kidapawan</option>
                </select>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }
}
