(function ($) {
    'use strict';

    function openBaleSaleView($btn) {
        var bale = $btn.data('bale');
        if (!bale) return;
        var F = window.SalesFormat;

        F.setVal('v_contract_quality', bale.contract_quality);
        F.setVal('v_sale_id', bale.bales_sales_id);
        F.setVal('v_sale_contract', bale.sale_contract);
        F.setVal('v_purchase_contract', bale.purchase_contract);
        F.setVal('v_sale_type', bale.sale_type);
        F.setVal('v_trans_date', bale.transaction_date);
        F.setVal('v_sale_buyer', bale.buyer_name);
        F.setVal('v_shipping_date', bale.shipping_date);
        F.setVal('v_sale_source', bale.source);
        F.setVal('v_sale_destination', bale.destination);
        F.setNum('v_contract_container', bale.contract_container_num);
        F.setNum('v_total_milling_cost', bale.total_milling_cost);
        F.setNum('v_contract_quantity', bale.contract_quantity);
        F.setVal('v_currency', bale.currency);
        F.setNum('v_contract_price', bale.contract_price);
        F.setNum('v_tax_rate', bale.tax_rate);
        F.setNum('v_tax_amount', bale.tax_amount);
        F.setVal('v_other_terms', bale.other_terms);
        F.setVal('v_number_container', bale.no_containers);
        F.setVal('v_total_num_bales', bale.total_num_bales);
        F.setNum('v_total_bale_weight', bale.total_bale_weight);
        F.setNum('v_overall_ave_kiloCost', bale.overall_ave_cost_kilo);
        F.setNum('v_total_sale', bale.total_sales);
        F.setNum('v_amount_paid', bale.amount_paid);
        F.setNum('v_unpaid_balance', bale.unpaid_balance);
        F.setNum('v_sales_proceeds', bale.sales_proceed);
        F.setNum('v_total_bale_cost', bale.total_bale_cost);
        F.setNum('v_total_ship_exp', bale.total_ship_expense);
        F.setNum('v_over_all_cost', bale.overall_cost);
        F.setNum('v_gross_profit', bale.gross_profit);

        var salesId = bale.bales_sales_id;
        $.ajax({
            url: 'table/bales_sales_container.php',
            method: 'POST',
            data: { sales_id: salesId },
            success: function (html) {
                $('#container_selected').html(html);
                $('#print_content input').prop('readonly', true);
                $('#print_content textarea').prop('readonly', true);
                $('#print_content select').prop('disabled', true);
                $('#print_content button').not('#btnPrint').hide();
            }
        });
        $.ajax({
            url: 'table/bales_sales_payment.php',
            method: 'POST',
            data: { sales_id: salesId },
            success: function (html) {
                $('#payment_list_table').html(html);
                $('#print_content input').prop('readonly', true);
                $('#print_content textarea').prop('readonly', true);
                $('#print_content select').prop('disabled', true);
                $('#print_content button').not('#btnPrint').hide();
            }
        });

        var cur = bale.currency || '₱';
        $('#currency_selected_sales, #currency_selected_paid, #currency_selected_balance, #currency_selected_price').text(cur);
        $('.payment-currency-symbol').text(cur);
        SalesModal.show('#viewSalesRecord');
    }

    $(function () {
        var $table = $('#sales_rec_table');
        if (!$table.length || !$.fn.DataTable) return;
        if ($.fn.DataTable.isDataTable($table)) $table.DataTable().destroy();

        var dt = $table.DataTable({
            processing: true,
            serverSide: true,
            ajax: SalesDt.ajax('fetch/fetchBaleSalesRecord.php'),
            columns: [
                { data: 'status' },
                { data: 'bales_sales_id', className: 'text-center' },
                { data: 'transaction_date' },
                { data: 'sale_contract', className: 'text-center' },
                { data: 'buyer_name' },
                { data: 'contract_price', className: 'number-cell' },
                { data: 'total_bale_weight', className: 'number-cell' },
                { data: 'overall_ave_cost_kilo', className: 'number-cell' },
                { data: 'total_sales', className: 'number-cell' },
                { data: 'overall_cost', className: 'number-cell' },
                { data: 'unpaid_balance', className: 'number-cell' },
                { data: 'gross_profit', className: 'number-cell' },
                { data: 'action', orderable: false, searchable: false, className: 'text-center' }
            ],
            order: [[1, 'desc']],
            pageLength: 30,
            lengthMenu: [[15, 30, 50, 100], [15, 30, 50, 100]],
            dom: SalesDt.dom,
            buttons: ['excelHtml5', 'pdfHtml5', 'print'],
            language: SalesDt.language,
            columnDefs: [{ orderable: false, targets: -1 }]
        });

        SalesDt.bindFilters(dt);
        $(document).on('click', '#sales_rec_table .btnViewRecord', function () {
            openBaleSaleView($(this));
        });
    });

    $(document).on('click', '.btnPrint', function () {
        $('#print_content button').hide();
        html2canvas(document.querySelector('#print_content')).then(function (canvas) {
            var w = window.open('');
            $(w.document.body).html('<img src="' + canvas.toDataURL('image/png') + '" style="width:100%;">').ready(function () {
                w.focus();
                w.print();
            });
            $('#print_content button').show();
        });
    });
}(jQuery));
