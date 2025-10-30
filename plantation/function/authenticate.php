<?php
    $username="";
    $password="";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        $password = $_SESSION['pass'];
    }
    $sql=mysqli_query($link,"SELECT * FROM users WHERE username='$username' and password='$password'");
    $count = mysqli_num_rows($sql);
    if($count == 0){
        echo "	<script type='text/javascript'>
                    alert('Session Expired');
                    window.location='../index.php';
                </script>";
    }
?>