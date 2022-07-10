<?php 
   include('include/header.php');
   include "include/navbar.php";
   $Ex_category = "SELECT * FROM category_expenses ";
   $result = mysqli_query($con, $Ex_category);
   $exCatList='';
   while($arr = mysqli_fetch_array($result))
   {
   $exCatList .= '

<option value="'.$arr["category"].'">'.$arr["category"].'</option>';
   }
   ?>

<body>
    <!-- Rounded tabs -->
    <?php $month = date("m");
$day = date("d");
$year = date("Y");

$today = $year . "-" . $month . "-" . $day;
?>




    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/tab.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="p-5 bg-white rounded shadow mb-5">
             <?php include('ledgerTab/expenses.php')?>
            </div>
            <!-- ============================================================== -->
        </div>
    </div>
</body>

<script src="ledgerTab/js/expenses.js"></script>

</html> <?php
include('modal/expenseModal.php');
?>
<!-- for date filter -->

<div class="modal fade viewExpenseCat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table" id='transaction_record'>
                        <?php
                                    $record  = mysqli_query($con, "SELECT * from category_expenses ORDER BY id DESC LIMIT 5 "); ?>
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Category Name</th>
        
                            </tr>
                        </thead>
                        <tbody> <?php while ($row = mysqli_fetch_array($record)) { ?> <tr>
                                <th scope="row"> <?php echo $row['id']?> </th>
                                <td> <?php echo $row['category']?> </td>
                               
                            </tr> <?php } ?> </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>