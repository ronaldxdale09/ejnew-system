<!DOCTYPE html>
<?php 


?>
<html>
    <head>
        <?php
            include "include/bootstrap.php";
            include "include/jquery.php";
        ?>
        <link rel='stylesheet' href='css/index.css'>
        <link rel='stylesheet' href='css/sales.css'>
        <link rel='stylesheet' href='css/dashboard.css'>        
        <?php include "include/datatables_buttons_js.php"; ?>
        <?php include "include/datatables_buttons_css.php"; ?>
        <script>
            $(document).ready(function(){
                //Load Cart when Clicking cart from the list
                $(document).on('click', '.edit-submit', function() {
                    var id = $(this).attr('id');
                    var us = $("#edit-user").val();
                    var pw = $("#edit-password").val();
                    var cpw = $("#edit-confirm-password").val();
                    if(pw != ''){
                        if(pw != cpw){
                            alert('New Passwords Must Match!');
                            return;
                        }
                    }
                    
                    $.ajax({
                        url:"function/user_edit.php",
                        method:"POST",
                        data:{user_id:id,username:us,password:pw},
                        dataType:"html",
                        success:function(data) {
                            $("#user-"+id).text(us);
                            document.getElementById("edit-password").value = '';
                            document.getElementById("edit-confirm-password").value = '';
                            closeModal();
                        },
                        error:function(){
                            alert("Something went wrong");
                        }
                    });
                });

                $(document).on('click', '.add-submit', function() {
                    var us = $("#add-user").val();
                    var pw = $("#add-password").val();
                    var cpw = $("#add-confirm-password").val();
                    var typ = $("#add-type").val();
                    if(pw != ''){
                        if(pw != cpw){
                            alert('New Passwords Must Match!');
                            return;
                        }
                    }
                    
                    $.ajax({
                        url:"function/user_add.php",
                        method:"POST",
                        data:{username:us,password:pw,type:typ},
                        dataType:"html",
                        success:function(data) {
                            location.reload();
                            closeAddModal();
                        },
                        error:function(){
                            alert("Something went wrong");
                        }
                    });
                });

                $(document).on('click', '.delete-submit', function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        url:"function/user_delete.php",
                        method:"POST",
                        data:{user_id:id},
                        dataType:"html",
                        success:function(data) {
                            location.reload();
                            closeAddModal();
                        },
                        error:function(){
                            alert("Something went wrong");
                        }
                    });
                });

                $(document).on('click', '.edit-user', function() {
                    var id = $(this).attr('id');
                    openModal(id);
                });

                $(document).on('click', '.add-user', function() {
                    openAddModal();
                });


                $(document).on('click', '.delete-user', function() {
                    var id = $(this).attr('id');
                    openDeleteModal(id);
                });

                $('.close-sale-modal').on('click', function() {
                    closeModal();
                    closeAddModal();
                    closeDeleteModal();
                });

                $('.modal').on('click', function(e) {
                    if (e.target !== this)
                        return;
                    closeModal();
                    closeAddModal();
                    closeDeleteModal();
                });

                function openModal(id) {
                    $("#quantity-modal").attr("style","display:flex");
                    var user = document.getElementById("user-"+id).textContent;
                    document.getElementById("edit-user").value = user;
                    document.getElementsByClassName("edit-submit")[0].id = id;
                };

                
                function openDeleteModal(id) {
                    $("#delete-modal").attr("style","display:flex");
                    var user = document.getElementById("user-"+id).textContent;
                    document.getElementById("delete-username").innerHTML = user;
                    document.getElementsByClassName("delete-submit")[0].id = id;
                };

                function openAddModal() {
                    $("#add-modal").attr("style","display:flex");
                };
                
                
                function closeAddModal() {
                    $("#add-modal").attr("style","display:none");
                    //Remove Previous User Inputs
                    document.getElementById("add-user").value = '';
                    document.getElementById("add-password").value = '';
                    document.getElementById("add-confirm-password").value = '';
                };
                
                function closeDeleteModal() {
                    $("#delete-modal").attr("style","display:none");
                };

                function closeModal() {
                    $("#quantity-modal").attr("style","display:none");
                };

                var table = $('#myTable').DataTable({
                    lengthChange: false,
                    dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
                    buttons: [
                        'copy',
                        'excel',
                        'pdf',
                        'colvis',
                    ],
                });
                table.buttons().container()
                    .appendTo( '#myTable_wrapper .col-md-6:eq(0)' );
            });
                
        </script>
    </head>
    <body>
    <?php include "include/navbar.php"; ?>
        <div class="main-content">
            <div class="container main-container">
                <div class="row g-1">
                    <div class="col-md-2 store-info-container">
                        <div class="store-info internal-div" style='font-size:1.3vw;'>  
                            <?php echo $_SESSION['store']; ?> Users
                        </div>
                        <div class="store-info internal-div dashboard-module" style='height:150px;'> 
                                <p class='m-0 label' style='font-size:1.3vw'>
                                    Users Registered
                                </p>
                                <p class="dashboard-data">
                                <?php
                                    $store = $_SESSION['store_id'];
                                    $user_listings = mysqli_query($link,"SELECT * FROM user where store=$store");
                                    $user_count=mysqli_num_rows($user_listings);
                                    echo $user_count;
                                ?>
                                </p>
                        </div>
                        <div class="store-info internal-div" style='height:auto; font-size:initial;'>  
                            <button class='btn btn-success add-user' style='height:100%; width:100%;'><i class="fa-solid fa-user-plus"></i> Add New User</button>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class='internal-div'>
                            <div class="table-container">
                                <table class="table-proper table table-striped" id='myTable' style='width:100%;'>
                                    <thead class='table-dark'>
                                        <tr>
                                            <td class="theader" style='width:55%'>User Mail</td>
                                            <td class="theader" style='width:15%; text-align:center;'>User Type</td>
                                            <td class="theader" style='width:30%'>Actions</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $store = $_SESSION['store_id'];
                                            $sql = "SELECT * FROM user WHERE store=$store";
                                            $userList = $link->query($sql);
                                            if ($userList->num_rows > 0) {
                                                while($user=mysqli_fetch_array($userList)):
                                        ?>
                                        <tr>
                                            <td style='width:55%' id='user-<?php echo $user['id']; ?>'><?php echo $user['username']; ?></td>
                                            <td style='width:15%; text-align:center;'><?php echo $user['type']; ?></td>
                                            <td style='width:30%'><button class='btn btn-primary edit-user' id="<?php echo $user['id']; ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</button><button style='margin-left:10px;' class='btn btn-danger delete-user' id="<?php echo $user['id']; ?>"><i class="fa-solid fa-user-minus"></i> Delete</button></td>
                                        </tr>
                                        <?php
                                                endwhile;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id='quantity-modal'>
            <div class="sale-info" id="sale-info" style='display:flex; flex-direction:column; justify-content:center; height:450px; width:420px;'>
                <div style='margin-top:10px; font-size:25px;'>
                    <div id='product-name' style='font-weight:bold;'>
                        Edit User Details
                    </div>
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <div>
                        Username
                    </div>
                    <input id='edit-user' name='username' type="text">
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <div>
                        Password
                    </div>
                    <input id='edit-password' name='password' type="text">
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <div>
                        Confirm Password
                    </div>
                    <input id='edit-confirm-password' name='confirm_password' type="text">
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <button class='btn close-sale-modal btn btn-secondary' style='position:static;'>Return</button>
                    <button type="button" value='Edit' class='edit-submit btn btn-primary' id=''><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                </div>
            </div>
        </div>
        <div class="modal" id='add-modal'>
            <div class="sale-info" id="sale-info" style='display:flex; flex-direction:column; justify-content:center; height:500px; width:430px;'>
                <div style='margin-top:10px; font-size:25px;'>
                    <div id='product-name' style='font-weight:bold;'>
                        Add User Details
                    </div>
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <div>
                        Username
                    </div>
                    <input id='add-user' name='username' type="text">
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <div>
                        Password
                    </div>
                    <input id='add-password' name='password' type="password">
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <div>
                        Confirm Password
                    </div>
                    <input id='add-confirm-password' name='confirm_password' type="password">
                </div>
                <div class='' style='margin-top:10px; font-size:25px; width:80%;'>
                    <div>
                        User Type
                    </div>
                    <select id='add-type' name='user-type' style='width:100%;'>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <button class='btn close-sale-modal btn btn-secondary' style='position:static;'>Return</button>
                    <button type="button" value='Add' class='add-submit btn btn-success' id=''><i class="fa-solid fa-plus"></i> Add</button>
                </div>
            </div>
        </div>
        <div class="modal" id='delete-modal'>
            <div class="sale-info" id="sale-info" style='position:relative; display:flex; flex-direction:column; justify-content:center; height:250px; width:500px; left:auto; top:auto; border-radius:3px;'>
                <button class='btn close-sale-modal' style='right:10px; top:10px; left:auto;'><i class='fa fa-close'></i></button>
                <div style='margin-top:10px; font-size:25px; font-weight:bold; text-align:center;'>
                        Are you sure you want to Delete This User?
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <span id='delete-username'></span>
                </div>
                <div style='margin-top:10px; font-size:25px;'>
                    <div>
                        <input type="button" value='Delete' class='btn btn-danger delete-submit' id=''>
                        <input type="button" value='Cancel' class='btn btn-secondary close-sale-modal' style='position:static;'>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>