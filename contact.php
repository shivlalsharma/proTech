<?php
    session_start();
    include './functions/common_files.php';
    if(!isset($_SESSION['user_id'])){
        get_cart_details();
    }
    
    $user_id = $_SESSION['user_id'];

    if(isset($_POST['contact'])){
        if(isset($_SESSION['user_id'])){
            $user_email = $user_name = $user_message = "";
            $user_name_error = $user_message_error = $user_email_error = "";

            function testinput($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if(!empty($_POST['name'])){
                $user_name = testinput($_POST['name']);
            }
            else{
                $user_name_error = "<p>Name must be required</p>";
            }

            if(!empty($_POST['email'])){
                $user_email = testinput($_POST['email']);
            }
            else{
                $user_email_error = "<p>Email must be required</p>";
            }

            if(!empty($_POST['message'])){
                $user_message = testinput($_POST['message']);
            }
            else{
                $user_message_error = "<p>Message must be required</p>";
            }

            $user_id = (int) $_POST['user_id'];

            if(empty($user_name_error) && empty($user_email_error) && empty($user_message_error)){
                include 'connect.php';
                $select_query = "SELECT `user_id`,`user_name`,`user_email`,`user_message` FROM `contact` WHERE `user_id`=? && `user_name`=? && `user_email`=? && `user_message`=?";
                $answer = $con->prepare($select_query);
                if($answer){
                    $answer->bind_param('isss',$user_id,$user_name,$user_email,$user_message);
                    if($answer->execute()){
                        $answer->store_result();
                        if($answer->num_rows > 0){
                            echo "<script>alert('Message has already been sent successfully!');</script>";
                            echo "<script>window.open('contact.php','_self');</script>";
                        }
                        else{
                            $insert_query = "INSERT INTO `contact` (`user_id`,`user_name`,`user_email`,`user_message`) VALUES(?,?,?,?)";
                            $result = $con->prepare($insert_query);
                            if($result){
                                $result->bind_param('isss',$user_id,$user_name,$user_email,$user_message);
                                if($result->execute()){
                                    echo "<script>alert('Message has been sent successfully!');</script>";
                                    echo "<script>window.open('contact.php','_self');</script>";
                                }
                                else{
                                    echo "<script>window.open('contact.php','_self');</script>";
                                }
                            }
                            else{
                                echo "<script>window.open('contact.php','_self');</script>";
                            }
                            $result->close();
                        }
                    }
                    else{
                        echo "<script>window.open('contact.php','_self');</script>";
                    }
                }
                else{
                    echo "<script>window.open('contact.php','_self');</script>";
                }
                $answer->close();
                $con->close();
            }
            else{
                $user_email_error = $user_email_error;
                $user_name_error = $user_name_error;
                $user_message_error = $user_message_error;
            }
        }
        else{
            echo "<script>window.open('login.php','_self');</script>";
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
    <link rel="stylesheet" href="./css/user_sidebar.css"/>
    <link rel="stylesheet" href="./css/header.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
<?php 
    get_header(); 
    get_user_profile();
?>
    <main>
        <div class="container">
            <div class="form-container">
                <h2>Contact</h2>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                        <?php if(isset($user_name_error)) echo $user_name_error; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                        <?php if(isset($user_email_error)) echo $user_email_error; ?>
                    </div>                 
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" rows="4" style="width:100%;resize:vertical;padding:10px;border: 1px solid #ddd;
    border-radius: 4px;" required></textarea>
                        <?php if(isset($user_message_error)) echo $user_message_error; ?>
                    </div>    
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">               
                    <div class="form-group">
                        <button type="submit" name="contact">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="./js/sidebar.js"></script>
    <script src="./js/user-sidebar2.js"></script>
</body>
</html>
