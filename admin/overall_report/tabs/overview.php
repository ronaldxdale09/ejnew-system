<div class="adm-grid-2">
    <div class="adm-card">
        <div class="adm-card__head"><h3>Monthly Revenue &amp; Gross Profit</h3></div>
        <div class="adm-card__body adm-card__body--chart"><canvas id="orRevenueProfitChart"></canvas></div>
    </div>
    <div class="adm-card">
        <div class="adm-card__head"><h3>Cost Structure (<?php echo $report_year; ?>)</h3></div>
        <div class="adm-card__body adm-card__body--chart"><canvas id="orCostChart"></canvas></div>
        <div class="adm-card__foot adm-card__foot--stats">
            <span>Direct costs <?php echo adm_peso($total_direct_costs); ?></span>
            <span>Margin <?php echo number_format($gross_margin_pct, 1); ?>%</span>
        </div>
    </div>
</div>

<div class="adm-grid-2-1 adm-section">
    <div class="adm-card">
        <div class="adm-card__head"><h3>Top Customers</h3></div>
        <div class="adm-card__body adm-card__body--flush">
            <div class="table-responsive adm-table-wrap">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Buyer</th>
                            <th class="text-end">Purchases</th>
                            <th class="text-end">Share</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($top_buyers)): ?>
                            <tr><td colspan="3" class="text-muted text-center py-3">No sales recorded for <?php echo $report_year; ?>.</td></tr>
                        <?php else: ?>
                            <?php foreach ($top_buyers as $buyer):
                                $share = $total_revenue > 0 ? ($buyer['total_bought'] / $total_revenue) * 100 : 0;
                            ?>
                                <tr>
                                    <td><?php echo adm_esc($buyer['buyer_name']); ?></td>
                                    <td class="text-end fw-semibold"><?php echo adm_peso($buyer['total_bought']); ?></td>
                                    <td class="text-end text-muted"><?php echo number_format($share, 1); ?>%</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="adm-card">
        <div class="adm-card__head"><h3>Revenue Mix</h3></div>
        <div class="adm-card__body">
            <div class="adm-stat-rows">
                <div class="adm-stat-row">
                    <span>Bales</span>
                    <strong><?php echo adm_peso($bales_revenue); ?></strong>
                    <small><?php echo $total_revenue > 0 ? number_format(($bales_revenue / $total_revenue) * 100, 1) : 0; ?>%</small>
                </div>
                <div class="adm-stat-row">
                    <span>Cuplump</span>
                    <strong><?php echo adm_peso($cuplump_revenue); ?></strong>
                    <small><?php echo $total_revenue > 0 ? number_format(($cuplump_revenue / $total_revenue) * 100, 1) : 0; ?>%</small>
                </div>
                <?php if ($coffee_revenue > 0): ?>
                <div class="adm-stat-row">
                    <span>Coffee</span>
                    <strong><?php echo adm_peso($coffee_revenue); ?></strong>
                    <small><?php echo number_format(($coffee_revenue / $total_revenue) * 100, 1); ?>%</small>
                </div>
                <?php endif; ?>
                <div class="adm-stat-row adm-stat-row--total">
                    <span>Avg selling price</span>
                    <strong>₱<?php echo number_format($avg_sell_price_kg, 2); ?>/kg</strong>
                </div>
            </div>
        </div>
    </div>
</div>
