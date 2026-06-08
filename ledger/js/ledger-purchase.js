(function ($) {
    'use strict';

    function formatToLocaleString(value) {
        return parseFloat(value).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function submitPurchaseForm(form, action) {
        var submitBtn = form.querySelector('button[type="submit"]');
        var originalText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';

        var formData = new FormData(form);
        formData.append(action, action);

        $.ajax({
            url: 'function/ledger/addPurchase.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
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
                        if (window.purchaseTable) {
                            window.purchaseTable.ajax.reload();
                        }
                    }, 500);
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
        if (!$('#purchase_table').length || !$.fn.DataTable) {
            return;
        }

        $('#min, #max').datepicker({ dateFormat: 'yy-mm-dd' });

        $(document).on('click', '.btnUpdate', function () {
            var purchase = $(this).data('purchase');
            $('#p_id').val(purchase.id);
            $('#u_date').val(purchase.date);
            $('#u_voucher').val(purchase.voucher);
            $('#u_category').val(purchase.category);
            $('#name').val(purchase.customer_name);
            $('#u_description').val(purchase.others_desc);
            $('#u_net_kilo').val(formatToLocaleString(purchase.net_kilos));
            $('#u_price').val(formatToLocaleString(purchase.price));
            $('#u_cash_advance').val(formatToLocaleString(purchase.cash_advance));
            $('#u_tax').val(formatToLocaleString(purchase.tax_amount));
            $('#u_others').val(formatToLocaleString(purchase.others));
            $('#u_net_total_amount').val(formatToLocaleString(purchase.net_total_amount));
            $('#u_total_amount').val(formatToLocaleString(purchase.total_amount));
            LedgerModal.show('#updatePurchase');
        });

        $(document).on('click', '.btnDelete', function () {
            var purchase = $(this).data('purchase');
            $('#my_id').val(purchase.id);
            LedgerModal.show('#removePurchase');
        });

        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            if (settings.nTable.id !== 'purchase_table') {
                return true;
            }

            var minVal = $('#min').val();
            var maxVal = $('#max').val();
            var min = minVal ? new Date(minVal) : null;
            var max = maxVal ? new Date(maxVal) : null;

            if (max) {
                max.setHours(23, 59, 59, 999);
            }
            if (min) {
                min.setHours(0, 0, 0, 0);
            }

            var startDate = new Date(data[0]);
            if (min == null && max == null) return true;
            if (min == null && startDate <= max) return true;
            if (max == null && startDate >= min) return true;
            if (startDate <= max && startDate >= min) return true;
            return false;
        });

        window.purchaseTable = $('#purchase_table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'pdf',
                {
                    text: 'Export to Excel',
                    action: function (e, dt) {
                        window.open('ledgerTab/server_fetch/export_to_excel.php?' + $.param(dt.ajax.params()));
                    }
                }
            ],
            ajax: {
                url: 'ledgerTab/server_fetch/purchase.php',
                type: 'POST',
                data: function (data) {
                    data.minDate = $('#min').val();
                    data.maxDate = $('#max').val();
                    data.categoryFilter = $('#category_filter').val();
                }
            },
            columns: [
                { data: 'date' },
                { data: 'voucher' },
                { data: 'category' },
                { data: 'customer_name' },
                { data: 'price' },
                { data: 'net_kilos' },
                { data: 'net_total_amount' },
                { data: 'action', orderable: false }
            ],
            order: [[0, 'desc']],
            pageLength: 25,
            searchDelay: 500,
            language: {
                processing: '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
                emptyTable: 'No purchase records available'
            }
        });

        $(document).on('submit', '#purchase-form', function (e) {
            e.preventDefault();
            submitPurchaseForm(this, 'add');
        });
        $(document).on('submit', '#updatePurchaseForm', function (e) {
            e.preventDefault();
            submitPurchaseForm(this, 'update');
        });
        $(document).on('submit', '#deletePurchaseForm', function (e) {
            e.preventDefault();
            submitPurchaseForm(this, 'delete');
        });

        $('#min, #max, #category_filter').on('change', function () {
            window.purchaseTable.ajax.reload();
        });

        $('#today').on('click', function () {
            var today = new Date().toISOString().split('T')[0];
            $('#min, #max').val(today);
            window.purchaseTable.ajax.reload();
        });

        $('#this-week').on('click', function () {
            var today = new Date();
            var firstDayOfWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - today.getDay());
            var offset = today.getTimezoneOffset() * 60000;
            $('#min').val(new Date(firstDayOfWeek.getTime() - offset).toISOString().split('T')[0]);
            $('#max').val(new Date(today.getTime() - offset).toISOString().split('T')[0]);
            window.purchaseTable.ajax.reload();
        });

        $('#this-month').on('click', function () {
            var today = new Date();
            var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            var offset = today.getTimezoneOffset() * 60000;
            $('#min').val(new Date(firstDayOfMonth.getTime() - offset).toISOString().split('T')[0]);
            $('#max').val(new Date(today.getTime() - offset).toISOString().split('T')[0]);
            window.purchaseTable.ajax.reload();
        });
    });
})(jQuery);
