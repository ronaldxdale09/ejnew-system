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
               <tr >
                
                  <th scope="col"> ID</th>
                  <th scope="col">Supplier</th>
                  <th scope="col"  width="7%">Lot</th>
                  <th scope="col" width="13%">Kilo Cost</th>
                  <th scope="col" width="18%">Total Cost</th>
                  <th scope="col" width="13%">Reweight</th>
                  <th scope="col"></th>

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
                         <td>'.$row['recording_id'].'</td>
                         <td>'.$row['supplier'].' </td>
                         <td>'.$row['lot_num'].' </td>
                         <td>₱ '.sprintf('%.2f', $cost_per_kilo).' </td>
                         <td>₱ '.sprintf('%.2f', $row['total_amount']).' </td>
                         <td>'.number_format($row['reweight'], 0, '.', ',').' kg </td>
                         <td><button type="button" id="addProduct" class="btn btn-danger btn-sm  addProduct"><i class="fa fa-minus"></i></button> </td>
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
 
 <hr>
 <div class="row">
 
     <div class="col">
         <label style="font-size:15px" class="col-md-12">Total Cost</label>
         <div class="input-group mb-3">
             <div class="input-group-prepend">
                 <span class="input-group-text">₱</span>
             </div>
             <input type="text" class="form-control" name="cuplumps_total_cost"
                 id="cuplumps_total_cost" value="'.number_format($total_cost, 2, '.', ',').'" style="width: 100px;" readonly />
         </div>
     </div>
 
     <div class="col">
         <label style="font-size:15px" class="col-md-12">Total Weight</label>
         <div class="input-group mb-3">
             <input type="text" class="form-control" name="cuplumps_total_weight"
                 id="cuplumps_total_weight" value="'.number_format($total_weight, 2, '.', ',').'" style="width: 100px;" readonly />
         </div>
     </div>
 
     <div class="col">
         <label style="font-size:15px" class="col-md-12">Average Cost per Kilo</label>
         <div class="input-group mb-3">
             <div class="input-group-prepend">
                 <span class="input-group-text">₱</span>
             </div>
             <input type="text" class="form-control" name="cuplumps_average_per_kilo"
                 id="cuplumps_average_per_kilo"  value="'.number_format($average_cost_per_kilo, 2, '.', ',').'" style="width: 100px;" readonly />
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