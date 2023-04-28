<style>
/* Basic styling */

[type=checkbox] {
    width: 2rem;
    height: 2rem;
    color: black;
    vertical-align: middle;
    -webkit-appearance: none;
    background: none;
    border: 1;
    outline: 0;
    flex-grow: 0;
    border-radius: 50%;
    background-color: #FFFFFF;
    transition: background 300ms;
    cursor: pointer;
}


/* Pseudo element for check styling */

[type=checkbox]::before {
    content: "";
    color: transparent;
    display: block;
    width: inherit;
    height: inherit;
    border-radius: inherit;
    border: 0;
    background-color: transparent;
    background-size: contain;
    box-shadow: inset 0 0 0 1px #D6FAFF;
}


/* Checked */

[type=checkbox]:checked {
    background-color: currentcolor;
}

[type=checkbox]:checked::before {
    box-shadow: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}


/* Disabled */

[type=checkbox]:disabled {
    background-color: #CCD3D8;
    opacity: 0.84;
    cursor: not-allowed;
}


/* IE */

[type=checkbox]::-ms-check {
    content: "";
    color: transparent;
    display: block;
    width: inherit;
    height: inherit;
    border-radius: inherit;
    border: 0;
    background-color: #FCF4A3;
    background-size: contain;
    box-shadow: inset 0 0 0 1px #CCD3D8;
}

[type=checkbox]:checked::-ms-check {
    box-shadow: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}


#select_prod_return {
    font-size: 10px;
}
</style>

<?php  

  include "../function/db.php";
 $output = '';  


 $result  = mysqli_query($con, "SELECT DISTINCT planta_recording.*, rubber_transaction.total_amount as total_amount, rubber_transaction.net_weight as net_weight 
 FROM planta_recording
 LEFT JOIN rubber_transaction ON planta_recording.purchased_id = rubber_transaction.id
 WHERE planta_recording.status = 'Field'");
 
  $output .= '  
  <table class="table table-bordered table-hover table-striped" id="recording_table-receiving">
             <thead class="table-dark" style="font-size: 14px !important" >
                 <tr >
                    <th scope="col">Status</th>
                    <th scope="col"> ID</th>
                    <th scope="col">Date Received</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Location</th>
                    <th scope="col"  width="7%">Lot No.</th>
                    <th scope="col" width="13%">Kilo Cost</th>
                    
                    <th scope="col" width="13%">Total Cost</th>
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
               
                 <td>
                 <span class="badge bg-success">'.$row['status'].'</span>
                    </td>
                     <td>'.$row['recording_id'].'</td>
                     <td>'.$row['receiving_date'].' </td>
                     <td>'.$row['supplier'].' </td>
                     <td>'.$row['location'].' </td>
                     <td>'.$row['lot_num'].' </td>
                     <td>₱ '.number_format(($row['total_amount']/ $row['net_weight']), 2, '.', ',').' </td>
                     <td>'.$row['total_amount'].' </td>
                     <td> <input  class="form-control" id="weight_'.$recording_id.'" name="weight[]" value="'.$row["reweight"].'"/>
                     </td>
                     <td><button type="button" id="addProduct" class="btn btn-warning btn-sm addProduct"><i
                     class="fa fa-plus-circle"></i></button> </td>
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

