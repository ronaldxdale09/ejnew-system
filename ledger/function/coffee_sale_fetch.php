<?php
include('db.php');

$coffee_sale_id = $_POST["coffee_sale_id"];

// Prepare your SQL query to fetch data from coffee_sale_line table
$sql = "SELECT * FROM coffee_sale_line WHERE coffee_sale_id = '$coffee_sale_id'";
$result = mysqli_query($con, $sql);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}

$output = '<div class="row">
                                <div class="col">Product
                                </div>
                                <div class="col">Qty
                                </div>
                                <div class="col">Price
                                </div>
                                <div class="col">Amount
                                </div>
                                <div class="col">Actions
                                </div>
                                </div>
                                <hr>';

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $product = $row["product"] == "0" ? "-" : $row["product"];
                                        $unit = $row["unit"] == "0" ? "-" : $row["unit"];
                                        $price = $row["price"] == "0" ? "-" : $row["price"];
                                        $amount = $row["amount"] == "0" ? "-" : $row["amount"];
                                
                                        $output .= "<div class='row'>
                                                        <div class='col'>
                                                            
                                                            <td><input type='text' class='form-control' value='$product' readonly></td>
                                                        </div>
                                                        <div class='col'>
                                                            
                                                        <td><input type='text' class='form-control' value='$unit' readonly></td>
                                                        </div>
                                                        <div class='col'>
                                                            
                                                            <input type='text' class='form-control' value='$price' readonly>
                                                        </div>
                                                        <div class='col'>
                                                            
                                                            <input type='text' class='form-control' value='$amount' readonly>
                                                        </div>
                                                        <div class='col'>
                                                            
                                                        <button class='btn btn-danger removeRow' style='align-items: center;'><i class='fas fa-trash'></i></button>
                                                        </div>
                                                    </div><hr>";
                                    }
                                } else {
                                    $output = "<p>No data found.</p>";
                                }

echo $output;
?>