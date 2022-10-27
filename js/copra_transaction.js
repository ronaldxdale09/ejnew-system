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