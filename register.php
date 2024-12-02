<?php 
    include 'connect.php';
    include './functions/common_files.php';
    session_start();

    if(isset($_SESSION['user_id'])){
        get_cart_details();
    }

    if(isset($_GET['token'])){
        $token = $_GET['token'];
        $user_status = "active";
        $update_status = "UPDATE `register` SET `status`=? WHERE `token`=?";
        $status_result = $con->prepare($update_status);
        if($status_result){
            $status_result->bind_param('si',$user_status,$token);
            if($status_result->execute()){
                header('location:login.php');
            }
            else{
                header('location:register.php');
            }
        }
        else{
            header('location:register.php');
        }
    }

    $user_name = $user_email = $user_pass = $user_cpass = $user_image = $user_mobile_no = $user_address = "";
    $user_name_error = $user_email_error = $user_pass_error = $user_cpass_error = "";

    if(isset($_POST['register'])){
        function testinput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if(!empty($_POST['username'])){
            $user_name = testinput($_POST['username']);
        }
        else{
            $user_name_error = "<p>Username must be required</p>";
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
        
        if(!empty($_POST['cpassword'])){
            $user_cpass = testinput($_POST['cpassword']);
        }
        else{
            $user_cpass_error = "<p>Confirm Password must be required</p>";
        }
        
        $user_image = "default.png";
        $user_mobile_no = (int) "";
        $user_address = "";
        $user_token = bin2hex(random_bytes(20));
        $current_status = "inactive";
        $user_status = "active";
        
        if($user_pass !== $user_cpass){
            $user_cpass_error = "<p>Incorrect Confirm Password</p>";
        }

        if (empty($user_name_error) && empty($user_email_error) && empty($user_pass_error) && empty($user_cpass_error)) {
            $user_hash_pass = password_hash($user_cpass, PASSWORD_BCRYPT);
            $select_query = "SELECT `user_email`,`status` FROM `register` WHERE `user_email`= ? AND `status`=?";
            $result = $con->prepare($select_query);
            if($result){
                $result->bind_param('ss',$user_email,$user_status);
                if($result->execute()){
                    $result->store_result();
                    if($result->num_rows > 0){
                        echo "<script>alert('Email already exists..');</script>";
                        echo "<script>window.open('register.php','_self');</script>";
                    }
                    elseif($user_pass !== $user_cpass){
                        echo "<script>alert('Invalid Confirm Password...');</script>";
                        echo "<script>window.open('register.php','_self');</script>";
                    }
                    else{
                        $insert_query = "INSERT INTO `register` (`user_name`,`user_image`,`user_address`,`user_phone`,`user_email`,`user_password`,`token`,`status`) VALUES(?,?,?,?,?,?,?,?)";
                        $answer = $con->prepare($insert_query);
                        if($answer){
                            $answer->bind_param('sssissss',$user_name,$user_image,$user_address,$user_mobile_no,$user_email,$user_hash_pass,$user_token,$current_status);
                            if($answer->execute()){
                                $subject = "Email Verification";
                                $body = "Hello, \n$user_name. \nClick below link to verify your Email Account\nhttp://localhost/project1/register.php?token=$user_token";
                                $sender = "From: shivlalkumarsharma30062003@rjcollege.edu.in";
                                if(mail($user_email,$subject,$body,$sender)){
                                    echo "<script>alert('Verify your Email...');</script>";
                                    echo "<script>window.open('login.php','_self');</script>";
                                }
                                else{
                                    echo "<script>alert('Something went wrong...');</script>";
                                    echo "<script>window.open('register.php','_self');</script>";
                                }
                            }
                            else{
                                echo "<script>window.open('register.php','_self');</script>";
                            }
                        }
                        else{
                            echo "<script>window.open('register.php','_self');</script>";
                        }
                        $answer->close();
                    }
                }
                else{
                    echo "<script>window.open('register.php','_self');</script>";
                }
            }
            else{
                echo "<script>window.open('register.php','_self');</script>";
            }
            $result->close();
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
    <link rel="stylesheet" href="./css/register.css"/>
    <link rel="stylesheet" href="./css/header.css"/>
    <link rel='stylesheet' href='./css/footer.css'/>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css'/>
</head>
<body>
    <?php get_header(); ?>
    <main>
        <div class="container">
            <div class="form-container">
                <h2>Sign Up</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="return validate()" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text" id="username" name="username" required>
                        <?php if(isset($user_name_error)) echo $user_name_error; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                        <?php if(isset($user_email_error)) echo $user_email_error; ?>
                    </div>
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
                    <div class="form-group">
                        <button type="submit" name="register">Sign Up</button>
                    </div>
                    <p>Already have an account ?<a href="login.php">Login</a></p>
                </form>
            </div>
        </div>
    </main>
    <?php get_footer(); ?>

    <script src="./js/register.js"></script>
    <script src="./js/sidebar.js"></script>
</body>
</html>
