<?php
$today = date('Y-m-d');


$rubberTypes = ['5L', 'SPR-5', 'SPR-10', 'SPR-20', 'Off Color'];
?>
<div class="modal fade" id="purchaseModal" tabindex="-1" role="dialog" aria-labelledby="newContainerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newContainerLabel">Bale Outside Purchase</h5>
                <button type="button" class="btn text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="function/bale_shipment.php" method="POST">

                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Purchase Type</label>
                            <div class="input-group mb-3">
                                <input type="text" class='form-control' value="Outsource" name="purchase_type" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Purchase Date</label>
                            <div class="col-md-12">
                                <input type="date" class='form-control' value="<?php echo $today; ?>" name="n_date" require>
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Recorded by:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='recorded_by' autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <label style='font-size:15px' class="col-md-12">Supplier</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='destination' autocomplete='off' style="width: 100px;" required />
                            </div>
                        </div>

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Location</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='location' autocomplete='off' style="width: 100px;" required />
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Driver (Optional)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='driver' autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                        <div class="col">
                            <label style='font-size:15px' class="col-md-12">Truck Number (Optional)</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name='truck_num' autocomplete='off' style="width: 100px;" />
                            </div>
                        </div>
                    </div>




                    <button class="btn btn-warning" type="button" id="addRow">+ Add Bale</button> <br> <br>
                    <table class="table table-bordered" id="rubber-table">
                        <thead>
                            <tr>
                                <th scope="col" width="15%">Quality</th>
                                <th scope="col" width="15%">Kilo Per Bale</th>
                                <th scope="col">Weight (kg)</th>
                                <th scope="col">No. of Bale</th>
                                <th scope="col" width="22%">Remarks</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Purchase Cost</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center" id="purchase_cost" required>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Total Weight</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center" id="p_u_total_weight" readonly>
                                <span class="input-group-text">kg</span>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Itemized Expenses</label>
                            <div class="input-group">
                                <input type="text" style='font-size:19px' class="form-control text-center" name='expense_desc' id="u_expense_desc" placeholder='Expense Description'>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Expense Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="text" style='font-size:19px' class="form-control text-center" id="u_expense" name='expense' onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                            </div>
                        </div>

                    </div>
                    <div class="col">
                        <label style='font-size:15px' class="col-md-12">Remarks:</label>
                        <div class="input-group mb-3">
                            <textarea type="text" name="remarks" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name='new'>Proceed</button>
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
                '<select class="form-control type" name="type[]" autocomplete="off" step="any" style="font-weight:normal;">' +
                '<option selected="selected" disabled value="" style="font-weight:normal;">Choose Quality </option>' +
                selectOptions + '</select>' +
                '</td>' +
                '<td>' +
                '<div class="input-group">' +
                '<select class="form-control kilo_bale" name="kilo_bale[]" id="kilo_bale_new' + counter + '" style="font-weight:normal;">' +
                '<option selected="selected" disabled value="" style="font-weight:normal;">Choose Kilo</option>' +
                '<option value="35">35 kg</option>' +
                '<option value="33.33">33.33 kg</option>' +
                '</select>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control weight" name="weight[]" id="weight_new' + counter +
                '" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" readonly>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control bale_num" name="bale_num[]" id="bale_num_new' + counter +
                '" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" disabled>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" name="description[]" autocomplete="off" step="any">' +
                '</td>' +
                '<td><button class="btn btn-danger removeRow"><i class="fas fa-trash"></i></button></td>' +
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

        // Update the corresponding fields with the calculated values
        $("#p_u_total_weight").val(totalWeight.toLocaleString("en-US", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));


    }
</script>