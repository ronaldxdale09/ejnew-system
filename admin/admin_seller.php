<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator | Copra > Seller</title>
    
    <!-- PHP Code -->
    <?php
        include 'include/header.php';
        include 'include/navbar.php';
    ?><!-- CSS only -->
    <link href="./css/admin-styles.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
   
</head>
<body>
    <!--ACCOUNT OF ALL USER -->
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu' ></i>
            <span class="text">Copra</span>
        </div>
        <main>
            <div class="box-shadow p-3 rounded">
            <!-- Seller View Account -->
                <h3><i class='bx bx-user-pin'></i> Seller</h3>
                <small class="form-text text-muted">List of sellers. </small>
                <br>
                <br>
                <table class="table" id="seller_table"><?php
                    $results_seller  = mysqli_query($con, "SELECT * from seller"); ?>
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Cheque</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Cash Advance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($results_seller)) { ?>
                        <tr>
                            <td scope="row"><?php echo $row['code']?> </td>
                            <td> <?php echo $row['name']?> </td>
                            <td> <?php echo $row['address']?> </td>
                            <td> <?php echo $row['cheque']?> </td>
                            <td> <?php echo $row['contact']?> </td>
                            <td> <?php echo $row['cash_advance']?> </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </section>    
    
    <script>
        // seller table
        $(document).ready(function() {
                $('#seller_table').DataTable( {
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