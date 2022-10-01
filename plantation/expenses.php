<?php 
   include('include/header.php');
   include "include/navbar.php";

  


     // TOTAL CASH ADVANCE
     $CA_count = mysqli_query($con,"SELECT * FROM rubber_cashadvance ");
     $ca_no=mysqli_num_rows($CA_count);

     
    $results = mysqli_query($con, "SELECT SUM(cash_advance) as total from rubber_seller"); 
    $row = mysqli_fetch_array($results);
   


   ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <link rel='stylesheet' href='css/expenses.css'>


    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <div class="container-fluid">

                    <div class="inventory-table">
                        <div class="expenses-box">

                            <div class="flex-2">
                                <div class="inventory-table">
                                    <div class="flex-2-header-button">
                                        <div class="button-left">
                                            <button type="button" class="btn btn-success btn-md" data-bs-toggle="modal"
                                                data-bs-target="#createNew">Create New</button>
                                            <button type="button" class="btn btn-warning btn-md">Category</button>
                                        </div>
                                        <div class="button-right">
                                            <select name="" id="">
                                                <option value="">Category</option>
                                                <option value="">All</option>
                                                <option value="">Category</option>
                                            </select>
                                            <h5> Date Filter</h5>
                                            <input type="text" id="min" name="min" placeholder="From Date" />
                                            <input type="text" id="max" name="max" placeholder="To Date" />
                                        </div>
                                    </div>
                                    <?php
                        $results  = mysqli_query($con, "SELECT * from tbl_expenses "); ?>
                                    <table id="expenses_table" class="table table-hover" style="width:100%">
                                        <thead class="table-dark">
                                            <tr style='font-size:14px'>
                                                <th>Action</th>
                                                <th>No.</th>
                                                <th>Particular</th>
                                                <th>Category</th>
                                                <th>Voucher No.</th>
                                                <th>Date of Transaction</th>
                                                <th>Date of Payment</th>
                                                <th>Amount</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($results)) { ?>
                                            <tr>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#editTableRow"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteTableRow"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                                <td><?php echo $row['expense_id']; ?></td>
                                                <td><?php echo $row['particular']; ?></td>
                                                <td><?php echo $row['expense_category']; ?></td>
                                                <td><?php echo $row['voucher_no']; ?></td>
                                                <td><?php echo $row['date_transaction']; ?></td>
                                                <td><?php echo $row['date_payment']; ?></td>
                                                <td><?php echo number_format((float)$row['amount'], 2, '.', ',');  ?>
                                                </td>

                                            </tr>

                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="top">
                                    <div class="top-bar">
                                        <h4>Operating Expenses</h4>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewOperating">View All</button>
                                    </div>
                                    <small>AUGUST 2022</small>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Category
                                </div>
                                </th>
                                <th scope="col">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Salaries & allowances</td>
                                        <td>P 123,000</td>
                                    </tr>
                                    <tr>
                                        <td>Marketing expenses</td>
                                        <td>P 123,000</td>
                                    </tr>
                                    <tr>
                                        <td>Utilities</td>
                                        <td>P 123,000</td>
                                    </tr>
                                    <tr>
                                        <td>Office supplies</td>
                                        <td>P 123,000</td>
                                    </tr>
                                </tbody>

                                </table>
                            </div>
                            <div class="bottom">
                                <div class="card-body">
                                    <canvas id="expense_chart" style="width: 100%; height: 300px"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html> <?php
include('modal/cashadvanceModal.php');
?>
<script type="text/javascript" src="js/copra-ca.js"></script>