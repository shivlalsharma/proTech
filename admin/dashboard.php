<?php
    include '../functions/admin_files.php';
    session_start();
    if(!isset($_SESSION['admin_id'])){
        echo "<script>window.open('admin_login.php','_self');</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php get_current_url(); ?></title>
    <link rel="icon" type="image/png" href="../all_images/logo.png" />
    <link rel="stylesheet" href="../admin_css/admin_header.css" />
    <link rel="stylesheet" href="../admin_css/dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
    <?php
        get_admin_header();
        get_dashboard();
        get_about_us();
        add_brand();
        get_brands();
        add_category();
        get_categories();
        add_products();
        get_products();
        add_carts();
        get_carts();
        add_order();
        get_user_orders();
        add_user();
        get_users();
        add_payment();
        get_payments();
        add_contacts();
        get_contacts();
        add_admins();
        get_admins();
    ?>

    <script src="../js/register.js"></script>
    <script src="../js/sidebar.js"></script>
</body>
</html>