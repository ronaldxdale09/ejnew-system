<?php
 include('../../function/db.php');

if (isset($_GET['coffee_id'])) {
    $coffee_id = $_GET['coffee_id'];
    $sql = "SELECT description FROM coffee_products WHERE coffee_id = ?";
    
    // Using prepared statements for security
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $coffee_id); // "i" means integer
        $stmt->execute();
        $stmt->bind_result($description);
        $stmt->fetch();
        echo $description; // output the description (weight)
        $stmt->close();
    }
}
?>
