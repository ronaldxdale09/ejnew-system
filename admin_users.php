<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator | Add User Account</title>
    <!-- PHP Code -->
    <?php
        include 'include/header.php';
        include 'include/sidenav.php';
    ?><!-- CSS only -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    <?php 
                                
        $ulist = "
        <option value='Admin'>Admin</option>
        <option value='Copra'>Copra</option>
        <option value='Finance'>Finance</option>
        ";
    ?>

</head>
<body>
    <!--ACCOUNT OF ALL USER -->
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu' ></i>
            <span class="text">User Account</span>
        </div>
        <main>
            <ul class="nav nav-pills mb-3  justify-content-end" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class='bx bx-user-voice'></i> User Account</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class='bx bx-user-pin'></i> Seller Account</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active rounded bg-white" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="container bg-white rounded p-3">
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Add user account</h5>
                                    </div>
                                
                                    <form action="./function/admin/add_user.php" method="POST">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="col-md-12">User Type</label>
                                                            <div class="col-md-12">
                                                                <input class="form-control" list="datalistOptions" style="text-transform: capitalize"
                                                                    name='user_type' id="user_type"
                                                                    placeholder="User type">
                                                                <datalist id="datalistOptions"> <?php echo $ulist; ?> </datalist>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="user_name">Username</label>
                                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Ex. JuanDelaCruz">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Add User</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User View Account -->
                    <div class="container bg-white rounded p-3 mb-3">
                        <h3><i class='bx bx-user-voice'></i> User account</h3>
                        <div class="col-md-12">
                            <button class="btn  mt-2" style="background: #f3f4f5" data-toggle="modal" data-target="#exampleModalCenter"><b><i class='bx bx-user-plus'></i> Add Account</b></button>
                            <br>
                            <small class="form-text text-muted">Add user account (Both: Copra & Ledger)</small>
                            <small class="form-text text-muted">Click the row to pop-up action menu.</small>
                        </div>
                        <br>
                        <table class="table table-hover" id="user_table"><?php
                            $results_users  = mysqli_query($con, "SELECT * from users"); ?>
                            <thead class="table-success">
                                <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($rowU = mysqli_fetch_array($results_users)) { ?>
                                <tr data-bs-toggle="modal" data-bs-target="#openActionModal"  data-bs-user_type="<?php echo $rowU['type']?>" data-bs-user_password="<?php echo $rowU['password']?>" data-bs-id="<?php echo $rowU['id']?>" data-bs-username="<?php echo $rowU['username']?>">
                                    <td><?php echo $rowU['username']?> </td>
                                    <td> <?php echo $rowU['password']?> </td>
                                    <td> <?php echo $rowU['type']?> </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal of user -->
                    <div class="modal fade" id="openActionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal Action</h5>
                            </div>
                            <div class="modal-body">
                                <form action="./function/admin/update_user.php" method="POST">
                                    <input type="text" id="my_id" name="my_id" style="display: none">
                                    <div class="form-group">
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-12">User Type</label>
                                                    <div class="col-md-12">
                                                        <input class="form-control" list="datalistOptions" style="text-transform: capitalize"
                                                            name='update_user_type' id="update_user_type"
                                                            placeholder="User type">
                                                        <datalist id="datalistOptions"> <?php echo $ulist; ?> </datalist>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="update_user_name">Username</label>
                                        <input type="text" class="form-control" id="update_user_name" name="update_user_name" placeholder="Ex. JuanDelaCruz">
                                    </div>
                                    <div class="form-group">
                                        <label for="update_password">Password</label>
                                        <input type="password" class="form-control" id="update_password" name="update_password" placeholder="Password">
                                                                                
                                        <input type="checkbox" id="showPass"> Show Password
                                        <script>
                                            $(document).ready(function(){
                                                $('#showPass').on('click', function(){
                                                    var passInput=$("#update_password");
                                                    if(passInput.attr('type')==='password')
                                                    {
                                                        passInput.attr('type','text');
                                                    }else{
                                                        passInput.attr('type','password');
                                                    }
                                                })
                                            })
                                        </script>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success"><i class='bx bx-check'></i> Save Changes</button>
                                </form>
                                <br>
                                <hr>
                                <button type="button" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="btn btn-danger"><i class='bx bx-trash'></i> Remove Account</button>
                                
                                    
                                <div class="row">
                                    <div class="col">
                                        <div class="collapse multi-collapse" id="multiCollapseExample1">
                                            <div class="card card-body">
                                                <p>Please confirm to remove this account. This account will remove permanently. Remove? </p>
                                                <form action="./function/admin/del_user.php"  method="POST">
                                                    <input type="text" id="my_iddel" name="my_iddel" style="display: none">
                                                    <button type="button" class="btn btn-light" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">No</button>
                                                    <button type="submit" name="submit" id="btn-delete-user" class="btn border border-danger">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        const exampleModalRemove = document.getElementById('openActionModal')
                        exampleModalRemove.addEventListener('show.bs.modal', event => {
                            // Button that triggered the modal
                            const button = event.relatedTarget
                            // Extract info from data-bs-* attributes
                            const id = button.getAttribute('data-bs-id')
                            const username = button.getAttribute('data-bs-username')
                            const user_password = button.getAttribute('data-bs-user_password')
                            const user_type = button.getAttribute('data-bs-user_type')
                            //
                            // Update the modal's content.
                            const modalTitleRemove = exampleModalRemove.querySelector('.modal-title')
                            const idu = exampleModalRemove.querySelector('.modal-body #my_id')
                            const iddel = exampleModalRemove.querySelector('.modal-body #my_iddel')
                            const un = exampleModalRemove.querySelector('.modal-body #update_user_name')
                            const pw = exampleModalRemove.querySelector('.modal-body #update_password')
                            const ut = exampleModalRemove.querySelector('.modal-body #update_user_type')

                            iddel.value = id
                            idu.value = id
                            un.value = username
                            pw.value = user_password
                            ut.value = user_type
                            
                            if(ut.value == 'Admin' || ut.value == 'admin') {
                                document.querySelector('#update_user_type').disabled = true;
                                document.querySelector('#btn-delete-user').disabled = true;
                                document.querySelector('#btn-delete-user').innerHTML = "Restricted";
                            } else {
                                document.querySelector('#update_user_type').disabled = false;
                                document.querySelector('#btn-delete-user').disabled = false;
                                document.querySelector('#btn-delete-user').innerHTML = "Yes";
                            }
                        })
                    </script>
                </div>

                <!-- Seller Tab -->
                <div class="tab-pane fade bg-white" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <!-- Seller View Account -->
                    <div class="container bg-white rounded p-3">
                        <h3><i class='bx bx-user-pin'></i> Seller account</h3>
                        <small class="form-text text-muted">Click the row to pop-up action menu.</small>
                        <br>
                        <br>
                        <table class="table" id="seller_table"><?php
                            $results_seller  = mysqli_query($con, "SELECT * from seller"); ?>
                            <thead class="table-success">
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
                </div>
            </div>
        </main>
    </section>    
    
    <script src="./js/admin_script.js"></script>
    <!-- JavaScript Bundle with Popper -->
    
    <script>
        var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
        triggerTabList.forEach(function (triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })

        // user table
        $(document).ready(function() {
                $('#user_table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>