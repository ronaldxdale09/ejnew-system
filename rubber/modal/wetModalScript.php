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

    if (!document.getElementById('total-amount').value ||
        !document.getElementById('date').value ||
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
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#m_invoice').val($("#invoice").val());
        $('#m_name').val($("#name").val());
        $('#m_date').val($("#date").val());
        $('#m_address').val($("#address").val());
        $('#m_contract').val($("#contract").val());


        var supplierType = $("#supplier_type").val();
    
        $('#m_supplier_type').val(supplierType);
        $('#m_quantity').val($("#quantity").val());
        $('#m_balance').val($("#balance").val());

        // purchase info

        $('#m_gross').val($("#gross").val());
        $('#m_tare').val($("#tare").val());
        $('#m_net').val($("#net").val());


        $('#m_1price').val($("#first_price").val());
        $('#m_2price').val($("#second_price").val());

        // total res

        $('#m_weight_1').val($("#first-weight").val());
        $('#m_weight_2').val($("#second-weight").val());

        $('#m_total_first').val($("#first_total").val());
        $('#m_total_sec').val($("#second_total").val());

        // 
        $('#m_total-amount').val($("#total-amount").val());
        $('#m_less').val($("#cash_advance").val());
        $('#m_total-paid').val($("#amount-paid").val());
        $('#m_total-words').val($("#amount-paid-words").val());
    }
});
</script>

<!-- end -->

<script>
// validation

$('#vouchBtn').click(function() {

    if (!document.getElementById('total-amount').value ||
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


        $('#v_1price').val($("#first_price").val());
        $('#v_2price').val($("#sec_price").val());

        // total res

        $('#v_weight_1').val($("#first-weight").val());
        $('#v_weight_2').val($("#second-weight").val());

        $('#v_total_first').val($("#first_total").val());
        $('#v_total_sec').val($("#sec_total").val());

        // 
        $('#v_total-amount').val($("#total-amount").val());
        $('#v_less').val($("#cash_advance").val());
        $('#v_total-paid').val($("#amount-paid").val());
        $('#v_total-words').val($("#amount-paid-words").val());

    }

});
</script>



<script>
// validation

$('#receiptBtn').click(function() {

    if (!document.getElementById('total-amount').value ||
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

        $('#r_gross').val($("#gross").val());
        $('#r_tare').val($("#tare").val());
        $('#r_net').val($("#net").val());


        $('#r_1price').val($("#first_price").val());
        $('#r_2price').val($("#sec_price").val());

        // total res

        $('#r_weight_1').val($("#first-weight").val());
        $('#r_weight_2').val($("#second-weight").val());

        $('#r_total_first').val($("#first_total").val());
        $('#r_total_sec').val($("#sec_total").val());

        // 
        $('#r_total-amount').val($("#total-amount").val());
        $('#r_less').val($("#cash_advance").val());
        $('#r_total-paid').val($("#amount-paid").val());
        $('#r_total-words').val($("#amount-paid-words").val());

    }

});
</script>