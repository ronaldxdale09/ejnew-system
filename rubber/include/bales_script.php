</script>
<!--hide contract details -->
<script type="text/javascript">
$(document).ready(function() {



    //IF THE USER PRESS ENTER , THE FOCUS TEXT BOX WILL MOVE TO THE NEXT INDEX
    $('input,select').on('keypress', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            console.log($next.length);
            if (!$next.length) {
                $next = $('[tabIndex=1]');
            }
            $next.focus();
        }
    });




    document.getElementById("contract-form").style.display = "none";
    document.getElementById("cash_advance-form").style.display = "none";
});
</script>


<!-- CONTRACT DETAILS -->
<script type="text/javascript">
$(document).ready(function() {
    // Country dependent ajax
    $("#contract").on("change", function() {
        var contract = $(this).val();

        contractSet(contract);
    });
});


function contractSet(contractVal) {
    var contract = contractVal;

    // Creates a new XMLHttpRequest object
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {

        // Defines a function to be called when
        // the readyState property changess
        if (this.readyState == 4 &&
            this.status == 200) {

            // Typical action to be performed
            // when the document is ready
            var myObj = JSON.parse((this.responseText));

            if (contract == "SPOT") {
                $('#name').attr('disabled', false);
                document.getElementById("contract-form").style.display = "none";

            } else {
                document.getElementById("contract-form").style.display = "block";
                $('#name').attr('disabled', true);

            }


            console.log(quantity = myObj[0]);
            console.log(delivered = myObj[1]);
            console.log(balance = myObj[2]);
            console.log(ca = myObj[3]);
            console.log(name = myObj[4]);

            $.ajax({
                url: "include/fetch/fetchAddress.php",
                type: "POST",
                cache: false,
                data: {
                    name: name
                },
                cache: false,
                success: function(address) {
                    $("#address").html(address);

                }
            });


            document.getElementById("balance").value = balance;
            document.getElementById("quantity").value = quantity;


            $('#name').val(name).trigger('chosen:updated');

            let nf = new Intl.NumberFormat('en-US');
            $.ajax({
                url: "include/fetch/fetchRubberCashAdvance.php",
                type: "POST",
                cache: false,
                data: {
                    name: name
                },
                cache: false,
                success: function(less) {
                    if (less !== "") {
                        document.getElementById("cash_advance-form").style.display =
                            "block";
                        document.getElementById("cash_advance").value = nf.format(
                            less);
                        document.getElementById("total_ca").value = nf.format(less);
                        document.getElementById('cash_advance').readOnly = false;
                    } else {
                        document.getElementById("cash_advance-form").style.display =
                            "none";
                        document.getElementById("cash_advance").value = nf.format(
                            less);
                        document.getElementById("total_ca").value = nf.format(less);
                        document.getElementById('cash_advance').readOnly = true;
                    }
                    console.log(less);


                }
            });

        }
    };

    // xhttp.open("GET", "filename", true);
    xmlhttp.open("GET", "include/fetch/fetchContract.php?contract=" + contract.replace(/,/g, ''),
        true);

    // Sends the request to the server
    xmlhttp.send();
}
</script>



<!-- DISPLAY ADDRESS -->
<script type="text/javascript">
$(document).ready(function() {
    let nf = new Intl.NumberFormat('en-US');
    // Country dependent ajax
    $("#name").on("change", function() {
        var name = $(this).val();
        nameChange(name);


    });



    function nameChange(name) {
        $.ajax({
            url: "include/fetch/fetchAddress.php",
            type: "POST",
            cache: false,
            data: {
                name: name
            },
            cache: false,
            success: function(address) {
                $("#address").html(address);

            }
        });

        //CASH ADVANCE SHOW

        $.ajax({
            url: "include/fetch/fetchRubberCashAdvance.php",
            type: "POST",
            cache: false,
            data: {
                name: name
            },
            cache: false,
            success: function(less) {
                console.log(less);
                if (less == '' || less == '0') {
                    document.getElementById("cash_advance-form").style.display = "none";
                    document.getElementById("cash_advance").value = nf.format(less);
                    document.getElementById("total_ca").value = less;

                    document.getElementById('cash_advance').readOnly = true;

                    ComputationRubber();
                } else {


                    document.getElementById("cash_advance-form").style.display = "block";
                    document.getElementById("cash_advance").value = nf.format(less);
                    document.getElementById("total_ca").value = nf.format(less);
                    document.getElementById('cash_advance').readOnly = false;


                    ComputationRubber();
                }



            }
        });
    }

});
</script>

<script>
function BalesRubber() {

    var entry = $("#entry").val().replace(/,/g, '');
    var net = $("#net_weight").val().replace(/,/g, '');
    var kilo_bales = $("#kilo_bales").val().replace(/,/g, '');
    var price = $("#price").val().replace(/,/g, '');
    var less = $("#cash_advance").val().replace(/,/g, '');


    bales_compute(entry, net, kilo_bales, price, less);

};
</script>




<!-- add netweight -->
<script>
$(function() {
    $("#entry").keyup(function() {
        BalesRubber();
    });




});
</script>


<script>
$(function() {
    $("#net_weight").keyup(function() {
        BalesRubber();

    });




});
</script>

<!-- total -->
<script>
$(function() {
    $("#price").keyup(function() {

        BalesRubber();
        getWords($("#amount_paid").val().replace(/,/g, ''));

    });
});
</script>

<script>
$(function() {
    $("#price2").keyup(function() {

        BalesRubber();


    });
});
</script>
<script>
$(function() {
    $("#cash_advance").keyup(function() {
        BalesRubber();
    });
});
</script>