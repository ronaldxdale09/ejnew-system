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
            <div class="containr bg-white rounded p-3 mb-3">
                <label for="">Add user account (Both: Copra & Ledger)</label>
                <br>
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class='bx bx-user-plus'></i> Add Account</button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add user account</h5>
                            </div>
                        
                            <form>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="update_user_type">Options</label>
                                            </div>
                                            <select class="custom-select" id="update_user_type" name="update_user_type">
                                                <option selected>Choose...</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Finance">Finance</option>
                                                <option value="Copra">Copra</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="update_user_name">Username</label>
                                        <input type="text" class="form-control" id="update_user_name" placeholder="Ex. Juan Dela Cruz">
                                    </div>
                                    <div class="form-group">
                                        <label for="update_password">Password</label>
                                        <input type="password" class="form-control" id="update_password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User View Account -->
            <div class="container bg-white rounded p-3 mb-3">
                <h3><i class='bx bx-user-voice'></i> User account</h3>
                <small class="form-text text-muted">Click the row to pop-up action menu.</small>
                <br>
                <table class="table table-hover">
                    <thead class="table-success">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-toggle="modal" data-target="#openActionModal">
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        </tr>
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
                    <form>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="update_user_type">Options</label>
                                </div>
                                <select class="custom-select" id="update_user_type" name="update_user_type">
                                    <option selected>Choose...</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Copra">Copra</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="update_user_name">Username</label>
                            <input type="text" class="form-control" id="update_user_name" placeholder="Ex. Juan Dela Cruz">
                        </div>
                        <div class="form-group">
                            <label for="update_password">Password</label>
                            <input type="password" class="form-control" id="update_password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-success"><i class='bx bx-check'></i> Update</button>
                    </form>
                    <br>
                    <hr>
                    <button type="button" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="btn btn-danger"><i class='bx bx-trash'></i> Remove Account</button>
                    
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                <div class="card card-body">
                                    <p>Please confirm to remove this account. This account will remove permanently. Remove? </p>
                                    <form action="">
                                        <button type="button" class="btn btn-light" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">No</button>
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            <!-- Seller View Account -->
            <div class="container bg-white rounded p-3">
                <h3><i class='bx bx-user-pin'></i> Seller account</h3>
                <small class="form-text text-muted">Click the row to pop-up action menu.</small>
                <br>
                <table class="table">
                    <thead class="table-success">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Cheque</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Cash Advance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </section>
    
    <script src="./js/admin_script.js"></script>
</body>
</html>