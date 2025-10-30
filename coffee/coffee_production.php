<?php
include('include/header.php');
include('include/navbar.php');

?>

<body>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper"> <br>
                <h2 class="page-title">
                    <b>
                        <font color="#0C0070">COFFEE </font>
                        <font color="#046D56"> PRODUCTION </font>
                    </b>
                </h2>
                <br>
                <?php     include "statistical_card/coffee.production.card.php"; ?>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-4">
                            <div class="btn-group">
                                <button type="button" class="btn btn-dark text-white" data-toggle="modal" data-target="#newProduction">
                                    <i class="fa fa-add" aria-hidden="true"></i> NEW PRODUCTION
                                </button>
                            </div>
                        </div>
                        <hr>
                        <?php

                        // Prepare SQL statement
                        $sql = "SELECT * FROM coffee_production_record";
                        $results = mysqli_query($con, $sql);

                        // Check for SQL errors
                        if (!$results) {
                            die("SQL error: " . mysqli_error($con));
                        }
                        ?>
                        <div class="table-responsive">
                            <table class="table" id='customerTable'>
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Production Code</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Entry Weight</th>
                                        <th scope="col">Production Weight</th>
                                        <th scope="col">Recovery</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>

                                            <td>
                                                <span class="badge bg-warning text-dark">
                                                    <?php echo $row['production_code'] ?></span>
                                            </td>
                                            <td><?php echo $row['prod_date'] ?> </td>
                                            <td><?php echo number_format($row['entry_weight'], 2) ?> kg</td>
                                            <td><?php echo number_format($row['total_weight'], 2) ?> kg</td>
                                            <td><?php echo number_format($row['recovery_weight'], 2) ?>%</td>
                                            <td><button class='btn btn-primary btn-sm btnUpdate' data-record='<?php echo json_encode($row); ?>'>Update</button>
                                                <button hidden class='btn btn-danger btn-sm btnDelete'>Delete</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "modal/production_modal.php";
    include "modal/production_update.php";
    ?>


    <script>
        $(document).ready(function() {


            $('.btnUpdate').on('click', function() {


                var coffee = $(this).data('record');

                $('#production_id').val(coffee.production_id);
                $('#prod_date').val(coffee.prod_date);
                $('#production_code').val(coffee.production_code);
                $('#recorded_by').val(coffee.recorded_by);
                $('#no_sack').val(coffee.no_sack);
                $('#u_entry_weight').val(coffee.entry_weight);
                $('#u_global_total_weight').val(coffee.total_weight);
                $('#u_recovery_weight').val(coffee.recovery_weight);
                $('#recorded_by').val(coffee.recorded_by);

                function fetch_prods() {
                    $.ajax({
                        url: "table/coffee_production.php",
                        method: "POST",
                        data: {
                            prod_id: coffee.production_id,
                        },
                        success: function(data) {
                            $('#prod_list_table').html(data);

                        }
                    });
                }
                fetch_prods();


                $('#updateProd').modal('show');
            });




            $('.btnDelete').on('click', function() {
                // $tr = $(this).closest('tr');

                // var data = $tr.children("td").map(function() {
                //     return $(this).text();
                // }).get();

                // $('#d_coffee_id').val(data[0]);

                // $('#deleteProductModal').modal('show'); // Close the modal

                Swal.fire({
                    title: "Under Development",
                    text: "Delete function is currently under development.",
                    type: "info",
                    confirmButtonText: "Okay"
                });


            });



        });
    </script>



</body>

</html>