<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator | Ledger > Cash Advance</title>
    
    <!-- PHP Code -->
    <?php
        include 'include/header.php';
        include 'include/sidenav.php';
    ?><!-- CSS only -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>
<body>
    <!--ACCOUNT OF ALL USER -->
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu' ></i>
            <span class="text">Ledger</span>
        </div>
        <main>
            <div class="box-shadow p-3 rounded">
            <!-- cash advance -->
                <h3><i class='bx bx-money'></i> Cash Advance</h3>
                <small class="form-text text-muted">List of cash advance. </small>
                <br>
                <br>
                <div class="table-responsive">
                    
                <table class="table table-bordered table-responsive-lg" id='cashadvance_table'>
                            <?php
                                    $results  = mysqli_query($con, "SELECT * from ledger_cashadvance ORDER BY id DESC"); ?>
                            <thead class="table-dark">
                                <tr>
                                    <th>Voucher #</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Buying Station</th>
                                    <th>category</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> <tr>
                                    <td> <?php echo $row['voucher']?> </td>
                                    <td> <?php echo $row['date']?> </td>
                                    <td> <?php echo $row['customer']?> </td>
                                    <td> <?php echo $row['buying_station']?> </td>
                                    <td> <?php echo $row['category']?> </td>
                                    <td> <?php echo $row['amount']?> </td>
                                </tr> <?php } ?> </tbody>
                        </table>
                </div>
            </div>
        </main>
    </section>    
    
    <script>
        // cashadvance_table
        $(document).ready(function() {
                $('#cashadvance_table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>
    <script src="./js/admin_script.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>