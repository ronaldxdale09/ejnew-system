(function ($) {
    'use strict';

    window.SalesDt = {
        filterParams: function () {
            return {
                filterBuyer: $('#filterBuyer').val() || '',
                filterStatus: $('#filterStatus').val() || '',
                filterMonth: $('#filterMonth').val() || '',
                filterYear: $('#filterYear').val() || '',
                startDate: $('#startDate').val() || '',
                endDate: $('#endDate').val() || '',
                filterLocation: $('#filterLocation').val() || ''
            };
        },
        bindFilters: function (table) {
            $('#filterBuyer, #filterStatus, #filterMonth, #filterYear, #startDate, #endDate, #filterLocation').on('change', function () {
                table.ajax.reload();
            });
        },
        language: {
            processing: '<i class="fas fa-spinner fa-spin"></i> Loading…',
            search: '',
            searchPlaceholder: 'Search records…',
            emptyTable: 'No records found.',
            zeroRecords: 'No matching records found.'
        },
        dom: '<"top d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2"<"left-col"B><"center-col"f>>rt<"bottom d-flex flex-wrap align-items-center justify-content-between gap-2 mt-2"ip>',
        ajaxError: function (xhr) {
            var msg = 'Failed to load table data.';
            try {
                var json = JSON.parse(xhr.responseText || '{}');
                if (json.error) msg = json.error;
            } catch (e) {
                if (xhr.responseText) msg = xhr.responseText.substring(0, 200);
            }
            console.error('Sales DataTable error:', msg, xhr);
        },
        ajaxDefaults: function (url, extraData) {
            return {
                url: url,
                type: 'POST',
                data: function (d) {
                    var payload = $.extend(d, SalesDt.filterParams());
                    if (typeof extraData === 'function') {
                        return extraData(payload);
                    }
                    if (extraData && typeof extraData === 'object') {
                        return $.extend(payload, extraData);
                    }
                    return payload;
                },
                error: SalesDt.ajaxError
            };
        },
        ajax: function (url, extraData) {
            return SalesDt.ajaxDefaults(url, extraData);
        }
    };
}(jQuery));
