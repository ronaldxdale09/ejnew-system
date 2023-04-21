$(document).ready(function() {


    $('#newReceiving').on('shown.bs.modal', function() {
        $('.source', this).chosen();
    });



    // Country dependent ajax
    $("#r_select_purchase").on("change", function() {
        var purchased_id = $(this).val();
        console.log(purchased_id);
        purchasedData(purchased_id)
    });



    function purchasedData(purchased_id) {
        var p_id = purchased_id;

        // Creates a new XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Parse the JSON response
                var myObj = JSON.parse(this.responseText);

                // Log the response values to the console
                // console.log("quantity:", myObj[0]);
                document.getElementById("r_date").value = myObj[0];
                document.getElementById("r_supplier").value = myObj[1];
                document.getElementById("r_location").value = myObj[2];

                document.getElementById("r_weight").value = Number(myObj[3]).toLocaleString();
                document.getElementById("r_kilo_cost").value = Number(myObj[5]).toLocaleString();
                document.getElementById("r_total_cost").value = Number(myObj[7]).toLocaleString();

            }
        };

        xmlhttp.open("GET", "fetch/fetchPurchasedData.php?purchased_id=" + p_id.replace(/,/g, ''), true);

        // Sends the request to the server
        xmlhttp.send();
    }

});