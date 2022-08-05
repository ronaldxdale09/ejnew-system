<div class="modal fade viewTransaction" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Copra Purchase Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table" id='transaction_record'>
                        <?php
                                    $record  = mysqli_query($con, "SELECT * from transaction_record ORDER BY id DESC LIMIT 5 "); ?>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Invoice</th>
                                <th scope="col">Date</th>
                                <th scope="col">Contract</th>
                                <th scope="col">Seller</th>
                                <th scope="col">Net Resecada Weight </th>
                                <th scope="col">Amount Paid</th>
                            </tr>
                        </thead>
                        <tbody> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                                <th scope="row"> <?php echo $row['id']?> </th>
                                <td> <?php echo $row['date']?> </td>
                                <td> <?php echo $row['contract']?> </td>
                                <td> <?php echo $row['seller']?> </td>
                                <td> <?php echo number_format($row['net_res']);?> Kg </td>
                                <td>₱ <?php echo number_format($row['amount_paid']); ?> </td>
                            </tr> <?php } ?> </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script>
  
  
   // for date
   
   var minDate, maxDate;
    
   // Custom filtering function which will search data in column four between two values
   $.fn.dataTable.ext.search.push(
       function( settings, data, dataIndex ) {
           var min = minDate.val();
           var max = maxDate.val();
           var date = new Date( data[0] );
   
    
           if (
               ( min === null && max === null ) ||
               ( min === null && date <= max ) ||
               ( min <= date   && max === null ) ||
               ( min <= date   && date <= max )
           ) {
               return true;
           }
           return false;
       }
   );
   
   
   // for date filter
   
   
   $(document).ready(function() {
       // Create date inputs
       minDate = new DateTime($('#p_min'), {
           format: 'YYYY-MM-DD'
       });
       maxDate = new DateTime($('#p_max'), {
           format: 'YYYY-MM-DD'
       });
    
       // DataTables initialisation
       var table = $('#transaction_record').DataTable(
           {
            order: [
            [0, 'desc']
        ],
           dom: 'Bfrtip',
           buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 1, 2, 3,4,5 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 1, 2, 3,4,5 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 1, 2, 3,4,5 ]
                }
            },

               
               
           ],
         orderCellsTop: true,
       
       
       
       }
       );
    
       // Refilter the table
       $('#p_min, #p_max').on('change', function () {
        purchase_table.draw();
       });
   });

   



</script>