<?php
    include "db.php";
    session_unset();
    session_destroy();
    echo "	<script type='text/javascript'>
                window.location='/ejnew-system/index.php';
            </script>";
?>