<?php
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: function/logout.php'); // replace 'logout.php' with your logout script
    exit();
}

?>