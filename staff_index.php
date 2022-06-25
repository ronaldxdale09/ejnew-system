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
        <link rel='stylesheet' href='css/dashboard.css'>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <title>Dashboard | Qcut</title>
    </head>
    <body>
    <?php include "include/navbar.php"; ?>
        <div class="main-content">
            <div class="container main-container">
                <div class="row g-1">
                    <div class="col-md-4">
                        <div class='internal-div' style='height:597px;'>
                            <div style='font-weight:bold; font-size:30px; padding-left:10px;'>
                                <?php echo $_SESSION['store']; ?>
                            </div>
                            <canvas id="pie" style="width:100%;max-width:100%; height:100%;"></canvas>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-1" style='margin-bottom:5px; height:150px;'>
                            <div class="col-md-4">
                                <div class='internal-div h-100 dashboard-module'>
                                    <p class='m-0 label'>Total Customers</p>
                                    <p class="dashboard-data">
                                    <?php
                                        $customers = mysqli_query($link,"SELECT * FROM customer");
                                        $customer_count=mysqli_num_rows($customers);
                                        echo $customer_count;
                                    ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class='internal-div h-100 dashboard-module'>
                                    <p class='m-0 label'>Sales Today</p>
                                    <p class='dashboard-data'>
                                    <?php
                                        $sales_count = mysqli_query($link,"SELECT * FROM cart WHERE DATE(date_transacted) = CURDATE() AND status='TRANSACTED'");
                                        $sales_today=mysqli_num_rows($sales_count);
                                        echo $sales_today;
                                    ?>
                                    </p>
                                    <?php
                                        $sales_count = mysqli_query($link,"SELECT * FROM cart WHERE DATE(date_transacted) = CURDATE() - INTERVAL 1 DAY AND status='TRANSACTED'");
                                        $sales_yesterday=mysqli_num_rows($sales_count);
                                        $sales_comparison = $sales_today - $sales_yesterday;
                                        if($sales_comparison < 0){
                                            echo "  
                                                    <p class='dashboard-comparison m-0' style='color:red'>
                                                        $sales_comparison from yesterday
                                                    </p>
                                                    ";
                                        }
                                        else{
                                            echo "  <p class='dashboard-comparison m-0' style='color:lightgreen'>
                                                        + $sales_comparison from yesterday
                                                    </p>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class='internal-div h-100 dashboard-module'>
                                    <p class='m-0 label'>Sales This Month</p>
                                    <p class='dashboard-data'>
                                    <?php
                                        $sales_count = mysqli_query($link,"SELECT * FROM cart WHERE MONTH(date_transacted) = MONTH(CURDATE()) AND status='TRANSACTED'");
                                        $sales_tomonth=mysqli_num_rows($sales_count);
                                        echo $sales_tomonth;
                                    ?>
                                    </p>
                                    <?php
                                        $sales_count = mysqli_query($link,"SELECT * FROM cart WHERE MONTH(date_transacted) = MONTH(CURDATE()) - INTERVAL 1 MONTH AND status='TRANSACTED'");
                                        $sales_yestermonth = mysqli_num_rows($sales_count);
                                        $sales_comparison = $sales_tomonth - $sales_yestermonth;
                                        if($sales_comparison < 0){
                                            echo "  
                                                    <p class='dashboard-comparison m-0' style='color:red'>
                                                        $sales_comparison from last month
                                                    </p>
                                                    ";
                                        }
                                        else{
                                            echo "  <p class='dashboard-comparison m-0' style='color:green'>
                                                        + $sales_comparison from last month
                                                    </p>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row g-1" style='margin-bottom:5px; height:150px;'>
                            <div class="col-md-2">
                                <div class='internal-div h-100 dashboard-module'>
                                    <p class='m-0 label' style='font-size:1vw'>Registered Products</p>
                                    <p class="dashboard-data">
                                    <?php
                                        $store = $_SESSION['store_id'];
                                        $inventory_listings = mysqli_query($link,"SELECT * FROM inventory_listing where store=$store");
                                        $inventory_count=mysqli_num_rows($inventory_listings);
                                        echo $inventory_count;
                                    ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class='internal-div h-100 dashboard-module'>
                                    <p class='m-0 label' style='font-size:1vw'>
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
                            <div class="col-md-4">
                                <div class='internal-div h-100 dashboard-module' style='position:relative;'>
                                    <p class='m-0 label' style='font-size:1vw'>Revenue Today</p>
                                    <p class="dashboard-data" style='color:green; font-size:1.6vw;'>
                                    <?php
                                        $revenue = mysqli_fetch_array(mysqli_query($link,"SELECT SUM(final_total) as total_revenue FROM cart WHERE DATE(date_transacted) = CURDATE()"));
                                        echo "PHP ".round($revenue['total_revenue'],2);
                                    ?>
                                    </p>
                                    <?php
                                        $revenue_yesterday = mysqli_fetch_array(mysqli_query($link,"SELECT SUM(final_total) as total_revenue FROM cart WHERE DATE(date_transacted) = CURDATE() - INTERVAL 1 DAY"));
                                        $revenue_comparison = $revenue['total_revenue'] - $revenue_yesterday['total_revenue'];
                                        $revenue_comparison = round($revenue_comparison,2);
                                        if($revenue_comparison < 0){
                                            echo "  
                                                    <p class='dashboard-comparison m-0' style='color:red;'>
                                                        $revenue_comparison from yesterday
                                                    </p>
                                                    ";
                                        }
                                        else{
                                            echo "  <p class='dashboard-comparison m-0' style='color:green;'>
                                                        + $revenue_comparison from yesterday
                                                    </p>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class='internal-div h-100 dashboard-module' style='position:relative;'>
                                    <p class='m-0 label' style='font-size:1vw'>Total Revenue</p>
                                    <p class="dashboard-data" style='color:green; font-size:1.6vw; position:absolute; right:10px;'>
                                    <?php
                                        $revenue = mysqli_fetch_array(mysqli_query($link,"SELECT SUM(final_total) as total_revenue FROM cart"));
                                        echo "PHP ".round($revenue['total_revenue'],2);
                                    ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row g-1" style='height:300px;'>
                            <div class="col-md-12">
                                <div class='internal-div h-100'>
                                    <canvas id="plots" style="width:100%;max-width:100%; height:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        // Get the HTML canvas by its id 
        plots = document.getElementById("plots");
        pie = document.getElementById("pie");
        // Example datasets for X and Y-axes 
        <?php
            $days = [];
            $sales = [];
            for($i = 0; $i < 7; $i++){
                $sales_count = mysqli_query($link,"SELECT * FROM cart WHERE DATE(date_transacted) = CURDATE() - INTERVAL $i DAY AND status='TRANSACTED'");
                $day = mysqli_fetch_array(mysqli_query($link,"SELECT DAYNAME(CURDATE() - INTERVAL $i DAY) AS week_day"));
                $days[$i] = $day['week_day'];
                $sales[$i] = mysqli_num_rows($sales_count);
            }
        ?>
        var days = [<?php for($i = 6; $i >= 0; $i--){ echo '\''.$days[$i].'\''.','; } ?>]; //Stays on the X-axis 
        var sales = [<?php for($i = 6; $i >= 0; $i--){ echo $sales[$i].','; } ?>] //Stays on the Y-axis 
        // Create an instance of Chart object:
        new Chart(plots, {
                options: {
                    plugins:{
                        title:{
                            display:true,
                            text: 'Past Week Sales History',
                        },
                    },
                },
                type: 'line', //Declare the chart type 
                data: {
                labels: days, //X-axis data 
                datasets: [{
                    label:'Sales',
                    data: sales, //Y-axis data 
                    backgroundColor: '#f26c4f',
                    borderColor: '#f26c4f',
                    tension: 0.3,
                    fill: false, //Fills the curve under the line with the babckground color. It's true by default
                }]
            },
        });
        <?php
            $sql = mysqli_query($link,"SELECT * FROM cart WHERE status='TRANSACTED'");
            $num_transacted=mysqli_num_rows($sql);
            $sql = mysqli_query($link,"SELECT * FROM cart WHERE status='OPEN'");
            $num_open=mysqli_num_rows($sql);
            $sql = mysqli_query($link,"SELECT * FROM cart WHERE status='CANCEL'");
            $num_cancel=mysqli_num_rows($sql);
            $sql = mysqli_query($link,"SELECT * FROM cart WHERE status='CONFIRMED'");
            $num_confirmed=mysqli_num_rows($sql);
        ?>
        new Chart(pie, {
                options: {
                    plugins:{
                        title:{
                            display:true,
                            text: 'Digi Carts Distribution',
                        },
                    },
                },
                type: 'doughnut', //Declare the chart type 
                data: {
                labels: [
                    'Open',
                    'Transacted',
                    'Waiting',
                    'Cancelled',
                ],
                datasets: [{
                    label:'Carts',
                    data:[<?php echo $num_transacted.",".$num_open.",".$num_confirmed.",".$num_cancel ?>],
                    backgroundColor: [
                        'rgb(0, 153, 51)',
                        'rgb(102, 153, 153)',
                        'rgb(255, 204, 0)',
                        'rgb(153, 0, 0)'
                    ],
                    borderColor: 'black',
                    fill: false, //Fills the curve under the line with the babckground color. It's true by default
                }]
            },
        });
    </script>
</html>