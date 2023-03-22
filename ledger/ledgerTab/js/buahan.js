// for date

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


// for date filter


$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#p_min'), {
        format: 'YYYY-MM-DD'
    });
    maxDate = new DateTime($('#p_max'), {
        format: 'YYYY-MM-DD'
    });

    // DataTables initialisation
    var table = $('#maloong_toppers').DataTable({
        dom: 'Bfrtip',
        order: [
            [0, 'desc']
        ],
        buttons: [{
                extend: 'excelHtml5',footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'pdfHtml5',footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'print',footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },



        ],
        orderCellsTop: true,




    });

    // Refilter the table
    $('#p_min, #p_max').on('change', function() {
        purchase_table.draw();
    });
});





$(function() {
    $("#net_kilos").keyup(function() {


        net_kilos = $("#net_kilos").val().replace(/,/g, '');
        price = $("#price").val().replace(/,/g, '');
        price = $("#price").val().replace(/,/g, '');
        ejn_percent = $("#ejn_percent").val().replace(/,/g, '');
        topper_percent = $("#topper_percent").val().replace(/,/g, '');
        less = $("#less").val().replace(/,/g, '');

        buahanTopper(net_kilos, price, ejn_percent, topper_percent, less);


    });
});

$(function() {
    $("#price").keyup(function() {

        net_kilos = $("#net_kilos").val().replace(/,/g, '');
        price = $("#price").val().replace(/,/g, '');
        ejn_percent = $("#ejn_percent").val().replace(/,/g, '');
        topper_percent = $("#topper_percent").val().replace(/,/g, '');
        less = $("#less").val().replace(/,/g, '');

        buahanTopper(net_kilos, price, ejn_percent, topper_percent, less);



    });
});
$(function() {
    $("#ejn_percent").keyup(function() {




        net_kilos = $("#net_kilos").val().replace(/,/g, '');
        price = $("#price").val().replace(/,/g, '');
        ejn_percent = $("#ejn_percent").val().replace(/,/g, '');
        topper_percent = $("#topper_percent").val().replace(/,/g, '');
        less = $("#less").val().replace(/,/g, '');

        buahanTopper(net_kilos, price, ejn_percent, topper_percent, less);



    });
});

$(function() {
    $("#topper_percent").keyup(function() {




        net_kilos = $("#net_kilos").val().replace(/,/g, '');
        price = $("#price").val().replace(/,/g, '');
        ejn_percent = $("#ejn_percent").val().replace(/,/g, '');
        topper_percent = $("#topper_percent").val().replace(/,/g, '');
        less = $("#less").val().replace(/,/g, '');

        buahanTopper(net_kilos, price, ejn_percent, topper_percent, less);


    });
});

$(function() {
    $("#less").keyup(function() {

        net_kilos = $("#net_kilos").val().replace(/,/g, '');
        price = $("#price").val().replace(/,/g, '');
        ejn_percent = $("#ejn_percent").val().replace(/,/g, '');
        topper_percent = $("#topper_percent").val().replace(/,/g, '');
        less = $("#less").val().replace(/,/g, '');

        buahanTopper(net_kilos, price, ejn_percent, topper_percent, less);


    });
});

function buahanTopper(net_kilos, price, ejn_percent, topper_percent, less) {

    let nf = new Intl.NumberFormat('en-US');

    total = net_kilos * price;

    $("#total").val(nf.format(total));

    ejn_total = total * (ejn_percent / 100);
    $("#ejn_total").val(nf.format(ejn_total));


    topper_gross = total * (topper_percent / 100);
    $("#topper_gross").val(nf.format(topper_gross));


    topper_total = topper_gross - less;
    $("#topper_total").val(nf.format(topper_total));



}