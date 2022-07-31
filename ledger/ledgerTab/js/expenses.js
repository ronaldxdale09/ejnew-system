$('#addExpense').on('shown.bs.modal', function() {
    $('.ex_category', this).chosen();
});
var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[0]);

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });
    var table = $('#expenses_table').DataTable({
        dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
        buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },

        ],

        initComplete: function() {
            this.api().columns([1]).every(function() {
                var column = this;
                var select = $('<select class="form-control"><option value="">All</option></select>')
                    .appendTo($('thead tr:eq(1) th:eq(' + this.index() + ')'))
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }



    });
    $('#min, #max').on('change', function() {
        table.draw();
    });





});