(function ($) {
    'use strict';

    function openShipmentView($btn) {
        var s = $btn.data('shipment');
        if (!s) return;
        var F = window.SalesFormat;

        F.setVal('v_ship_id', s.shipment_id);
        F.setVal('v_type', s.type);
        F.setVal('v_date', s.ship_date);
        F.setVal('v_source', s.source);
        F.setVal('v_destination', s.destination);
        F.setVal('v_remarks', s.remarks);
        F.setVal('v_recorded_by', s.recorded_by);
        F.setVal('v_vessel', s.vessel);
        F.setVal('v_info_lading', s.bill_lading);
        F.setNum('ship_exp_freight', s.freight, 2);
        F.setNum('ship_exp_loading', s.loading_unloading, 2);
        F.setNum('ship_exp_processing', s.processing_fee, 2);
        F.setNum('ship_exp_trucking', s.trucking_expense, 2);
        F.setNum('ship_exp_cranage', s.cranage_fee, 2);
        F.setNum('ship_exp_misc', s.miscellaneous, 2);
        F.setNum('total_ship_exp', s.total_shipping_expense, 2);
        F.setVal('number_container', s.no_containers);
        F.setNum('ship_cost_per_container', s.ship_cost_container, 2);
        F.setNum('total-cuplump-weight', s.total_cuplump_weight, 2);

        $.ajax({
            url: 'table/cuplump_shipment_container_record.php',
            method: 'POST',
            data: { shipment_id: s.shipment_id, readonly: 1 },
            success: function (html) {
                $('#shipment_container_record').html(html);
                $('#print_content button').not('#btnPrint').hide();
            }
        });
        SalesModal.show('#cuplumpShipmentModal');
    }

    $(function () {
        var $table = $('#cuplump_shipment_table');
        if (!$table.length || !$.fn.DataTable) return;
        if ($.fn.DataTable.isDataTable($table)) $table.DataTable().destroy();

        var dt = $table.DataTable({
            processing: true,
            serverSide: true,
            ajax: SalesDt.ajax('fetch/fetchCuplumpShipmentRecord.php'),
            columns: [
                { data: 'status' },
                { data: 'shipment_id', className: 'text-center' },
                { data: 'particular' },
                { data: 'type' },
                { data: 'ship_date' },
                { data: 'route' },
                { data: 'shipping_expense', className: 'number-cell' },
                { data: 'no_containers', className: 'number-cell' },
                { data: 'total_cuplump_weight', className: 'number-cell' },
                { data: 'total_cuplump_cost', className: 'number-cell' },
                { data: 'action', orderable: false, searchable: false, className: 'text-center' }
            ],
            order: [[1, 'desc']],
            pageLength: 30,
            dom: SalesDt.dom,
            buttons: ['excelHtml5', 'pdfHtml5', 'print'],
            language: SalesDt.language,
            columnDefs: [{ orderable: false, targets: -1 }]
        });

        SalesDt.bindFilters(dt);
        $(document).on('click', '#cuplump_shipment_table .btnViewRecord', function () {
            openShipmentView($(this));
        });
    });
}(jQuery));
