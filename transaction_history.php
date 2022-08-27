<?php 
   include('include/header.php');
   include "include/navbar.php";

   $seller = "SELECT * FROM seller ";
   $result = mysqli_query($con, $seller);
   $sellerList='';
   while($arr = mysqli_fetch_array($result))
   {
   $sellerList .= '
<option value="'.$arr["name"].'">[ '.$arr["code"].' ]      '.$arr["name"].'</option>';
   }


     // TOTAL CASH ADVANCE
     $CA_count = mysqli_query($con,"SELECT * FROM copra_cashadvance where status='PENDING'");
     $ca_no=mysqli_num_rows($CA_count);

     
    $results = mysqli_query($con, "SELECT SUM(cash_advance) as total from seller"); 
    $row = mysqli_fetch_array($results);
   


   ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <div class="row">


                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- CONTENT -->
                                    <div class="row">
                                        <div class="col-5">
                                    <h4> Transaction Reocrd </h4>
                                        </div>
                                        <div class="col">
                                            <h5> Date Filter</h5>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" id="min" name="min" class="form-control"
                                                placeholder="From Date" />
                                        </div>
                                        <div class="col-3">
                                            <input type="text" id="max" name="max" class="form-control"
                                                placeholder="To Date" />
                                        </div>
                                    </div>
                                    <br>
                                    <h6 class="card-title m-t-40">
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Copra
                                        Purchased Record
                                    </h6>


                                    <div class="table-responsive">
                                        <table class="table" id='transaction_history'>
                                            <?php
                                    $record  = mysqli_query($con, "SELECT * from transaction_record ORDER BY id "); ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Invoice</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Contract</th>
                                                    <th scope="col">Seller</th>
                                                    <th scope="col">First Price</th>
                                                    <th scope="col">Second Price</th>
                                                    <th scope="col">Net Weight</th>
                                                    <th scope="col">Amount Paid</th>
                                                    <th scope="col">Action</th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                    <th scope="col" hidden></th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                                                    <td scope="row"> <?php echo $row['invoice']?> </td>
                                                    <td> <?php echo $row['date']?> </td>
                                                    <td> <?php echo $row['contract']?> </td>
                                                    <td> <?php echo $row['seller']?> </td>
                                                    <td>₱ <?php echo number_format($row['first_res'])?> </td>
                                                    <td>₱ <?php echo number_format($row['sec_res'])?> </td>

                                                    <td> <?php 
                                                    
                                                    $total_weight = $row['rese_weight_1'] +  $row['rese_weight_2'];
                                                    
                                                    echo number_format($total_weight);?> Kg </td>


                                                    <td>₱ <?php echo number_format(($row['amount_paid'] )); ?> </td>
                                                    <td hidden> </td>
                                                    <td hidden> <?php echo $row['noSack']?> </td>
                                                    <td hidden> <?php echo $row['gross']?> </td>
                                                    <td hidden> <?php echo $row['tare']?> </td>
                                                    <td hidden> <?php echo $row['net_weight']?> </td>
                                                    <td hidden> <?php echo $row['dust']?> </td>
                                                    <td hidden> <?php echo $row['new_dust']?> </td>
                                                    <td hidden> <?php echo $row['total_dust']?> </td>
                                                    <td hidden> <?php echo $row['moisture']?> </td>
                                                    <td hidden> <?php echo $row['discount']?> </td>
                                                    <td hidden> <?php echo $row['total_moisture']?> </td>
                                                    <td hidden> <?php echo $row['net_res']?> </td>
                                                    <td hidden> <?php echo $row['total_first_res']?> </td>
                                                    <td hidden> <?php echo $row['total_sec_res']?> </td>
                                                    <td hidden> <?php echo $row['total_amount']?> </td>
                                                    <td hidden> <?php echo $row['less']?> </td>
                                                    <td hidden> <?php echo $row['amount_words']?> </td>
                                                    <td hidden> <?php echo $row['rese_weight_1']?> </td>
                                                    <td hidden> <?php echo $row['rese_weight_2']?> </td>
                                                    <td hidden> <?php echo $row['id']?> </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-secondary text-white viewButton">
                                                            <i class='fa-solid fa-eye'></i> </button>

                                                        <button type="button"
                                                            class="btn btn-danger text-white deleteBtn">
                                                            <i class='fa-solid fa-remove'></i> </button>
                                                    </td>
                                                </tr> <?php } ?> </tbody>

                                        </table>
                                    </div>
                                    <!-- END CONTENT -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>





<?php include('modal/copraHistory_modal.php'); ?>


<script>
$(document).ready(function() {
    $('.viewButton').on('click', function() {


        $('#viewHistory').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
 
        $('#invoice').val(data[0]);
        $('#name').val(data[3]);
        $('#date').val(data[1]);
        $('#contract').val(data[2]);
        $('#address').val(data[8]);
        // purchase info
        $('#noSack').val(data[9]);
        $('#gross').val(data[10]);
        $('#tare').val(data[11]);
        $('#net').val(data[12]);

        $('#dust').val(data[13]);
        $('#new-dust').val(data[14]);
        $('#total-dust').val(data[15]);

        $('#moisture').val(data[16]);
        $('#discount_reading').val(data[17]);
        $('#total-moisture').val(data[18]);


        $('#total-res').val(data[19]);

        $('#1resecada').val(data[4]);
        $('#2resecada').val(data[5]);

        // total res
        $('#total_1res').val(data[20]);
        $('#total_2res').val(data[21]);

        $('#1rese-weight').val(data[25]);
        $('#2rese-weight').val(data[26]);
        // 

        $('#total-amount').val(data[22]);
        $('#less').val(data[23]);
        $('#total-paid').val(data[7]);
        $('#total-words').val(data[24]);
        $('#amount-paid').val(data[7]);
    });

    $('.deleteBtn').on('click', function() {


        $('#deleteRecord').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#d_invoice').val(data[0]);
        $('#d_id').val(data[27]);
        $('#d_contract').val(data[2]);

    });

});
</script>



<script>
// for date

var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[0]);

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });
    var table = $('#transaction_history').DataTable({
        dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
        order: [
            [0, 'desc']
        ],
        buttons: [{
                extend: 'copy',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },

        ],
        lengthChange: false,
        orderCellsTop: true,



    });
    $('#min, #max').on('change', function() {
        table.draw();
    });



});
</script>