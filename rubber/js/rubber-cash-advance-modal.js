(function ($) {
    'use strict';

    function caBase() {
        return window.RUBBER_BASE || '';
    }

    function bindAjaxCashAdvanceForm(selector) {
        $(selector).on('submit', function (e) {
            if (!window.RUBBER_CA_AJAX) {
                return;
            }

            e.preventDefault();

            var $form = $(this);
            var $btn = $form.find('[type="submit"][name="submit"]').prop('disabled', true);
            var payload = $form.serializeArray();

            payload.push({ name: 'ajax', value: '1' });
            payload.push({ name: 'submit', value: '1' });

            $.ajax({
                url: caBase() + 'function/newCA.php',
                type: 'POST',
                data: $.param(payload),
                dataType: 'json',
                timeout: 30000
            }).done(function (res) {
                if (!res || !res.success) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cash Advance Failed',
                        text: (res && res.message) ? res.message : 'Could not save cash advance.'
                    });
                    return;
                }

                var modalEl = $form.closest('.modal')[0];
                if (modalEl) {
                    if (window.bootstrap && bootstrap.Modal) {
                        var instance = bootstrap.Modal.getInstance(modalEl);
                        if (instance) {
                            instance.hide();
                        }
                    } else {
                        $(modalEl).modal('hide');
                    }
                }

                $form.find('#ca_amount, input[name="ca_amount"]').val('');

                Swal.fire({
                    icon: 'success',
                    title: 'Cash Advance Added',
                    text: 'Available balance was updated.',
                    timer: 1600,
                    showConfirmButton: false
                });

                if (typeof window.rubberRefreshPurchaseCashAdvance === 'function') {
                    window.rubberRefreshPurchaseCashAdvance(res.seller, res);
                }
            }).fail(function (xhr) {
                var message = 'Could not reach the server. Please try again.';

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                } else if (xhr.responseText) {
                    try {
                        var parsed = JSON.parse(xhr.responseText);
                        if (parsed.message) {
                            message = parsed.message;
                        }
                    } catch (ignore) {
                        if (xhr.responseText.indexOf('ERROR:') === 0) {
                            message = xhr.responseText.replace(/^ERROR:\s*/, '');
                        }
                    }
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Cash Advance Failed',
                    text: message
                });
            }).always(function () {
                $btn.prop('disabled', false);
            });
        });
    }

    $(function () {
        bindAjaxCashAdvanceForm('#copraCashAdvance form');
        bindAjaxCashAdvanceForm('#copraCashAdvance1 form');
    });
}(jQuery));
