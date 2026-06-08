(function (global, $) {
    'use strict';

    var cfg = global.CUPLUMP_CONTAINER_DETAIL || {};
    var containerId = cfg.containerId;

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
        var $form = $('#container_form');
        $form.addClass('is-locked');
        $form.find('input, textarea').prop('readonly', true);
        $form.find('select').prop('disabled', true);
        $form.find('button').prop('disabled', true);
        $('.sales-detail-toolbar').addClass('sales-detail-toolbar--locked');
        $('#addRow').hide();
    }

    function rowIsEmpty($row) {
        var supplier = $.trim($row.find('[name="supplier[]"]').val());
        var weight = $.trim($row.find('.weight').val());
        var cost = $.trim($row.find('.cost_per_kilo').val());
        var paid = $.trim($row.find('.amount_paid').val());
        return !supplier && !weight && !cost && !paid;
    }

    function prepareFormSubmit() {
        $('#cuplump_container tbody tr').each(function () {
            var empty = rowIsEmpty($(this));
            $(this).find(':input').prop('disabled', empty);
        });
    }

    function restoreFormInputs() {
        $('#cuplump_container tbody tr').find(':input').prop('disabled', false);
        if (cfg.isLocked) lockForm();
    }

    global.fetch_cuplump_container = function fetch_cuplump_container() {
        return $.ajax({
            url: 'table/cuplump_container_record.php',
            method: 'POST',
            data: { container_id: containerId }
        }).done(function (html) {
            $('#container_listing').html(html);
            if (typeof global.initCuplumpInventoryTable === 'function') {
                global.initCuplumpInventoryTable();
            } else if (typeof global.calculateCuplumpContainerTotals === 'function') {
                global.calculateCuplumpContainerTotals();
            }
            if (cfg.isLocked) {
                $('#container_listing input, #container_listing button').prop('disabled', true);
            }
        });
    };

    function submitForm(action, modalId, icon, title, text, redirect) {
        if ($('#cuplump_container tbody tr').length && !$('#cuplump_container tbody tr').filter(function () {
            return !rowIsEmpty($(this));
        }).length) {
            Swal.fire({ icon: 'warning', title: 'No inventory', text: 'Add at least one inventory line with supplier and weight before saving.' });
            return;
        }

        prepareFormSubmit();
        $('#loadingOverlay').show();

        $.ajax({
            type: 'POST',
            url: action,
            data: $('#container_form').serialize(),
            success: function (response) {
                restoreFormInputs();
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
                restoreFormInputs();
                $('#loadingOverlay').hide();
                Swal.fire({ icon: 'error', title: 'Error', text: 'Form submission failed!' });
            }
        });
    }

    $(function () {
        applyFormData(cfg.formData);
        if (cfg.isLocked) lockForm();

        $('#loadingOverlay').hide();
        fetch_cuplump_container();

        $('.btnDraft').on('click', function () {
            if ($('#van_no').prop('readonly')) {
                Swal.fire({ icon: 'warning', title: 'Locked', text: 'This container cannot be edited.' });
                return;
            }
            showModal('#draftModal');
        });

        $('.confirmContainer').on('click', function (e) {
            e.preventDefault();
            if ($('#van_no').prop('readonly')) {
                Swal.fire({ icon: 'warning', title: 'Locked', text: 'This container cannot be edited.' });
                return;
            }
            showModal('#confirmModal');
        });

        $('.btnVoid').on('click', function () {
            if ($('#van_no').prop('readonly')) {
                Swal.fire({ icon: 'warning', title: 'Not Allowed', text: 'Finalized containers cannot be deleted.' });
                return;
            }
            Swal.fire({
                icon: 'warning',
                title: 'Delete this container?',
                text: 'This will remove the container and all inventory lines.',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Yes, delete'
            }).then(function (result) {
                if (!result.isConfirmed) return;
                $('#loadingOverlay').show();
                $.post('function/cuplump_container/container.void.php', { container_id: containerId }, function (response) {
                    $('#loadingOverlay').hide();
                    if (String(response).trim() === 'success') {
                        Swal.fire({ icon: 'success', title: 'Deleted', text: 'Container removed.' })
                            .then(function () { window.location.href = 'cuplump_container_record.php'; });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response });
                    }
                }).fail(function () {
                    $('#loadingOverlay').hide();
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Could not delete container.' });
                });
            });
        });

        $('#confirmButton').on('click', function (e) {
            e.preventDefault();
            submitForm('function/cuplump_container/container.confirm.php', '#confirmModal', 'success', 'Confirmed', 'Container saved and awaiting shipment.');
        });

        $('#saveDraftBtn').on('click', function (e) {
            e.preventDefault();
            submitForm('function/cuplump_container/container.draft.php', '#draftModal', 'info', 'Draft Saved', 'Container draft saved.', 'cuplump_container_record.php');
        });
    });
}(window, jQuery));
