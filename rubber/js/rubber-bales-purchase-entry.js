(function ($) {
    'use strict';

    function base() {
        return window.RUBBER_BASE || '';
    }

    function purchaseId() {
        var raw = $('#invoice').val() || window.BALES_PURCHASE_ID || '';
        return String(raw).replace(/\D/g, '');
    }

    function fieldVal(id) {
        var $el = $('#' + id);
        if (!$el.length) {
            return '';
        }
        return $el.val();
    }

    function copyField(fromId, toId) {
        $('#' + toId).val(fieldVal(fromId));
    }

    function parseNum(val) {
        return parseFloat(String(val || '').replace(/,/g, '')) || 0;
    }

    window.copyBalesField = copyField;

    function populateConfirmModal() {
        var id = purchaseId();
        $('#m_invoice').val(id);
        copyField('name', 'm_name');
        copyField('date', 'm_date');
        copyField('address', 'm_address');
        copyField('contract', 'm_contract');
        copyField('quantity', 'm_quantity');
        copyField('balance', 'm_balance');
        copyField('entry', 'm_entry');
        copyField('total_net_weight', 'm_total_net_weight');
        copyField('drc', 'm_drc');
        copyField('excess', 'm_excess');
        copyField('price_1', 'm_price_1');
        copyField('price_2', 'm_price_2');
        copyField('bales_count', 'm_bales_count');
        copyField('lot_code', 'm_lot_number');
        copyField('prod_id', 'm_prod_id');
        copyField('first_total', 'm_first_total');
        copyField('second_total', 'm_second_total');
        copyField('total_amount', 'm_total_amount');
        copyField('cash_advance', 'm_less');
        copyField('amount_paid', 'm_total-paid');
        copyField('amount-paid-words', 'm_total-words');

        if (!$('#received_by').val()) {
            $('#received_by').val(fieldVal('name'));
        }

        var delivery = fieldVal('m_delivery_date');
        if (delivery) {
            $('#m_delivery_date').val(delivery);
        }
    }

    function collectPurchasePayload() {
        populateConfirmModal();

        var id = purchaseId();
        return {
            m_invoice: id,
            purchase_id: id,
            m_name: fieldVal('name'),
            m_date: fieldVal('date'),
            m_address: fieldVal('address'),
            m_contract: fieldVal('contract') || 'SPOT',
            m_quantity: fieldVal('quantity'),
            m_balance: fieldVal('balance'),
            m_entry: fieldVal('entry'),
            m_total_net_weight: fieldVal('total_net_weight'),
            m_drc: fieldVal('drc'),
            m_excess: fieldVal('excess'),
            m_price_1: fieldVal('price_1'),
            m_price_2: fieldVal('price_2'),
            m_bales_count: fieldVal('bales_count'),
            m_lot_number: fieldVal('lot_code'),
            m_prod_id: fieldVal('prod_id'),
            m_first_total: fieldVal('first_total'),
            m_second_total: fieldVal('second_total'),
            m_total_amount: fieldVal('total_amount'),
            m_less: fieldVal('cash_advance'),
            'm_total-paid': fieldVal('amount_paid'),
            'm_total-words': fieldVal('amount-paid-words'),
            m_delivery_date: fieldVal('m_delivery_date'),
            prepared_by: fieldVal('prepared_by'),
            approved_by: fieldVal('approved_by'),
            received_by: fieldVal('received_by'),
            is_update: window.BALES_IS_EDIT ? '1' : '0'
        };
    }

    $(function () {
        $('#newPurchase').on('submit', function (e) {
            e.preventDefault();
        });

        $('#confirmPurchase').off('click.balesSubmit').on('click.balesSubmit', function () {
            var id = purchaseId();
            if (!id) {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing purchase ID',
                    text: 'Reload this page from Bales Purchase Record and try again.'
                });
                return;
            }

            if (!$('#received_by').val()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing field',
                    text: 'Received By is required.'
                });
                return;
            }

            var $btn = $(this).prop('disabled', true);

            if (typeof window.syncBalesCashAdvanceBeforeSubmit === 'function') {
                window.syncBalesCashAdvanceBeforeSubmit();
            }

            var payload = collectPurchasePayload();

            $.ajax({
                url: base() + 'function/bales_rubber_purchase.php',
                type: 'POST',
                data: payload,
                timeout: 30000
            }).done(function (result) {
                var text = (result || '').toString().trim();
                if (text.indexOf('ERROR:') === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Transaction failed',
                        text: text.replace(/^ERROR:\s*/, '')
                    });
                    return;
                }

                if (window.RubberModal && RubberModal.hide) {
                    RubberModal.hide('#confirmModal');
                } else {
                    $('#confirmModal').modal('hide');
                }

                var wasUpdate = text === 'updated' || window.BALES_IS_EDIT;
                Swal.fire({
                    icon: 'success',
                    title: wasUpdate ? 'Updated' : 'Success',
                    text: wasUpdate ? 'Purchase record was updated successfully.' : 'Transaction was successful!'
                }).then(function () {
                    var span = document.getElementById('trans_status');
                    if (span) {
                        span.classList.remove('bg-danger');
                        span.classList.add('bg-success');
                        span.textContent = 'COMPLETED';
                    }
                    var receiptBtn = document.getElementById('receiptBtn');
                    if (receiptBtn) {
                        receiptBtn.click();
                    }
                });
            }).fail(function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Transaction failed',
                    text: 'Could not reach the server. Please try again.'
                });
            }).always(function () {
                $btn.prop('disabled', false);
            });
        });
    });
}(jQuery));
