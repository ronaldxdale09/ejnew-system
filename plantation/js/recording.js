$(document).ready(function() {


    $('#newReceiving').on('shown.bs.modal', function() {
        $('.source', this).chosen();
    });




    $("#r_select_purchase").on("change", function() {
        var selectedOption = $(this).val();
        // Split the 'value' to get the 'id' and 'type'
        var splitOption = selectedOption.split(",");
        var purchased_id = splitOption[1];
        var type = splitOption[0];
        console.log(purchased_id);
        if (type === 'EJN') {
            ejnData(purchased_id);
        } else {
            purchasedData(purchased_id);
        }
        document.getElementById("r_weight").setAttribute("readonly", "readonly");
        document.getElementById("purchase_total_cost").setAttribute("readonly", "readonly");
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

    function ejnData(purchased_id) {
        var p_id = purchased_id;

        // Creates a new XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Parse the JSON response
                var myObj = JSON.parse(this.responseText);

                // Update fields with the response values
                document.getElementById("r_date").value = myObj[0];
                document.getElementById("r_supplier").value = myObj[1];
                document.getElementById("r_location").value = myObj[2];

                document.getElementById("r_weight").value = Number(myObj[3]).toLocaleString();
                document.getElementById("purchase_total_cost").value = Number(myObj[4]).toLocaleString();

            }
        };

        xmlhttp.open("GET", "fetch/fetchEjnData.php?purchased_id=" + p_id.replace(/,/g, ''), true);

        // Sends the request to the server
        xmlhttp.send();
    }



});