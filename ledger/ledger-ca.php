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