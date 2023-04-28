<?php  

  include "../function/db.php";
 $output = '';  
$sales_id=$_POST['sales_id'];

 $result  = mysqli_query($con, "SELECT DISTINCT sales_cuplump_selected_inventory.*,planta_recording.*, rubber_transaction.total_amount as total_amount, rubber_transaction.net_weight as net_weight 
 FROM sales_cuplump_selected_inventory
 LEFT JOIN planta_recording ON sales_cuplump_selected_inventory.recording_id = planta_recording.recording_id
 LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
 where sales_id ='$sales_id'");
 
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
       while($row = mysqli_fetch_array($result))  
       {

       $weight=  $row["reweight"];
       $recording_id = $row["recording_id"];
            $output .= '  
                 <tr>  

                     <td>'.$row['recording_id'].'</td>
                     <td>'.$row['supplier'].' </td>
                     <td>'.$row['lot_num'].' </td>
                     <td>₱ '.number_format(($row['total_amount']/ $row['net_weight']), 2, '.', ',').' </td>
                     <td>₱ '.number_format($row['total_amount'],2).' </td>
                     <td>'.number_format($row['reweight'], 0, '.', ',').' kg </td>
                     </td>
                     <td><button type="button" id="addProduct" class="btn btn-danger btn-sm  addProduct"><i
                     class="fa fa-minus"></i></button> </td>
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
 $output .= '</table>
 
 
 </div>';
 echo $output;
 ?>