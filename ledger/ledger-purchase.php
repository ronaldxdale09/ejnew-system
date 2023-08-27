<?php 
   include('include/header.php');
   include "include/navbar.php";

   // purchase category

   $pur_category = "SELECT * FROM purchase_category ";
   $pur_result = mysqli_query($con, $pur_category);
   $purCatList='';
   while($array = mysqli_fetch_array($pur_result))
   {
   $purCatList .= '
<option value="'.$array["category"].'">'.$array["category"].'</option>';
   }

   $sql = mysqli_query($con, "SELECT SUM(total_amount) AS total_amount from ledger_purchase  WHERE DATE(`date`) = CURDATE()  "); 
   $purchase_today = mysqli_fetch_array($sql);

   if ($purchase_today['total_amount'] == null || $purchase_today['total_amount'] == ''){
    $purchase_today['total_amount'] = 0;
   }
   
   $getMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(total_amount) as month_total 
   from ledger_purchase  group by year(date), month(date) ORDER BY ID DESC");
   $purchase_month = mysqli_fetch_array($getMonthTotal);

   ?>


<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-12">
                        <br>
                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">GENERAL </font>
                                <font color="#046D56"> PURCHASE </font>
                            </b>
                        </h2>
                        <br>
                        <?php include('ledgerTab/purchase.php')?>
                    </div>
                    <!-- ============================================================== -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!-- Bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>

<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
<script src="ledgerTab/js/purchase.js"></script>
<?php
include('modal/modal_purchase.php');
?>

<script>
$('#purchase-modal').on('shown.bs.modal', function() {
    $('.pur_category', this).chosen();
});
</script>


<script>
pie = document.getElementById("ca_pie");

<?php
           $expenses_count = mysqli_query($con,"SELECT year(date) as year ,MONTHNAME(date) as monthname,sum(total_amount) as month_total , category as category from ledger_purchase  group by category ORDER BY date");        
           if($expenses_count->num_rows > 0) {
             foreach($expenses_count as $data) {
                $category[] = $data['category'];
                 $month[] = $data['monthname'];
                 $expense[] = $data['month_total'];
             }
         }
        ?>

new Chart(pie, {
    options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Purchases',
            },
        },
    },
    type: 'doughnut', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($category) ?>,
        datasets: [{
            data: <?php echo json_encode($expense) ?>,
            backgroundColor: [
                'rgb(0, 153, 51)',
                'rgb(102, 153, 153)',
                'rgb(255, 204, 0)',
                'rgb(255, 0, 0)',
            ],
            borderColor: 'black',
            fill: false, //Fills the curve under the line with the babckground color. It's true by default
        }]
    },
});
</script>