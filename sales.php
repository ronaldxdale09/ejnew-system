<!DOCTYPE html>
<?php 
    include "function/db.php"; 

?>
<html>
    <head>
        <?php
            include "include/bootstrap.php";
            include "include/jquery.php";
            include "include/datatables_buttons_css.php";
        ?>
        <link rel='stylesheet' href='css/index.css'>
        <link rel='stylesheet' href='css/sales.css'>        
        <?php include "include/datatables_buttons_js.php"; ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function(){
                //Load Cart when Clicking cart from the list
                $(document).on('click', '.sale', function() {
                    var cart = $(this).attr('id');
                    $.ajax({
                        url:"function/get_cart.php",
                        method:"POST",
                        data:{cart_id:cart},
                        dataType:"html",
                        success:function(data) {
                            $("#sale-info").html(data);
                            $("#sale-modal").attr("style","display:flex");
                        },
                        error:function(){
                            alert("Something went wrong");
                        }
                    });
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

                function closeModal() {
                    $("#sale-modal").attr("style","display:none");
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
        <title>Sales | Qcut</title>
    </head>
    <body>
    <?php include "include/navbar.php"; ?>
        <div class="main-content">
            <div class="container main-container">
                <div class="row g-1">
                    <div class="col-md-3">
                        <div class="store-info internal-div" style='font-size:1.3vw;'>  
                            <?php echo $_SESSION['store']; ?> Sales
                        </div>
                        <div class="store-info internal-div dashboard-module" style='height:400px;'> 
                            <canvas id="pie" style="width:100%;max-width:100%; height:100%;"></canvas>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class='internal-div'>
                            <div class="table-container">
                                <table id='myTable' class="table-proper table table-striped" style='width:100%;'>
                                    <thead class='table-dark'>
                                        <tr>
                                            <td class="table-date theader text-center">Transaction Date</td>
                                            <td class="table-total theader">Sales Total</td>
                                            <td class="table-status theader text-center">Transaction Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT * FROM cart WHERE status='TRANSACTED'";
                                            $salesList = $link->query($sql);
                                            if ($salesList->num_rows > 0) {
                                                while($sale=mysqli_fetch_array($salesList)):
                                        ?>
                                        <tr id="<?php echo $sale['id']; ?>" class='sale'>
                                            <td class="table-date text-center">
                                                <?php
                                                    echo $sale['date_transacted']." ";
                                                    $datetimesent = new DateTime($sale['date_transacted']);
                                                    //echo $datetimesent->format('D, M j, \'y, h:i A');  
                                                ?>
                                            </td>
                                            <td class="table-total" style='padding-right:10px;'>
                                                <?php
                                                    echo "PHP ".$sale['final_total'];
                                                ?>
                                            </td>
                                            <td class="table-status text-center">
                                                <?php
                                                    echo $sale['status'];
                                                ?>
                                            </td>
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
        <div class="modal" id='sale-modal'>
        <button class='btn close-sale-modal'><i class='fa fa-close'></i></button>
            <div class="sale-info" id="sale-info">
                <!-- Sale Info Output -->
            </div>
        </div>
        <script>
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
    </body>
</html>