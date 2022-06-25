<!DOCTYPE html>
<?php 
    include "function/db.php"; 

?>
<html>
    <head>
        <?php
            include "include/bootstrap.php";
            include "include/jquery.php";
        ?>
        <link rel='stylesheet' href='css/index.css'>
        <link rel='stylesheet' href='css/sales.css'>
        <link rel='stylesheet' href='css/dashboard.css'>        
        <?php include "include/datatables_buttons_js.php"; ?>
        <?php include "include/datatables_buttons_css.php"; ?>
        <script>
            $(document).ready(function(){
                //Load Cart when Clicking cart from the list
                $(document).on('click', '.edit-submit', function() {
                    var product = $(this).attr('id');
                    var qty = $("#edit-quantity").val();
                    var prc = $("#edit-price").val();
                    $.ajax({
                        url:"function/listing_edit.php",
                        method:"POST",
                        data:{listing_id:product,quantity:qty,price:prc},
                        dataType:"html",
                        success:function(data) {
                            $("#quantity-"+product).text(qty);
                            $("#price-"+product).text(prc);
                            $("#total-price-"+product).text((prc * qty).toFixed(2));
                            closeModal();
                        },
                        error:function(){
                            alert("Something went wrong");
                        }
                    });
                });

                $(document).on('click', '.edit-btn', function() {
                    var id = $(this).attr('id');
                    openModal(id);
                });

                $(document).on('click','.close-sale-modal', function() {
                    closeModal();
                });

                $('.close-sale-modal').on('click', function() {
                    closeModal();
                });

                $('.modal').on('click', function(e) {
                    if (e.target !== this)
                        return;
                    closeModal();
                });

                function openModal(id) {
                    $("#quantity-modal").attr("style","display:flex");
                    var quantity = parseFloat(document.getElementById("quantity-"+id).textContent);
                    var price = parseFloat(document.getElementById("price-"+id).textContent);
                    document.getElementById("edit-quantity").value = quantity;
                    document.getElementById("edit-price").value = price;
                    document.getElementsByClassName("edit-submit")[0].id = id;
                };
                
                function closeModal() {
                    $("#quantity-modal").attr("style","display:none");
                };

                var table = $('#myTable').DataTable({
                    lengthChange: false,
                    dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
                    buttons: [
                        'copy',
                        'excel',
                        'pdf',
                        'colvis',
                    ],
                });
                table.buttons().container()
                    .appendTo( '#myTable_wrapper .col-md-6:eq(0)' );
            });
        </script>
        <title>Inventory | Qcut</title>
    </head>
    <body>
    <?php include "include/navbar.php"; ?>
        <div class="main-content">
            <div class="container main-container">
                <div class="row g-1">
                    <div class="col-md-2 store-info-container">
                        <div class="store-info internal-div" style='font-size:1.3vw;'>  
                            <?php echo $_SESSION['store']; ?> Inventory
                        </div>
                        <div class="store-info internal-div dashboard-module" style='height:150px;'> 
                                <p class='m-0 label' style='font-size:1.3vw'>
                                    Products Listed
                                </p>
                                <p class="dashboard-data">
                                <?php
                                    $store = $_SESSION['store_id'];
                                    $inventory_listings = mysqli_query($link,"SELECT * FROM inventory_listing where store=$store");
                                    $inventory_count=mysqli_num_rows($inventory_listings);
                                    echo $inventory_count;
                                ?>
                                </p>
                        </div>
                        <div class="store-info internal-div dashboard-module" style='height:150px;'> 
                                <p class='m-0 label' style='font-size:1.3vw'>
                                <?php
                                    $low_threshold = 100; //Quantity required to not be considered low.
                                    echo "Low Stock Items (<".$low_threshold.")";
                                ?>
                                </p>
                                <p class="dashboard-data" style='color:orange'>
                                <?php
                                    $low_inventory_listings = mysqli_query($link,"SELECT * FROM inventory_listing where store=$store AND quantity < 100");
                                    $low_inventory_count=mysqli_num_rows($low_inventory_listings);
                                    echo $low_inventory_count;
                                ?>
                                </p>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class='internal-div'>
                            <div class="table-container">
                                <table class="table-proper table table-striped" id='myTable' style='width:100%;'>
                                    <thead class='table-dark'>
                                        <tr>
                                            <td class="table-date theader" style='width:30%'>Product Name</td>
                                            <td class="table-quantity theader" style='width:10%'>Quantity</td>
                                            <td class="table-price theader" style='width:20%'>Individual Price</td>
                                            <td class="table-total-value theader" style='width:20%'>Total Value</td>
                                            <td class="table-barcode theader" style='width:20%'>Barcode</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $store = $_SESSION['store_id'];
                                            $sql = "SELECT * FROM inventory_listing WHERE store=$store";
                                            $productList = $link->query($sql);
                                            if ($productList->num_rows > 0) {
                                                while($product_listing=mysqli_fetch_array($productList)):
                                                    $product_id = $product_listing['product'];
                                                    $product = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM product WHERE id=$product_id"));
                                        ?>
                                        <tr <?php if($product_listing['quantity']<$low_threshold){ echo "style='color:orange;'"; } ?>>
                                            <td class="table-name" style='width:30%'><?php echo $product['name']; ?></td>
                                            <td class="table-quantity" id='quantity-<?php echo $product_listing['id']; ?>' style='width:10%'><?php echo $product_listing['quantity']; ?></td>
                                            <td class="table-price" id='price-<?php echo $product_listing['id']; ?>' style='width:20%'><?php echo $product_listing['price']; ?></td>
                                            <td class="table-total-value" id='total-price-<?php echo $product_listing['id']; ?>' style='width:20%'><?php echo $product_listing['quantity'] * $product_listing['price']; ?></td>
                                            <td class="table-barcode" style='width:20%'><?php echo $product['barcode']; ?><button class='btn edit-btn' id="<?php echo $product_listing['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                        </tr>
                                        <?php
                                                endwhile;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id='quantity-modal'>
            <div class="sale-info" id="sale-info" style='display:flex; flex-direction:column; justify-content:center; height:370px; width:350px;'>
                <div style='margin-top:10px; font-size:25px;'>
                    <div id='product-name' style='font-weight:bold;'>
                        Product Name
                    </div>
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <div>
                        Quantity
                    </div>
                    <input name='quantity' id='edit-quantity' type="number" step="0.01">
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <div>
                        Price
                    </div>
                    <input name='price' id='edit-price' type="number" step="0.01">
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <button class='btn btn-secondary close-sale-modal' style='position:static;'>Return</button>
                    <button type="button" value='Edit' class='edit-submit btn btn-primary' id=''><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                </div>
            </div>
        </div>
    </body>
</html>