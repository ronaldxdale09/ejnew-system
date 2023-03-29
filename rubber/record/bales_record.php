<?php 
 
   $seller = "SELECT * FROM rubber_seller WHERE loc='$loc' ";
   $result = mysqli_query($con, $seller);
   $sellerList='';
   while($arr = mysqli_fetch_array($result))
   {
   $sellerList .= '
        <option value="'.$arr["name"].'">'.$arr["name"].'</option>';
   }


   

   ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>

    <div class="row">
        <div class="col-12">
            <!-- CONTENT -->
            <div class="row">
                <div class="col-4">
                    <h4><b> BALES RECORD </b></h4>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select class='form-select' id='seller_filter'>
                            <option disabled="disabled" selected>Select Supplier </option>
                            <option value=''>All</option>
                            <?php echo $sellerList?>
                            <!--PHP echo-->
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <input type="text" id="min2" name="min" class="form-control" placeholder="From Date" />
                </div>
                <div class="col-3">
                    <input type="text" id="max2" name="max" class="form-control" placeholder="To Date" />
                </div>
            </div>
            <br>
            <h6 class="card-title m-t-40">
                <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>Copra
                Purchased Record
            </h6>

            <div class="table-responsive">
                <table class="table" id='bales_table'>
                    <?php
                                    $record  = mysqli_query($con, "SELECT * from bales_transaction  WHERE loc='$loc' ORDER BY id DESC  "); ?>
                    <thead class="table-dark" style='font-size:15px'>
                        <tr>
                            <th scope="col">Invoice</th>
                            <th scope="col">Date</th>
                            <th scope="col">Contract</th>
                            <th scope="col">Seller</th>
                             <th scope="col">LOT #</th>
                            <th scope="col">Entry Weight</th>
                            <th scope="col">Net Weight</th>
                            <th scope="col">First Price</th>
                            <th scope="col">Second Price</th>
                            <th scope="col">Cash Advance</th>
                            <th scope="col">Amount Paid</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody style='font-size:17px'> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                            <td scope="row"> <?php echo $row['id']?> </td>
                            <td> <?php echo $row['date']?> </td>
                            <td> <?php echo $row['contract']?> </td>
                            <td> <?php echo $row['seller']?> </td>
                              <td> <?php echo $row['lot_code']?> </td>
                            <td> <?php echo number_format($row['entry'])?> Kg</td>
                            <td> <?php  
                                        $total_weight = $row['net_weight_1'] +  $row['net_weight_2'];          
                                        echo number_format($total_weight);?> Kg </td>

                            <td>₱ <?php echo number_format($row['price_1'],2)?> </td>
                            <td>₱ <?php echo number_format($row['price_2'],2)?> </td>
                            <td>₱ <?php echo number_format($row['less'],2)?> </td>
                            <td>₱ <?php echo number_format(($row['amount_paid']),2); ?> </td>


                            <td> <button type="button" class="btn btn-dark btnView"><i class="fa fa-eye"></i></button>
                                <button type="button" class="btn btn-danger btnBalesDelete"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr> <?php } ?>
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>

                </table>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>

</body>



</html>

<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
<script type="text/javascript">
var minDate1, maxDate1;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate1.val();
        var max = maxDate1.val();
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


minDate1 = new DateTime($('#min2'), {
    format: 'MMMM Do YYYY'
});
maxDate1 = new DateTime($('#max2'), {
    format: 'MMMM Do YYYY'
});





$(document).ready(function() {


    table = $('#bales_table').DataTable({
        dom: 'Bfrtip',
        order: [
            [0, 'desc']
        ],
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

    $('#min2, #max2').on('change', function() {
        table.draw();
    });

    $('#seller_filter').on('change', function() {
        table.search(this.value).draw();
    });

});
</script>