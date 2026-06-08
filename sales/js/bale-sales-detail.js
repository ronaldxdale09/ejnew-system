(function (global, $) {
    'use strict';

    var cfg = global.BALE_SALES_DETAIL || {};
    var salesId = cfg.salesId;

    function showModal(id) {
        if (global.SalesModal) {
            global.SalesModal.show(id);
        } else {
            $(id).modal('show');
        }
    }

    function hideModal(id) {
        if (global.SalesModal) {
            global.SalesModal.hide(id);
        } else {
            $(id).modal('hide');
        }
    }

    function setCurrencyLabels(currency) {
        ['#currency_selected_sales', '#currency_selected_paid', '#currency_selected_balance', '#currency_selected_price']
            .forEach(function (sel) {
                $(sel).text(currency || '');
            });
        $('.payment-currency-symbol').text(currency || '');
    }

    function applyFormData(data) {
        if (!data) return;
        Object.keys(data).forEach(function (key) {
            var el = document.getElementById(key);
            if (el) {
                el.value = data[key] == null ? '' : data[key];
            }
        });
        setCurrencyLabels(data.sale_currency);
    }

    function lockForm() {
        var $form = $('#salesForm');
        $form.addClass('is-locked');
        $form.find('input, textarea').prop('readonly', true);
        $form.find('select').prop('disabled', true);
        $('.sales-detail-toolbar .btnDraft, .sales-detail-toolbar .confirmSales, .sales-detail-toolbar .btnVoid').prop('disabled', true);
    }

    function changeGrossProfitColor() {
        var gross = parseFloat(String($('#gross_profit').val()).replace(/,/g, '')) || 0;
        var $wrap = $('#gross_profit').closest('.sales-field');
        $wrap.removeClass('sales-field--profit-pos sales-field--profit-neg');
        if (gross < 0) {
            $wrap.addClass('sales-field--profit-neg');
        } else if (gross > 0) {
            $wrap.addClass('sales-field--profit-pos');
        }
    }

    global.changeGrossProfitColor = changeGrossProfitColor;

    global.fetch_bale_container = function fetch_bale_container() {
        return $.ajax({
            url: 'table/bales_sales_container.php',
            method: 'POST',
            data: { sales_id: salesId }
        }).done(function (html) {
            $('#container_selected').html(html);
            if (typeof computeGrossSales === 'function') {
                computeGrossSales();
            }
            if (typeof computeSalesProceeds === 'function') {
                computeSalesProceeds();
            }
            changeGrossProfitColor();
        });
    };

    global.fetch_bale_payment = function fetch_bale_payment() {
        return $.ajax({
            url: 'table/bales_sales_payment.php',
            method: 'POST',
            data: { sales_id: salesId }
        }).done(function (html) {
            $('#payment_list_table').html(html);
            if (typeof computeSalesProceeds === 'function') {
                computeSalesProceeds();
            }
            changeGrossProfitColor();
        });
    };

    function submitForm(action, modalId, successIcon, successTitle, successText) {
        $('#salesForm').attr('action', action);
        $('#loadingOverlay').show();

        $.ajax({
            type: 'POST',
            url: action,
            data: $('#salesForm').serialize(),
            success: function (response) {
                $('#loadingOverlay').hide();
                if (String(response).trim() === 'success') {
                    Swal.fire({ icon: successIcon, title: successTitle, text: successText });
                    lockForm();
                    if (modalId) hideModal(modalId);
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: response });
                }
            },
            error: function () {
                $('#loadingOverlay').hide();
                Swal.fire({ icon: 'error', title: 'Error', text: 'Form submission failed!' });
            }
        });
    }

    $(function () {
        applyFormData(cfg.formData);
        if (cfg.isLocked) {
            lockForm();
        }

        $('#loadingOverlay').hide();

        fetch_bale_container();
        fetch_bale_payment();

        $('#sale_currency').on('change', function () {
            setCurrencyLabels($(this).val());
        });

        $(document).on('keyup change', '#contract_price, #total_bale_weight', function () {
            if (typeof computeGrossSales === 'function') computeGrossSales();
        });

        $(document).on('keyup change', '#tax_rate', function () {
            if (typeof computeGrossProfit === 'function') computeGrossProfit();
        });

        $('.btnContainer').on('click', function () {
            $.ajax({
                url: 'table/bales_sales_container_selection.php',
                method: 'POST',
                data: { sales_id: salesId },
                success: function (data) {
                    $('#container_selection_modal').html(data);
                    showModal('#containerListModal');
                },
                error: function () {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to load container list.' });
                }
            });
        });

        $('.confirmSales').on('click', function () {
            if ($('#sale_buyer').prop('readonly')) {
                Swal.fire({ icon: 'warning', title: 'Form Completed', text: 'This sale is already completed.' });
                return;
            }
            showModal('#confirmModal');
        });

        $('.btnDraft').on('click', function () {
            if ($('#sale_buyer').prop('readonly')) {
                Swal.fire({ icon: 'warning', title: 'Form Completed', text: 'This sale is already completed.' });
                return;
            }
            showModal('#draftModal');
        });

        $('.btnVoid').on('click', function () {
            if ($('#sale_buyer').prop('readonly')) {
                Swal.fire({ icon: 'warning', title: 'Not Allowed', text: 'Completed sales cannot be voided.' });
                return;
            }
            Swal.fire({
                icon: 'warning',
                title: 'Void this sale?',
                text: 'This will delete the sale record and release linked containers.',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Yes, void it'
            }).then(function (result) {
                if (!result.isConfirmed) return;
                $('#loadingOverlay').show();
                $.post('function/sales/sales.void.php', { sales_id: salesId }, function (response) {
                    $('#loadingOverlay').hide();
                    if (String(response).trim() === 'success') {
                        Swal.fire({ icon: 'success', title: 'Voided', text: 'Sale record removed.' })
                            .then(function () { window.location.href = 'bale_sale_record.php'; });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response });
                    }
                }).fail(function () {
                    $('#loadingOverlay').hide();
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Could not void sale.' });
                });
            });
        });

        $('#confirmButton').on('click', function (e) {
            e.preventDefault();
            submitForm('function/sales/sales.confirm.php', '#confirmModal', 'success', 'Success', 'Sale transaction completed!');
        });

        $('#saveDraftBtn').on('click', function (e) {
            e.preventDefault();
            submitForm('function/sales/sales.draft.php', '#draftModal', 'info', 'Saved', 'Sale transaction saved as draft!');
        });

        $('.btnPrint').on('click', function () {
            if (!$('#sale_buyer').prop('readonly')) {
                Swal.fire({ icon: 'warning', title: 'Incomplete', text: 'Please confirm the sale before printing.' });
                return;
            }
            $('#print_content button').hide();
            html2canvas(document.querySelector('#print_content')).then(function (canvas) {
                var img = canvas.toDataURL('image/png');
                var w = window.open('');
                $(w.document.body).html("<img src='" + img + "' style='width:100%;'>").ready(function () {
                    w.focus();
                    w.print();
                });
                $('#print_content button').show();
            });
        });

        if (typeof computeGrossSales === 'function') computeGrossSales();
        if (typeof computeSalesProceeds === 'function') computeSalesProceeds();
        changeGrossProfitColor();
    });
}(window, jQuery));
