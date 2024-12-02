<?php
    @session_start();
    include '../functions/admin_files.php';
    if(isset($_SESSION['admin_id'])){
        header('Location:dashboard.php');
        exit();
    }

    if(isset($_POST['forget_pass'])){
        $admin_email = "";
        $admin_email_error = "";
        function testinput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if(!empty($_POST['email'])){
            $admin_email = testinput($_POST['email']);
        }else{
            $admin_email_error = "<p>Email must be required</p>";
        }
        $admin_status = "active";
        if(empty($admin_email_error) && !empty($admin_status) && $admin_status === "active"){
            include '../connect.php';
            $select_email_query = "SELECT `admin_name`,`admin_email`,`token`,`status` FROM `admin_table` WHERE `admin_email`=? AND `status`=?";
            $select_result = $con->prepare($select_email_query);
            if($select_result){
                $select_result->bind_param('ss',$admin_email,$admin_status);
                if($select_result->execute()){
                    $select_result->bind_result($admin_name,$admin_email,$token,$status);
                    $select_result->store_result();
                    if($select_result->num_rows > 0){
                        $select_result->fetch();
                        $subject = "Reset Password";
                        $body = "Hello,\n$admin_name.\nClick here to Reset Password of your Email Account.\nhttp://localhost/project1/admin/admin_reset_pass.php?token=$token";
                        $sender = "From : shivlalkumarsharma303062003@rjcollege.edu.in";
                        if(mail($admin_email,$subject,$body,$sender)){
                            echo "<script>alert('Verify your Email...')</script>";
                            echo "<script>window.open('admin_login.php','_self')</script>";
                        }else{
                            echo "<script>alert('Something went wrong...')</script>";
                            echo "<script>window.open('admin_forget_pass.php','_self')</script>";
                            exit();
                        }
                    }else{
                        echo "<script>alert('Invalid Email...')</script>";
                        echo "<script>window.open('admin_forget_pass.php','_self')</script>";
                        exit();
                    }
                }else{
                    echo "<script>window.open('admin_forget_pass.php','_self')</script>";
                    exit();
                }
            }else{
                echo "<script>window.open('admin_forget_pass.php','_self')</script>";
                exit();
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
    <link rel="icon" type="image/png" href="../all_images/logo.png" />
    <link rel="stylesheet" href="../admin_css/admin_header.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
    <?php get_admin_header(); ?>
    <main>
        <div class='container'>
            <div class='form-container'>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>
                    <div class='form-group'>
                        <label for='email'>Email</label>
                        <input type='email' id='email' name='email' required>
                        <?php if(isset($admin_email_error)) echo $admin_email_error; ?>
                    </div>
                    <div class='form-group'>
                        <button type='submit' name='forget_pass'>Next</button>
                    </div>
                    <p>Are you admin ? <a href='admin_login.php'>Login</a></p>
                </form>
            </div>
        </div>
    </main>
</body>
</html>