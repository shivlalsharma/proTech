<?php 
    include './functions/common_files.php';
    @session_start();

    if(isset($_SESSION['user_id'])){
        get_cart_details();
    }

    if(isset($_POST['login'])){
        $user_email = $user_pass = "";
        $user_email_error = $user_pass_error = "";
        function testinput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if(!empty($_POST['email'])){
            $user_email = testinput($_POST['email']);
        }
        else{
            $user_email_error = "<p>Email must be required</p>";
        }
        if(!empty($_POST['password'])){
            $user_pass = testinput($_POST['password']);
        }
        else{
            $user_pass_error = "<p>Password must be required</p>";
        }
        $user_status = "active";
        if(empty($user_email_error) && empty($user_pass_error)){
            include 'connect.php';
            $select_query = "SELECT `user_id`,`user_email`,`user_password`,`user_name`,`status` FROM `register` WHERE `user_email`=? AND `status`=?";
            $result = $con->prepare($select_query);
            if($result){
                $result->bind_param('ss',$user_email,$user_status);
                if($result->execute()){
                    $values = $result->get_result();
                    if($values->num_rows > 0){
                        $row = $values->fetch_assoc();
                        $user_name = $row['user_name'];
                        $user_id = $row['user_id'];
                        if(password_verify($user_pass,$row['user_password'])){
                            $_SESSION['user_id'] = $user_id;
                            $user_id = $_SESSION['user_id'];
                            $_SESSION['user_name'] = $user_name;
                            $select_cart_query = "SELECT `user_id` FROM `carts` WHERE `user_id`=?";
                            $cart_result = $con->prepare($select_cart_query);
                            if($cart_result){
                                $cart_result->bind_param('i',$user_id);
                                if($cart_result->execute()){
                                    $cart_result->store_result();
                                    if($cart_result->num_rows > 0){
                                        echo "<script>alert('You have logged in successfully!');</script>";
                                        echo "<script>window.open('payment.php','_self');</script>";
                                    }else{
                                        echo "<script>alert('You have logged in successfully!');</script>";
                                        echo "<script>window.open('home.php','_self');</script>";
                                    }
                                    $cart_result->close();
                                }else{
                                    echo "<script>window.open('payment.php','_self');</script>";
                                }
                            }else{
                                echo "<script>window.open('login.php','_self');</script>";
                            }
                        }else{
                            echo "<script>alert('Invalid Password...');</script>";
                            echo "<script>window.open('login.php','_self');</script>";
                        }
                    }else{
                        echo "<script>alert('Invalid Credentials...');</script>";
                        echo "<script>window.open('login.php','_self');</script>";
                    }
                    $values->close();
                }else{
                    echo "<script>window.open('login.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('login.php','_self');</script>";
            }
            $result->close();
            $con->close();
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
    <link rel="stylesheet" href="./css/register.css"/>
    <link rel="stylesheet" href="./css/header.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
    <?php get_header(); ?>
    <main>
        <div class="container">
            <div class="form-container">
                <h2>Login</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                        <?php if(isset($user_email_error)) echo $user_email_error; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        <i class="fa-sharp fa-solid fa-eye-slash" id="eye-close" onClick="toggle()"></i>
                        <?php if(isset($user_pass_error)) echo $user_pass_error; ?>
                    </div>
                    <div class="form-group">
                        <a href="forget_password.php">Forget Password?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login">Login</button>
                    </div>
                    <p>Don't have an account ? <a href="register.php">Register</a></p>
                </form>
            </div>
        </div>
    </main>
    <script src="./js/register.js"></script>
    <script src="./js/sidebar.js"></script>
</body>
</html>
