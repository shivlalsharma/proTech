<?php 
    include '../functions/admin_files.php';
    @session_start();
    if(isset($_SESSION['admin_id'])){
        header('Location:admin_login.php');
        exit();
    }

    if(isset($_POST['reset_pass'])){
        $admin_cpass = $admin_pass = "";
        $admin_cpass_error = $admin_pass_error = "";
        function testinput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if(!empty($_POST['password'])){
            $admin_pass = testinput($_POST['password']);
        }else{
            $admin_pass_error = "<p>Password must be required</p>";
        }
        if(!empty($_POST['cpassword'])){
            $admin_cpass = testinput($_POST['cpassword']);
        }else{
            $admin_cpass_error = "<p>Confirm Password must be required</p>";
        }
        if($admin_pass !== $admin_cpass){
            $admin_cpass_error = "<p>Incorrect Confirm Password</p>";
        }
        $admin_token = $_POST['admin_token'];
        $admin_hash_pass = password_hash($admin_pass,PASSWORD_BCRYPT);
        if(empty($admin_pass_error) && empty($admin_cpass_error)){
            include '../connect.php';
            $update_pass = "UPDATE `admin_table` SET `admin_password`=? WHERE `token`=?";
            $update_result = $con->prepare($update_pass);
            if($update_result){
                $update_result->bind_param('ss',$admin_hash_pass,$admin_token);
                if($update_result->execute()){
                    echo "<script>alert('Password has been changed successfully!');</script>";
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }else{
                    echo "<script>alert('Something went wrong...')</script>";
                    header('Location:admin_forget_pass.php');
                    exit();
                }
            }else{
                echo "<script>alert('Something went wrong...')</script>";
                header('Location:admin_forget_pass.php');
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
    <link rel="icon" type="image/png" href="../all_images/logo.png" />
    <link rel="stylesheet" href="../admin_css/admin_header.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
    <?php
        include '../connect.php';
        $token = $_GET['token'];
        $select_query = "SELECT `token` FROM `admin_table` WHERE `token`=?";
        $select_result = $con->prepare($select_query);
        if($select_result){
            $select_result->bind_param('s',$token);
            if($select_result->execute()){
                $select_result->bind_result($token);
                $select_result->store_result();
                if($select_result->num_rows > 0){
                    $select_result->fetch();
    ?>
    <?php get_admin_header(); ?>
    <main>
        <div class="container">
            <div class="form-container">
                <h2>Reset Password</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" onsubmit="return validate()">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" onkeyup="check1(this.value)" required>
                        <i class="fa-sharp fa-solid fa-eye-slash" id="eye-close" onClick="toggle()"></i>
                        <p class="error"></p>
                        <?php if(isset($admin_pass_error)) echo $admin_pass_error; ?>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" id="cpassword" name="cpassword" onkeyup="check2(this.value)" required>
                        <p class="error"></p>
                        <?php if(isset($admin_cpass_error)) echo $admin_cpass_error; ?>
                    </div>
                    <input type="hidden" name="admin_token" value="<?php echo $token; ?>">
                    <div class="form-group">
                        <button type="submit" name="reset_pass">Reset Password</button>
                    </div>
                    <p>Are you admin ? <a href="admin_login.php">Login</a></p>
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

    <script src="../js/register.js"></script>
</body>
</html>