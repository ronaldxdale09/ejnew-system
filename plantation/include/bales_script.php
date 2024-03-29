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

                document.getElementById('net_weight_2').disabled = true;
                document.getElementById('price_2').disabled = true;
                document.getElementById('kilo_bales_2').disabled = true;


            } else {
                document.getElementById("contract-form").style.display = "block";
                $('#name').attr('disabled', true);


                document.getElementById('net_weight_2').disabled = false;
                document.getElementById('price_2').disabled = false;
                document.getElementById('kilo_bales_2').disabled = false;
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
                url: "include/fetch/fetchCABales.php",
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

                    BalesRubber();
                } else {


                    document.getElementById("cash_advance-form").style.display = "block";
                    document.getElementById("cash_advance").value = nf.format(less);
                    document.getElementById("total_ca").value = nf.format(less);
                    document.getElementById('cash_advance').readOnly = false;


                    BalesRubber();
                }



            }
        });
    }

});
</script>

<script>
function BalesRubber() {

    var entry = $("#entry").val().replace(/,/g, '');
    var net_1 = $("#net_weight_1").val().replace(/,/g, '');
    var net_2 = $("#net_weight_2").val().replace(/,/g, '');

    var kilo_bales_1 = $("#kilo_bales_1").val().replace(/,/g, '');
    var kilo_bales_2 = $("#kilo_bales_2").val().replace(/,/g, '');


    var price_1 = $("#price_1").val().replace(/,/g, '');
    var price_2 = $("#price_2").val().replace(/,/g, '');


    var less = $("#cash_advance").val().replace(/,/g, '');


    bales_compute(entry, net_1, net_2, kilo_bales_1, kilo_bales_2, price_1, price_2, less);

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
    $("#net_weight_1,#net_weight_2").keyup(function() {
        BalesRubber();

    });

});
</script>

<script>
$(function() {
    $("#kilo_bales_1,#kilo_bales_2").on("change", function() {
        BalesRubber();

    });

});
</script>

<!-- total -->
<script>
$(function() {
    $("#price_1,#price_2").keyup(function() {


        BalesRubber();

        var amount_paid = $("#amount_paid").val().replace(/,/g, '');

        words = numToWords(amount_paid);
        document.getElementById("amount-paid-words").value = words;

    });
});
</script>


<script>
$(function() {
    $("#cash_advance").keyup(function() {


        BalesRubber();
        var amount_paid = $("#amount_paid").val().replace(/,/g, '');

        words = numToWords(amount_paid);
        document.getElementById("amount-paid-words").value = words;
    });
});
</script>


<script>
function numToWords(s) {

    var th = ['', 'thousand', 'million', 'billion', 'trillion'];

    var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen',
        'nineteen'
    ];
    var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'not a number';
    var x = s.indexOf('.');
    if (x == -1) x = s.length;
    if (x > 15) return 'too big';
    var n = s.split('');
    var str = '';
    var sk = 0;
    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (n[i] == '1') {
                str += tn[Number(n[i + 1])] + ' ';
                i++;
                sk = 1;
            } else if (n[i] != 0) {
                str += tw[n[i] - 2] + ' ';
                sk = 1;
            }
        } else if (n[i] != 0) {
            str += dg[n[i]] + ' ';
            if ((x - i) % 3 == 0) str += 'hundred ';
            sk = 1;
        }
        if ((x - i) % 3 == 1) {
            if (sk) str += th[(x - i - 1) / 3] + ' ';
            sk = 0;
        }
    }
    str += 'peso/s ';
    if (x != s.length) {
        var y = s.length;
        str += 'and ';
        for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
        str = str + 'centavo/s ';
    }

    str = str.replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase());
    return str.replace(/\s+/g, ' ');
}
</script>