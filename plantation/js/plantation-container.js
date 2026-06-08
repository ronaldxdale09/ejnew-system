(function ($) {
    'use strict';

    var workspace = document.querySelector('.plantation-container-workspace');
    if (!workspace) return;

    var containerId = workspace.getAttribute('data-container-id');
    var editable = workspace.getAttribute('data-editable') === '1';

    function loadSelectedInventory() {
        return $.ajax({
            url: 'table/contaner_selectedList.php',
            method: 'POST',
            data: { container_id: containerId },
            success: function (html) {
                $('#selected_inventory').html(html);
            },
        });
    }

    function loadInventoryPicker() {
        return $.ajax({
            url: 'table/container_bales_inventory.php',
            method: 'POST',
            data: { container_id: containerId },
            success: function (html) {
                $('#inventory_picker_body').html(html);
                initInventoryTable();
            },
        });
    }

    function initInventoryTable() {
        var tableEl = $('#bales-inventory');
        if (!tableEl.length || !$.fn.DataTable) return;

        if ($.fn.DataTable.isDataTable(tableEl)) {
            tableEl.DataTable().destroy();
        }

        var table = tableEl.DataTable({
            dom: 'frtip',
            pageLength: 25,
            order: [[0, 'asc']],
        });

        $('#kilobale_filter').off('change').on('change', function () {
            table.search(this.value).draw();
        });
    }

    function validateHeaderFields() {
        var fields = ['van_no', 'withdrawal_date', 'quality', 'kilo_bale', 'recorded_by'];
        var ok = true;
        fields.forEach(function (id) {
            var el = document.getElementById(id);
            if (!el || !String(el.value || '').trim()) {
                if (el) el.classList.add('is-invalid');
                ok = false;
            } else if (el) {
                el.classList.remove('is-invalid');
            }
        });
        return ok;
    }

    function copyTotalsToDraftForm() {
        $('#draft_van_no').val($('#van_no').val());
        $('#draft_withdrawal_date').val($('#withdrawal_date').val());
        $('#draft_quality').val($('#quality').val());
        $('#draft_kilo_bale').val($('#kilo_bale').val());
        $('#draft_remarks').val($('#remarks').val());
        $('#draft_recorded_by').val($('#recorded_by').val());
        $('#draft_num_bales').val($('#num_bales').val() || '0');
        $('#draft_total_bale_weight').val($('#total_bale_weight').val() || '0');
        $('#draft_total_bale_cost').val($('#total_bale_cost').val() || '0');
        $('#draft_average_cost').val($('#average_cost').val() || '0');
        $('#draft_total_milling_cost').val($('#total_milling_cost').val() || '0');
    }

    function baleCount() {
        return parseInt($('#num_bales').val() || '0', 10) || 0;
    }

    $(document).ready(function () {
        loadSelectedInventory();

        if (editable) {
            $('#btnSelectInventory').on('click', function () {
                loadInventoryPicker().done(function () {
                    PlantationModal.show('#inventoryPickerModal');
                });
            });

            $('#btnCompleteContainer').on('click', function () {
                if (!validateHeaderFields()) {
                    Swal.fire({ icon: 'error', title: 'Missing fields', text: 'Fill all required container fields.' });
                    return;
                }
                if (baleCount() <= 0) {
                    Swal.fire({ icon: 'warning', title: 'No bales selected', text: 'Add at least one bale before completing.' });
                    return;
                }
                Swal.fire({
                    title: 'Complete container?',
                    text: 'This will mark the container as awaiting release.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, complete',
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $('#containerForm').trigger('submit');
                    }
                });
            });

            $('#btnDraftContainer').on('click', function () {
                if (!validateHeaderFields()) {
                    Swal.fire({ icon: 'error', title: 'Missing fields', text: 'Fill all required container fields.' });
                    return;
                }
                copyTotalsToDraftForm();
                Swal.fire({
                    title: 'Save as draft?',
                    text: 'You can continue editing this container later.',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Save draft',
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $('#draftForm').trigger('submit');
                    }
                });
            });

            $('#btnVoidContainer').on('click', function () {
                Swal.fire({
                    title: 'Void this container?',
                    text: 'Selected bales will be returned to inventory.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'Void container',
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $('#voidForm').trigger('submit');
                    }
                });
            });
        }

        $(document).on('click', '.btn-add-inventory', function () {
            var $tr = $(this).closest('tr');
            var data = $tr.data();
            var qty = parseInt($tr.find('.container-qty-input').val(), 10);
            var maxBales = parseInt(data.maxBales, 10) || 0;

            if (!qty || qty <= 0) {
                Swal.fire({ icon: 'warning', title: 'Enter quantity', text: 'Number of bales must be greater than zero.' });
                return;
            }
            if (qty > maxBales) {
                Swal.fire({ icon: 'error', title: 'Too many bales', text: 'Quantity exceeds available stock (' + maxBales + ' pcs).' });
                return;
            }

            $.ajax({
                method: 'POST',
                url: 'table/container/addInventory.php',
                data: {
                    container_id: containerId,
                    bales_id: data.balesId,
                    num_bales: qty,
                    planta_id: data.plantaId,
                    total_weight: data.totalWeight,
                },
                success: function (response) {
                    loadSelectedInventory();
                    loadInventoryPicker();
                    Swal.fire({
                        icon: 'success',
                        title: response.trim() || 'Added',
                        timer: 900,
                        showConfirmButton: false,
                    });
                },
                error: function (xhr) {
                    Swal.fire({ icon: 'error', title: 'Could not add bale', text: xhr.responseText || 'Request failed.' });
                },
            });
        });

        $(document).on('click', '.btn-remove-inventory', function () {
            var balesId = $(this).closest('tr').data('balesId');
            Swal.fire({
                title: 'Remove bales?',
                text: 'They will be returned to available inventory.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Remove',
            }).then(function (result) {
                if (!result.isConfirmed) return;
                $.ajax({
                    url: 'table/container/removeInventory.php',
                    type: 'POST',
                    data: { bales_id: balesId },
                    success: function () {
                        loadSelectedInventory();
                    },
                    error: function (xhr) {
                        Swal.fire({ icon: 'error', title: 'Remove failed', text: xhr.responseText || 'Request failed.' });
                    },
                });
            });
        });
    });
})(jQuery);
