<?php
    include './functions/common_files.php';
    session_start();
    if(!isset($_SESSION['user_id'])){
        get_cart_details();
    }
    else{
        session_unset();
        session_destroy();
        echo "<script>window.open('home.php','_self');</script>";
    }
?>