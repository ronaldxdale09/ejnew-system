<script>
$('#confirm').click(function() {
    var ca = $("#cash_advance").val().replace(/,/g, '');
    var available_ca = $("#total_ca").val().replace(/,/g, '');
    var status = null;


    ////////////// FETCH TRANSACTION STATUS
    function callback(response) {
        status = response;

    }
    $.ajax({
        'async': false,
        url: "modal/fetch/fetch_status.php",
        type: "POST",
        data: {
            ca: ca
        },
        cache: false,
        success: function(state) {
            console.log(state);
            callback(state)

        }
    });
    ////////////////////////////////////////

    if (!document.getElementById('total_amount').value ||
        !document.getElementById('date').value ||   !document.getElementById('price_1').value ||
        !$("#name").val()
    ) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Fill all the necessary fields ',
        });

    } else if (status == 'COMPLETED') {
        Swal.fire({
            icon: 'info',
            title: 'PLEASE CREATE NEW TRANSACTION',
            text: 'This transaction is already completed',
        });
    } else {
        $('#confirmModal').modal('show');

        $('#m_invoice').val($("#invoice").val());
        $('#m_name').val($("#name").val());
        $('#received_by').val($("#name").val());
        $('#m_date').val($("#date").val());
        $('#m_address').val($("#address").val());
        $('#m_contract').val($("#contract").val());

        $('#m_quantity').val($("#quantity").val());
        $('#m_balance').val($("#balance").val());

        // purchase info

        $('#m_entry').val($("#entry").val());


        $('#m_total_net_weight').val($("#total_net_weight").val());
        $('#m_drc').val($("#drc").val());
        $('#m_excess').val($("#excess").val());

        $('#m_price_1').val($("#price_1").val());
        $('#m_price_2').val($("#price_2").val());
        $('#m_bales_count').val($("#bales_count").val());

        $('#m_lot_number').val($("#lot_code").val());
        $('#m_prod_id').val($("#prod_id").val());

        $('#m_first_total').val($("#first_total").val());
        $('#m_second_total').val($("#second_total").val());

        // 
        $('#m_total_amount').val($("#total_amount").val());
        $('#m_less').val($("#cash_advance").val());
        $('#m_total-paid').val($("#amount_paid").val());
        $('#m_total-words').val($("#amount-paid-words").val());


        console.log("m_invoice: " + $('#recording_id').val());
        console.log("m_name: " + $('#m_name').val());
        console.log("received_by: " + $('#received_by').val());
        console.log("m_date: " + $('#m_date').val());
        console.log("m_address: " + $('#m_address').val());
        console.log("m_contract: " + $('#m_contract').val());

        console.log("m_quantity: " + $('#m_quantity').val());
        console.log("m_balance: " + $('#m_balance').val());

        // purchase info
   console.log("m_bales_count: " + $('#m_bales_count').val());

        console.log("m_entry: " + $('#m_entry').val());

        console.log("m_total_net_weight: " + $('#m_total_net_weight').val());
        console.log("m_drc: " + $('#m_drc').val());

        console.log("m_price_1: " + $('#m_price_1').val());
        console.log("m_price_2: " + $('#m_price_2').val());

        console.log("m_first_total: " + $('#m_first_total').val());
        console.log("m_second_total: " + $('#m_second_total').val());

        // 
        console.log("m_total_amount: " + $('#m_total_amount').val());
        console.log("m_less: " + $('#m_less').val());
        console.log("m_total-paid: " + $('#m_total-paid').val());
        console.log("m_total-words: " + $('#m_total-words').val());



    }
});


$(function() {
    $("#delivery_date,#lot_number").keyup(function() {


        var delivery_date = $("#delivery_date").val();
        var lot_number = $("#lot_code").val();

        $("#m_delivery_date").val(delivery_date);
        $("#m_lot_number").val(lot_number);

    });
});
</script>

<!-- end -->

<script>
// validation

$('#vouchBtn').click(function() {

    if (!document.getElementById('tota_amount').value ||
        !document.getElementById('date').value ||
        !$("#name").val()
    ) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Fill all the necessary fields ',
        })

    } else {
        $('#print_vouch').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#v_invoice').val($("#invoice").val());
        $('#v_name').val($("#name").val());
        $('#v_date').val($("#date").val());
        $('#v_address').val($("#address").val());
        $('#v_contract').val($("#contract").val());

        $('#v_quantity').val($("#quantity").val());
        $('#v_balance').val($("#balance").val());

        // purchase info

        $('#v_gross').val($("#gross").val());
        $('#v_tare').val($("#tare").val());
        $('#v_net').val($("#net").val());


        $('#v_1price').val($("#price").val());
        $('#v_2price').val($("#sec_price").val());

        // total res

        $('#v_weight_1').val($("#first-weight").val());
        $('#v_weight_2').val($("#second-weight").val());

        $('#v_total_first').val($("#first_total").val());
        $('#v_total_sec').val($("#sec_total").val());

        // 
        $('#v_tota_amount').val($("#tota_amount").val());
        $('#v_less').val($("#cash_advance").val());
        $('#v_total-paid').val($("#amount_paid").val());
        $('#v_total-words').val($("#amount-paid-words").val());

    }

});
</script>



<script>
// validation

$('#receiptBtn').click(function() {

    if (!document.getElementById('total_amount').value ||
        !document.getElementById('date').value ||
        !$("#name").val()
    ) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Fill all the necessary fields ',
        })

    } else {
        $('#modal_receipt').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#r_invoice').val($("#invoice").val());
        $('#r_name').val($("#name").val());
        $('#r_date').val($("#date").val());
        $('#r_address').val($("#address").val());
        $('#r_contract').val($("#contract").val());

        $('#r_quantity').val($("#quantity").val());
        $('#r_balance').val($("#balance").val());

        // purchase info

        $('#r_entry').val($("#entry").val());
        $('#r_net_weight_1').val($("#net_weight_1").val());
        $('#r_net_weight_2').val($("#net_weight_2").val());


        $('#r_total_net_weight').val($("#total_net_weight").val());

        $('#r_drc').val($("#drc").val());
        $('#r_kilo_bales_1').val($("#kilo_bales_1").val());
        $('#r_kilo_bales_2').val($("#kilo_bales_2").val());


        $('#r_total_bales_1').val($("#total_bales_1").val());
        $('#r_total_bales_2').val($("#total_bales_2").val());


        $('#r_price_1').val($("#price_1").val());
        $('#r_price_2').val($("#price_2").val());


        $('#r_total_first').val($("#first_total").val());

        // 
        $('#r_total_amount').val($("#total_amount").val());
        $('#r_less').val($("#cash_advance").val());
        $('#r_total-paid').val($("#amount_paid").val());
        $('#r_total-words').val($("#amount-paid-words").val());
    }

});
</script>