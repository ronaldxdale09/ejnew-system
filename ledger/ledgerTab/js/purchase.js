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
    var table = $('#purchase_table').DataTable({
        dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
        "targets": 'no-sort',
        "bSort": false,
        order: [
            [0, 'desc']
        ],
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
        lengthChange: true,
        orderCellsTop: true,



    });
    $('#min, #max').on('change', function() {
        table.draw();
    });



});




$(function() {
    $("#p_price").keyup(function() {

        $("#p_total_amount").val(((+$("#p_net-kilos").val().replace(/,/g, '') * +$("#p_price").val().replace(/,/g, ''))).toLocaleString());
    });
});

$(function() {
    $("#p_adjustprice").keyup(function() {

        $("#p_net_total").val(((+$("#p_net-kilos").val().replace(/,/g, '') * +$("#p_adjustprice").val().replace(/,/g, ''))).toLocaleString());
    });
});


$(function() {
    $("#p_less").keyup(function() {

        $("#p_total_amount").val(((+$("#p_total_amount").val().replace(/,/g, '') - (+$("#p_less").val().replace(/,/g, ''))).toLocaleString()));
    });
});

$(function() {
    $("#p_partial_payment").keyup(function() {

        var total_amount = $("#p_total_amount").val().replace(/,/g, '').toLocaleString();
        var partial = $("#p_partial_payment").val().replace(/,/g, '').toLocaleString();

        $("#p_total_amount").val(total_amount - partial);

    });
});