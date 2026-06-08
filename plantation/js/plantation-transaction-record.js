(function ($) {
    'use strict';

    function openTransactionReport($btn) {
        var F = window.PlantationFormat || {};

        function setVal(id, val) {
            var el = document.getElementById(id);
            if (el) el.value = val == null || val === '' ? '-' : val;
        }

        setVal('recording_id', $btn.data('recording_id'));
        setVal('record_supplier', $btn.data('supplier'));
        setVal('record_loc', $btn.data('location') || '-');
        setVal('record_lot', $btn.data('lot_num'));
        setVal('record_driver', $btn.data('driver') || '-');
        setVal('record_truck', $btn.data('truck') || '-');
        setVal('date_purchased', F.formatDate ? F.formatDate($btn.data('date_purchased')) : ($btn.data('date_purchased') || '-'));
        setVal('wet_weight', F.formatNumber ? F.formatNumber($btn.data('wet_weight'), 0) : $btn.data('wet_weight'));
        setVal('date_received', F.formatDate ? F.formatDate($btn.data('date_received')) : ($btn.data('date_received') || '-'));
        setVal('reweight', F.formatNumber ? F.formatNumber($btn.data('reweight'), 0) : $btn.data('reweight'));
        setVal('milling_date', F.formatDate ? F.formatDate($btn.data('date_milled')) : ($btn.data('date_milled') || '-'));
        setVal('crumbed_weight', F.formatNumber ? F.formatNumber($btn.data('crumbed_weight'), 0) : $btn.data('crumbed_weight'));
        setVal('dry_date', F.formatDate ? F.formatDate($btn.data('date_dryed')) : ($btn.data('date_dryed') || '-'));
        setVal('dry_weight', F.formatNumber ? F.formatNumber($btn.data('dry_weight'), 0) : $btn.data('dry_weight'));
        setVal('production_date', F.formatDate ? F.formatDate($btn.data('production_date')) : ($btn.data('production_date') || '-'));
        setVal('bale_weight', F.formatNumber ? F.formatNumber($btn.data('bale_weight'), 0) : $btn.data('bale_weight'));
        setVal('drc', F.formatNumber ? F.formatNumber($btn.data('drc'), 2) : $btn.data('drc'));

        var recordingId = String($btn.data('recording_id') || '').replace(/\s+/g, '');
        $.ajax({
            url: 'table/pressing_data.php',
            method: 'POST',
            data: { recording_id: recordingId },
            success: function (html) {
                $('#pressing_modal_update_table').html(html);
            }
        });

        PlantationModal.show('#transactionReportModal');
    }

    $(function () {
        if (!$.fn.DataTable) {
            console.error('DataTables not loaded');
            return;
        }

        var $table = $('#sellerTable');
        if (!$table.length) return;

        if ($.fn.DataTable.isDataTable($table)) {
            $table.DataTable().destroy();
        }

        window.transactionRecordTable = $table.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'fetch/fetchTransactionRecord.php',
                type: 'POST',
                error: function (xhr) {
                    console.error('Transaction record load failed:', xhr.responseText || xhr.statusText);
                }
            },
            columns: [
                { data: 'status', orderable: true },
                { data: 'recording_id', orderable: true },
                { data: 'supplier', orderable: true },
                { data: 'lot_num', orderable: true },
                { data: 'weight', orderable: true, className: 'number-cell' },
                { data: 'reweight', orderable: true, className: 'number-cell' },
                { data: 'crumbed_weight', orderable: true, className: 'number-cell', visible: false },
                { data: 'dry_weight', orderable: true, className: 'number-cell', visible: false },
                { data: 'produce_total_weight', orderable: true, className: 'number-cell' },
                { data: 'drc', orderable: true, className: 'number-cell' },
                { data: 'purchase_cost', orderable: true, className: 'number-cell' },
                { data: 'production_expense', orderable: true, className: 'number-cell' },
                { data: 'milling_cost', orderable: true, className: 'number-cell' },
                { data: 'action', orderable: false, searchable: false }
            ],
            order: [[1, 'desc']],
            pageLength: 50,
            lengthMenu: [[25, 50, 100], [25, 50, 100]],
            dom: '<"top d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2"<"left-col"B><"center-col"f>>rt<"bottom d-flex flex-wrap align-items-center justify-content-between gap-2 mt-2"ip>',
            buttons: [
                { extend: 'excelHtml5', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
                { extend: 'pdfHtml5', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
                { extend: 'print', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } }
            ],
            language: {
                processing: '<i class="fas fa-spinner fa-spin"></i> Loading transactions…',
                search: '',
                searchPlaceholder: 'Search supplier, lot, status…',
                emptyTable: 'No rubber transactions found.',
                zeroRecords: 'No matching transactions found.'
            },
            drawCallback: function () {
                $table.closest('.dataTables_wrapper').find('.dataTables_filter input').addClass('form-control form-control-sm');
            }
        });

        $(document).on('click', '.btnViewRecord', function () {
            openTransactionReport($(this));
        });
    });
}(jQuery));
