<?php
// Assuming you have already established a connection $con

// 1. Total Products
$sql = mysqli_query($con, "SELECT COUNT(*) as total_products FROM coffee_products");
$total_products = mysqli_fetch_array($sql)['total_products'];

// 2. Total Inventory Quantity
$sql = mysqli_query($con, "SELECT SUM(quantity) as total_quantity FROM coffee_inventory");
$total_quantity = mysqli_fetch_array($sql)['total_quantity'];

// 3. Most Stocked Product
$sql = mysqli_query($con, "SELECT coffee_name, quantity FROM coffee_products LEFT JOIN coffee_inventory ON coffee_products.coffee_id = coffee_inventory.coffee_id ORDER BY quantity DESC LIMIT 1");
$most_stocked = mysqli_fetch_array($sql);

// 4. Least Stocked Product
$sql = mysqli_query($con, "SELECT coffee_name, quantity FROM coffee_products LEFT JOIN coffee_inventory ON coffee_products.coffee_id = coffee_inventory.coffee_id WHERE quantity > 0 ORDER BY quantity ASC LIMIT 1");
$least_stocked = mysqli_fetch_array($sql);
if (mysqli_num_rows($sql) > 0) {
    $least_stocked = mysqli_fetch_array($sql);
} else {
    $least_stocked = [
        'coffee_name' => 'N/A',
        'quantity' => 0
    ];
}



// 5. Highest Unit Price Product
$sql = mysqli_query($con, "SELECT coffee_name, unit_price FROM coffee_products ORDER BY unit_price DESC LIMIT 1");
$highest_price = mysqli_fetch_array($sql);

// 6. Total Inventory Value
$sql = mysqli_query($con, "SELECT SUM(unit_price * quantity) as total_value FROM coffee_products LEFT JOIN coffee_inventory ON coffee_products.coffee_id = coffee_inventory.coffee_id");
$total_value = mysqli_fetch_array($sql)['total_value'];

?>

<div class="row">

    <!-- Total Products -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total Products</h6>
                <p><?php echo number_format($total_products, 0) ?></p>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-box"></i>
            </div>
        </div>
    </div>

    <!-- Total Inventory Quantity -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total Inventory</h6>
                <p><?php echo number_format($total_quantity, 0) ?> pcs</p>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-warehouse"></i>
            </div>
        </div>
    </div>

    <!-- Most Stocked Product -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Most Stocked</h6>
                <p><?php echo $most_stocked['coffee_name'] ?> (<?php echo $most_stocked['quantity'] ?> pcs)</p>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-trophy"></i>
            </div>
        </div>
    </div>

    <!-- Least Stocked Product -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Least Stocked</h6>
                <p><?php echo $least_stocked['coffee_name'] ?> (<?php echo $least_stocked['quantity'] ?> pcs)</p>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-exclamation-circle"></i>
            </div>
        </div>
    </div>

    <!-- Highest Unit Price Product -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Highest Unit Price</h6>
                <p><?php echo $highest_price['coffee_name'] ?> (₱<?php echo number_format($highest_price['unit_price'], 2) ?>)</p>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-tag"></i>
            </div>
        </div>
    </div>

    <!-- Total Inventory Value -->
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-card__content">
                <h6>Total Inventory Value</h6>
                <p>₱<?php echo number_format($total_value, 2) ?></p>
            </div>
            <div class="stat-card__icon">
                <i class="fa fa-coins"></i>
            </div>
        </div>
    </div>

</div>