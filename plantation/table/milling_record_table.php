<?php  
include('../function/db.php');

 $recording_id = (string)$_POST['recording_id'];

 

 $sql  = "SELECT * FROM planta_recording_logs 
 WHERE recording_id='$recording_id' and status='Milling'
 ORDER BY milling_date DESC";

$output='';


 $result = mysqli_query($con, $sql);  
 $output .= '  
            <table id="s_record_table"class="table">
            <thead class="table-dark">
                <tr>
                <th scope="col">Milling Update Date</th>
                <th scope="col">Crumbed Weight</th>
                </tr>
            </thead>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($arr = mysqli_fetch_array($result))  
      {  


           $output .= '  
                <tr>  
          
             <td scope="row"  >'.$arr["milling_date"].'</td>

             <td scope="row"  > <span class="badge bg-warning text-dark">'.$arr["crumbed_weight"].'</span></td>
            
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
 $output .= '

 </table>  


      </div>';  
 echo $output;  
 ?>