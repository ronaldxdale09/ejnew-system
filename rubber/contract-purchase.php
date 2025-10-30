<?php
include('include/header.php');
include "include/navbar.php";


$loc = str_replace(' ', '', $_SESSION['loc']);

$getMonthTotal  = mysqli_query($con, "SELECT year(date) as year, month(date) as month, sum(balance) as month_total from rubber_contract WHERE loc='$loc' group by year(date), month(date) ORDER BY ID DESC");

if (mysqli_num_rows($getMonthTotal) > 0) {
    $sumPurchaced_Copra = mysqli_fetch_array($getMonthTotal);
    // ... rest of your code that uses $sumPurchaced_Copra
} else {
    // Handle the case where the query returns no results
    $sumPurchaced_Copra = ['month_total' => 0];
}
$month = date("F");
$day = date("d");
$year = date("Y");

//    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
//    $monthName = $dateObj->format('F');
//PENDING CONTRACT
$pendingContract_count = mysqli_query($con, "SELECT * FROM rubber_contract where loc='$loc' and status='PENDING' OR status='UPDATED'");
$contract = mysqli_num_rows($pendingContract_count);


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
                                    <p class="text-uppercase mb-1 text-muted"><b><?php echo $month; ?>
                                            <?php echo $year; ?> </b> CONTRACTS</p>
                                            <h2><i class="text-danger font-weight-bold mr-1"></i><?php echo number_format($sumPurchaced_Copra['month_total'], 0, '', ','); ?> KG</h2>
                                        KG
                                    </h2>
                                    <div>
                                        <span class="text-muted">
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

                        <div class="col-sm-3 offset-sm-0">
                            <div class="stat-card">
                                <div class="stat-card__content">
                                    <p class="text-uppercase mb-1 text-muted"><b><?php echo $month; ?>
                                            <?php echo $year; ?> </b> BALANCE</p>
                                    <h2>
                                        <!-- WHY COPRA -->
                                        <!-- <i
                                            class="text-danger font-weight-bold mr-1"></i><?php echo number_format($sumPurchaced_Copra['month_total'], 0, '', ',') ?> -->
                                        KG
                                    </h2>
                                    <div>
                                        <span class="text-muted">
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
                                            <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#newContract">
                                                <i class="fa fa-add" aria-hidden="true"></i> NEW CONTRACT </button>
                                        </div>
                                        <div class="col">
                                            <h6> Date <br> Filter</h6>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" id="min" name="min" class="form-control" placeholder="From Date" />
                                        </div>
                                        <div class="col-3">
                                            <input type="text" id="max" name="max" class="form-control" placeholder="To Date" />
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="table-responsive">
                                        <table class="table" id='contractTable'> <?php
                                                                                    $results  = mysqli_query($con, "SELECT * from rubber_contract  where loc='$loc' ");

                                                                                    ?> <thead class="table-dark">
                                                <tr>
                                                    <th width="10%">Contract No.</th>
                                                    <th scope="col">Type</th>
                                                    <th width="10%">Date</th>
                                                    <th width="15%">Supplier</th>
                                                    <th scope="col">Contract Qty</th>
                                                    <th hidden scope="col">Delivered</th>
                                                    <th scope="col">Remaining Qty</th>
                                                    <th scope="col">Contract Price</th>
                                                    <th scope="col">Status</th>
                                                    <th>Action</th>
                                                    <th hidden></th>
                                                </tr>
                                            </thead>
                                            <tbody> <?php while ($row = mysqli_fetch_array($results)) {
                                                        $hidden = '';
                                                        if ($row['status'] == 'PENDING') {
                                                            $status = 'warning';
                                                        } else if ($row['status'] == 'UPDATED') {
                                                            $status = 'primary';
                                                        } else if ($row['status'] == 'COMPLETED') {
                                                            $status = 'success';
                                                            $hidden = 'hidden';
                                                        }


                                                    ?> <tr>
                                                        <td> <?php echo $row['contract_no'] ?> </td>
                                                        <td><?php echo $row['type'] ?></td>
                                                        <td scope="row"> <?php echo $row['date'] ?> </td>
                                                        <td> <?php echo $row['seller'] ?> </td>
                                                        <td> <?php echo number_format($row['contract_quantity']) ?> kg</td>
                                                        <td hidden> <?php echo number_format($row['delivered']) ?> </td>
                                                        <td> <?php echo number_format($row['balance']) ?> kg</td>
                                                        <td>₱ <?php echo number_format($row['price'], 2) ?> </td>
                                                        <td>
                                                            <h5><span class="badge bg-<?php echo $status ?>"><?php echo $row['status'] ?></span>
                                                            </h5>
                                                        </td>

                                                        <td>
                                                            <button type="button" class="btn btn-secondary text-white editBtn" <?php echo $hidden ?>>
                                                                <i class='fa-solid fa-edit'></i> </button>

                                                            <button type="button" class="btn btn-danger text-white deleteBtn" <?php echo $hidden ?>>
                                                                <i class='fa-solid fa-remove'></i> </button>
                                                        </td>
                                                        <td hidden> <?php echo $row['id'] ?> </td>

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
            order: [
                [1, 'desc']
            ],
            buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
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




<script>
    $(document).ready(function() {
        $('.editBtn').on('click', function() {


            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#m_id').val(data[10]);
            $('#m_date').val(data[0]);
            $('#m_contact').val(data[1]);
            $('#m_name').val(data[2]);
            $('#m_type').val(data[8]);
            // document.getElementById("m_type").value = data[8];
            var quantity = data[3].replace(/[^0-9\.]+/g, "");
            $('#m_quantity').val(quantity);

            var price = data[6].replace(/[^0-9\.]+/g, "");
            $('#m_price').val(price);

            $('#editContract').modal('show');

        });
        $('.deleteBtn').on('click', function() {


            $('#deleteRec').modal('show');
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();


            $('#d_contract').val(data[1]);


            $('#d_id').val(data[10]);

        });


    });
</script>



<?php if (isset($_SESSION['update'])) : ?>
    <div class="msg">

        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Contract has been Updated!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
        <?php
        unset($_SESSION['update']);
        ?>
    </div>
<?php endif ?>


<?php if (isset($_SESSION['deleted'])) : ?>
    <div class="msg">

        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Contract has been deleted!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
        <?php
        unset($_SESSION['deleted']);
        ?>
    </div>
<?php endif ?>