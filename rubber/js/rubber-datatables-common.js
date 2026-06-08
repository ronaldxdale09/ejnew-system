(function ($) {
    'use strict';

    window.RubberDt = {
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
            console.error('Rubber DataTable error:', msg, xhr);
        },
        ajax: function (url, extraData) {
            return {
                url: url,
                type: 'POST',
                data: function (d) {
                    if (typeof extraData === 'function') {
                        return extraData(d);
                    }
                    if (extraData && typeof extraData === 'object') {
                        return $.extend(d, extraData);
                    }
                    return d;
                },
                error: RubberDt.ajaxError
            };
        },
        parseFilterDate: function (selector) {
            var $el = $(selector);
            if (!$el.length) return '';
            var v = $el.val();
            if (!v) return '';
            var dtObj = $el.data('datetime') || $el.data('DateTime');
            if (dtObj && typeof dtObj.val === 'function') {
                var dt = dtObj.val();
                if (dt instanceof Date && !isNaN(dt.getTime())) {
                    return dt.toISOString().slice(0, 10);
                }
            }
            var parsed = new Date(v);
            if (!isNaN(parsed.getTime())) {
                return parsed.toISOString().slice(0, 10);
            }
            return '';
        },
        filterParams: function (opts) {
            opts = opts || {};
            return function () {
                var out = {};
                if (opts.seller) {
                    out.filterSeller = $(opts.seller).val() || '';
                }
                if (opts.startDate) {
                    out.startDate = RubberDt.parseFilterDate(opts.startDate);
                }
                if (opts.endDate) {
                    out.endDate = RubberDt.parseFilterDate(opts.endDate);
                }
                if (opts.source) {
                    out.filterSource = opts.source;
                }
                return out;
            };
        },
        bindFilters: function (table, selectors) {
            var $els = $(selectors.join(','));
            $els.on('change keyup', function () {
                if (table && table.ajax) {
                    table.ajax.reload();
                }
            });
        },
        initServerTable: function (selector, options) {
            var $table = $(selector);
            if (!$table.length || !$.fn.DataTable) return null;
            if ($.fn.DataTable.isDataTable($table)) {
                $table.DataTable().destroy();
            }
            var getExtra = options.getExtraData || options.filterParams;
            var ajaxOpts = RubberDt.ajax(options.url, function (d) {
                var extra = typeof getExtra === 'function' ? getExtra() : {};
                return $.extend(d, extra);
            });
            var defaults = {
                processing: true,
                serverSide: true,
                ajax: ajaxOpts,
                pageLength: 30,
                lengthMenu: [[15, 30, 50, 100], [15, 30, 50, 100]],
                dom: RubberDt.dom,
                buttons: ['excelHtml5', 'pdfHtml5', 'print'],
                language: RubberDt.language
            };
            var dt = $table.DataTable($.extend(true, {}, defaults, options.tableOptions || {}));
            if (options.filters) {
                RubberDt.bindFilters(dt, options.filters);
            }
            return dt;
        }
    };
}(jQuery));
