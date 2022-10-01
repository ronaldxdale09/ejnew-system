<?php 


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

    <div class="row">
        <div class="col-12">
            <!-- CONTENT -->
            <div class="row">
                <div class="col-4">

                </div>
                <div class="col">
                    <h5> Date Filter</h5>
                </div>
                <div class="col-3">
                    <input type="text" id="min1" name="min" class="form-control" placeholder="From Date" />
                </div>
                <div class="col-3">
                    <input type="text" id="max1" name="max" class="form-control" placeholder="To Date" />
                </div>
            </div>
            <br>
            <h6 class="card-title m-t-40">
                <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Copra
                Purchased Record
            </h6>

            <div class="table-responsive">
                <table class="table" id='wet_record_table'>
                    <?php
                  $record  = mysqli_query($con, "SELECT * from rubber_transaction ORDER BY id DESC  "); ?>
                    <thead class="table-dark" style='font-size:15px'>
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
                        </tr>
                    </thead>
                    <tbody style='font-size:17px'> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                            <th scope="row"> <?php echo $row['id']?> </th>
                            <td> <?php echo $row['date']?> </td>
                            <td> <?php echo $row['contract']?> </td>
                            <td> <?php echo $row['seller']?> </td>
                            <td>₱ <?php echo number_format($row['price_1'])?> </td>
                            <td>₱ <?php echo number_format($row['price_2'])?> </td>

                            <td> <?php 
                                                    
                                                    $total_weight = $row['total_weight_1'] +  $row['total_weight_2'];
                                                    
                                                    echo number_format($total_weight);?> Kg </td>


                            <td>₱ <?php echo number_format(($row['amount_paid'] )); ?> </td>
                            <td> <button type="button" class="btn btn-dark wetBtnView"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger btnDelete"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr> <?php } ?> </tbody>

                </table>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>

</body>

</html>

<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
<script type="text/javascript">
var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[1]);

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


minDate = new DateTime($('#min1'), {
    format: 'MMMM Do YYYY'
});
maxDate = new DateTime($('#max1'), {
    format: 'MMMM Do YYYY'
});





$(document).ready(function() {


    table_1 = $('#wet_record_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print',

        ],
        drawCallback: function() {
            var api = this.api();
            var sum = 0;
            var formated = 0;
            //to show first th
            $(api.column(8).footer()).html('Total');


            sum = api.column(9, {
                page: 'current'
            }).data().sum();

            //to format this sum
            formated = parseFloat(sum).toLocaleString(undefined, {
                minimumFractionDigits: 2
            });
            $(api.column(9).footer()).html('P ' + formated);


        }
    });

    $('#min1, #max1').on('change', function() {
        table_1.draw();
    });

});
</script>