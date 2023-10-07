<?php
include('include/header.php');
include "include/navbar.php";

// purchase category

$pur_category = "SELECT * FROM purchase_category ";
$pur_result = mysqli_query($con, $pur_category);
$purCatList = '';
while ($array = mysqli_fetch_array($pur_result)) {
    $purCatList .= '
<option value="' . $array["category"] . '">' . $array["category"] . '</option>';
}


?>


<body>
    <link rel='stylesheet' href='css/tab.css'>
    <input type='hidden' id='selected-cart' value=''>
   
        <div class="container home-section h-100" style="max-width:95%;">
                <br>
                <h2 class="page-title">
                    <b>
                        <font color="#0C0070">GENERAL </font>
                        <font color="#046D56"> PURCHASE </font>
                    </b>
                </h2>
                <br>
                <?php include('ledgerTab/purchase.php') ?>
        </div>
</body>

</html>
<!-- Bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>

<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
<?php
include('modal/modal_purchase.php');
?>

<script>
    $('#purchase-modal').on('shown.bs.modal', function() {
        $('.pur_category', this).chosen();
    });
</script>

