<!--hide contract details -->


<script>
function ComputationCopra() {

    gross = $("#gross").val().replace(/,/g, '');
    tare = $("#tare").val().replace(/,/g, '');
    dust = $("#dust").val().replace(/,/g, '');

    discount = $("#discount_reading").val().replace(/,/g, '');
    rese1 = $("#first-res").val().replace(/,/g, '');
    rese2 = $("#second-res").val().replace(/,/g, '');
    less = $("#cash_advance").val().replace(/,/g, '');


    total_dust = $("#total-dust").val(((+$("#net").val().replace(/,/g, '') - +$("#new").val().replace(/,/g, '')))
        .toLocaleString());

    CopraComputation(gross, tare, discount, rese1, rese2, less);
};
</script>


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
            document.getElementById("first-res").value = ca;


            $('#name').val(name).trigger('chosen:updated');

            let nf = new Intl.NumberFormat('en-US');
            $.ajax({
                url: "include/fetch/fetchCopraCashAdvance.php",
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

                    } else {
                        document.getElementById("cash_advance-form").style.display =
                            "none";
                        document.getElementById("cash_advance").value = nf.format(
                            less);
                        document.getElementById("total_ca").value = nf.format(less);

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
            url: "include/fetch/fetchCopraCashAdvance.php",
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


                    ComputationCopra();
                } else {


                    document.getElementById("cash_advance-form").style.display = "block";
                    document.getElementById("cash_advance").value = nf.format(less);
                    document.getElementById("total_ca").value = nf.format(less);


                    ComputationCopra();
                }



            }
        });
    }

});
</script>





<!-- add netweight -->
<script>
$(function() {
    $("#gross, #tare").keyup(function() {

        ComputationCopra();

    });




});
</script>

<!-- end net weight -->

<!-- autput DISCOUNT -->
<!-- get total DUST -->
<script>
$(function() {
    $("#dust").keyup(function() {

        $("#new").val((Math.floor((+$("#dust").val().replace(/,/g, '') / 100) * +$("#net").val()
            .replace(/,/g, ''))));

        ComputationCopra();
    });
});
</script>


<script>
$(function() {
    $("#moisture").keyup(function() {

        ComputationCopra();
    });
});
</script>

<!-- total -->
<script>
$(function() {
    $("#first-res").keyup(function() {

        ComputationCopra();


    });
});
</script>

<script>
$(function() {
    $("#new").keyup(function() {

        ComputationCopra();


    });
});
</script>


<script>
$(function() {
    $("#cash_advance").keyup(function() {
        ComputationCopra();
    });
});
</script>


<script>
$(function() {
    $("#discount_reading").keyup(function() {

        ComputationCopra();
    });
});
</script>

<script>
$(function() {
    $("#second-res").keyup(function() {

        ComputationCopra();


    });
});

$(function() {
    $("#tax").keyup(function() {

        ComputationCopra();


    });
});
</script>





<?php 
function parseNum(string $money) : float
{
    $money = preg_replace('/[ ,]+/', '', $money);
    return number_format((float) $money, 2, '.', '');
}


if (isset($_GET['view'])){
    $view = $_GET['view'];

$sql = mysqli_query($con, "SELECT  * from transaction_record where invoice='$view'  ");
$record = mysqli_fetch_array($sql);

?>
<script>
$(document).ready(function() {


    let nf = new Intl.NumberFormat('en-US');



    $("#noSack").val(nf.format(<?php echo ($record['noSack'])?>));
    $("#gross").val(nf.format(<?php echo ($record['gross'])?>));
    $("#tare").val(nf.format(<?php echo ($record['tare'])?>));
    $("#dust").val(nf.format(<?php echo ($record['dust'])?>));

    $("#moisture").val(nf.format(<?php echo ($record['moisture'])?>));
    $("#discount_reading").val(nf.format(<?php echo ($record['discount'])?>));
    $("#first-res").val(nf.format(<?php echo ($record['first_res'])?>));
    $("#second-res").val(nf.format(<?php echo ($record['sec_res'])?>));
    $("#cash_advance").val(nf.format(<?php echo ($record['less'])?>));



    contract = "<?php echo $record['contract']?>";
    name = "<?php echo $record['seller']?>";


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

    ComputationCopra();
    ComputationCopra();

    if (contract == "SPOT") {
        $('#name').attr('disabled', true);
        $('#name').val(name).trigger('chosen:updated');
        nameChange(name);


    } else {
        $('#contract').attr('disabled', true);
        $('#contract').val(contract);

        $("#1rese-weight").val(nf.format(<?php echo ($record['rese_weight_1'])?>));
        $("#total-1res").val(nf.format(<?php echo ($record['total_first_res'])?>));


        $("#2rese-weight").val(nf.format(<?php echo ($record['rese_weight_2'])?>));
        $("#total-2res").val(nf.format(<?php echo ($record['total_sec_res'])?>));

        $("#total-amount").val(nf.format(<?php echo ($record['total_amount'])?>));
        $("#amount-paid").val(nf.format(<?php echo ($record['amount_paid'])?>));

    }



});
</script>

<?php 
}

?>