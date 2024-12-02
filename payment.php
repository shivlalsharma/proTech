<?php 
    include './functions/common_files.php';
    @session_start();
    if(!isset($_SESSION['user_id'])){
        get_cart_details();
    }

    $user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php get_current_url(); ?></title>
    <link rel="icon" type="image/png" href="./all_images/logo.png" />
    <link rel="stylesheet" href="./css/payment.css" />
    <link rel="stylesheet" href="./css/user_sidebar.css" />
    <link rel="stylesheet" href="./css/header.css"/>
    <link rel='stylesheet' href='./css/footer.css'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
   <?php 
        get_header(); 
        get_user_profile();
    ?>
   <main>
        <div class="box">
            <h2>Payment Options</h2>
            <div class="row">
                <a href="https://www.paypal.com"><img src="./all_images/payment.jpg" alt="Payment Image" class="image"></a>
                <a href='order.php' class='button'>Pay Offline</a>
            </div>
        </div>
    </main>
    <script src="./js/sidebar.js"></script>
    <script src="./js/user-sidebar2.js"></script>
</body>
</html>