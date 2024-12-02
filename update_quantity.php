<?php 
    include './functions/common_files.php';
    session_start();

    if(!isset($_SESSION['user_id'])){
       get_cart_details();
    }

    $user_id = $_SESSION['user_id'];

    if(isset($_POST['update_product_quantity'])){
        include 'connect.php';
        if(!empty($_POST['quantity'])){
            $product_quantity = $_POST['quantity'];
            $item_id = $_POST['product_id'];
            $update_quantity = "UPDATE `carts` SET `quantity`=? WHERE `product_id`=? AND `user_id`=?";
            $result = $con->prepare($update_quantity);
            $result->bind_param('iii',$product_quantity,$item_id,$user_id);
            if($result->execute()){
                echo "<script>window.open('cart_table.php','_self');</script>";
            }
            else{
                echo "<script>window.open('cart_table.php','_self');</script>";
            }
            $result->close();
        }
        else{
            echo "<script>window.open('cart_table.php','_self');</script>";
        }
        $con->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php get_current_url(); ?></title>
    <link rel="icon" type="image/png" href="./all_images/logo.png" />
    <link rel="stylesheet" href="./css/cart_table.css" />
    <link rel="stylesheet" href="./css/user_sidebar.css" />
    <link rel="stylesheet" href="./css/header.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
    <?php 
        if(isset($_GET['update_product_id'])){
            include 'connect.php';
            if(!empty($_GET['update_product_id'])){
                $update_product_id = $_GET['update_product_id'];
                $select_product = "SELECT `product_id`,`user_id` FROM `carts` WHERE `product_id`=? AND `user_id`=?";
                $result_product = $con->prepare($select_product);
                $result_product->bind_param('ii',$update_product_id,$user_id);
                if($result_product->execute()){
                    $result_product->store_result();
                    if($result_product->num_rows > 0){
    ?>
    <?php   
        get_header(); 
        get_user_profile();
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Product Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if(isset($_GET['update_product_id'])){
                include 'connect.php';
                $product_id = $_GET['update_product_id'];
                $select_cart_query = "SELECT * FROM `carts` WHERE `user_id`=? AND `product_id`=?";
                $result = $con->prepare($select_cart_query);
                $result->bind_param('ii',$user_id,$product_id);
                $result->execute();
                $cart_items = $result->get_result();
                if($cart_items->num_rows > 0){
                    $row = $cart_items->fetch_assoc();

                    $select_query = "SELECT product_id,product_name,product_image1,product_price FROM `products` WHERE `product_id`=?";
                    $answer = $con->prepare($select_query);
                    $answer->bind_param('i',$product_id);
                    $answer->execute();
                    $product_items = $answer->get_result();
                    $rows = $product_items->fetch_assoc();
                    $product_id = $rows['product_id'];
                    $product_name = $rows['product_name'];
                    $product_image1 = $rows['product_image1'];
                    $product_price = $rows['product_price'];
        ?>
            <tr>
                <td><?php echo $product_name; ?></td>
                <td class="product-image"><img src="./product_images/<?php echo $product_image1; ?>" alt="<?php echo $product_name; ?>"></td>
                <td><input type="hidden" name="product_id" value="<?php echo $product_id; ?>"><input type="number" min="1" max="10" name="quantity" class="change-quantity" required></td>
                <td>Rs.<?php echo number_format($rows['product_price'],2,'.',','); ?>/-</td>
                <td><button type="submit" class="update-quantity-button" name="update_product_quantity">Update</button></td>
            </tr>
            <?php   
                $answer->close();
                }
                $cart_items->close();
                $result->close();
            }
            ?>
        </tbody>
    </table>
    </form>
   
    <div class="cart-summary">
        <div class="buttons">
            <button><a href="home.php">Continue Shopping</a></button>
            <button><a href="cart_table.php">Back</a></button>
        </div>
    </div>
    <?php
                    }
                    else{
                        echo "<script>window.open('cart_table.php','_self');</script>";
                    }
                }
                else{
                    echo "<script>window.open('cart_table.php','_self');</script>";
                }
                $result_product->close();
            }
            else{
                echo "<script>window.open('cart_table.php','_self');</script>";
            }
            $con->close();
        }
    ?>

    <script src="./js/sidebar.js"></script>
    <script src="./js/user-sidebar2.js"></script>
</body>
</html>
