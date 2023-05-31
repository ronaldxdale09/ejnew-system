
<?php 
include('../../function/db.php');
                       
    $container_id = $_POST['container_id']; 
    $bales_id = $_POST['bales_id'];
    $num_bales = preg_replace('/[^\p{L}\p{N}\s]/u', '', $_POST['num_bales']);;



    $check = mysqli_query($con, "SELECT * FROM receiving_record_product WHERE  product_id='$product_id' AND receiving_id='$receiving_id' AND loc='NTC'");
    $arrCheck = mysqli_fetch_array($check);

    $quantity += $arrCheck['product_quantity'];


    if($check->num_rows == 1) {
        $update = "UPDATE  receiving_record_product set product_quantity ='$quantity'
          WHERE   product_id='$product_id' AND receiving_id='$receiving_id' AND loc='NTC'";
        $results = mysqli_query($con, $update);
    
    

        }

        else{

          if ($quantity =='' || $quantity ==null ){
            $quantity=1;
          }

            $sql = "INSERT INTO receiving_record_product (receiving_id,product_id,product_quantity,loc,voucher) VALUES ('$receiving_id','$product_id','$quantity','NTC','$voucher')";
            $results = mysqli_query($con, $sql);

    }
    
  
    echo $product_id;

    exit();

  
 ?>





 