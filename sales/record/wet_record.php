<?php 


   $seller = "SELECT * FROM rubber_seller    where loc='$loc'";
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
   <h4><b> WET RECORD </b></h4>
                </div>
      
                <div class="col">
                <div class="form-group">
                        <select class='form-select' id='wet_seller_filter'>
                            <option disabled="disabled" selected>Select Supplier </option>
                            <option value=''>All</option>
                            <?php echo $sellerList?>
                            <!--PHP echo-->
                        </select>
                    </div>
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
                  $record  = mysqli_query($con, "SELECT * from rubber_transaction   where loc='$loc' ORDER BY id DESC  "); ?>
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
                            <td scope="row"> <?php echo $row['id']?> </td>
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
                                <button type="button" class="btn btn-danger btnWetDelete"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr> <?php } ?> </tbody>
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


    wet_table = $('#wet_record_table').DataTable({
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
            $(api.column(6).footer()).html('Total');


            sum = api.column(7, {
                page: 'current'
            }).data().sum();

            //to format this sum
            formated = parseFloat(sum).toLocaleString(undefined, {
                minimumFractionDigits: 2
            });
            $(api.column(7).footer()).html('P ' + formated);


        }
    });
    $('#min1, #max1').on('change', function() {
        wet_table.draw();
    });
    $('#wet_seller_filter').on('change', function() {
        wet_table.search(this.value).draw();
    });


});
</script>