<?php
    include "db.php";
    session_unset();
    session_destroy();
    header("Location: ../../index.php");
?>