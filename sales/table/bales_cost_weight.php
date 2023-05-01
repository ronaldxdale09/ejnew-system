<?php  

  include "../function/db.php";
 $output = '';  
$sales_id=$_POST['sales_id'];

 $result  = mysqli_query($con, "SELECT DISTINCT sales_cuplump_selected_inventory.*,planta_recording.*, rubber_transaction.total_amount as total_amount, rubber_transaction.net_weight as net_weight 
 FROM sales_cuplump_selected_inventory
 LEFT JOIN planta_recording ON sales_cuplump_selected_inventory.recording_id = planta_recording.recording_id
 LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
 where sales_id ='$sales_id'");
$total_cost = 0.0;
$total_weight = 0.0;
$cost_per_kilo = 0.0;
$output .= '  
<table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
           <thead class="table-dark" style="font-size: 12px !important" >
           <tr>
           <th>ID</th>
           <th>Source</th>
           <th>No. of Bales</th>
           <th>Bale Weight</th>
           <th>Weight</th>
           <th>Cost per Kilo</th>
           <th>Total Cost</th>
       </tr>
           </thead>';  
           if(mysqli_num_rows($result) > 0)  
           {  
             while($row = mysqli_fetch_array($result)) {
                 $total_cost += floatval($row['total_amount']);
                 $total_weight += floatval($row['reweight']);
                 $weight = $row["reweight"];
                 $recording_id = $row["recording_id"];
                 $cost_per_kilo = floatval($row['total_amount']) / floatval($row['net_weight']);
             
                 $output .= '  
                 <tr>
                    <td class="bales_id"></td>
                    <td class="bales_source"></td>
                    <td class="bales_num"></td>
                    <td class="bales_weight"></td>
                    <td class="bales_total_weight"></td>
                    <td class="bales_cost_per_kilo"></td>
                    <td class="bales_total_cost"></td>
                   </tr>
                 ';
             }
           }
           

 else
 {
 $output .= '<tr>
     <td colspan="4">Nothings in the cart</td>
 </tr>';
 }
 

 $average_cost_per_kilo = $total_weight > 0 ? $total_cost / $total_weight : 0.0;
 $output .= '</table>
 </div>
        <div class="row">
        <div class="col">
            <!-- BASED SA EXCEL KO DITO, ISANG TYPE LANG DAPAT LAHAT-->
            <label for="bales_quality" class="form-label">Quality</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_quality" readonly>
            </div>
        </div>
        <div class="col">
            <!-- #,### NO DECIMAL -->
            <!-- ADD LAHAT NG BALE PCS -->
            <label for="bales_total_num" class="form-label">Total Bales</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_total_num" readonly>
                <span class="input-group-text">pcs</span>
            </div>
        </div>
        <div class="col">
            <!-- #,###.## -->
            <!-- ADD LAHAT NG WEIGHT -->
            <label for="bales_total_weight" class="form-label">Total Weight</label>
            <div class="input-group">
                <input type="text" class="form-control" id="bales_total_weight" readonly>
                <span class="input-group-text">kg</span>
            </div>
        </div>
        <div class="col">
            <!-- #,###.## -->
            <!-- = TOTAL COST / TOTAL WEIGHT -->
            <label for="bales_avg_cost_per_kilo" class="form-label">Ave. Cost per Kilo</label>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" id="bales_avg_cost_per_kilo" readonly>
            </div>
        </div>
        <div class="col">
            <!-- #,###.## -->
            <!-- ADD LAHAT NG COST -->
            <label for="bales_total_cost" class="form-label">Total Bale Cost</label>
            <div class="input-group">
                <span class="input-group-text">₱</span>
                <input type="text" class="form-control" id="bales_total_cost" readonly>
            </div>
        </div>
        </div>
 ';
 
 echo $output;
 
 ?>


<script>
$(document).ready(function() {


    $('.addProduct').on('click', function() {


        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $tr.each(function() {
            var quantity = $(this).find(".keyvalue input").val();

            console.log(quantity);



            var recording_id = data[0];

            var sales_id = <?php echo $sales_id ?>;


            console.log(sales_id)

            console.log(recording_id)
            $.ajax({
                method: "POST",
                url: "table/button/cuplump_remove_inventory.php",
                data: {
                    recording_id: recording_id,
                    sales_id: sales_id,

                },
                success: function(data) {
                    console.log('success');
                    console.log(data);
                    fetch_cost_weight();

                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Inventory Removed!',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            });
        });


    });


});
</script>