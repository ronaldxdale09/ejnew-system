<?php 
include('../../function/db.php');

$container_id = $_POST['container_id']; 
$bales_id = $_POST['bales_id'];
$planta_id = $_POST['planta_id'];
$total_weight = $_POST['total_weight'];

$num_bales = preg_replace('/[^\p{L}\p{N}\s]/u', '', $_POST['num_bales']);

// first check if the bales_id already exists in the database
$check_sql = "SELECT * FROM bales_container_selection WHERE bales_id='$bales_id' AND container_id='$container_id'";
$check_result = mysqli_query($con, $check_sql);

if(mysqli_num_rows($check_result) > 0){
    // if it exists, update it
    $update_sql = "UPDATE bales_container_selection SET num_bales='$num_bales' WHERE bales_id='$bales_id' AND container_id='$container_id'";
    $results = mysqli_query($con, $update_sql);
    echo 'Inventory Updated!';
}else{
    // if it doesn't exist, then insert it
    $insert_sql = "INSERT INTO bales_container_selection (container_id,bales_id,num_bales,total_weight,planta_id) VALUES ('$container_id','$bales_id','$num_bales','$total_weight','$planta_id')";
    $results = mysqli_query($con, $insert_sql);
    echo 'Product Added!';
}
exit();
?>
