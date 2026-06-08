<div class="modal fade copra-modal viewTransaction" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-book me-1"></i> Recent Copra Purchases</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Invoice</th>
                                <th>Date</th>
                                <th>Contract</th>
                                <th>Seller</th>
                                <th class="text-end">1st price</th>
                                <th class="text-end">Net res.</th>
                                <th class="text-end">Paid</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $record = mysqli_query($con, 'SELECT * FROM copra_transaction ORDER BY id DESC LIMIT 10');
                            if ($record && mysqli_num_rows($record) > 0) :
                                while ($row = mysqli_fetch_array($record)) :
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['invoice'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['contract'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['seller'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-end">₱ <?php echo number_format(floatval($row['first_res']), 2); ?></td>
                                <td class="text-end"><?php echo number_format(floatval($row['net_res'])); ?> kg</td>
                                <td class="text-end">₱ <?php echo number_format(floatval($row['amount_paid']), 2); ?></td>
                                <td class="text-nowrap">
                                    <a href="transaction.php?view=<?php echo urlencode($row['invoice']); ?>" class="btn btn-sm btn-outline-primary" title="Open">
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                endwhile;
                            else :
                            ?>
                            <tr><td colspan="8" class="text-center text-muted py-4">No transactions yet.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a href="transaction_history.php" class="btn btn-sm btn-outline-primary">View full record</a>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
