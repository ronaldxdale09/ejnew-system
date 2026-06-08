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
        F.setVal('v_bill_lading', s.bill_lading);
        F.setNum('v_ship_exp_freight', s.freight, 0);
        F.setNum('v_ship_exp_loading', s.loading_unloading, 0);
        F.setNum('v_ship_exp_processing', s.processing_fee, 0);
        F.setNum('v_ship_exp_trucking', s.trucking_expense, 0);
        F.setNum('v_ship_exp_cranage', s.cranage_fee, 0);
        F.setNum('v_ship_exp_misc', s.miscellaneous, 0);
        F.setNum('v_total_ship_exp', s.total_shipping_expense, 0);
        F.setNum('v_number_container', s.no_containers, 0);
        F.setNum('v_ship_cost_per_container', s.ship_cost_container, 0);
        F.setNum('v_total_num_bales', s.total_num_bales, 0);
        F.setNum('v_total_bale_weight', s.total_bale_weight, 0);

        $.ajax({
            url: 'table/bales_shipment_container_record.php',
            method: 'POST',
            data: { shipment_id: s.shipment_id },
            success: function (html) {
                $('#shipment_container_record').html(html);
            }
        });
        SalesModal.show('#baleShipmentModal');
    }

    $(function () {
        var $table = $('#bale_shipment_table');
        if (!$table.length || !$.fn.DataTable) return;
        if ($.fn.DataTable.isDataTable($table)) $table.DataTable().destroy();

        var dt = $table.DataTable({
            processing: true,
            serverSide: true,
            ajax: SalesDt.ajax('fetch/fetchBaleShipmentRecord.php'),
            columns: [
                { data: 'status' },
                { data: 'shipment_id', className: 'text-center' },
                { data: 'particular', className: 'text-center' },
                { data: 'ship_date' },
                { data: 'type' },
                { data: 'source' },
                { data: 'destination' },
                { data: 'shipping_expense', className: 'number-cell' },
                { data: 'no_containers', className: 'text-center' },
                { data: 'total_num_bales', className: 'number-cell' },
                { data: 'total_bale_weight', className: 'number-cell' },
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
        $(document).on('click', '#bale_shipment_table .btnViewRecord', function () {
            openShipmentView($(this));
        });
    });
}(jQuery));
