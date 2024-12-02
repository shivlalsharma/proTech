<?php include './functions/common_files.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php get_current_url(); ?></title>
    <link rel="icon" type="image/png" href="./all_images/logo.png" />
    <link rel="stylesheet" href="./css/home.css"/>
    <link rel="stylesheet" href="./css/cart_header.css"/>
    <link rel='stylesheet' href='./css/footer.css'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
    <?php 
        get_cart_header();
        get_product_details();
        get_search_data();
        get_unique_category();
        get_unique_brand();
    ?>
    <script src="./js/sidebar.js"></script>
</body>
</html>
