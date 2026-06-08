(function (global, $) {
    'use strict';

    var cfg = global.CUPLUMP_SHIPMENT_DETAIL || {};
    var shipmentId = cfg.shipmentId;

    function parseNum(value) {
        return parseFloat(String(value || '').replace(/,/g, '')) || 0;
    }

    function formatMoney(num) {
        return parseNum(num).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function showModal(id) {
        if (global.SalesModal) global.SalesModal.show(id);
        else $(id).modal('show');
    }

    function hideModal(id) {
        if (global.SalesModal) global.SalesModal.hide(id);
        else $(id).modal('hide');
    }

    function applyFormData(data) {
        if (!data) return;
        Object.keys(data).forEach(function (key) {
            var el = document.getElementById(key);
            if (el) el.value = data[key] == null ? '' : data[key];
        });
    }

    function lockForm() {
        var $form = $('#shipment_form');
        $form.addClass('is-locked');
        $form.find('input, textarea').prop('readonly', true);
        $form.find('select').prop('disabled', true);
        $form.find('button').prop('disabled', true);
        $('.sales-detail-toolbar').addClass('sales-detail-toolbar--locked');
        $('.selectContainer').hide();
    }

    global.computeCuplumpShipmentWeight = function computeCuplumpShipmentWeight() {
        var totalWeight = 0;
        var count = 0;
        var $table = $('#container_table');

        if (!$table.length) {
            $('#number_container').val('0');
            $('#total-cuplump-weight').val('0.00');
            global.calculateCuplumpShippingExpenses();
            return;
        }

        $table.find('tbody tr').each(function () {
            var $cells = $(this).find('td');
            if ($cells.length < 5) return;
            var weight = parseNum($cells.eq(4).text());
            if (weight > 0) {
                totalWeight += weight;
                count += 1;
            }
        });

        $('#number_container').val(String(count));
        $('#total-cuplump-weight').val(formatMoney(totalWeight));
        global.calculateCuplumpShippingExpenses();
    };

    global.calculateCuplumpShippingExpenses = function calculateCuplumpShippingExpenses() {
        var totalExpense =
            parseNum($('#ship_exp_freight').val()) +
            parseNum($('#ship_exp_loading').val()) +
            parseNum($('#ship_exp_processing').val()) +
            parseNum($('#ship_exp_trucking').val()) +
            parseNum($('#ship_exp_cranage').val()) +
            parseNum($('#ship_exp_misc').val());

        var numContainers = parseNum($('#number_container').val()) || 0;
        var costPerContainer = numContainers > 0 ? totalExpense / numContainers : 0;

        $('#total_ship_exp').val(formatMoney(totalExpense));
        $('#ship_cost_per_container').val(formatMoney(costPerContainer));
    };

    global.fetch_cuplump_shipment_containers = function fetch_cuplump_shipment_containers() {
        return $.ajax({
            url: 'table/cuplump_shipment_container_record.php',
            method: 'POST',
            data: { shipment_id: shipmentId }
        }).done(function (html) {
            $('#selected_container_list').html(html);
            global.computeCuplumpShipmentWeight();
            if (cfg.isLocked) {
                $('#selected_container_list input, #selected_container_list button').prop('disabled', true);
            }
        });
    };

    function validateRequired() {
        var required = ['type', 'particular', 'ship_date', 'ship_destination', 'ship_source', 'ship_vessel', 'ship_info_lading', 'ship_recorded'];
        var missing = required.filter(function (id) {
            return !$.trim($('#' + id).val());
        });

        if (missing.length) {
            Swal.fire({ icon: 'error', title: 'Missing fields', text: 'Please complete all required shipment fields.' });
            return false;
        }

        if (parseNum($('#number_container').val()) <= 0) {
            Swal.fire({ icon: 'warning', title: 'No containers', text: 'Select at least one container before saving.' });
            return false;
        }

        return true;
    }

    function submitForm(action, modalId, icon, title, text, redirect) {
        if (!validateRequired()) return;

        $('#loadingOverlay').show();
        $.ajax({
            type: 'POST',
            url: action,
            data: $('#shipment_form').serialize(),
            success: function (response) {
                $('#loadingOverlay').hide();
                if (String(response).trim() === 'success') {
                    Swal.fire({ icon: icon, title: title, text: text }).then(function () {
                        if (redirect) window.location.href = redirect;
                        else window.location.reload();
                    });
                    if (modalId) hideModal(modalId);
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: response });
                }
            },
            error: function () {
                $('#loadingOverlay').hide();
                Swal.fire({ icon: 'error', title: 'Error', text: 'Form submission failed!' });
            }
        });
    }

    function bindExpenseInputs() {
        $(document).off('input.cuplumpShipExp', '.ship-exp-input');
        $(document).on('input.cuplumpShipExp', '.ship-exp-input', global.calculateCuplumpShippingExpenses);

        $(document).off('blur.cuplumpShipExp', '.ship-exp-input');
        $(document).on('blur.cuplumpShipExp', '.ship-exp-input', function () {
            var val = parseNum($(this).val());
            if (val > 0) $(this).val(formatMoney(val));
        });
    }

    function bindContainerRemoval() {
        $(document).off('click.cuplumpShipRem', '.removeContainer');
        $(document).on('click.cuplumpShipRem', '.removeContainer', function () {
            if ($('#ship_destination').prop('readonly')) return;

            var $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function () { return $(this).text(); }).get();
            var containerId = $.trim(data[0]);

            $.post('table/button/cuplump_remove_inventory.php', {
                container_id: containerId,
                shipment_id: shipmentId
            }).done(function (response) {
                if (String(response).trim() !== 'success') {
                    Swal.fire({ icon: 'error', title: 'Error', text: response });
                    return;
                }
                global.fetch_cuplump_shipment_containers();
                Swal.fire({ icon: 'info', title: 'Container removed', timer: 1200, showConfirmButton: false });
            }).fail(function () {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Could not remove container.' });
            });
        });
    }

    function bindContainerPicker() {
        $('.selectContainer').off('click.cuplumpShipPick').on('click.cuplumpShipPick', function () {
            if ($('#ship_destination').prop('readonly')) return;

            $.ajax({
                url: 'table/cuplump_shipment_container.php',
                method: 'POST',
                data: { shipment_id: shipmentId }
            }).done(function (html) {
                $('#container_list').html(html);
                showModal('#containerModal');
            });
        });

        $(document).off('click.cuplumpShipAdd', '.addCuplump');
        $(document).on('click.cuplumpShipAdd', '.addCuplump', function () {
            var $tr = $(this).closest('tr');

            $.post('table/button/cuplump_add_container.php', {
                container_id: $tr.data('container-id'),
                shipment_id: shipmentId,
                van_no: $tr.data('van-no'),
                date: $tr.data('loading-date'),
                total_weight: $tr.data('total-weight'),
                ave_cost: $tr.data('ave-cost'),
                total_cost: $tr.data('total-cost')
            }).done(function (response) {
                if (String(response).trim() !== 'success') {
                    Swal.fire({ icon: 'error', title: 'Error', text: response });
                    return;
                }
                global.fetch_cuplump_shipment_containers();
                $.ajax({
                    url: 'table/cuplump_shipment_container.php',
                    method: 'POST',
                    data: { shipment_id: shipmentId }
                }).done(function (html) {
                    $('#container_list').html(html);
                });
                Swal.fire({ icon: 'success', title: 'Container added', timer: 1200, showConfirmButton: false });
            }).fail(function () {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Could not add container.' });
            });
        });
    }

    function handleVoid() {
        Swal.fire({
            icon: 'warning',
            title: 'Delete this shipment?',
            text: 'This will remove the shipment and release assigned containers.',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Yes, delete'
        }).then(function (result) {
            if (!result.isConfirmed) return;
            $('#loadingOverlay').show();
            $.post('function/cuplump_shipment_void.php', { ship_id: shipmentId }, function (response) {
                $('#loadingOverlay').hide();
                if (String(response).trim() === 'success') {
                    Swal.fire({ icon: 'success', title: 'Deleted', text: 'Shipment removed.' })
                        .then(function () { window.location.href = 'cuplump_shipment_record.php'; });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: response });
                }
            }).fail(function () {
                $('#loadingOverlay').hide();
                Swal.fire({ icon: 'error', title: 'Error', text: 'Could not delete shipment.' });
            });
        });
    }

    $(function () {
        applyFormData(cfg.formData);
        if (cfg.isLocked) lockForm();

        bindExpenseInputs();
        bindContainerRemoval();
        bindContainerPicker();
        global.calculateCuplumpShippingExpenses();
        global.fetch_cuplump_shipment_containers();

        $('.btnDraft').on('click', function () {
            if ($('#ship_destination').prop('readonly')) {
                Swal.fire({ icon: 'warning', title: 'Locked', text: 'This shipment cannot be edited.' });
                return;
            }
            showModal('#draftModal');
        });

        $('.btnVoid').on('click', function () {
            if ($('#ship_destination').prop('readonly')) {
                Swal.fire({ icon: 'warning', title: 'Locked', text: 'This shipment cannot be deleted.' });
                return;
            }
            handleVoid();
        });

        $('.confirmShipment').on('click', function (e) {
            e.preventDefault();
            if ($('#ship_destination').prop('readonly')) {
                Swal.fire({ icon: 'warning', title: 'Locked', text: 'This shipment cannot be edited.' });
                return;
            }
            if (!validateRequired()) return;
            showModal('#confirmModal');
        });

        $('#confirmButton').on('click', function () {
            submitForm('function/cuplump_shipment_confirm.php', '#confirmModal', 'success', 'Confirmed', 'Shipment marked complete.');
        });

        $('#saveDraftBtn').on('click', function () {
            submitForm('function/cuplump_shipment_draft.php', '#draftModal', 'info', 'Draft Saved', 'Shipment draft saved.', 'cuplump_shipment_record.php');
        });
    });
}(window, jQuery));
