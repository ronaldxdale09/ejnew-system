<?php 
   include('include/header.php');
   include "include/navbar.php";

  


     // TOTAL CASH ADVANCE
     $CA_count = mysqli_query($con,"SELECT * FROM copra_cashadvance where status='PENDING'");
     $ca_no=mysqli_num_rows($CA_count);

     
    $results = mysqli_query($con, "SELECT SUM(cash_advance) as total from seller"); 
    $row = mysqli_fetch_array($results);
   


   ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                                    <p class="text-uppercase mb-1 text-muted">Cash Advance</p>
                                    <h2><i class="text-danger font-weight-bold mr-1"></i>
                                        ₱ <?php echo number_format($row['total']); ?>
                                    </h2>

                                </div>
                                <div class="stat-card__icon stat-card__icon--success">
                                    <div class="stat-card__icon-circle">
                                        <i class="fa fa-info" aria-hidden="true"></i>
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
                                            <button type="button" class="btn btn-primary text-white" data-toggle="modal"
                                                data-target="#copraCashAdvance">
                                                <i class="fa fa-add" aria-hidden="true"></i> NEW CASH ADVANCE
                                            </button>
                                        </div>
                                        
                                    </div>
                                    <br>
                                    <h6 class="card-title m-t-40">
                                        <i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i>List
                                        of
                                        Purchase Contract
                                    </h6>


                                    <div class="table-responsive">
                                        <table class="table" id='contractTable'> <?php
                                    $results  = mysqli_query($con, "SELECT * from seller  ORDER BY id ASC"); 
                                    
                                    ?> <thead class="table-dark">
                                                <tr>
                                                    <th width="10%">ID</th>
                                                    <th width="15%">Name</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Cash Advance</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                                    <td hidden> <?php echo $row['id']?> </td>
                                                    <td> <?php echo $row['code']?> </td>
                                                    <td> <?php echo $row['name']?> </td>
                                                    <td> <?php echo $row['address']?></td>
                                                    <td>₱ <?php echo number_format($row['cash_advance']) ?> </td>

                                                    <td>
                                                        <a href="seller_profile.php?view=<?php echo $row['code']; ?>"
                                                            class="btn btn-primary btn-sm ">
                                                            <i class='fa-solid fa-user'></i></a>

                                                        <button type="button"
                                                            class="btn btn-dark btn-sm text-white editBtn">
                                                            <i class='fa-solid fa-edit'></i> </button>
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
    </div>

</body>

</html> <?php
include('modal/copra/copra_cashadvanceModal.php');

?>
<script type="text/javascript" src="js/copra-ca.js"></script>

<script> 

    $('.editBtn').on('click', function() {

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#m_id').val(data[0]);
        $('#m_code').val(data[1]);
        $('#m_name').val(data[2]);
        $('#m_cashadv').val(data[4]);
        
        $('#editCA').modal('show');
    });

</script>

<?php if (isset($_SESSION['update'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'CA Update!',
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    <?php 
			unset($_SESSION['update']);
		?>
</div>
<?php endif ?>