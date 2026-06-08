<div class="ledger-toolbar mb-3">
    <div class="ledger-toolbar__actions">
        <button type="button" class="ledger-btn ledger-btn--primary" data-bs-toggle="modal" data-bs-target="#buahanToppers">
            <i class="fas fa-plus"></i> New Transaction
        </button>
    </div>
    <div class="ledger-toolbar__filters">
        <div class="ledger-filter-field">
            <label for="min">From</label>
            <input type="text" id="min" name="min" class="form-control form-control-sm datepicker" placeholder="yyyy-mm-dd" autocomplete="off">
        </div>
        <div class="ledger-filter-field">
            <label for="max">To</label>
            <input type="text" id="max" name="max" class="form-control form-control-sm datepicker" placeholder="yyyy-mm-dd" autocomplete="off">
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover ledger-topper-table ledger-topper-table--buahan w-100" id="buahan_toppers">
        <thead>
            <tr class="ledger-topper-table__group">
                <th colspan="6">Description</th>
                <th colspan="2">EJN</th>
                <th colspan="3">Toppers</th>
                <th colspan="1"></th>
            </tr>
            <tr>
                <th>Date</th>
                <th>Voucher #</th>
                <th>Particulars</th>
                <th class="text-end">Net Kilos</th>
                <th class="text-end">Price</th>
                <th class="text-end">Total</th>
                <th class="text-end">EJN %</th>
                <th class="text-end">Total</th>
                <th class="text-end">Toppers %</th>
                <th>Deductions</th>
                <th class="text-end">Total</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $results = mysqli_query($con, 'SELECT * FROM ledger_buahantoppers ORDER BY date DESC');
            while ($row = mysqli_fetch_array($results)) {
                $dateObj = new DateTime($row['date']);
            ?>
            <tr>
                <td data-order="<?php echo adm_esc($row['date']); ?>">
                    <?php echo $dateObj->format('M j, Y'); ?>
                </td>
                <td><?php echo adm_esc($row['voucher']); ?></td>
                <td><?php echo adm_esc($row['name']); ?></td>
                <td class="text-end"><?php echo number_format(floatval($row['net_kilos']), 2); ?> kg</td>
                <td class="text-end"><?php echo adm_peso($row['price'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['total'], 2); ?></td>
                <td class="text-end"><?php echo number_format(floatval($row['ejn_percent']), 2); ?>%</td>
                <td class="text-end"><?php echo adm_peso($row['ejn_total'], 2); ?></td>
                <td class="text-end"><?php echo number_format(floatval($row['toppers_percent']), 2); ?>%</td>
                <td><?php echo adm_esc($row['less_category']); ?>: <?php echo adm_peso($row['less_toppers'], 2); ?></td>
                <td class="text-end"><?php echo adm_peso($row['toppers_total'], 2); ?></td>
                <td class="text-center">
                    <div class="btn-group btn-group-sm">
                        <button type="button" data-buahantoppers='<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>' class="btn btn-success btnUpdate" title="Edit">
                            <span class="fa fa-edit"></span>
                        </button>
                        <button type="button" data-buahantoppers='<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8'); ?>' class="btn btnDelete btn-danger" title="Delete">
                            <span class="fa fa-trash"></span>
                        </button>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
