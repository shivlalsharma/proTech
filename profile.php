<?php 
    include './functions/common_files.php';
    session_start();
    
    if(!isset($_SESSION['user_id'])){
        get_cart_details();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php get_current_url(); ?></title>
    <link rel="icon" type="image/png" href="./all_images/logo.png" />
    <link rel="stylesheet" href="./css/header.css"/>
    <link rel="stylesheet" href="./css/profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
    <?php get_header(); ?>
    <div class="container">
        <?php get_user_profile(); ?>
        <div class="main-content">
            <?php
                get_order_pending_details();
                get_payment_details();
                get_user_order_details();
                get_confirm_payment();
                get_edit_account();
                get_delete_account();
            ?>
        </div>
    </div>
    
    <script src="./js/sidebar.js"></script>
    <script src="./js/user-sidebar.js"></script>
</body>
</html>