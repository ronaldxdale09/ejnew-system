(function ($) {
    'use strict';

    function peso(v) {
        return '₱' + Number(v || 0).toLocaleString('en-PH', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
    }

    function refreshKpis() {
        $.getJSON('function/ledger/expense_kpis.php', function (res) {
            if (!res.success || !res.kpis) return;
            var k = res.kpis;
            $('#ledgerKpiToday').text(peso(k.today));
            $('#ledgerKpiMonth').text(peso(k.month));
            $('#ledgerKpiYear').text(peso(k.year));
            $('#ledgerKpiTodaySub').text(k.count_today + ' record' + (k.count_today === 1 ? '' : 's') + ' today');
        });
    }

    function computeTotal(amountSel, lessSel, totalSel) {
        var amount = parseFloat(String($(amountSel).val()).replace(/,/g, '')) || 0;
        var less = parseFloat(String($(lessSel).val()).replace(/,/g, '')) || 0;
        var total = Math.max(0, amount - less);
        $(totalSel).val(total.toFixed(2));
        if (typeof FormatCurrency === 'function' && totalSel) {
            FormatCurrency(document.querySelector(totalSel));
        }
    }

    function submitExpenseForm(form, action) {
        var $form = $(form);
        var submitBtn = form.querySelector('button[type="submit"]');
        var originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';

        var formData = new FormData(form);
        formData.append(action, action);

        $.ajax({
            url: 'function/ledger/expense_function.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    if (window.expenseTable) {
                        window.expenseTable.ajax.reload(null, false);
                    }
                    LedgerModal.hideClosest(form);
                    form.reset();
                    refreshKpis();
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                }
            },
            error: function () {
                Swal.fire({ icon: 'error', title: 'Network Error', text: 'Please try again.' });
            },
            complete: function () {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }

    $(function () {
        if (!$.fn.DataTable) {
            console.error('DataTables not loaded');
            return;
        }

        if ($.fn.DataTable.isDataTable('#expenses_table')) {
            $('#expenses_table').DataTable().destroy();
        }

        try {
        window.expenseTable = $('#expenses_table').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: ['copy', 'pdf', {
                text: 'Export Excel',
                action: function (e, dt) {
                    window.open('ledgerTab/server_fetch/export_to_excel.php?' + $.param(dt.ajax.params()));
                }
            }],
            ajax: {
                url: 'ledgerTab/server_fetch/expense.php',
                type: 'POST',
                data: function (data) {
                    data.minDate = $('#fromDate').val();
                    data.maxDate = $('#toDate').val();
                    data.typeFilter = $('#typeFilter').val();
                    data.categoryFilter = $('#categoryFilter').val();
                    data.selectedMonth = $('#monthFilter').val();
                    data.selectedYear = $('#yearFilter').val();
                }
            },
            columns: [
                { data: 'date' },
                { data: 'particulars' },
                { data: 'voucher_no' },
                { data: 'type_expense' },
                { data: 'category' },
                { data: 'total_amount' },
                { data: 'action', orderable: false }
            ],
            order: [[0, 'desc']],
            pageLength: 25
        });
        } catch (err) {
            console.error('Expense table init failed:', err);
        }

        $('#fromDate, #toDate').datepicker({ dateFormat: 'yy-mm-dd' });
        $('#fromDate, #toDate, #typeFilter, #categoryFilter, #monthFilter, #yearFilter').on('change', function () {
            if (window.expenseTable) window.expenseTable.ajax.reload();
        });

        $(document).on('click', '.btnPressUpdate', function () {
            var $b = $(this);
            $('#update_id').val($b.data('id'));
            $('#u_date_transaction').val($b.data('date'));
            $('#u_location').val($b.data('location'));
            $('#u_voucher').val($b.data('voucher_no'));
            $('#u_typeExpense').val($b.data('type_expense'));
            $('#u_particular').val($b.data('particulars'));
            $('#u_category').val($b.data('category'));
            $('#u_mode_transaction').val($b.data('mode_transact'));
            $('#u_amount').val($b.data('amount'));
            $('#u_less').val($b.data('less'));
            $('#u_total').val($b.data('total_amount'));
            $('#u_remarks').val($b.data('remarks'));
            LedgerModal.show('#updateExpense');
        });

        $(document).on('click', '.btnExpenseDelete', function () {
            $('#del_id').val($(this).data('id'));
            LedgerModal.show('#removeExpenseModal');
        });

        $(document).on('submit', '#expense_form', function (e) {
            e.preventDefault();
            submitExpenseForm(this, 'add');
        });
        $(document).on('submit', '#update_form', function (e) {
            e.preventDefault();
            submitExpenseForm(this, 'update');
        });
        $(document).on('submit', '#delete_form', function (e) {
            e.preventDefault();
            submitExpenseForm(this, 'delete');
        });

        $('#n_amount, #n_less').on('keyup', function () {
            computeTotal('#n_amount', '#n_less', '#n_total');
        });
        $('#u_amount, #u_less').on('keyup', function () {
            computeTotal('#u_amount', '#u_less', '#u_total');
        });

        $(document).keypress(function (e) {
            if (e.which === 96) {
                var btn = document.querySelector('[data-bs-target="#addExpense"]');
                if (btn) btn.click();
            }
        });

        // Category modals
        $(document).on('click', '.catUpdate', function () {
            var $tr = $(this).closest('tr');
            $('#u_id').val($tr.find('td:first').text().trim());
            $('#u_name').val($tr.find('td:nth-child(2)').text().trim());
            LedgerModal.show('#ModalEdit');
        });

        $(document).on('click', '.btnDelete', function () {
            var $tr = $(this).closest('tr');
            $('#d_id').val($tr.find('td:first').text().trim());
            LedgerModal.show('#catDelete');
        });
    });
})(jQuery);
