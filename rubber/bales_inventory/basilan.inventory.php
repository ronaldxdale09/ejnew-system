<?php

$loc = str_replace(' ', '', $_SESSION['loc']);
$bale_table_id = $bale_table_id ?? 'bale_table';
$bale_filter_source = $bale_filter_source ?? '';
$sourceAttr = $bale_filter_source !== ''
    ? ' data-filter-source="' . htmlspecialchars($bale_filter_source, ENT_QUOTES) . '"'
    : '';

?>
<hr>
<div class="table-responsive">
    <table class="table  table-hover table-striped " style='width:100%' id="<?php echo htmlspecialchars($bale_table_id, ENT_QUOTES); ?>"<?php echo $sourceAttr; ?>>
        <thead class="table-dark" style='font-size:13px'>
            <tr>
                <th>Status</th>
                <th>Rec. ID</th>
                <th>Bale ID</th>
                <th>Date Produced</th>
                <th>Supplier</th>
                <th>Lot No.</th>
                <th>Quality</th>
                <th>Kilo</th>
                <th>Produced Bales</th>
                <th  >Remaining Bales</th>
                <th>Cuplump Weight</th>
                <th>Bale Weight</th>
                <th>DRC</th>
                <th>Description</th>
                <th>Mill Cost</th>
                <th>Unit Cost</th>
                <th>Production Type</th>
                <th>Purchased Type</th>
                <th>Purchased ID</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


<div class="loading" style="display:none;">Loading...</div>

<script>
    $(document).ready(function() {
        var fetchBase = window.RUBBER_BASE || '';

        $(document).on('click', '#bale_table .btnUpdateCost, #bale_table_kidapawan .btnUpdateCost', function() {

            var prod_expense = $(this).data('production_expense');
            var trans_type = $(this).data('trans_type');
            var purchased_id = $(this).data('purchased_id');
            var recording_id = $(this).data('recording_id');

            console.log(prod_expense);
            console.log(trans_type);
            console.log(purchased_id);
            console.log(recording_id);

            Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to update the cost?",
                    icon: "warning",
                    showCancelButton: true, // This line enables the cancel button
                    confirmButtonText: "Yes, update it!",
                    cancelButtonText: "No, cancel!"
                })
                .then((result) => {
                    if (result.isConfirmed) { // This line checks if the user clicked "Yes"
                        // Show loading screen
                        $('.loading').show();

                        if (trans_type === 'EJN') {
                            ejnData(purchased_id, recording_id, prod_expense);
                        } else if (trans_type === 'DRY') {
                            dryData(purchased_id, recording_id, prod_expense);
                        } else {
                            purchasedData(purchased_id, recording_id, prod_expense);
                        }
                    } else if (result.isDismissed) { // This line checks if the user clicked "No"
                        // You can add code here to handle the "Cancel" action, if needed
                    }
                });

        });

        function updateBaleCost(purchased_id, recording_id, purchase_cost, expense) {

            var purchase_cost = parseFloat(purchase_cost);
            var expense = parseFloat(expense);
            var total_cost = purchase_cost + expense;

            console.log("Total cost:", total_cost);

            function update_cost() {
                $.ajax({
                    url: fetchBase + "function/updateBaleCost.php",
                    method: "POST",
                    data: {
                        recording_id: recording_id,
                        purchase_cost: purchase_cost,
                        total_cost: total_cost
                    },
                    success: function(data) {
                        // Hide loading screen
                        $('.loading').hide();

                        Swal.fire({
                            title: "Success!",
                            text: "The cost has been updated.",
                            icon: "success",
                            showCancelButton: false, // Hide cancel button
                            confirmButtonText: "Confirm"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Reload the page when the user clicks "Confirm"
                            }
                        });

                        console.log('success');
                    }
                });
            }
            update_cost();

        }


        function purchasedData(purchased_id, recording_id, prod_expense) {
            var p_id = String(purchased_id);


            // Creates a new XMLHttpRequest object
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Parse the JSON response
                    var myObj = JSON.parse(this.responseText);



                    // supplier
                    console.log(myObj[1]);
                    // weight
                    console.log(myObj[3]);
                    //purchased cost
                    console.log(myObj[7]);
                    var purchase_cost = myObj[7];

                    updateBaleCost(purchased_id, recording_id, purchase_cost, prod_expense)

                }
            };

            xmlhttp.open("GET", fetchBase + "fetch/fetchPurchasedData.php?purchased_id=" + p_id.replace(/,/g, ''), true);

            // Sends the request to the server
            xmlhttp.send();
        }

        function ejnData(purchased_id, recording_id, prod_expense) {
            var p_id = String(purchased_id);


            // Creates a new XMLHttpRequest object
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Parse the JSON response
                    var myObj = JSON.parse(this.responseText);

                    // supplier
                    console.log(myObj[1]);
                    // weight
                    console.log(myObj[3]);
                    //purchased cost
                    console.log(myObj[4]);

                    var purchase_cost = myObj[4];

                    updateBaleCost(purchased_id, recording_id, purchase_cost, prod_expense)

                }
            };

            xmlhttp.open("GET", fetchBase + "fetch/fetchEjnData.php?purchased_id=" + p_id.replace(/,/g, ''), true);

            // Sends the request to the server
            xmlhttp.send();
        }

        function dryData(purchased_id, recording_id, prod_expense) {
            var p_id = String(purchased_id);
            var recording_id = String(recording_id);
            // Creates a new XMLHttpRequest object
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Parse the JSON response
                    var myObj = JSON.parse(this.responseText);
                    // supplier
                    console.log(myObj[0]);
                    // weight
                    console.log(myObj[1]);
                    //purchased cost
                    console.log(myObj[2]);

                    var purchase_cost = myObj[2];

                    updateBaleCost(purchased_id, recording_id, purchase_cost, prod_expense)
                }
            };

            xmlhttp.open("GET", fetchBase + "fetch/fetchBaleCost.php?recording_id=" + recording_id.replace(/,/g, '') + "&purchased_id=" + p_id.replace(/,/g, ''), true);
            // Sends the request to the server
            xmlhttp.send();
        }




    });
</script>