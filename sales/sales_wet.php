<?php 
   include('include/header.php');
   include "include/navbar.php";



    $tab= '';
    if (isset($_GET['tab'])) {
        $tab = filter_var($_GET['tab']) ;
      }
   ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/record-tab.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">

            <!-- ============================================================== -->
            <div class="container-fluid">

                <div class="row">
                    <h2 class="page-title"><B>
                            <font color="#0C0070"> CUPLUMP </font>
                            <font color="#046D56"> EXPORT SALE </font>
                        </b></h2>
                    <div class="inventory-table">
                        <div class="container-fluid">
                            <div class="wrapper" id="myTab">
                                <div class="title"><?php include('sales/wet_sales.php');?> </div>
                            </div>

                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>

</body>

</html>



<script>
$('.btnInventory').on('click', function() {
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    // $('#prod_trans_id').val(data[1]);
    // $('#prod_trans_date').val(data[2]);
    // $('#prod_trans_supplier').val(data[3]);
    // $('#prod_trans_loc').val(data[4]);
    // $('#prod_trans_lot').val(data[5]);


    // $('#prod_trans_entry').val(parseFloat(data[6]).toLocaleString());

    // $('#prod_trans_drc').val(data[8]);
    // $('#prod_trans_total_weight').val(data[7]);

    function fetch_data() {

        $.ajax({
            url: "table/field-inventory.php",
            method: "POST",
            success: function(data) {
                $('#inventory_table').html(data);
               

            }
        });
    }
    fetch_data();

    $('#inventoryModal').modal('show');

});
</script>

<?php    include "sales_modal/wet_modal_sales.php";?>