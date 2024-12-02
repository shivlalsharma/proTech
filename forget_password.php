<?php
    @session_start();
    include './functions/common_files.php';
    if(isset($_SESSION['user_id'])){
        get_cart_details();
    }

    if(isset($_POST['forget_password'])){
        $user_email = "";
        $user_email_error = "";
        function testinput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if(!empty($_POST['email'])){
            $user_email = testinput($_POST['email']);
        }else{
            $user_email_error = "<p>Email must be required</p>";
        }
        $user_status = "active";
        if(empty($user_email_error) && !empty($user_status) && $user_status === "active"){
            include 'connect.php';
            $select_email_query = "SELECT `user_name`,`user_email`,`token` FROM `register` WHERE `user_email`=? AND `status`=?";
            $select_result = $con->prepare($select_email_query);
            if($select_result){
                $select_result->bind_param('ss',$user_email,$user_status);
                if($select_result->execute()){
                    $select_result->bind_result($user_name,$user_email,$user_token);
                    $select_result->store_result();
                    if($select_result->num_rows > 0){
                        $select_result->fetch();
                        $subject = "Reset Password";
                        $body = "Hello, \n$user_name. \nClick below link to Reset Password of your Email Account\nhttp://localhost/project1/reset_password.php?user_token=$user_token";
                        $sender = "From : shivlalkumarsharma303062003@rjcollege.edu.in";
                        if(mail($user_email,$subject,$body,$sender)){
                            echo "<script>alert('Verify your Email...')</script>";
                            echo "<script>window.open('login.php','_self')</script>";
                        }else{
                            echo "<script>alert('Something went wrong...')</script>";
                            echo "<script>window.open('forget_password.php','_self')</script>";
                        }
                    }else{
                        echo "<script>alert('Invalid Email...')</script>";
                        echo "<script>window.open('forget_password.php','_self')</script>";
                    }
                }else{
                    echo "<script>window.open('forget_password.php','_self')</script>";
                }
            }else{
                echo "<script>window.open('forget_password.php','_self')</script>";
            }
            $select_result->close();
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
        <div class='container'>
            <div class='form-container'>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>
                    <div class='form-group'>
                        <label for='email'>Email</label>
                        <input type='email' id='email' name='email' required>
                        <?php if(isset($user_email_error)) echo $user_email_error; ?>
                    </div>
                    <div class='form-group'>
                        <button type='submit' name='forget_password'>Next</button>
                    </div>
                    <p>Don't have an account ? <a href='register.php'>Register</a></p>
                </form>
            </div>
        </div>
    </main>
</body>
</html>