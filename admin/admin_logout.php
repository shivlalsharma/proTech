<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        session_unset();
        session_destroy();
        echo "<script>window.open('admin_login.php','_self');</script>";
    }
    else{
        echo "<script>window.open('admin_login.php','_self');</script>";
    }
?>