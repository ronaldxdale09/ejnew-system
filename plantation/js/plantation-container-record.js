(function ($) {
    'use strict';

    var statusFilter = '';

    var statusBadgeClass = {
        'Draft': 'bg-info',
        'In Progress': 'bg-warning text-dark',
        'Awaiting Release': 'bg-secondary',
        'Released': 'bg-primary',
        'Shipped Out': 'bg-dark',
        'Sold': 'bg-success',
        'Sold-Update': 'bg-success',
        'Void': 'bg-danger',
    };

    function readRow($tr) {
        var d = $tr.data();
        return {
            containerId: String(d.containerId || ''),
            status: String(d.status || ''),
            withdrawalDate: String(d.withdrawalDate || ''),
            vanNo: String(d.vanNo || ''),
            quality: String(d.quality || ''),
            kiloBale: String(d.kiloBale || ''),
            remarks: String(d.remarks || ''),
            recordedBy: String(d.recordedBy || ''),
        };
    }

    function setMeta(id, value) {
        var $el = $('#' + id);
        if ($el.length) {
            $el.text(value || '—');
        }
    }

    function renderStatusBadge(status) {
        var cls = statusBadgeClass[status] || 'bg-secondary';
        return '<span class="badge ' + cls + '">' + $('<span>').text(status || '—').html() + '</span>';
    }

    function showBalesLoading() {
        $('#bales_container_record').html(
            '<div class="plantation-view-bales__loading">' +
            '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> Loading bales…' +
            '</div>'
        );
    }

    $(document).ready(function () {
        if (!$.fn.DataTable || !$('#containerRecordTable').length) {
            return;
        }

        var table = $('#containerRecordTable').DataTable({
            dom: "<'plantation-dt-top'<'plantation-dt-export'B><'plantation-dt-search'f>>rt<'plantation-dt-bottom'ip>",
            order: [[0, 'asc'], [1, 'desc']],
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            buttons: [
                { extend: 'excelHtml5', className: 'btn btn-sm btn-outline-secondary', title: 'Container Records' },
                { extend: 'pdfHtml5', className: 'btn btn-sm btn-outline-secondary', title: 'Container Records', orientation: 'landscape' },
                { extend: 'print', className: 'btn btn-sm btn-outline-secondary', title: 'Container Records' },
            ],
            columnDefs: [
                { orderable: false, targets: [10] },
                { className: 'text-end', targets: [5, 6, 7, 8, 10] },
                { type: 'num', targets: [0, 1, 5, 6, 7, 8] },
            ],
            language: {
                search: '',
                searchPlaceholder: 'Search containers…',
                emptyTable: 'No container records found.',
                info: 'Showing _START_–_END_ of _TOTAL_ containers',
                infoEmpty: 'No containers to show',
                paginate: { previous: 'Prev', next: 'Next' },
            },
        });

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            if (settings.nTable.id !== 'containerRecordTable') {
                return true;
            }
            if (!statusFilter) {
                return true;
            }
            var rowStatus = $(table.row(dataIndex).node()).data('status') || '';
            if (statusFilter === 'Sold') {
                return rowStatus === 'Sold' || rowStatus === 'Sold-Update';
            }
            if (statusFilter === 'Released') {
                return rowStatus === 'Released' || rowStatus === 'Shipped Out';
            }
            return rowStatus === statusFilter;
        });

        $('.plantation-status-chip').on('click', function () {
            $('.plantation-status-chip').removeClass('is-active');
            $(this).addClass('is-active');
            statusFilter = $(this).data('statusFilter') || '';
            table.draw();
        });

        $(document).on('click', '.btn-view-container', function () {
            var row = readRow($(this).closest('tr'));

            $('#v_id').val(row.containerId);
            $('#v_ref_label').text('#' + row.containerId);
            $('#v_status_badge').html(renderStatusBadge(row.status));
            setMeta('v_date', row.withdrawalDate);
            setMeta('v_van', row.vanNo);
            setMeta('v_quality', row.quality);
            setMeta('v_kilo', row.kiloBale);
            setMeta('v_remarks', row.remarks);
            setMeta('v_recorded', row.recordedBy);

            if (row.status === 'Awaiting Release') {
                $('#releaseButton').show();
                $('#editButton').hide();
            } else if (row.status === 'Draft' || row.status === 'In Progress' || row.status === 'Sold-Update') {
                $('#releaseButton').hide();
                $('#editButton').show();
            } else {
                $('#releaseButton').hide();
                $('#editButton').hide();
            }

            showBalesLoading();
            PlantationModal.show('#viewContainer');

            $.ajax({
                url: 'table/contaner_bales_record.php',
                method: 'POST',
                data: { container_id: row.containerId },
                success: function (html) {
                    $('#bales_container_record').html(html);
                },
                error: function () {
                    $('#bales_container_record').html(
                        '<div class="plantation-empty-state">Could not load bales. Please try again.</div>'
                    );
                },
            });
        });
    });
})(jQuery);
