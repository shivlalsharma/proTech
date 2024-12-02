<?php 
    include './functions/common_files.php';
    @session_start();
    if(isset($_SESSION['user_id'])){
        get_cart_details();
    }

    if(isset($_POST['reset_password'])){
        $user_pass = $user_cpass = "";
        $user_pass_error = $user_cpass_error = "";
        function testinput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if(!empty($_POST['password'])){
            $user_pass = testinput($_POST['password']);
        }else{
            $user_pass_error = "<p>Password must be required</p>";
        }
        if(!empty($_POST['cpassword'])){
            $user_cpass = testinput($_POST['cpassword']);
        }else{
            $user_cpass_error = "<p>Confirm Password must be required</p>";
        }
        if($user_pass !== $user_cpass){
            $user_cpass_error = "<p>Incorrect Confirm Password</p>";
        }
        $user_token = $_POST['user_token'];
        $user_hash_pass = password_hash($user_pass,PASSWORD_BCRYPT);
        if(empty($user_pass_error) && empty($user_cpass_error) && !empty($user_token)){
            include 'connect.php';
            $update_pass = "UPDATE `register` SET `user_password`=? WHERE `token`=?";
            $update_result = $con->prepare($update_pass);
            if($update_result){
                $update_result->bind_param('ss',$user_hash_pass,$user_token);
                if($update_result->execute()){
                    echo "<script>alert('Password has been changed successfully!')</script>";
                    echo "<script>window.open('login.php','_self');</script>";
                }else{
                    echo "<script>alert('Something went wrong...')</script>";
                    header('Location:forget_password.php');
                    exit();
                }
            }else{
                echo "<script>alert('Something went wrong...')</script>";
                header('Location:forget_password.php');
                exit();
            }
            $update_result->close();
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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css'/>
</head>
<body>
    <?php
        include './connect.php';
        $user_token = $_GET['user_token'];
        $select_query = "SELECT `token` FROM `register` WHERE `token`=?";
        $select_result = $con->prepare($select_query);
        if($select_result){
            $select_result->bind_param('s',$user_token);
            if($select_result->execute()){
                $select_result->bind_result($user_token);
                $select_result->store_result();
                if($select_result->num_rows > 0){
                    $select_result->fetch();
    ?>
    <?php get_header(); ?>
    <main>
        <div class="container">
            <div class="form-container">
                <h2>Reset Password</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return validate()">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" onkeyup="check1(this.value)" required>
                        <i class="fa-sharp fa-solid fa-eye-slash" id="eye-close" onClick="toggle()"></i>
                        <p class="error"></p>
                        <?php if(isset($user_pass_error)) echo $user_pass_error; ?>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" id="cpassword" name="cpassword" onkeyup="check2(this.value)" required>
                        <p class="error"></p>
                        <?php if(isset($user_cpass_error)) echo $user_cpass_error; ?>
                    </div>
                    <input type="hidden" name="user_token" value="<?php echo $user_token; ?>">
                    <div class="form-group">
                        <button type="submit" name="reset_password">Reset Password</button>
                    </div>
                    <p>Already have an account ? <a href="login.php">Login</a></p>
                </form>
            </div>
        </div>
    </main>
    <?php   
            }
        }
    } 
    $select_result->close();
    $con->close();
    ?>

    <script src="./js/register.js"></script>
    <script src="./js/sidebar.js"></script>
</body>
</html>