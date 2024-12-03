<?php 
    include '../functions/admin_files.php';
    @session_start();
    if(isset($_SESSION['admin_id'])){
        echo "<script>window.open('dashboard.php','_self');</script>";
    }
    $admin_email = $admin_pass = "";
    $admin_email_error = $admin_pass_error ="";
    if(isset($_POST['admin_login'])){
        function testinput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if(!empty($_POST['email'])){
            $admin_email = testinput($_POST['email']);
        }
        else{
            $admin_email_error = "<p>Email must be required</p>";
        }
        if(!empty($_POST['password'])){
            $admin_pass = testinput($_POST['password']);
        }
        else{
            $admin_pass_error = "<p>Password must be required</p>";
        }

        $admin_status = 'active';

        include '../connect.php';
        $select_query = "SELECT `admin_id`,`admin_email`,`admin_password` FROM `admin_table` WHERE `admin_email`=? AND `status`=?";
        $result = $con->prepare($select_query);
        if($result){
            $result->bind_param('ss',$admin_email,$admin_status);
            if($result->execute()){
                $values = $result->get_result();
                if($values->num_rows > 0){
                    $row = $values->fetch_assoc();
                    $admin_id = $row['admin_id'];
                    if(password_verify($admin_pass,$row['admin_password'])){
                        $_SESSION['admin_id'] = $admin_id;
                        echo "<script>alert('You have logged in successfully!');</script>";
                        echo "<script>window.open('dashboard.php','_self');</script>";
                    }
                    else{
                        echo "<script>alert('Invalid Password...');</script>";
                        echo "<script>window.open('admin_login.php','_self');</script>";
                    }
                }
                else{
                    echo "<script>alert('Invalid Credentials...');</script>";
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            }
            else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
            $values->close();
        }
        else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
        $result->close();
        $con->close();
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
        <div class="container">
            <div class="form-container">
                <h2>Admin Login</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                        <?php if(isset($admin_email_error)) echo $admin_email_error; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                        <i class="fa-sharp fa-solid fa-eye-slash" id="eye-close" onClick="toggle()"></i>
                        <?php if(isset($admin_pass_error)) echo $admin_pass_error; ?>
                    </div>
                    <div class="form-group">
                        <a href="admin_forget_pass.php">Forget Password?</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="admin_login">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="../js/register.js"></script>
</body>
</html>
