<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator | Ledger > Expenses</title>
    
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
                <h3><i class='bx bx-money'></i> Expenses</h3>
                <small class="form-text text-muted">List of expenses. </small>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table" id='expenses_table'> 
                        <?php
                            $results  = mysqli_query($con, "SELECT * from ledger_expenses ORDER BY id DESC  "); 
                            ?> 
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">PARTICULARS</th>
                                <th scope="col">VOC#</th>
                                <th scope="col">CATEGORY</th>
                                <th scope="col">AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> 
                            <tr>
                                <td> <?php echo $row['date']?> </td>
                                <td> <?php echo $row['particulars']?> </td>
                                <td> <?php echo $row['voucher_no']?> </td>
                                <td> <?php echo $row['category']?> </td>
                                <td>₱ <?php echo number_format($row['amount'])?> </td>
                            </tr> 
                                <?php }
                                ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>    
    
    <script>
        // expenses_table
        $(document).ready(function() {
                $('#expenses_table').DataTable( {
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