(function ($) {
    'use strict';

    function updateBaleCost(purchasedId, recordingId, purchaseCost, expense) {
        var totalCost = parseFloat(purchaseCost) + parseFloat(expense);

        return $.ajax({
            url: 'function/updateBaleCost.php',
            method: 'POST',
            data: {
                recording_id: recordingId,
                purchase_cost: purchaseCost,
                total_cost: totalCost
            }
        });
    }

    function fetchPurchaseCost(transType, purchasedId, recordingId, prodExpense) {
        var url;
        if (transType === 'EJN') {
            url = 'fetch/fetchEjnData.php?purchased_id=' + encodeURIComponent(String(purchasedId).replace(/,/g, ''));
        } else if (transType === 'DRY') {
            url = 'fetch/fetchBaleCost.php?recording_id=' + encodeURIComponent(String(recordingId).replace(/,/g, ''))
                + '&purchased_id=' + encodeURIComponent(String(purchasedId).replace(/,/g, ''));
        } else {
            url = 'fetch/fetchPurchasedData.php?purchased_id=' + encodeURIComponent(String(purchasedId).replace(/,/g, ''));
        }

        return $.getJSON(url).then(function (myObj) {
            var purchaseCost;
            if (transType === 'EJN') {
                purchaseCost = myObj[4];
            } else if (transType === 'DRY') {
                purchaseCost = myObj[2];
            } else {
                purchaseCost = myObj[7];
            }
            return updateBaleCost(purchasedId, recordingId, purchaseCost, prodExpense);
        });
    }

    $(function () {
        if (!$.fn.DataTable) {
            console.error('DataTables not loaded');
            return;
        }

        var $table = $('#bale_table');
        if (!$table.length) return;

        if ($.fn.DataTable.isDataTable($table)) {
            $table.DataTable().destroy();
        }

        window.baleRecordTable = $table.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'fetch/fetchBaleRecord.php',
                type: 'POST',
                error: function (xhr) {
                    console.error('Bale record load failed:', xhr.responseText || xhr.statusText);
                }
            },
            columns: [
                { data: 'status' },
                { data: 'recording_id' },
                { data: 'bales_prod_id' },
                { data: 'production_date' },
                { data: 'supplier' },
                { data: 'lot_num' },
                { data: 'bales_type' },
                { data: 'kilo_per_bale', className: 'number-cell' },
                { data: 'number_bales', className: 'number-cell bales-column' },
                { data: 'remaining_bales', className: 'number-cell remaining-column' },
                { data: 'reweight', className: 'number-cell', visible: false },
                { data: 'rubber_weight', className: 'number-cell' },
                { data: 'drc', className: 'number-cell' },
                { data: 'description' },
                { data: 'milling_cost', className: 'number-cell' },
                { data: 'unit_cost', className: 'number-cell' },
                { data: 'production_type' },
                { data: 'purchase_type' },
                { data: 'purchased_id' },
                { data: 'action', orderable: false, searchable: false }
            ],
            order: [[2, 'desc']],
            pageLength: 30,
            lengthMenu: [[15, 30, 50, 100], [15, 30, 50, 100]],
            responsive: true,
            dom: '<"row mb-2"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>'
                + '<"row"<"col-sm-12"tr>>'
                + '<"row mt-2"<"col-sm-12 col-md-5"l><"col-sm-12 col-md-7"p>>',
            buttons: [
                { extend: 'excelHtml5', text: 'Excel', exportOptions: { columns: ':visible' } },
                { extend: 'pdfHtml5', text: 'PDF', exportOptions: { columns: ':visible' } },
                { extend: 'print', text: 'Print', exportOptions: { columns: ':visible' } },
                'colvis'
            ],
            language: {
                processing: '<i class="fas fa-spinner fa-spin"></i> Loading bale records…',
                search: '',
                searchPlaceholder: 'Search supplier, lot, quality…',
                emptyTable: 'No bale records found.',
                zeroRecords: 'No matching bale records found.'
            },
            drawCallback: function () {
                $table.closest('.dataTables_wrapper').find('.dataTables_filter input').addClass('form-control form-control-sm');
            }
        });

        $table.on('click', '.btnUpdateCost', function () {
            var $btn = $(this);
            var prodExpense = $btn.data('production_expense');
            var transType = $btn.data('trans_type');
            var purchasedId = $btn.data('purchased_id');
            var recordingId = $btn.data('recording_id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to update the cost?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'No, cancel'
            }).then(function (result) {
                if (!result.isConfirmed) return;

                $('.plantation-loading').show();

                fetchPurchaseCost(transType, purchasedId, recordingId, prodExpense)
                    .done(function () {
                        Swal.fire({
                            title: 'Success!',
                            text: 'The cost has been updated.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function () {
                            if (window.baleRecordTable) {
                                window.baleRecordTable.ajax.reload(null, false);
                            }
                        });
                    })
                    .fail(function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update failed',
                            text: 'Could not update unit cost. Please try again.'
                        });
                    })
                    .always(function () {
                        $('.plantation-loading').hide();
                    });
            });
        });
    });
}(jQuery));
