<?php


$loc = str_replace(' ', '', $_SESSION['loc']);

?>

<hr>
<div class="table-responsive">
    <table class="table  table-hover table-striped " style='width:100%' id="bale_table">

        <?php
        $results = mysqli_query($con, "SELECT * FROM planta_bales_production 
                                   LEFT JOIN planta_recording ON planta_bales_production.recording_id = planta_recording.recording_id
                                   WHERE 
                                   planta_recording.source='$loc'
                                   ORDER BY planta_bales_production.recording_id ASC ");
        ?>


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
        <tbody>
            <?php while ($row = mysqli_fetch_array($results)) {
                $unit_cost =($row['total_production_cost'] / $row['produce_total_weight']);
               
               
               ?>
                <tr>
                    <td>
                        <?php if ($row['status'] == 'For Sale') : ?>
                            <span class="badge bg-dark"><?php echo $row['status'] ?></span>
                        <?php elseif ($row['status'] == 'Complete') : ?>
                            <span class="badge bg-success"><?php echo $row['status'] ?></span>
                        <?php elseif ($row['status'] == 'Pressing') : ?>
                            <span class="badge bg-danger"><?php echo $row['status'] ?></span>
                        <?php elseif ($row['status'] == 'Purchase') : ?>
                            <span class="badge bg-info"><?php echo $row['status'] ?></span>
                            <?php elseif ($row['status'] == 'Drying'): ?>
                            <span class="badge bg-warning"><?php echo $row['status'] ?></span>
                        <?php else : ?>
                            <span class="badge"><?php echo $row['status'] ?></span>
                            
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge bg-dark"><?php echo $row['recording_id'] ?></span>
                    </td>
                    <td>
                        <span class="badge bg-secondary"><?php echo $row['bales_prod_id'] ?></span>
                    </td>
                    <td><?php echo  date('M d, Y', strtotime($row['production_date'])); ?></td>
                    <td><?php echo $row['supplier'] ?></td>
                    <td>
                        <?php
                        if ($row['lot_num'] == 'Outsourced') {
                            echo 'OS';
                        } else {
                            echo $row['lot_num'];
                        }
                        ?>
                    </td>
                    <td><?php echo $row['bales_type'] ?></td>
                    <td class="number-cell"> <?php echo $row['kilo_per_bale'] ?> kg</td>
                    <td class="number-cell bales-column"> <?php echo number_format($row['number_bales'], 0, '.', ',') ?> pcs </td>
                    <td class="number-cell remaining-column"> <?php echo number_format($row['remaining_bales'], 0, '.', ',') ?> pcs </td>
                    <td class="number-cell">
                        <?php echo number_format($row['reweight'], 0, '.', ',') ?> kg</td>
                    <td class="number-cell">
                        <?php echo number_format($row['rubber_weight'], 0, '.', ',') ?> kg</td>

                    <td class="number-cell"><?php echo number_format($row['drc'], 2) ?>%</td>
                    <td><?php echo $row['description'] ?></td>
                    <td> ₱<?php echo number_format($row['milling_cost']) ?>
                    </td>
                    <td> ₱<?php echo number_format($row['total_production_cost'] / $row['produce_total_weight'], 2) ?>
                    </td>
                    <td>
                        <?php if ($row['trans_type'] == 'OUTSOURCE') : ?>
                            <span class="badge bg-danger">Outsourced</span>
                        <?php else : ?>
                            <span class="badge bg-success">EJN Produced</span>
                        <?php endif; ?>
                    </td>
                    <td> <?php if ($row['trans_type'] == 'OUTSOURCE') : ?>
                            <span class="badge bg-danger">Outsourced</span>
                        <?php elseif ($row['trans_type'] == 'DRY') : ?>
                            <span class="badge bg-dark"> Dry/Bale Purchase</span>
                        <?php elseif ($row['trans_type'] == 'SALE') : ?>
                            <span class="badge bg-success"> Cuplump/Wet Purchase</span>
                        <?php elseif ($row['trans_type'] == 'EJN') : ?>
                            <span class="badge bg-warning text-dark"> EJN Rubber</span>
                        <?php elseif ($row['trans_type'] == 'Excess') : ?>
                            <span class="badge bg-primary "> Production Excess</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge bg-dark"><?php echo $row['purchased_id'] ?></span>
                    </td>
                    <td>
                        <?php
                        if ($unit_cost == 0 || empty($unit_cost)) {
                        ?>
                            <button type="button" class="btn btn-warning text-dark btn-sm btnUpdateCost" data-production_expense='<?php echo $row['production_expense']; ?>' data-trans_type='<?php echo $row['trans_type']; ?>' data-purchased_id='<?php echo $row['purchased_id']; ?>' data-recording_id='<?php echo $row['recording_id']; ?>'>
                                <i class="fas fa-money-check"></i> Update Unit Cost
                            </button>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<div class="loading" style="display:none;">Loading...</div>

<script>
    $(document).ready(function() {

        $('#bale_table').on('click', '.btnUpdateCost', function() {

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
                    url: "function/updateBaleCost.php",
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

            xmlhttp.open("GET", "fetch/fetchPurchasedData.php?purchased_id=" + p_id.replace(/,/g, ''), true);

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

            xmlhttp.open("GET", "fetch/fetchEjnData.php?purchased_id=" + p_id.replace(/,/g, ''), true);

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

            xmlhttp.open("GET", "fetch/fetchBaleCost.php?recording_id=" + recording_id.replace(/,/g, '') + "&purchased_id=" + p_id.replace(/,/g, ''), true);
            // Sends the request to the server
            xmlhttp.send();
        }




        var table = $('#bale_table').DataTable({
            "order": [
                [2, 'desc']
            ],
            "pageLength": 30, // Changed this from -1 to 30
            "dom": "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>", // Added 'l' and 'p' for length changing input and pagination controls
            "responsive": true,
            "buttons": [{
                    extend: 'excelHtml5',
                    text: 'Excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                'colvis'
            ],
            columnDefs: [{
                orderable: false,
                targets: -1
            }, {
                targets: [10],
                visible: false
            }],
        });
    });
</script>