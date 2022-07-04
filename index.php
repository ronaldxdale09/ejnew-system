<!DOCTYPE html>
<html>
    <head>
        <?php
            include "include/bootstrap.php";
            include "include/jquery.php";
        ?>
        <link rel='stylesheet' href='css/login.css'>
    </head>
    <body style="background-image: url('assets/img/cart-bg.jpg'); background-repeat: no-repeat; background-size: cover;">
        <div class="banner">
           EJN System
        </div>
        <div class="login-box">
            <form method='POST' action='function/login.php'>
                <div class="user-box">
                    <input type="text" name="username" required="">
                    <label>Username</label>
                    </div>
                    <div class="user-box">
                    <input type="password" name="password" required="">
                    <label>Password</label>
                    </div>
                    <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>