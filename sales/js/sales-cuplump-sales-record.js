(function ($) {
    'use strict';

    function openCuplumpSaleView($btn) {
        var cuplump = $btn.data('cuplump');
        if (!cuplump) return;
        var F = window.SalesFormat;

        F.setVal('sales_id', cuplump.sales_cuplump_id || cuplump.cuplump_sales_id);
        F.setVal('v_sale_contract', cuplump.sale_contract);
        F.setVal('v_purchase_contract', cuplump.purchase_contract);
        F.setVal('v_sale_type', cuplump.sale_type);
        F.setVal('v_trans_date', cuplump.transaction_date);
        F.setVal('v_sale_buyer', cuplump.buyer_name);
        F.setVal('v_shipping_date', cuplump.shipping_date);
        F.setVal('v_sale_source', cuplump.source);
        F.setVal('v_sale_destination', cuplump.destination);
        F.setNum('v_contract_container', cuplump.contract_container_num);
        F.setNum('v_contract_quantity', cuplump.contract_quantity);
        F.setVal('v_currency', cuplump.currency);
        F.setNum('v_contract_price', cuplump.contract_price);
        F.setNum('v_tax_rate', cuplump.tax_rate);
        F.setNum('v_tax_amount', cuplump.tax_amount);
        F.setVal('v_other_terms', cuplump.other_terms);
        F.setVal('v_number_container', cuplump.no_containers);
        F.setNum('v_total_cuplump_weight', cuplump.total_cuplump_weight || cuplump.total_net_weight);
        F.setNum('v_overall_ave_kiloCost', cuplump.overall_ave_cost_kilo);
        F.setNum('v_total_sale', cuplump.total_sales);
        F.setNum('v_amount_paid', cuplump.amount_paid);
        F.setNum('v_unpaid_balance', cuplump.unpaid_balance);
        F.setNum('v_sales_proceeds', cuplump.sales_proceed);
        F.setNum('v_total_cuplump_cost', cuplump.total_cuplump_cost);
        F.setNum('v_total_ship_exp', cuplump.total_ship_expense);
        F.setNum('v_over_all_cost', cuplump.overall_cost);
        F.setNum('v_gross_profit', cuplump.gross_profit);

        var salesId = cuplump.sales_cuplump_id || cuplump.cuplump_sales_id;
        $.ajax({
            url: 'table/cuplump_sales_container.php',
            method: 'POST',
            data: { sales_id: salesId },
            success: function (html) {
                $('#container_cuplump_list').html(html);
                $('#print_content input').prop('readonly', true);
                $('#print_content textarea').prop('readonly', true);
                $('#print_content select').prop('disabled', true);
                $('#print_content button').not('#btnPrint').hide();
            }
        });
        $.ajax({
            url: 'table/cuplump_sales_payment.php',
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

        var cur = cuplump.currency || '₱';
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
            ajax: SalesDt.ajax('fetch/fetchCuplumpSalesRecord.php'),
            columns: [
                { data: 'status' },
                { data: 'cuplump_sales_id', className: 'text-center' },
                { data: 'transaction_date' },
                { data: 'sale_contract', className: 'text-center' },
                { data: 'buyer_name' },
                { data: 'contract_price', className: 'number-cell' },
                { data: 'total_cuplump_weight', className: 'number-cell' },
                { data: 'overall_ave_cost_kilo', className: 'number-cell' },
                { data: 'total_sales', className: 'number-cell' },
                { data: 'overall_cost', className: 'number-cell' },
                { data: 'unpaid_balance', className: 'number-cell' },
                { data: 'gross_profit', className: 'number-cell' },
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
        $(document).on('click', '#sales_rec_table .btnViewRecord', function () {
            openCuplumpSaleView($(this));
        });
    });
}(jQuery));
