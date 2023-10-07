<?php
include('include/header.php');
include "include/navbar.php";

// purchase category
$query = "SELECT * FROM ledger_buying_station";
$result = mysqli_query($con, $query);
$buyingStation = '';
while ($array = mysqli_fetch_array($result)) {
    $buyingStation .= '
<option value="' . $array["name"] . '">' . $array["name"] . '</option>';
}


?>

<!-- Bootstrap -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<!-- Bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab.css'>
    <input type='hidden' id='selected-cart' value=''>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">CASH </font>
                                <font color="#046D56"> ADVANCES </font>
                            </b>
                        </h2>
                        <br>

                        <?php include('ledgerTab/cash-advance.php') ?>
                    </div>
                    <!-- ============================================================== -->
                </div>
            </div>
    </div>
</body>

</html>

<script src="ledgerTab/js/ca.js"></script>
<?php
include('modal/modal_cashadvance.php');
?>