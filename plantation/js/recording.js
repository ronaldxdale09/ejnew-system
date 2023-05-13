$(document).ready(function() {


    $('#newReceiving').on('shown.bs.modal', function() {
        $('.source', this).chosen();
    });




    // Country dependent ajax
    $("#r_select_purchase").on("change", function() {
        var purchased_id = $(this).val();
        if (purchased_id === '0') {
            document.getElementById("r_supplier").value = 'EJN';
            document.getElementById("r_location").value = 'EJN RUBBER';
            document.getElementById("r_weight").removeAttribute("readonly");
            document.getElementById("r_weight").value = '';
            document.getElementById("purchase_total_cost").value = '';
            document.getElementById("purchase_total_cost").removeAttribute("readonly");

            document.getElementById("r_supplier").setAttribute("readonly", "readonly");

        } else if (purchased_id === '-1') {
            document.getElementById("r_supplier").value = '';
            document.getElementById("r_location").value = '';
            document.getElementById("r_supplier").removeAttribute("readonly");
            document.getElementById("r_weight").removeAttribute("readonly");
            document.getElementById("r_weight").value = '';
            document.getElementById("purchase_total_cost").value = '0';
            document.getElementById("purchase_total_cost").setAttribute("readonly", "readonly");

        } else {
            console.log(purchased_id);
            purchasedData(purchased_id);
            document.getElementById("r_weight").setAttribute("readonly", "readonly");
            document.getElementById("purchase_total_cost").setAttribute("readonly", "readonly");
        }

    });

    function purchasedData(purchased_id) {
        var p_id = purchased_id;

        // Creates a new XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Parse the JSON response
                var myObj = JSON.parse(this.responseText);

                console.log(myObj[7])
                    // Log the response values to the console
                    // console.log("quantity:", myObj[0]);
                document.getElementById("r_date").value = myObj[0];
                document.getElementById("r_supplier").value = myObj[1];
                document.getElementById("r_location").value = myObj[2];

                document.getElementById("r_weight").value = Number(myObj[3]).toLocaleString();
                document.getElementById("purchase_total_cost").value = Number(myObj[7]).toLocaleString();

            }
        };

        xmlhttp.open("GET", "fetch/fetchPurchasedData.php?purchased_id=" + p_id.replace(/,/g, ''), true);

        // Sends the request to the server
        xmlhttp.send();
    }

});