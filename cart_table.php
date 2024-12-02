<?php 
    include './functions/common_files.php';
    session_start();

    if(!isset($_SESSION['user_id'])){
        echo "<script>window.open('login.php','_self');</script>";
    }

    $user_id = $_SESSION['user_id'];

    if(isset($_POST['remove_all_cart_items'])){
        if(!empty($_POST['remove_items'])){
            include 'connect.php';
            $remove_items = $_POST['remove_items'];
            $extract_ids = implode(',',array_fill(0,count($remove_items),'?'));
            $remove_query = "DELETE FROM `carts` WHERE `product_id` IN ($extract_ids)";
            $result = $con->prepare($remove_query);
            $types = str_repeat('i',count($remove_items));
            $result->bind_param($types,...$remove_items);
            if($result->execute()){
            header('location:cart_table.php');
            }
            else{
                header('location:cart_table.php');
            }
            $result->close();
            $co->close();
        }
        else{
            header('location:cart_table.php');
        }
    }

    if(isset($_GET['remove_product_id'])){
        if(!empty($_GET['remove_product_id'])){
            include 'connect.php';
            $product_id = $_GET['remove_product_id'];
            $remove_query = "DELETE FROM `carts` WHERE `product_id`=?";
            $remove = $con->prepare($remove_query);
            $remove->bind_param('i',$product_id);
            if($remove->execute()){
                header('location:cart_table.php');
            }
            else{
                header('location:cart_table.php');
            }
            $remove->close();
            $con->close();
        }
        else{
            header('location:cart_table.php');
            exit();
        }
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
        get_header(); 
        get_user_profile();    
    ?>
    <?php 
        include 'connect.php';
        $select_query = "SELECT * FROM `carts` WHERE `user_id`=?";
        $result = $con->prepare($select_query);
        $result->bind_param('i',$user_id);
        $result->execute();
        $cart_items = $result->get_result();
        if($cart_items->num_rows > 0){
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <table>
        <thead>
            <tr>
                <th><button class="remove-all-button" name="remove_all_cart_items"><i class="fa-sharp fa-solid fa-trash-can"></i></button> <input type="checkbox" id="remove-all"></th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Product Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include 'connect.php';
                $total_price = 0;
                $select_cart_query = "SELECT * FROM `carts` WHERE `user_id`=?";
                $result = $con->prepare($select_cart_query);
                $result->bind_param('i',$user_id);
                $result->execute();
                $cart_items = $result->get_result();
                if($cart_items->num_rows > 0){
                    while ($row = $cart_items->fetch_assoc()) {
                        $product_id = $row['product_id'];
                        $product_quantity = $row['quantity'];

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
                        $total_price += $product_price * $product_quantity;
            ?>
            <tr>
                <td><input type="checkbox" name="remove_items[]" value="<?php echo $product_id; ?>" class="remove-checkbox"></td>
                <td><?php echo $product_name; ?></td>
                <td class="product-image"><img src="./product_images/<?php echo $product_image1; ?>" alt="<?php echo $product_name; ?>"></td>
                <td><button id="quantity"><?php echo $product_quantity; ?></button> <button class="update-button"><a href="update_quantity.php?update_product_id=<?php echo $product_id; ?>">Edit</a></button></td>
                <td>Rs.<?php echo number_format($rows['product_price'],2,'.',','); ?>/-</td>
                <td><button class="remove-button"><a href="cart_table.php?remove_product_id=<?php echo $product_id; ?>">Trash</a></button></td>
            </tr>
            <?php $answer->close(); 
                }
            }
            $cart_items->close();
            ?>
        </tbody>
    </table>
   
    <div class="cart-summary">
        <div class="subtotal">Subtotal: Rs.<?php echo number_format($total_price,2,'.',','); ?>/-</div>
        <div class="buttons">
            <button><a href="home.php">Continue Shopping</a></button>
            <button><a href="payment.php">Checkout</a></button>
        </div>
    </div>
    </form>
    <?php
        }
        else{
            echo "<h2>No Cart Item Found</h2>
                  <div class='cart-summary'>
                    <div class='buttons'>
                        <button><a href='home.php'>Continue Shopping</a></button>
                    </div>
                  </div>";
        }
        $result->close();
        $con->close();
    ?>

    <script src='./js/sidebar.js'></script>
    <script src='./js/user-sidebar2.js'></script>
</body>
</html>
