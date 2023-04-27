<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator | Copra > Purchase Contract</title>
    
    <!-- PHP Code -->
    <?php
        include 'include/header.php';
        include 'include/navbar.php';
    ?><!-- CSS only -->
    
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
            <!-- Purchase Contract -->
                <h3><i class='bx bx-purchase-tag-alt'></i> Purchase Contract</h3>
                <small class="form-text text-muted">List of purchase contract. </small>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table" id='purchase_table'> 
                        <?php $results  = mysqli_query($con, "SELECT * from contract_purchase"); ?> 
                        <thead class="table-dark">
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
                        <tbody> <?php while ($row = mysqli_fetch_array($results)) { ?> 
                            <tr>
                                <th scope="row"> <?php echo $row['date']?> </th>
                                <td> <?php echo $row['contract_no']?> </td>
                                <td> <?php echo $row['seller']?> </td>
                                <td> <?php echo $row['contract_quantity']?> Kg</td>
                                <td hidden> <?php echo $row['delivered']?> </td>
                                <td> <?php echo $row['balance']?> Kg</td>
                                <td>₱ <?php echo $row['price_kg']?> </td>
                                <td>
                                    <h5><span class="badge bg-success"><?php echo $row['status']?></span></h5>
                                </td>
                            </tr> 
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </section>    
    
    <script>
        // purchase table
        $(document).ready(function() {
                $('#purchase_table').DataTable( {
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