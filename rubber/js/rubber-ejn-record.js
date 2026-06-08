(function ($) {
    'use strict';

    var base = window.RUBBER_BASE || '';

    $(function () {
        RubberDt.initServerTable('#inventory-table', {
            url: base + 'fetch/fetchEjnRubberRecord.php',
            tableOptions: {
                columns: [
                    { data: 'status' },
                    { data: 'ejn_id', className: 'text-center' },
                    { data: 'date' },
                    { data: 'supplier' },
                    { data: 'location' },
                    { data: 'total_buying_weight', className: 'number-cell' },
                    { data: 'total_purchase_cost', className: 'number-cell' },
                    { data: 'average_cost', className: 'number-cell' },
                    { data: 'remarks' },
                    { data: 'recorded_by' },
                    { data: 'action', orderable: false, searchable: false }
                ],
                order: [[1, 'desc']],
                columnDefs: [{ orderable: false, targets: -1 }]
            }
        });

        $(document).on('click', '.updateBtn', function () {
            var $btn = $(this);
            $('#u_id').val($btn.data('id'));
            $('#u_date').val($btn.data('date'));
            $('#u_supplier').val($btn.data('supplier'));
            $('#u_loc').val($btn.data('location'));
            $('#u_weight').val($btn.data('weight'));
            $('#u_cost').val($btn.data('cost'));
            $('#u_aveCost').val($btn.data('aveCost'));
            $('#u_remarks').val($btn.data('remarks'));
            $('#u_recorded').val($btn.data('recorded'));
            $('#updateModal').modal('show');
        });

        $(document).on('click', '.deleteBtn', function () {
            $('#d_id').val($(this).data('id'));
            $('#deleteModal').modal('show');
        });
    });
}(jQuery));
