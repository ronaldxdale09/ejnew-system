<script>
(function () {
    function copraNum(val) {
        return parseFloat(String(val || '').replace(/,/g, '')) || 0;
    }

    function copraSellerName() {
        var $name = $('#name');
        var val = $name.val();
        if (val) {
            return val;
        }
        var chosen = $name.find('option:selected').val();
        return chosen || '';
    }

    function copraAddressValue() {
        var $address = $('#address');
        var val = $address.val();
        if (val) {
            return val;
        }
        return $address.find('option:selected').text() || '';
    }

    function copraTransactionStatus(callback) {
        $.ajax({
            url: 'modal/fetch/fetch_status.php',
            type: 'POST',
            cache: false,
            success: function (state) {
                callback(String(state || '').trim());
            },
            error: function () {
                callback('ONGOING');
            }
        });
    }

    function copraValidateTransactionForm() {
        if (!copraNum($('#total-amount').val())) {
            return 'Enter weight and pricing details to compute the total amount.';
        }
        if (!$('#date').val()) {
            return 'Date is required.';
        }
        if (!copraSellerName()) {
            return 'Select a seller.';
        }
        return '';
    }

    function copraPopulateConfirmFields() {
        $('#m_invoice').val($('#invoice').val());
        $('#m_name').val(copraSellerName());
        $('#m_date').val($('#date').val());
        $('#m_address').val(copraAddressValue());
        $('#m_contract').val($('#contract').val());
        $('#m_tax-amount').val($('#tax-amount').val());
        $('#m_quantity').val($('#quantity').val());
        $('#m_balance').val($('#balance').val());

        $('#m_noSack').val($('#noSack').val());
        $('#m_gross').val($('#gross').val());
        $('#m_tare').val($('#tare').val());
        $('#m_net').val($('#net').val());
        $('#m_dust').val($('#dust').val());
        $('#m_new-dust').val($('#new').val());
        $('#m_moisture').val($('#moisture').val());
        $('#m_discount').val($('#discount_reading').val());
        $('#m_total-dust').val($('#total-dust').val());
        $('#m_total-moisture').val($('#total-moisture').val());
        $('#m_net-resecada').val($('#total-res').val());
        $('#m_1resecada').val($('#first-res').val());
        $('#m_2resecada').val($('#second-res').val());
        $('#m_3resecada').val('');

        $('#m_1rese-weight').val($('#1rese-weight').val());
        $('#m_2rese-weight').val($('#2rese-weight').val());
        $('#m_total_1res').val($('#total-1res').val());
        $('#m_total_2res').val($('#total-2res').val());
        $('#m_total_3res').val('');

        $('#m_total-amount').val($('#total-amount').val());
        $('#m_less').val($('#cash_advance').val());
        $('#m_total-paid').val($('#amount-paid').val());
        $('#m_tax').val($('#tax').val());
        $('#m_total-words').val($('#amount-paid-words').val());
    }

    function copraPopulateVoucherFields() {
        $('#v_invoice').val($('#invoice').val());
        $('#v_name').val(copraSellerName());
        $('#v_date').val($('#date').val());
        $('#v_contract').val($('#contract').val());
        $('#v_address').val(copraAddressValue());
        $('#v_noSack').val($('#noSack').val());
        $('#v_gross').val($('#gross').val());
        $('#v_tare').val($('#tare').val());
        $('#v_net').val($('#net').val());
        $('#v_dust').val($('#dust').val());
        $('#v_new-dust').val($('#new').val());
        $('#v_moisture').val($('#moisture').val());
        $('#v_discount').val($('#discount_reading').val());
        $('#v_total-dust').val($('#total-dust').val());
        $('#v_total-moisture').val($('#total-moisture').val());
        $('#v_net-resecada').val($('#total-res').val());
        $('#v_1resecada').val($('#first-res').val());
        $('#v_2resecada').val($('#second-res').val());
        $('#v_3resecada').val('');
        $('#v_total_1res').val($('#total-1res').val());
        $('#v_total_2res').val($('#total-2res').val());
        $('#v_total_3res').val('');
        $('#v_total-amount').val($('#total-amount').val());
        $('#v_less').val($('#cash_advance').val());
        $('#v_total-paid').val($('#amount-paid').val());
        $('#v_total-words').val($('#amount-paid-words').val());
    }

    $('#confirm').on('click', function () {
        var validationError = copraValidateTransactionForm();
        if (validationError) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: validationError
            });
            return;
        }

        var ca = copraNum($('#cash_advance').val());
        var availableCa = copraNum($('#total_ca').val());

        copraTransactionStatus(function (status) {
            if (status === 'COMPLETED') {
                Swal.fire({
                    icon: 'info',
                    title: 'PLEASE CREATE NEW TRANSACTION',
                    text: 'This transaction is already completed.'
                });
                return;
            }

            if (ca > 0 && ca > availableCa) {
                Swal.fire({
                    icon: 'info',
                    title: 'Oops...',
                    text: 'Less is greater than your total cash advance.'
                });
                return;
            }

            copraPopulateConfirmFields();
            CopraModal.show('#confirmModal');
        });
    });

    $('#vouchBtn').on('click', function () {
        var validationError = copraValidateTransactionForm();
        if (validationError) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: validationError
            });
            return;
        }

        copraPopulateVoucherFields();
        CopraModal.show('#print_vouch');
    });

    $('#receiptBtn').on('click', function () {
        var validationError = copraValidateTransactionForm();
        if (validationError) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: validationError
            });
            return;
        }

        CopraModal.show('#modal_receipt');
    });
})();
</script>
