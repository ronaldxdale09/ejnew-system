<?php
$today = date('Y-m-d');


$rubberTypes = ['5L', 'SPR-5', 'SPR-10', 'SPR-20', 'Off Color'];
?>
<div class="modal fade sales-modal" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable sales-modal-dialog--wide" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">Bale Outside Purchase</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/balePurchase.php" method="POST">
                <div class="modal-body sales-modal-body--compact">
                    <div class="row g-2 sales-modal-grid">
                        <div class="col-6 col-md-4 sales-field">
                            <label for="purchase_type">Purchase Type</label>
                            <input type="text" class="form-control form-control-sm" value="Outsource" name="purchase_type" id="purchase_type" readonly>
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="n_date">Purchase Date</label>
                            <input type="date" class="form-control form-control-sm" value="<?php echo $today; ?>" name="n_date" id="n_date" require>
                        </div>
                        <div class="col-6 col-md-4 sales-field">
                            <label for="recorded_by">Recorded By</label>
                            <input type="text" class="form-control form-control-sm" name="recorded_by" id="recorded_by" value="<?php echo $name ?>" autocomplete="off">
                        </div>
                        <div class="col-6 col-md-6 sales-field">
                            <label for="supplier">Supplier</label>
                            <input type="text" class="form-control form-control-sm" name="supplier" id="supplier" autocomplete="off" required>
                        </div>
                        <div class="col-6 col-md-6 sales-field">
                            <label for="location">Location</label>
                            <input type="text" class="form-control form-control-sm" name="location" id="location" autocomplete="off" required>
                        </div>
                        <div class="col-6 col-md-6 sales-field">
                            <label for="driver">Driver <span class="sales-field__suffix">(optional)</span></label>
                            <input type="text" class="form-control form-control-sm" name="driver" id="driver" autocomplete="off">
                        </div>
                        <div class="col-6 col-md-6 sales-field">
                            <label for="truck_num">Truck Number <span class="sales-field__suffix">(optional)</span></label>
                            <input type="text" class="form-control form-control-sm" name="truck_num" id="truck_num" autocomplete="off">
                        </div>
                    </div>

                    <div class="sales-modal-section__row">
                        <p class="sales-modal-section">Bale Lines</p>
                        <button class="btn btn-sm btn-outline-warning" type="button" id="addRow"><i class="fas fa-plus"></i> Add Bale</button>
                    </div>
                    <div class="sales-modal-table-wrap">
                        <table class="table table-bordered" id="rubber-table">
                            <thead>
                                <tr>
                                    <th scope="col" width="15%">Quality</th>
                                    <th scope="col" width="15%">Kilo Per Bale</th>
                                    <th scope="col">Weight (kg)</th>
                                    <th scope="col">No. of Bale</th>
                                    <th scope="col" width="25%">Remarks</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <p class="sales-modal-section">Cost Summary</p>
                    <div class="row g-2 sales-modal-grid">
                        <div class="col-6 col-md-6 sales-field sales-field--currency">
                            <label for="purchase_cost">Total Purchase Cost</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm text-center" id="purchase_cost" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" name="purchase_cost" required>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 sales-field sales-field--currency">
                            <label for="total_weight">Total Weight <span class="sales-field__suffix">kg</span></label>
                            <input type="text" class="form-control form-control-sm text-center" name="total_weight" id="total_weight" readonly>
                        </div>
                        <div class="col-12 col-md-6 sales-field">
                            <label for="expense_desc">List of Expenses</label>
                            <input type="text" class="form-control form-control-sm text-center" name="expense_desc" id="expense_desc">
                        </div>
                        <div class="col-6 col-md-3 sales-field sales-field--currency">
                            <label for="expense_amount">Expense Amount</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" class="form-control form-control-sm text-center" name="expense" id="expense_amount" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                            </div>
                        </div>
                        <div class="col-6 col-md-3 sales-field sales-field--currency sales-field--highlight">
                            <label for="average_kilo_cost">Average Kilo Cost</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₱</span>
                                <input type="text" readonly class="form-control form-control-sm text-center" id="average_kilo_cost" name="average_kilo_cost">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary" name="new">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        var counter = 0;
        var rubberTypes = <?php echo json_encode($rubberTypes); ?>;
        $("#addRow").on("click", function() {
            var selectOptions = rubberTypes.map(function(type) {
                return '<option value="' + type + '">' + type + '</option>';
            }).join('');

            var newRow = $('<tr>' +
                '<td>' +
                '<select class="form-control form-control-sm type" name="type[]" autocomplete="off" step="any" style="font-weight:normal;">' +
                '<option selected="selected" disabled value="" style="font-weight:normal;">Select...</option>' +
                selectOptions + '</select>' +
                '</td>' +
                '<td>' +
                '<div class="input-group input-group-sm">' +
                '<select class="form-control form-control-sm kilo_bale" name="kilo_bale[]" id="kilo_bale_new' + counter + '" style="font-weight:normal;">' +
                '<option selected="selected" disabled value="" style="font-weight:normal;">Select...</option>' +
                '<option value="35">35.00 kg</option>' +
                '<option value="33.33">33.33 kg</option>' +
                '</select>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-group input-group-sm">' +
                '<input type="text" class="form-control form-control-sm weight" name="weight[]" id="weight_new' + counter +
                '" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" readonly>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-group input-group-sm">' +
                '<input type="text" class="form-control form-control-sm bale_num" name="bale_num[]" id="bale_num_new' + counter +
                '" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" disabled>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control form-control-sm" name="description[]" autocomplete="off" step="any">' +
                '</td>' +
                '<td><button class="btn btn-sm btn-danger removeRow"><i class="fas fa-trash"></i></button></td>' +
                '</tr>');
            counter++;
            $("#rubber-table tbody").append(newRow);
            $(document).on("change", ".type, .kilo_bale", function() {
                var row = $(this).closest("tr");
                var selectedType = row.find(".type").val();
                var selectedKilo = row.find(".kilo_bale").val();
                var baleNumInput = row.find(".bale_num");

                if (selectedType && selectedKilo) {
                    baleNumInput.prop("disabled", false);
                    excessInput.prop("disabled", false);
                } else {
                    baleNumInput.prop("disabled", true);
                }
            });

        });

        // Remove row on click
        $(document).on("click", ".removeRow", function() {
            event.preventDefault();

            row = $(this).closest("tr");
            row.remove();

            calculateTotals();
        });
        $("#purchase_cost").on('input', calculateTotals);
        $("#expense_amount").on('input', calculateTotals);
    });
</script>


<script>
    $(document).on("keyup", ".bale_num, .excess", function() {
        var row = $(this).closest("tr");
        var kiloBale = parseFloat(row.find(".kilo_bale").val()) || 0;
        var baleNum = parseFloat(row.find(".bale_num").val().replace(/[^0-9.]/g, '')) || 0;

        // Compute and update the weight values
        var weight = (baleNum * kiloBale)
        row.find(".weight").val(weight.toFixed(2));

        // Calculate total weight and rubber_drc
        calculateTotals();
    });


    function calculateTotals() {
        var totalWeight = 0;

        $(".weight").each(function() {
            totalWeight += parseFloat($(this).val().replace(/[^0-9.]/g, '')) || 0;
        });

        // Calculate average kilo cost
        var purchaseCost = parseFloat($('#purchase_cost').val().replace(/[^0-9.]/g, '')) || 0;
        var expenseAmount =parseFloat($('#expense_amount').val().replace(/[^0-9.]/g, '')) || 0;
        
        var totalCost = purchaseCost + expenseAmount;
        var averageKiloCost = totalCost / totalWeight;

        // Update the corresponding fields with the calculated values
        $("#total_weight").val(totalWeight.toLocaleString("en-US", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));

        $("#average_kilo_cost").val(isNaN(averageKiloCost) ? 0 : averageKiloCost.toLocaleString("en-US", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
    }
</script>
