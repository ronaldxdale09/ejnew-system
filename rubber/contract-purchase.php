<?php 
   include('include/header.php');
   include "include/navbar.php";

 

   $getMonthTotal  = mysqli_query($con, "SELECT   year(date) as year,month(date) as month,sum(balance) as month_total 
   from wet_rubber_contract  group by year(date), month(date) ORDER BY ID DESC");
   $sumPurchaced_Copra = mysqli_fetch_array($getMonthTotal);

   $month = date("F");
$day = date("d");
$year = date("Y");

//    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
//    $monthName = $dateObj->format('F');
     //PENDING CONTRACT
     $pendingContract_count = mysqli_query($con,"SELECT * FROM wet_rubber_contract where status='PENDING' OR status='UPDATED'");
     $contract=mysqli_num_rows($pendingContract_count);


   ?>

<body>
    <link rel='stylesheet' href='css/statistic-card.css'>
    <input type='hidden' id='selected-cart' value=''>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-sm-3 offset-sm-0">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">PURCHASED CONTRACT BALANCE</p>
                                    <h2><i class="text-danger font-weight-bold mr-1"></i>
                                        <?php echo ($sumPurchaced_Copra['month_total']); ?> KG
                                    </h2>
                                    <div>
                                        <span class="text-muted"> <?php echo $month; ?>
                                            <?php echo $year; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--success">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted">Pending Contracts</p>
                                    <h2><?php echo $contract; ?> </h2>
                                    <div>
                                        <span class="text-muted">OVERALL EXPENSES</span>
                                    </div>
                                </div>
                                <div class="stat-card__icon stat-card__icon--primary">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-book"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- CONTENT -->
                                    <div class="row">
                                        <div class="col-5">
                                            <button type="button" class="btn btn-success text-white" data-toggle="modal"
                                                data-target="#newContract">
                                                <i class="fa fa-add" aria-hidden="true"></i> NEW CONTRACT </button>
                                        </div>
                                        <div class="col">
                                           <h5> Date Filter</h5>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" id="min" name="min" class="form-control"
                                                placeholder="From Date" />
                                        </div>
                                        <div class="col-3">
                                            <input type="text" id="max" name="max" class="form-control"
                                                placeholder="To Date" />
                                        </div>
                                    </div>
                                    <br>
                                    <h6 class="card-title m-t-40">
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>List of
                                        Purchase Contract
                                    </h6>


                                    <div class="table-responsive">
                                        <table class="table" id='contractTable'> <?php
                                    $results  = mysqli_query($con, "SELECT * from wet_rubber_contract WHERE status='PENDING' OR status='UPDATED' "); 
                                    
                                    ?> <thead class="table-dark">
                                                <tr>
                                                    <th width="10%">Date</th>
                                                    <th width="10%">Contact No.</th>
                                                    <th width="15%">Seller</th>
                                                    <th scope="col">Quantity</th>
                                                    <th hidden scope="col">Delivered</th>
                                                    <th scope="col">Balance</th>
                                                    <th scope="col">₱/KG</th>
                                                    <th scope="col">Status</th>
                                       
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <th scope="row"> <?php echo $row['date']?> </th>
                                                    <td> <?php echo $row['contract_no']?> </td>
                                                    <td> <?php echo $row['seller']?> </td>
                                                    <td> <?php echo $row['contract_quantity']?> Kg</td>
                                                    <td hidden> <?php echo $row['delivered']?> </td>
                                                    <td> <?php echo $row['balance']?> Kg</td>
                                                    <td>₱ <?php echo $row['price']?> </td>
                                                    <td>
                                                        <h5><span
                                                                class="badge bg-success"><?php echo $row['status']?></span>
                                                        </h5>
                                                    </td>
                                                 
                                                </tr> <?php } ?> </tbody>
                                        </table>
                                    </div>
                                    <!-- END CONTENT -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html> <?php
include('modal/contractModal.php');
?> <script>
$('#newContract').on('shown.bs.modal', function() {
    $('.select_seller', this).chosen();
});


var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[0]);

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });
    var table = $('#contractTable').DataTable({
        dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
        buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4,5,6,7]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4,5,6,7]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4,5,6,7]
                }
            },

        ],
        lengthChange: false,
        orderCellsTop: true,



    });
    $('#min, #max').on('change', function() {
        table.draw();
    });



});
</script>