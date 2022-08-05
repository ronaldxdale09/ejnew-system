<!-- CHOSEN -->


<script>
$(function() {
    $(".select_seller").chosen({
        search_threshold: 10
    });
});
</script>





<!--hide contract details -->
<script type="text/javascript">
$(document).ready(function() {
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

        // Creates a new XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            // Defines a function to be called when
            // the readyState property changess
            if (this.readyState == 4 &&
                this.status == 200) {

                // Typical action to be performed
                // when the document is ready
                var myObj = JSON.parse(this.responseText);

                if (contract === "SPOT") {

                    
                    $('#name').attr('disabled', false);
                    document.getElementById("contract-form").style.display = "none";
                    document.getElementById("contract-form").style.display = "none";
                } else {
                    document.getElementById("contract-form").style.display = "block";
                    $('#name').attr('disabled', true);

                }


                var quantity = myObj[0];
                var delivered = myObj[1];
                var balance = myObj[2];
                var ca = myObj[3];
                var name = myObj[4];


                document.getElementById("balance").value = balance;
                document.getElementById("quantity").value = quantity;
                document.getElementById("first-rese").value = ca;


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

    });
});
</script>


<!-- DISPLAY ADDRESS -->
<script type="text/javascript">
$(document).ready(function() {
    let nf = new Intl.NumberFormat('en-US');
    // Country dependent ajax
    $("#name").on("change", function() {
        var name = $(this).val();

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
                    document.getElementById("total_ca").value = nf.format(less);
                    document.getElementById('cash_advance').readOnly = true;
                } else {


                    document.getElementById("cash_advance-form").style.display = "block";
                    document.getElementById("cash_advance").value = nf.format(less);
                    document.getElementById("total_ca").value = nf.format(less);
                    document.getElementById('cash_advance').readOnly = false;
                }



            }
        });

    });




});
</script>





<!-- COMPUTE MOISTURE DISCOUNT -->

<!-- add netweight -->
<script>
$(function() {
    $("#gross, #tare").keyup(function() {

        $("#net").val(((+$("#gross").val().replace(/,/g, '') - +$("#tare").val().replace(/,/g, '')))
            .toLocaleString());
    });
});
</script>
<!-- end net weight -->

<!-- autput DISCOUNT -->
<!-- get total DUST -->
<script>
$(function() {
    $("#dust").keyup(function() {

        $("#new").val(Math.round((((+$("#dust").val().replace(/,/g, '') / 100) * +$("#net").val()
            .replace(/,/g, ''))).toLocaleString()));
        $("#total-dust").val(((+$("#net").val().replace(/,/g, '') - +$("#new").val().replace(/,/g, '')))
            .toLocaleString());
    });
});
</script>

<!-- total -->
<script>
$(function() {
    $("#first-rese").keyup(function() {

        restotal = $("#total-res").val().replace(/,/g, '');
        var contract = document.getElementById("contract").value;
        var balance = $("#balance").val().replace(/,/g, '');

        let nf = new Intl.NumberFormat('en-US');

        if (contract == 'SPOT') {
            $("#total-amount").val(((+$("#total-res").val().replace(/,/g, '') * +$("#first-rese").val()
                .replace(/,/g, ''))).toLocaleString());


            document.getElementById("1rese-weight").value = $("#total-res").val();

            document.getElementById("total-1res").value = $("#total-amount").val();

            $("#amount-paid").val(((+$("#total-amount").val().replace(/,/g, '') - +$("#cash_advance")
                .val().replace(
                    /,/g, ''))).toLocaleString());
            getWords($("#amount-paid").val());


        } else {

            if (restotal > balance) {

                document.getElementById("1rese-weight").value = nf.format(balance);

                var rese1_price = $("#first-rese").val().replace(/,/g, '');
                var rese1_weight = $("#1rese-weight").val().replace(/,/g, '');

                document.getElementById("total-1res").value = nf.format(rese1_price * rese1_weight);
                document.getElementById("second-res").readOnly = false;
                document.getElementById("2rese-weight").value = (Math.round(+$("#total-res").val()
                    .replace(/,/g,
                        '') - (+$("#balance").val().replace(/,/g, '')))).toLocaleString("en-US");

                //AMOUNT PAID AND TOTAL

                $("#total-amount").val(((+$("#first-rese").val().replace(/,/g, '') * +$("#total-res")
                    .val().replace(/,/g, ''))).toLocaleString());

                $("#amount-paid").val(((+$("#total-amount").val().replace(/,/g, '') - +$(
                    "#cash_advance").val().replace(/,/g, ''))).toLocaleString());

                getWords($("#amount-paid").val());
            } else if (restotal < balance) {


                document.getElementById("1rese-weight").value = nf.format(restotal);

                var rese1_price = $("#first-rese").val().replace(/,/g, '');
                var rese1_weight = $("#1rese-weight").val().replace(/,/g, '');


                document.getElementById("total-1res").value = nf.format(rese1_price * rese1_weight);

                $("#total-amount").val(((+$("#first-rese").val().replace(/,/g, '') * +$("#total-res")
                    .val().replace(/,/g, ''))).toLocaleString());

                $("#amount-paid").val(((+$("#total-amount").val().replace(/,/g, '') - +$(
                    "#cash_advance").val().replace(/,/g, ''))).toLocaleString());
                getWords($("#amount-paid").val());
            }

        }



    });
});
</script>

<script>
$(function() {
    $("#cash_advance").keyup(function() {

        $("#amount-paid").val(((+$("#total-amount").val().replace(/,/g, '') - +$("#cash_advance").val()
            .replace(
                /,/g, ''))).toLocaleString());
        getWords($("#amount-paid").val())

    });
});
</script>


<script>
$(function() {
    $("#discount_reading").keyup(function() {

        document.getElementById("total-moisture").value = (Math.round(-(+$("#total-dust").val().replace(
            /,/g,
            '') * (+$("#discount_reading").val().replace(/,/g, '')) / 100))).toLocaleString("en-US");


        document.getElementById("total-res").value = ((+(Number(+$("#total-dust").val().replace(/,/g,
            ''))) - (Math.abs(+$("#total-moisture").val().replace(/,/g, ''))))).toLocaleString(
            "en-US");


    });
});
</script>

<script>
$(function() {
    $("#second-res").keyup(function() {

        document.getElementById("total-2res").value = ((+(Number(+$("#second-res").val().replace(/,/g,
            ''))) * (Math.abs(+$("#2rese-weight").val().replace(/,/g, ''))))).toLocaleString(
            "en-US");

        $("#total-amount").val(((+$("#total-1res").val().replace(/,/g, '') + (+$("#total-2res").val()
            .replace(/,/g, '')))).toLocaleString());

        $("#amount-paid").val(((+$("#total-amount").val().replace(/,/g, '') - +$("#cash_advance").val()
            .replace(/,/g, ''))).toLocaleString());
        getWords($("#amount-paid").val())



    });
});
</script>



<script>
// onkeyup event will occur when the user 
// release the key and calls the function
// assigned to this event
function GetDetail(str) {
    if (str.length == 0) {
        document.getElementById("discount_reading").value = "";
        return;
    } else {
        // Creates a new XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {


            // Defines a function to be called when
            // the readyState property changess
            if (this.readyState == 4 &&
                this.status == 200) {



                // Typical action to be performed
                // when the document is ready
                var myObj = JSON.parse(this.responseText);

                // Returns the response data as a
                // string and store this array in
                // a variable assign the value 
                // received to first name input field

                percent_dis = document.getElementById("discount_reading").value = myObj[0];

                document.getElementById("total-moisture").value = (Math.round(-(+$("#total-dust").val().replace(
                    /,/g, '') * percent_dis) / 100)).toLocaleString("en-US");


                $total_dust = $("#total-dust").val().replace(/,/g, '');
                $total_moisture = $("#total-moisture").val().replace(/,/g, '');

                document.getElementById("total-res").value = ((+(Number($total_dust)) - (Math.abs(
                    $total_moisture)))).toLocaleString("en-US");


                //ACTIVATE 2ND RESE IF THERE IS EXCESS KG
                balance = $("#balance").val().replace(/,/g, '');
                restotal = $("#total-res").val().replace(/,/g, '');
                var contract = document.getElementById("contract").value;
                if ($contact != 'SPOT')
                    if (restotal > balance) {
                        console.log(restotal);
                        document.getElementById("second-res").readOnly = false;
                    }





            }
        };

        // xhttp.open("GET", "filename", true);
        xmlhttp.open("GET", "function/discount.php?moisture=" + str, true);

        // Sends the request to the server
        xmlhttp.send();
    }
}
</script>


<script>
// onkeyup event will occur when the user 
// release the key and calls the function
// assigned to this event
function getWords(str) {
    if (str.length == 0) {
        document.getElementById("amount-paid-words").value = "";
        return;
    } else {

        // Creates a new XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            // Defines a function to be called when
            // the readyState property changess
            if (this.readyState == 4 &&
                this.status == 200) {

                // Typical action to be performed
                // when the document is ready
                var myObj = JSON.parse(this.responseText);

                // Returns the response data as a
                // string and store this array in
                // a variable assign the value 
                // received to first name input field

                document.getElementById("amount-paid-words").value = myObj;
            }
        };

        // xhttp.open("GET", "filename", true);
        xmlhttp.open("GET", "function/fetchWords.php?number=" + str.replace(/,/g, ''), true);

        // Sends the request to the server
        xmlhttp.send();
    }
}
</script>



<!-- END -->