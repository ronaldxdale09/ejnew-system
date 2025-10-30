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
    } else if (parseInt(ca) > parseInt(available_ca)) {
        Swal.fire({
            icon: 'info',
            title: 'Oops...',
            text: 'Less is greater than your total cash advance',
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
        $('#m_tax-amount').val($("#tax-amount").val());
        
        $('#m_quantity').val($("#quantity").val());
        $('#m_balance').val($("#balance").val());

        // purchase info
        $('#m_noSack').val($("#noSack").val());
        $('#m_gross').val($("#gross").val());
        $('#m_tare').val($("#tare").val());
        $('#m_net').val($("#net").val());

        $('#m_dust').val($("#dust").val());
        $('#m_new-dust').val($("#new").val());
        $('#m_moisture').val($("#moisture").val());
        $('#m_discount').val($("#discount_reading").val());
        $('#m_total-dust').val($("#total-dust").val());

        $('#m_total-moisture').val($("#total-moisture").val());
        $('#m_net-resecada').val($("#total-res").val());
        $('#m_1resecada').val($("#first-res").val());
        $('#m_2resecada').val($("#second-res").val());
        $('#m_3resecada').val($("#third-rese").val());
        // total res

        $('#m_1rese-weight').val($("#1rese-weight").val());
        $('#m_2rese-weight').val($("#2rese-weight").val());

        $('#m_total_1res').val($("#total-1res").val());
        $('#m_total_2res').val($("#total-2res").val());
        $('#m_total_3res').val($("#total-3res").val());
        // 
        $('#m_total-amount').val($("#total-amount").val());
        $('#m_less').val($("#cash_advance").val());
        $('#m_total-paid').val($("#amount-paid").val());
        $('#m_tax').val($("#tax").val());
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
        $('#v_contract').val($("#contract").val());
        $('#v_address').val($("#address").val());
        // purchase info
        $('#v_noSack').val($("#noSack").val());
        $('#v_gross').val($("#gross").val());
        $('#v_tare').val($("#tare").val());
        $('#v_net').val($("#net").val());

        $('#v_dust').val($("#dust").val());
        $('#v_new-dust').val($("#new").val());


        $('#v_moisture').val($("#moisture").val());
        $('#v_discount').val($("#discount_reading").val());
        $('#v_total-dust').val($("#total-dust").val());


        $('#v_total-moisture').val($("#total-moisture").val());
        $('#v_net-resecada').val($("#total-res").val());
        $('#v_1resecada').val($("#first-rese").val());
        $('#v_2resecada').val($("#second-rese").val());
        $('#v_3resecada').val($("#third-rese").val());
        // total res
        $('#v_total_1res').val($("#total-1res").val());
        $('#v_total_2res').val($("#total-2res").val());
        $('#v_total_3res').val($("#total-3res").val());
        // 

        $('#v_total-amount').val($("#total-amount").val());
        $('#v_less').val($("#less").val());
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
        $('#r_contract').val($("#contract").val());
        $('#r_address').val($("#address").val());
        // purchase info
        $('#r_noSack').val($("#noSack").val());
        $('#r_gross').val($("#gross").val());
        $('#r_tare').val($("#tare").val());
        $('#r_net').val($("#net").val());

        $('#r_dust').val($("#dust").val());
        $('#r_new-dust').val($("#new").val());


        $('#r_moisture').val($("#moisture").val());
        $('#r_discount').val($("#discount_reading").val());
        $('#r_total-dust').val($("#total-dust").val());


        $('#r_total-moisture').val($("#total-moisture").val());
        $('#r_net-resecada').val($("#total-res").val());
        $('#r_1resecada').val($("#first-rese").val());
        $('#r_2resecada').val($("#second-rese").val());
        $('#r_3resecada').val($("#third-rese").val());
        // total res
        $('#r_total_1res').val($("#total-1res").val());
        $('#r_total_2res').val($("#total-2res").val());
        $('#r_total_3res').val($("#total-3res").val());
        // 

        $('#r_total-amount').val($("#total-amount").val());
        $('#r_less').val($("#less").val());
        $('#r_total-paid').val($("#amount-paid").val());
        $('#r_total-words').val($("#amount-paid-words").val());

    }

});
</script>