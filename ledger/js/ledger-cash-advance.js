(function ($) {
    'use strict';

    function ledgerNum(v) {
        return String(v ?? '').replace(/[^0-9.]/g, '');
    }

    function submitCashAdvanceForm(form, action) {
        var submitBtn = form.querySelector('button[type="submit"]');
        var originalText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';

        var formData = new FormData(form);
        formData.append(action, action);

        $.ajax({
            url: 'function/ledger/addCashAdvance.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (response) {
                if (response.success) {
                    LedgerModal.hideClosest(form);
                    form.reset();

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    setTimeout(function () {
                        if (window.caTable) {
                            window.caTable.ajax.reload(null, false);
                        }
                    }, 400);
                } else {
                    Swal.fire({ icon: 'error', title: 'Error!', text: response.message });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Network Error!',
                    text: 'Please check your connection and try again.'
                });
            },
            complete: function () {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }

    $(function () {
        if (!$('#ca_table').length || !$.fn.DataTable) {
            return;
        }

        window.caTable = $('#ca_table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                'copy',
                { extend: 'excelHtml5', exportOptions: { columns: ':not(:last-child)' } },
                { extend: 'pdfHtml5', exportOptions: { columns: ':not(:last-child)' } }
            ],
            ajax: {
                url: 'ledgerTab/server_fetch/cash_advance.php',
                type: 'POST',
                data: function (data) {
                    data.categoryFilter = $('#filterCategory').val();
                    data.monthFilter = $('#filterMonth').val();
                    data.startDate = $('#startDate').val();
                    data.endDate = $('#endDate').val();
                }
            },
            columns: [
                { data: 'voucher' },
                { data: 'date' },
                { data: 'customer' },
                { data: 'buying_station' },
                { data: 'category' },
                { data: 'amount', className: 'text-end' },
                { data: 'action', orderable: false, className: 'text-center' }
            ],
            order: [[1, 'desc']],
            pageLength: 25,
            searchDelay: 500,
            language: {
                processing: '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
                emptyTable: 'No cash advance records available'
            }
        });

        $('#filterCategory, #filterMonth, #startDate, #endDate').on('change', function () {
            window.caTable.ajax.reload();
        });

        $(document).on('submit', '#cashadvance-form', function (e) {
            e.preventDefault();
            submitCashAdvanceForm(this, 'add');
        });

        $(document).on('submit', '#updateCashAdvanceForm', function (e) {
            e.preventDefault();
            submitCashAdvanceForm(this, 'update');
        });

        $(document).on('submit', '#deleteCashAdvanceForm', function (e) {
            e.preventDefault();
            submitCashAdvanceForm(this, 'delete');
        });

        $(document).on('click', '#ca_table .btnUpdate', function () {
            var cashadvance = $(this).data('cashadvance');
            $('#update_ca_id').val(cashadvance.id);
            $('#u_ca_date').val(cashadvance.date);
            $('#u_ca_voucher').val(cashadvance.voucher);
            $('#u_ca_particular').val(cashadvance.customer);
            $('#u_ca_station').val(cashadvance.buying_station || '');
            $('#u_ca_category').val(cashadvance.category);
            $('#u_ca_amount').val(ledgerNum(cashadvance.amount));
            LedgerModal.show('#updateCashAdvance');
        });

        $(document).on('click', '#ca_table .btnDelete', function () {
            var cashadvance = $(this).data('cashadvance');
            $('#delete_ca_id').val(cashadvance.id);
            $('#delete_ca_customer_name').text(cashadvance.customer);
            LedgerModal.show('#removeCashAdvance');
        });
    });
})(jQuery);
