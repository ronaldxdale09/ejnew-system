$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });
    var table = $('#ca_table').DataTable({
        dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
        "targets": 'no-sort',
        "pageLength": 30,
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
            },

        ],
        drawCallback: function() {
            var api = this.api();
            var sum = 0;
            var formated = 0;
            //to show first th
            $(api.column(4).footer()).html('Total');


            sum = api.column(5, {
                page: 'current'
            }).data().sum();

            //to format this sum
            formated = parseFloat(sum).toLocaleString(undefined, {
                minimumFractionDigits: 2
            });
            $(api.column(5).footer()).html(formated);


        },
        lengthChange: true,
        orderCellsTop: true,
    });


    // Filter by Payee
    $('#filterCategory').on('change', function() {
        table.column(4).search(this.value).draw(); // Assuming Payee is the 5th column
    });

    $('#filterMonth').on('change', function() {
        var month = parseInt(this.value, 10);
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var dateIssued = new Date(data[1]); // Assuming Date Issued is the 3rd column
                return isNaN(month) || month === dateIssued.getMonth() + 1;
            }
        );
        table.draw();
        $.fn.dataTable.ext.search.pop(); // Clear this specific filter
    });

    // Filter by Date Range
    $('#startDate, #endDate').on('change', function() {
        var startDate = $('#startDate').val() ? new Date($('#startDate').val()) : null;
        var endDate = $('#endDate').val() ? new Date($('#endDate').val()) : null;

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var dateIssued = new Date(data[1]); // Assuming Date Issued is the 3rd column
                if (startDate && dateIssued < startDate) {
                    return false;
                }
                if (endDate && dateIssued > endDate) {
                    return false;
                }
                return true;
            }
        );
        table.draw();
        $.fn.dataTable.ext.search.pop(); // Clear this specific filter
    });


});