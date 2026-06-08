<div class="adm-grid-2-1">
    <div class="adm-card">
        <div class="adm-card__head"><h3>Priority Actions</h3></div>
        <div class="adm-card__body adm-card__body--flush">
            <?php if (empty($action_plan)): ?>
                <div class="adm-empty-state">
                    <i class="fas fa-circle-check"></i>
                    <p>No critical issues flagged. Key metrics are within normal ranges.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive adm-table-wrap">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Priority</th>
                                <th>Issue</th>
                                <th>Recommended Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($action_plan as $plan): ?>
                                <tr>
                                    <td>
                                        <?php
                                        $badge = match ($plan['priority']) {
                                            'Critical' => 'adm-badge adm-badge--red',
                                            'High' => 'adm-badge adm-badge--gold',
                                            default => 'adm-badge adm-badge--blue',
                                        };
                                        ?>
                                        <span class="<?php echo $badge; ?>"><?php echo adm_esc($plan['priority']); ?></span>
                                    </td>
                                    <td class="fw-semibold"><?php echo adm_esc($plan['issue']); ?></td>
                                    <td class="text-muted"><?php echo adm_esc($plan['action']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="adm-card">
        <div class="adm-card__head"><h3>Top Expense Categories (<?php echo $report_year; ?>)</h3></div>
        <div class="adm-card__body">
            <?php if (empty($top_expenses)): ?>
                <p class="text-muted mb-0">No ledger expenses recorded for this year.</p>
            <?php else: ?>
                <ul class="adm-expense-list">
                    <?php foreach ($top_expenses as $cat => $amt):
                        $pct = $operating_expenses > 0 ? ($amt / $operating_expenses) * 100 : 0;
                    ?>
                        <li>
                            <span><?php echo adm_esc($cat); ?></span>
                            <span class="adm-expense-list__amt"><?php echo adm_peso($amt); ?></span>
                            <small><?php echo number_format($pct, 1); ?>%</small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="adm-card adm-section">
    <div class="adm-card__head"><h3>Financial Summary</h3></div>
    <div class="adm-card__body">
        <div class="adm-summary-grid">
            <div><span>Total revenue</span><strong><?php echo adm_peso($total_revenue); ?></strong></div>
            <div><span>Direct costs (COGS + milling + shipping)</span><strong><?php echo adm_peso($total_direct_costs); ?></strong></div>
            <div><span>Gross profit (rubber)</span><strong class="text-success"><?php echo adm_peso($total_gross_profit); ?></strong></div>
            <div><span>Operating expenses</span><strong class="text-danger"><?php echo adm_peso($operating_expenses); ?></strong></div>
            <div class="adm-summary-grid__total"><span>Net after expenses</span><strong class="<?php echo $net_after_expenses >= 0 ? 'text-success' : 'text-danger'; ?>"><?php echo adm_peso($net_after_expenses); ?></strong></div>
        </div>
    </div>
</div>
