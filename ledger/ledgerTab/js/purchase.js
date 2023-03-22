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
    var table = $('#purchase_table').DataTable({
        dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
        "targets": 'no-sort',
        "pageLength": 30,
        "bSort": false,
        order: [
            [0, 'desc']
        ],
        buttons: [{
                extend: 'excelHtml5',footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdfHtml5',footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'print',footer: true,
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
            $(api.column(5).footer()).html('Total');


            sum = api.column(6, {
                page: 'current'
            }).data().sum();

            //to format this sum
            formated = parseFloat(sum).toLocaleString(undefined, {
                minimumFractionDigits: 2
            });
            $(api.column(6).footer()).html(formated);


        },
        lengthChange: true,
        orderCellsTop: true,



    });
    $('#min, #max').on('change', function() {
        table.draw();
    });



});




$(function() {
    $("#p_price").keyup(function() {

        net_kilo = +$("#p_net-kilos").val().replace(/,/g, '').toLocaleString();
        price = $("#p_price").val().replace(/,/g, '').toLocaleString()
        adjust_price = (+$("#p_adjustprice").val().replace(/,/g, '')).toLocaleString()
        less = $("#p_less").val().replace(/,/g, '').toLocaleString();
        partial = $("#p_partial_payment").val().replace(/,/g, '').toLocaleString();
        total_amount = $("#p_total_amount").val().replace(/,/g, '').toLocaleString();

        computePurchase(net_kilo, price, adjust_price, less, partial, total_amount);

    });
});

$(function() {
    $("#p_adjustprice").keyup(function() {


        net_kilo = +$("#p_net-kilos").val().replace(/,/g, '').toLocaleString();
        price = $("#p_price").val().replace(/,/g, '').toLocaleString()
        adjust_price = (+$("#p_adjustprice").val().replace(/,/g, '')).toLocaleString()
        less = $("#p_less").val().replace(/,/g, '').toLocaleString();
        partial = $("#p_partial_payment").val().replace(/,/g, '').toLocaleString();
        total_amount = $("#p_total_amount").val().replace(/,/g, '').toLocaleString();
        computePurchase(net_kilo, price, adjust_price, less, partial, total_amount);

    });
});


$(function() {
    $("#p_less").keyup(function() {


        net_kilo = +$("#p_net-kilos").val().replace(/,/g, '').toLocaleString();
        price = $("#p_price").val().replace(/,/g, '').toLocaleString()
        adjust_price = (+$("#p_adjustprice").val().replace(/,/g, '')).toLocaleString()
        less = $("#p_less").val().replace(/,/g, '').toLocaleString();
        partial = $("#p_partial_payment").val().replace(/,/g, '').toLocaleString();
        total_amount = $("#p_total_amount").val().replace(/,/g, '').toLocaleString();
        computePurchase(net_kilo, price, adjust_price, less, partial, total_amount);

    });
});

$(function() {
    $("#p_partial_payment").keyup(function() {

        net_kilo = +$("#p_net-kilos").val().replace(/,/g, '').toLocaleString();
        price = $("#p_price").val().replace(/,/g, '').toLocaleString()
        adjust_price = (+$("#p_adjustprice").val().replace(/,/g, '')).toLocaleString()
        less = $("#p_less").val().replace(/,/g, '').toLocaleString();
        partial = $("#p_partial_payment").val().replace(/,/g, '').toLocaleString();
        total_amount = $("#p_total_amount").val().replace(/,/g, '').toLocaleString();
        computePurchase(net_kilo, price, adjust_price, less, partial, total_amount);


    });
});

function computePurchase(net_kilo, price, adjust_price, less, partial, total_amount) {
    // compute total amount
    // $("#p_total_amount").val(net_kilo * price);
    $("#p_net_total").val(net_kilo * adjust_price);
    // $("#p_total_amount").val(((+$("#p_total_amount").val().replace(/,/g, '') - (+$("#p_less").val().replace(/,/g, ''))).toLocaleString()));
    $("#p_total_amount").val(((net_kilo * price) - partial) - less);


}