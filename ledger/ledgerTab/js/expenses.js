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
            (min === null && date < max) ||
            (min < date && max === null) ||
            (min < date && date < max)
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
        paging: false,
        "pageLength": 50,

        order: [
            [0, 'desc']
        ],
        buttons: [{
                extend: 'excelHtml5',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdfHtml5',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'print',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ],
        drawCallback: function() {
            var api = this.api();
            var sum = 0;
            var formated = 0;
            //to show first th
            $(api.column(3).footer()).html('Total');


            sum = api.column(4, {
                page: 'current'
            }).data().sum();

            //to format this sum
            formated = parseFloat(sum).toLocaleString(undefined, {
                minimumFractionDigits: 2
            });
            $(api.column(4).footer()).html(formated);


        },





    });
    $('#min, #max').on('change', function() {
        table.draw();
    });

    $('#category_filter').on('change', function() {
        var tosearch = this.value;
        table.search(tosearch).draw();
    });




});