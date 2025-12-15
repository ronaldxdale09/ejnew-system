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



<div class="row g-3">
    <!-- Total Products -->
    <div class="col-md-3">
        <div class="p-3 border rounded bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="text-muted small text-uppercase">Total Products</div>
                <div class="text-primary opacity-50"><i class="fas fa-box"></i></div>
            </div>
            <div class="h4 fw-bold mb-0 text-dark"><?php echo number_format($total_products, 0); ?></div>
        </div>
    </div>
    
    <!-- Total Inventory -->
    <div class="col-md-3">
        <div class="p-3 border rounded bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="text-muted small text-uppercase">Total Stock</div>
                <div class="text-info opacity-50"><i class="fas fa-warehouse"></i></div>
            </div>
            <div class="h4 fw-bold mb-0 text-dark"><?php echo number_format($total_quantity, 0); ?> <span class="fs-6 text-muted fw-normal">pcs</span></div>
        </div>
    </div>

    <!-- Inventory Value -->
    <div class="col-md-3">
        <div class="p-3 border rounded bg-white h-100">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="text-muted small text-uppercase">Inventory Value</div>
                 <div class="text-success opacity-50"><i class="fas fa-coins"></i></div>
            </div>
            <div class="h4 fw-bold mb-0 text-success">₱<?php echo number_format($total_value, 2); ?></div>
        </div>
    </div>

    <!-- Most Stocked -->
    <div class="col-md-3">
        <div class="p-3 border rounded bg-white h-100">
             <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="text-muted small text-uppercase">Top Item</div>
                 <div class="text-warning opacity-50"><i class="fas fa-trophy"></i></div>
            </div>
            <div class="fw-bold text-dark text-truncate" title="<?php echo $most_stocked['coffee_name']; ?>"><?php echo $most_stocked['coffee_name']; ?></div>
            <div class="small text-muted"><?php echo number_format($most_stocked['quantity'], 0); ?> pcs</div>
        </div>
    </div>
</div>
