<?php
    include './functions/common_files.php';
    session_start();

    if(!isset($_SESSION['user_id'])){
        get_cart_details();
    }

    $user_id = $_SESSION['user_id'];
    
    include 'connect.php';
    $total_price = 0;
    $select_cart_query = "SELECT * FROM `carts` WHERE `user_id`=?";
    $result = $con->prepare($select_cart_query);
    if($result){
        $result->bind_param('i',$user_id);
        if($result->execute()){
            $values = $result->get_result();
            $total_products = $values->num_rows;
            if($total_products > 0){
                while($row = $values->fetch_assoc()){
                    $product_id = $row['product_id'];
                    $product_quantity = $row['quantity'];

                    $select_query = "SELECT * FROM `products` WHERE `product_id`=?";
                    $answer = $con->prepare($select_query);
                    if($answer){
                        $answer->bind_param('i',$product_id);
                        if($answer->execute()){
                            $product_values = $answer->get_result();
                            if($product_values->num_rows > 0){
                                $many_rows = $product_values->fetch_assoc();
                                $product_price = $many_rows['product_price'];
                            }
                            else{
                                echo "<script>window.open('home.php','_self');</script>";
                            }
                            $product_values->close();
                        }
                        else{
                            echo "<script>window.open('home.php','_self');</script>";
                        }
                        $total_price += $product_price * $product_quantity; 
                    }
                    else{
                        echo "<script>window.open('home.php','_self');</script>";
                    }
                    $answer->close();
                }
            }
            else{
                echo "<script>window.open('home.php','_self');</script>";
            }
        }
        else{
            echo "<script>window.open('home.php','_self');</script>";
        }
        $values->close();
    }
    else{
        echo "<script>window.open('home.php','_self');</script>";
    }
    $result->close();
    $con->close();

    include 'connect.php';
    $select_query = "SELECT `user_id` FROM `carts` WHERE `user_id`=?";
    $result = $con->prepare($select_query);
    if($result){
        $result->bind_param('i',$user_id);
        if($result->execute()){
            $result->store_result();
            if($result->num_rows > 0){
                $invoice_number = mt_rand();
                $order_status = 'Pending...';
                $insert_query = "INSERT INTO `user_order` (`user_id`,`amount_due`,`invoice_number`,`total_product`,`order_status`) VALUES(?,?,?,?,?)";
                $order_result = $con->prepare($insert_query);
                if($order_result){
                    $order_result->bind_param('iiiis',$user_id,$total_price,$invoice_number,$total_products,$order_status);
                    if($order_result->execute()){
                        $delete_cart_query = "DELETE FROM `carts` WHERE `user_id`=?";
                        $cart_result = $con->prepare($delete_cart_query);
                        if($cart_result){
                            $cart_result->bind_param('i',$user_id);
                            if(!$cart_result->execute()){
                                echo "<script>window.open('cart_table.php','_self');</script>";
                            }
                        }else{
                            echo "<script>window.open('cart_table.php','_self');</script>";
                        }
                        echo "<script>alert('Order submitted successfully!');</script>";
                        echo "<script>window.open('profile.php','_self');</script>";
                    }else{
                        echo "<script>window.open('checkout.php','_self');</script>";
                    }
                }else{
                    echo "<script>window.open('checkout.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('home.php','_self');</script>";
            }
        }else{
            echo "<script>window.open('home.php','_self');</script>";
        }
    }else{
        echo "<script>window.open('home.php','_self');</script>";
    }
    $result->close();
    $con->close();
?>