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

                </div>
                <div class="col">
                    <div class="form-group">
                        <select class='form-select' id='seller_filter'>
                            <option disabled="disabled" selected>Select Seller </option>
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


            <div class="table-responsive">
                <table class="table" id='bales_table'>
                    <?php
                                    $record  = mysqli_query($con, "SELECT * from bales_transaction  WHERE loc='$loc' ORDER BY id DESC  "); ?>
                    <thead class="table-dark" style='font-size:15px'>
                        <tr>
                            <th scope="col">Ref No.</th>
                            <th scope="col">Date</th>
                            <th scope="col">Type</th>
                            <th scope="col">Buyer</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Total Weight</th>
                            <th scope="col">Sales</th>
                            <th scope="col">Net Gain</th>
                            <th scope="col">Unpaid Balance</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody style='font-size:17px'> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                            <td scope="row"> <?php echo $row['sale_id']?> </td>
                            <td> <?php echo $row['ship_date']?> </td>
                            <td> <?php echo $row['sale_type']?> </td>
                            <td> <?php echo $row['sale_buyer']?> </td>
                            <td> <?php echo $row['sale_destination']?> </td>
                            <td> <?php echo number_format($row['total_weight'])?> Kg</td>
                            <td>₱ <?php echo number_format($row['sales'],2)?> </td>
                            <td>₱ <?php echo number_format($row['net_gain'],2)?> </td>
                            <td>₱ <?php echo number_format($row['amount_unpaid'],2)?> </td>
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