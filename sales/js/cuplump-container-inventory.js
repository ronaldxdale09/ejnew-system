(function (global, $) {
    'use strict';

    function parseNum(value) {
        return parseFloat(String(value || '').replace(/,/g, '')) || 0;
    }

    function formatNum(num, decimals) {
        return parseNum(num).toLocaleString('en-US', {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals
        });
    }

    function formatWeight(num) {
        return formatNum(num, 2);
    }

    function formatMoney(num) {
        return formatNum(num, 2);
    }

    function calculateDryWeight(buyingWeight, drc) {
        return buyingWeight * (drc / 100);
    }

    function calculateTotalCost(costPerKilo, buyingWeight) {
        return costPerKilo * buyingWeight;
    }

    function calculateCostPerKilo(totalCost, buyingWeight) {
        return buyingWeight > 0 ? totalCost / buyingWeight : 0;
    }

    function recalculateRow($row, sourceField) {
        var buyingWeight = parseNum($row.find('.weight').val());
        var drc = parseNum($row.find('.drcInput').val());
        var costPerKilo = parseNum($row.find('.cost_per_kilo').val());
        var totalCost = parseNum($row.find('.total_cost').val());

        if (buyingWeight > 0 && drc > 0) {
            $row.find('.dry_weight').val(formatWeight(calculateDryWeight(buyingWeight, drc)));
        } else if (!drc || !buyingWeight) {
            $row.find('.dry_weight').val('');
        }

        if (buyingWeight > 0) {
            if (sourceField === 'total_cost' && totalCost > 0) {
                $row.find('.cost_per_kilo').val(formatMoney(calculateCostPerKilo(totalCost, buyingWeight)));
            } else if (costPerKilo > 0) {
                $row.find('.total_cost').val(formatMoney(calculateTotalCost(costPerKilo, buyingWeight)));
            } else if (totalCost > 0) {
                $row.find('.cost_per_kilo').val(formatMoney(calculateCostPerKilo(totalCost, buyingWeight)));
            } else {
                $row.find('.total_cost').val('');
            }
        } else {
            $row.find('.total_cost').val('');
        }
    }

    function calculateTotalsAndAverages() {
        var totalBuyingWeight = 0;
        var totalSellingWeight = 0;
        var totalCost = 0;

        $('#cuplump_container tbody tr').each(function () {
            var $row = $(this);
            var weight = parseNum($row.find('.weight').val());
            var sellingWeight = parseNum($row.find('.dry_weight').val());
            var cost = parseNum($row.find('.total_cost').val());

            totalBuyingWeight += weight;
            totalSellingWeight += sellingWeight;
            totalCost += cost;
        });

        var averageCost = totalBuyingWeight > 0 ? totalCost / totalBuyingWeight : 0;

        $('#total-cuplump-weight').val(formatWeight(totalBuyingWeight));
        $('#total_selling_weight').val(formatWeight(totalSellingWeight));
        $('#total-cuplump-cost').val(formatMoney(totalCost));
        $('#average-cuplump-cost').val(formatMoney(averageCost));
    }

    function recalculateAllRows() {
        $('#cuplump_container tbody tr').each(function () {
            recalculateRow($(this));
        });
        calculateTotalsAndAverages();
    }

    global.calculateCuplumpContainerTotals = calculateTotalsAndAverages;

    function newRowHtml() {
        return [
            '<tr>',
            '<td class="d-none"><input type="hidden" name="inventory_id[]" value=""></td>',
            '<td><input type="text" class="form-control form-control-sm" name="supplier[]" placeholder="Supplier"></td>',
            '<td><div class="input-group input-group-sm">',
            '<input type="text" class="form-control weight sales-num-input" name="buying_weight[]" placeholder="0">',
            '<span class="input-group-text">kg</span></div></td>',
            '<td><div class="input-group input-group-sm">',
            '<input type="text" class="form-control drcInput sales-num-input" name="drc[]" placeholder="0">',
            '<span class="input-group-text">%</span></div></td>',
            '<td><div class="input-group input-group-sm">',
            '<input type="text" class="form-control dry_weight" name="dry_weight[]" readonly>',
            '<span class="input-group-text">kg</span></div></td>',
            '<td><div class="input-group input-group-sm">',
            '<span class="input-group-text">₱</span>',
            '<input type="text" class="form-control cost_per_kilo sales-num-input" name="cost_per_kilo[]" placeholder="0">',
            '</div></td>',
            '<td><div class="input-group input-group-sm">',
            '<span class="input-group-text">₱</span>',
            '<input type="text" class="form-control total_cost" name="total_cost[]" readonly>',
            '</div></td>',
            '<td><input type="text" class="form-control form-control-sm amount_paid sales-num-input" name="amount_paid[]" placeholder="0"></td>',
            '<td><input type="text" class="form-control form-control-sm" name="inv_remarks[]" placeholder="Optional"></td>',
            '<td class="text-center"><button type="button" class="btn btn-outline-danger btn-sm removeRow"><i class="fas fa-trash"></i></button></td>',
            '</tr>'
        ].join('');
    }

    function bindInventoryTable() {
        $(document).off('input.cuplumpInv change.cuplumpInv', '#cuplump_container .weight, #cuplump_container .drcInput, #cuplump_container .cost_per_kilo, #cuplump_container .total_cost');
        $(document).on('input.cuplumpInv change.cuplumpInv', '#cuplump_container .weight, #cuplump_container .drcInput, #cuplump_container .cost_per_kilo', function () {
            var $row = $(this).closest('tr');
            recalculateRow($row, 'cost_per_kilo');
            calculateTotalsAndAverages();
        });

        $(document).off('input.cuplumpInv change.cuplumpInv', '#cuplump_container .total_cost');
        $(document).on('input.cuplumpInv change.cuplumpInv', '#cuplump_container .total_cost', function () {
            var $row = $(this).closest('tr');
            recalculateRow($row, 'total_cost');
            calculateTotalsAndAverages();
        });

        $(document).off('blur.cuplumpInv', '#cuplump_container .sales-num-input');
        $(document).on('blur.cuplumpInv', '#cuplump_container .sales-num-input', function () {
            var $el = $(this);
            var val = parseNum($el.val());
            if (!$el.val() || val === 0) return;
            if ($el.hasClass('weight')) {
                $el.val(formatNum(val, 0));
            } else if ($el.hasClass('drcInput')) {
                $el.val(formatNum(val, 2));
            } else {
                $el.val(formatMoney(val));
            }
        });

        $('#addRow').off('click.cuplumpInv').on('click.cuplumpInv', function () {
            if ($('#van_no').prop('readonly')) return;
            var $empty = $('.sales-inv-empty');
            if ($empty.length) $empty.remove();
            $('#cuplump_container tbody').append(newRowHtml());
        });

        $(document).off('click.cuplumpInv', '.removeRow').on('click.cuplumpInv', '.removeRow', function () {
            $(this).closest('tr').remove();
            if (!$('#cuplump_container tbody tr').length) {
                $('#container_listing').prepend(
                    '<div class="sales-inv-empty"><i class="fas fa-box-open"></i><p>No inventory lines yet. Click <strong>Add Line</strong> to record cuplump purchases.</p></div>'
                );
            }
            calculateTotalsAndAverages();
        });

        recalculateAllRows();
    }

    global.initCuplumpInventoryTable = bindInventoryTable;
}(window, jQuery));
