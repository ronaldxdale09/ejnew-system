(function ($) {
    'use strict';

    function initChosen() {
        $('.select_seller').each(function () {
            var $el = $(this);
            if ($el.data('chosen')) {
                $el.trigger('chosen:updated');
                return;
            }
            $el.chosen({ width: '100%', search_threshold: 10 });
        });
    }

    function fetchAddress(name, targetId) {
        if (!name) return;
        $.post('include/fetch/fetchLocation.php', { name: name }, function (address) {
            $(targetId).val(address || '');
        });
    }

    function formatNumInput(val) {
        if (val === null || val === undefined || val === '') return '';
        var n = parseFloat(val);
        if (isNaN(n)) return '';
        return n.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    $(function () {
        initChosen();

        $('#createDryTransfer').on('shown.bs.modal', function () {
            initChosen();
        });

        $('#new_seller').on('change', function () {
            fetchAddress($(this).val(), '#new_address');
        });

        $('#u_seller').on('change', function () {
            fetchAddress($(this).val(), '#u_address');
        });

        var $table = $('#dry-receiving-table');
        if (!$table.length || !$.fn.DataTable) return;
        if ($.fn.DataTable.isDataTable($table)) $table.DataTable().destroy();

        var dt = $table.DataTable({
            processing: true,
            serverSide: true,
            ajax: RubberDt.ajax((window.RUBBER_BASE || '') + 'fetch/fetchDryReceivingRecord.php'),
            columns: [
                { data: 'status', orderable: true },
                { data: 'dry_id', className: 'text-center' },
                { data: 'date' },
                { data: 'seller' },
                { data: 'address' },
                { data: 'net', className: 'number-cell' },
                { data: 'price', className: 'number-cell' },
                { data: 'cash_advance', className: 'number-cell' },
                { data: 'recorded_by' },
                { data: 'action', orderable: false, searchable: false, className: 'text-center' }
            ],
            order: [[1, 'desc']],
            pageLength: 30,
            lengthMenu: [[15, 30, 50, 100], [15, 30, 50, 100]],
            dom: RubberDt.dom,
            buttons: ['excelHtml5', 'pdfHtml5', 'print'],
            language: RubberDt.language,
            columnDefs: [{ orderable: false, targets: -1 }]
        });

        $(document).on('click', '.btnDryEdit', function () {
            var $btn = $(this);
            $('#u_id').val($btn.data('id'));
            $('#u_date').val($btn.data('date'));
            $('#u_recorded_by').val($btn.data('recordedBy'));
            $('#u_seller').val($btn.data('seller')).trigger('chosen:updated');
            $('#u_address').val($btn.data('address'));
            $('#u_net').val(formatNumInput($btn.data('net')));
            $('#u_price').val(formatNumInput($btn.data('price')));
            $('#u_cash_advance').val(formatNumInput($btn.data('cashAdvance')));
            RubberModal.show('#updateDryTransfer');
        });

        $(document).on('click', '.btnDryDelete', function () {
            $('#d_id').val($(this).data('id'));
            RubberModal.show('#deleteDryTransfer');
        });

        if (window.__dryReceivingFlash) {
            Swal.fire({
                icon: 'success',
                title: window.__dryReceivingFlash,
                timer: 2200,
                showConfirmButton: false
            });
        }
    });
}(jQuery));
