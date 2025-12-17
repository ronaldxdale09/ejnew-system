<?php
// Generate Dynamic Tasks based on Data
$dynamic_tasks = [];

// From Action Plan
foreach ($action_plan as $plan) {
    if ($plan['priority'] == 'Critical') {
        $dynamic_tasks[] = "URGENT: " . $plan['action'];
    } else {
        $dynamic_tasks[] = "Schedule meeting to discuss: " . $plan['issue'];
    }
}

// From Expenses
if (!empty($top_expenses)) {
    $top_cat = array_key_first($top_expenses);
    $dynamic_tasks[] = "Audit expenses for top category: '$top_cat' to reduce spend by 5%.";
}

// From Inventory
if ($days_inventory > 60) {
    $dynamic_tasks[] = "Inventory is high (>60 days). Initiate sales promotion or slow production.";
} elseif ($days_inventory < 15 && $days_inventory > 0) {
    $dynamic_tasks[] = "Low Stock Warning (<15 days). Increase production or sourcing immediately.";
}

// Fallbacks
if (empty($dynamic_tasks)) {
    $dynamic_tasks[] = "Review monthly financial statements.";
    $dynamic_tasks[] = "Conduct routine improved maintenance check.";
}
?>

<div class="row mb-4">
    <!-- STRATEGIC ACTION TABLE -->
    <div class="col-lg-8">
        <div class="chart-card h-100">
            <div class="card-title">Priority Action Matrix</div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light small text-uppercase text-secondary">
                        <tr>
                            <th>Priority</th>
                            <th>Issue Detected</th>
                            <th>Recommended Action</th>
                            <th>Impact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($action_plan)): ?>
                            <?php foreach ($action_plan as $plan): ?>
                                <tr>
                                    <td>
                                        <span
                                            class="badge rounded-pill 
                                            <?php echo ($plan['priority'] == 'Critical') ? 'bg-danger' :
                                                (($plan['priority'] == 'High') ? 'bg-warning text-dark' : 'bg-info'); ?>">
                                            <?php echo $plan['priority']; ?>
                                        </span>
                                    </td>
                                    <td class="fw-bold text-dark"><?php echo $plan['issue']; ?></td>
                                    <td class="small text-muted"><?php echo $plan['action']; ?></td>
                                    <td><span class="fw-bold text-primary"><?php echo $plan['impact']; ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted p-4">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i><br>
                                    No critical issues detected. Operations are running within optimal parameters.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- COST OPTIMIZATION (NEW) -->
    <div class="col-lg-4">
        <div class="chart-card h-100">
            <div class="card-title">Top Expense Drivers</div>
            <p class="text-muted small mb-3">Focus cost-cutting efforts on these high-spend categories.</p>
            <ul class="list-group list-group-flush">
                <?php foreach ($top_expenses as $cat => $amt): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-dark fw-bold"><?php echo $cat; ?></span>
                        <span class="text-danger fw-bold">₱<?php echo number_format($amt, 0); ?></span>
                    </li>
                <?php endforeach; ?>
                <?php if (empty($top_expenses)): ?>
                    <li class="list-group-item text-center text-muted">No expense data available.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<!-- AUTO GENERATED TASKS -->
<div class="row">
    <div class="col-12">
        <div class="chart-card">
            <h6 class="text-uppercase text-muted fw-bold mb-3" style="font-size:12px;">Automated Task Suggestions (AI
                Derived)</h6>
            <?php foreach ($dynamic_tasks as $task): ?>
                <div class="d-flex align-items-center mb-3">
                    <input type="checkbox" class="form-check-input me-3" style="width:20px;height:20px;">
                    <span class="text-dark"><?php echo $task; ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>