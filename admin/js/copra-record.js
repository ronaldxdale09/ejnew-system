(function ($) {
    'use strict';

    function formatDate(inputDate) {
        if (!inputDate) return '';
        var date = new Date(inputDate);
        if (isNaN(date.getTime())) return inputDate;
        return date.toLocaleDateString('en-US', { month: 'long', day: '2-digit', year: 'numeric' });
    }

    function formatNumber(value) {
        if (!value) return '0';
        var parsed = parseFloat(String(value).replace(/[^0-9.]/g, ''));
        return isNaN(parsed) ? '0' : parsed.toLocaleString('en-US');
    }

    function peso(n, decimals) {
        decimals = decimals === undefined ? 2 : decimals;
        return '₱' + Number(n || 0).toLocaleString('en-US', { minimumFractionDigits: decimals, maximumFractionDigits: decimals });
    }

    function updateFooters(totals) {
        if (!totals) return;
        $('#copraFilteredCount').text(Number(totals.count || 0).toLocaleString('en-US'));
        $('#copraFilteredPaid').text(peso(totals.paid));
        $('#copraFilteredWeight').text(Number(totals.weight || 0).toLocaleString('en-US') + ' kg');
        var avg = totals.weight > 0 ? totals.paid / totals.weight : 0;
        $('#copraFilteredAvgKg').text(peso(avg));
    }

    $(document).ready(function () {
        $('#copraDateFrom, #copraDateTo').datepicker({ dateFormat: 'yy-mm-dd' });

        var table = $('#transaction_history').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'fetch/fetchCopraData.php',
                type: 'POST',
                data: function (d) {
                    d.min = $('#copraDateFrom').val();
                    d.max = $('#copraDateTo').val();
                    d.year = $('#copraYear').val();
                    d.seller = $('#copraSeller').val();
                },
                dataSrc: function (json) {
                    updateFooters(json.totals);
                    return json.data;
                }
            },
            columns: [
                { data: 'invoice' },
                { data: 'date' },
                { data: 'contract' },
                { data: 'seller' },
                { data: 'first_res', className: 'text-end' },
                { data: 'sec_res', className: 'text-end' },
                { data: 'net_weight', className: 'text-end' },
                { data: 'amount_paid', className: 'text-end' },
                { data: 'action', orderable: false, searchable: false, className: 'text-center' }
            ],
            order: [[1, 'desc']],
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            dom: '<"d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2"Blf>rt<"d-flex flex-wrap align-items-center justify-content-between gap-2 mt-2"ip>',
            buttons: [
                { extend: 'excelHtml5', title: 'Copra Purchase Record' },
                { extend: 'pdfHtml5', title: 'Copra Purchase Record' },
                'print'
            ],
            language: {
                processing: '<i class="fas fa-spinner fa-spin"></i> Loading transactions…',
                search: '',
                searchPlaceholder: 'Search invoice, contract, seller…',
                emptyTable: 'No copra purchases found for the selected filters.',
                zeroRecords: 'No matching transactions found.'
            },
            drawCallback: function () {
                $('#transaction_history_wrapper .dataTables_filter input').addClass('form-control form-control-sm');
            }
        });

        function redrawTable() {
            table.draw();
        }

        $('#copraDateFrom, #copraDateTo, #copraSeller').on('change', redrawTable);

        $('#copraYear').on('change', function () {
            var year = $(this).val();
            window.location.href = 'copra_record.php?year=' + encodeURIComponent(year);
        });

        $('[data-copra-preset]').on('click', function () {
            var preset = $(this).data('copra-preset');
            var today = new Date();
            var y = today.getFullYear();
            var m = today.getMonth();

            if (preset === 'month') {
                var first = new Date(y, m, 1);
                $('#copraDateFrom').datepicker('setDate', first);
                $('#copraDateTo').datepicker('setDate', today);
            } else if (preset === 'ytd') {
                $('#copraDateFrom').datepicker('setDate', new Date(y, 0, 1));
                $('#copraDateTo').datepicker('setDate', today);
            } else if (preset === 'all') {
                $('#copraDateFrom, #copraDateTo').val('');
            }
            redrawTable();
        });

        $('#copraClearFilters').on('click', function () {
            $('#copraDateFrom, #copraDateTo, #copraSeller').val('');
            redrawTable();
        });

        $('#transaction_history').on('click', '.viewButton', function () {
            var copra = $(this).data('copra');
            if (!copra) return;

            var w1 = parseFloat(copra.rese_weight_1) || 0;
            var w2 = parseFloat(copra.rese_weight_2) || 0;
            var totalRes = w1 + w2;
            var amountPaid = parseFloat(copra.amount_paid) || 0;

            $('#copraModalTitle').text('Invoice #' + (copra.invoice || '—'));
            $('#copraModalSubtitle').text((copra.seller || '—') + ' · ' + formatDate(copra.date));
            $('#copraModalAmountPaid').text(peso(amountPaid));

            $('#viewHistory').modal('show');

            $('#invoice').val(copra.invoice);
            $('#name').val(copra.seller);
            $('#date').val(formatDate(copra.date));
            $('#contract').val(copra.contract);
            $('#address').val(copra.address || '');

            $('#noSack').val(formatNumber(copra.noSack));
            $('#gross').val(formatNumber(copra.gross));
            $('#tare').val(formatNumber(copra.tare));
            $('#net').val(formatNumber(copra.net_weight));

            $('#dust').val(formatNumber(copra.dust));
            $('#new-dust').val(formatNumber(copra.new_dust));
            $('#total-dust').val(formatNumber(copra.total_dust));

            $('#moisture').val(formatNumber(copra.moisture));
            $('#discount_reading').val(formatNumber(copra.discount));
            $('#total-moisture').val(formatNumber(copra.total_moisture));
            $('#total-res').val(formatNumber(totalRes));

            $('#1resecada').val(formatNumber(copra.first_res));
            $('#2resecada').val(formatNumber(copra.sec_res));
            $('#total_1res').val(formatNumber(copra.total_first_res));
            $('#total_2res').val(formatNumber(copra.total_sec_res));
            $('#1rese-weight').val(formatNumber(copra.rese_weight_1));
            $('#2rese-weight').val(formatNumber(copra.rese_weight_2));

            $('#total-amount').val(formatNumber(copra.total_amount));
            $('#less').val(formatNumber(copra.less));
            $('#total-paid').val(formatNumber(copra.amount_paid));
            $('#total-words').val(copra.amount_words || '');
            $('#amount-paid').val(formatNumber(copra.amount_paid));
            $('#tax').val(copra.tax_rate ? formatNumber(copra.tax_rate) + '%' : '1%');
            $('#tax-amount').val(formatNumber(copra.tax_amount));
        });

        $(document).on('click', '.btnPrint', function () {
            if (typeof html2canvas === 'undefined') return;
            html2canvas(document.querySelector('#copra_print_content'), {
                scale: 2,
                backgroundColor: '#ffffff'
            }).then(function (canvas) {
                var img = canvas.toDataURL('image/png');
                var win = window.open('');
                win.document.write('<html><head><title>Copra Transaction</title></head><body style="margin:0"><img src="' + img + '" style="width:100%"></body></html>');
                win.document.close();
                win.focus();
                win.onload = function () { win.print(); };
            });
        });
    });
}(jQuery));
