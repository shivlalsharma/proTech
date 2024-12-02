<?php
    function get_current_url(){
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== "off") ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        if(strpos($host,"www.") !== 0){
            $host = "www." .$host;
        }
        $request_uri = $_SERVER['REQUEST_URI'];
        $current_url = $protocol ."://". $host . $request_uri;
        echo $current_url;
    }

    function get_cart_header(){
        @session_start();
        echo "<div id='modal'>
                <div class='modal-content'>
                    <div class='sidebar' id='sidebar'>
                        <span id='closeSidebar'>&times;</span>";
                        if(isset($_SESSION['user_id'])){
                            include 'connect.php';
                            $user_id = $_SESSION['user_id'];
                            $select_query = 'SELECT `user_image` FROM `register` WHERE `user_id`=?';
                            $result = $con->prepare($select_query);
                            if($result){
                                $result->bind_param('i',$user_id);
                                if($result->execute()){
                                    $result->bind_result($user_image);
                                    $result->store_result();
                                    if($result->num_rows > 0){
                                        $result->fetch();
                                        echo "<a href='profile.php' class='user-picture'><img src='./user_images/$user_image' alt='Profile Page' class='profile-image' title='Edit Profile'></a>";
                                    }
                                }
                            }
                            $result->close();
                            $con->close();
                        }

                        $top = isset($_SESSION['user_id']) ? "119px" : "59px";
                        $right = isset($_SESSION['user_id']) ? "-34px" : "-34px";

                        echo "<li><a href='home.php'>Home</a></li>
                        <li><a href='products.php'>Products</a>
                              <ul class='sub-product' style='top:$top;right:$right;'>
                                      <li>Brands <i class='fa-sharp fa-solid fa-arrow-right'></i>
                                          <ul class='sub-brand'>";
                                              if(function_exists('get_brands')){
                                                  get_brands();
                                              }
                                     echo "</ul>
                                      </li>
                                      <li>Categories <i class='fa-sharp fa-solid fa-arrow-right'></i>
                                          <ul class='sub-category'>";
                                              if(function_exists('get_categories')){
                                                  get_categories();
                                              }
                                     echo "</ul>
                                      </li>
                              </ul>
                        </li>
                        <li><a href='contact.php'>Contact</a></li>";
                        if(!isset($_SESSION['user_id'])){
                            echo "<li class='login'><a href='register.php'>Register</a></li>
                            <li class='login'><a href='login.php'>Login</a></li>";
                        }
                        else{
                            echo "<li class='logout'><a href='logout.php'>Logout</a></li>";
                        }
                    echo "</div>
                </div>
            </div>
            <header>
                <nav class='navbar'>
                    <div class='navbar-brand'>
                        <span id='hamburger'><i class='fa-sharp fa-solid fa-bars' id='openSidebar'></i></span>
                        <a href='about-us.php'><img src='./all_images/logo.png' alt='Company Logo' class='logo-image' title='About Us'></a>
                    </div>
                    <ul class='navbar-links'>";
                        if(isset($_SESSION['user_id'])){
                            include 'connect.php';
                            $user_id = $_SESSION['user_id'];
                            $select_query = 'SELECT `user_image` FROM `register` WHERE `user_id`=?';
                            $result = $con->prepare($select_query);
                            if($result){
                                $result->bind_param('i',$user_id);
                                if($result->execute()){
                                    $result->bind_result($user_image);
                                    $result->store_result();
                                    if($result->num_rows > 0){
                                        $result->fetch();
                                        echo "<a href='profile.php' class='user-picture'><img src='./user_images/$user_image' alt='Profile Page' class='profile-image' title='Edit Profile'></a>";
                                    }
                                }
                            }
                            $result->close();
                            $con->close();
                        }
                        echo "<li class='home'><a href='home.php'>Home</a></li>
                        <li class='products'><a href='products.php'>Products</a>
                            <ul class='sub-products'>
                                    <li>Brands <i class='fa-sharp fa-solid fa-arrow-right'></i>
                                        <ul class='sub-brands'>";
                                            if(function_exists('get_brands')){
                                                get_brands();
                                            }
                                  echo "</ul>
                                    </li>
                                    <li>Categories <i class='fa-sharp fa-solid fa-arrow-right'></i>
                                        <ul class='sub-categories'>";
                                            if(function_exists('get_categories')){
                                                get_categories();
                                            }
                                  echo "</ul>
                                    </li>
                            </ul>
                        </li>
                        <li class='cart-detail'><a href='cart_table.php'><i class='fa-sharp fa-solid fa-cart-shopping'></i><sup>";if(isset($_SESSION['user_id'])){ if(function_exists('get_all_carts')){get_all_carts();}}else{echo '0';} echo "</sup></a></li>
                        <li class='contact'><a href='contact.php'>Contact</a></li>
                        <li class='total-price'>Total Price Rs."; if(isset($_SESSION['user_id'])){ if(function_exists('get_total_price')){ get_total_price();}}else{echo '0.00';} echo "/-</li>";
                        if(!isset($_SESSION['user_id'])){
                            echo "<li class='register'><a href='register.php' class='register-link'>Register</a></li>
                            <li class='login'><a href='login.php' class='register-link'>Login</a></li>";
                        }
                        else{
                            echo "<li class='logout'><a href='logout.php' class='logout-link'>Logout</a></li>";
                        }
               echo "</ul>
                    <div class='navbar-brand'>
                        <form class='navbar-search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                            <input type='text' name='search_name' placeholder='Search...'>
                            <button type='submit' name='search_data'><i class='fa-sharp fa-solid fa-magnifying-glass'></i></button>
                        </form>";
                        if(isset($_SESSION['user_id'])){
                            include 'connect.php';
                            $user_id = $_SESSION['user_id'];
                            $select_query = 'SELECT `user_image` FROM `register` WHERE `user_id`=?';
                            $result = $con->prepare($select_query);
                            if($result){
                                $result->bind_param('i',$user_id);
                                if($result->execute()){
                                    $result->bind_result($user_image);
                                    $result->store_result();
                                    if($result->num_rows > 0){
                                        $result->fetch();
                                        echo "<a href='profile.php' class='user-profile'><img src='./user_images/$user_image' alt='Profile Page' class='profile-image' title='Edit Profile'></a>";
                                    }
                                }
                            }
                            $result->close();
                            $con->close();
                        }
              echo "</div>
                </nav>
            </header>";               
    }

    function get_header(){
        echo "<div id='modal'>
                <div class='modal-content'>
                    <div class='sidebar' id='sidebar'>
                        <span id='closeSidebar'>&times;</span>";
                        if(isset($_SESSION['user_id'])){
                            include 'connect.php';
                            $user_id = $_SESSION['user_id'];
                            $select_query = 'SELECT `user_image` FROM `register` WHERE `user_id`=?';
                            $result = $con->prepare($select_query);
                            if($result){
                                $result->bind_param('i',$user_id);
                                if($result->execute()){
                                    $result->bind_result($user_image);
                                    $result->store_result();
                                    if($result->num_rows > 0){
                                        $result->fetch();
                                        echo "<a href='profile.php' class='user-picture'><img src='./user_images/$user_image' alt='Profile Page' class='profile-image' title='Edit Profile'></a>";
                                    }
                                }
                            }
                            $result->close();
                            $con->close();
                        }

                        $top = isset($_SESSION['user_id']) ? "100px" : "40px";
                        $right = isset($_SESSION['user_id']) ? "-12px" : "-22px";

                        echo "<li><a href='home.php'>Home</a></li>
                        <li><a href='products.php'>Products</a></li>
                        <li><a href='contact.php'>Contact</a></li>";
                        if(!isset($_SESSION['user_id'])){
                            echo "<li class='login'><a href='register.php'>Register</a></li>
                            <li class='login'><a href='login.php'>Login</a></li>";
                        }
                        else{
                            echo "<li class='logout'><a href='logout.php'>Logout</a></li>";
                        }
                    echo "</div>
                </div>
            </div>
            <header>
                <nav class='navbar'>
                    <div class='navbar-brand'>
                        <span id='hamburger'><i class='fa-sharp fa-solid fa-bars' id='openSidebar'></i></span>
                        <a href='about-us.php'><img src='./all_images/logo.png' alt='Company Logo' class='logo-image' title='About Us'></a>
                    </div>
                    <ul class='navbar-links'>
                        <li class='home'><a href='home.php'>Home</a></li>
                        <li class='product'><a href='products.php'>Products</a></li>
                        <li class='contact'><a href='contact.php'>Contact</a></li>";
                        if(!isset($_SESSION['user_id'])){
                            echo "<li class='register'><a href='register.php' class='register-link'>Register</a></li>
                            <li class='login'><a href='login.php' class='register-link'>Login</a></li>";
                        }
                        else{
                            echo "<li class='logout'><a href='logout.php' class='logout-link'>Logout</a></li>";
                        } 
                echo "</ul>
                    <ul class='navbar-links' id='user-image'>";
                        if(isset($_SESSION['user_id'])){
                            include 'connect.php';
                            $user_id = $_SESSION['user_id'];
                            $select_query = 'SELECT `user_image` FROM `register` WHERE `user_id`=?';
                            $result = $con->prepare($select_query);
                            if($result){
                                $result->bind_param('i',$user_id);
                                if($result->execute()){
                                    $result->bind_result($user_image);
                                    $result->store_result();
                                    if($result->num_rows > 0){
                                        $result->fetch();
                                        echo "<img src='./user_images/$user_image' alt='Profile Page' class='profile-image' title='Edit Profile' id='userSidebarOpen'>";
                                    }
                                }
                            }
                            $result->close();
                            $con->close();
                        }
                    echo "</ul>
                </nav>
            </header>";
    }

    function get_footer(){
        echo "<footer class='footer'>
                <div class='footer-content'>
                    <div class='footer-section'>
                        <h3>Contact Us</h3>
                        <p>Mankhurd, Mumbai 400088, India.</p>
                        <p><a href='mailto:shivlalsharma063@gmail.com'>shivlalsharma063@gmail.com</a></p>
                        <p>+91 123 456 7890</p>
                    </div>
                    <div class='footer-section'>
                        <h3>Quick Links</h3>
                        <div class='hyper-links'>
                            <a href='home.php'>Home</a>
                            <a href='products.php'>Products</a>
                            <a href='contact.php'>Contact</a>";
                                if(!isset($_SESSION['user_id'])){
                                    echo "<a href='register.php'>Register</a>
                                        <a href='login.php'>Login</a>";
                                }
                                else{
                                    echo "<a href='logout.php'>Logout</a>";
                                }
                    echo"</div>
                    </div>
                    <div class='footer-section' id='footer-social'>
                        <h3>Follow Us</h3>
                        <a href='https://www.linkedin.com/in/shivlal-sharma-56ba5a284/' target='_blank'><img src='./social-apps/LinkedIn.png' alt='LinkedIn'></a>
                        <a href='https://x.com/Shivlal85478071' target='_blank'><img src='./social-apps/x.png' alt='X'></a>
                        <a href='https://www.facebook.com/profile.php?id=100042969632345' target='_blank'><img src='./social-apps/Facebook.png' alt='Facebook'></a>
                        <a href='https://www.instagram.com/_.n482' target='_blank'><img src='./social-apps/Instagram.png' alt='Instagram'></a>
                    </div>
                </div>
                <div class='footer-bottom'>
                    <div class='copyright'>
                        <p>&copy; ".date('Y')." proTech. All rights reserved.</p>
                    </div>
                </div>
            </footer>";
    }

    function get_all_products(){
        include 'connect.php';
        if(!isset($_GET['category'])){
            If(!isset($_GET['brand'])){
                if(!isset($_GET['search_data'])){
                    $select_query = "SELECT `product_id`, `product_name`,`product_description`,`category_id`,`brand_id`,`product_image1`,`product_price` FROM `products` ORDER BY rand()";
                    $result = $con->prepare($select_query);
                    $result->execute();
                    $result->bind_result( $product_id,$product_name,$product_description,$category_id,$brand_id,$product_image1,$product_price);
                    $result->store_result();
                    if($result->num_rows > 0){
                        echo "<div class='container'>";
                        while($result->fetch()){
                            $formatted_price = number_format($product_price,2,'.',',');
                            echo "<div class='product-card'>
                                    <img src='./product_images/$product_image1' alt='$product_name' class='product-image'>
                                    <div class='product-info'>
                                        <h2 class='product-title'>$product_name</h2>
                                        <p class='product-description'>$product_description</p>
                                        <p class='product-price'>Rs.$formatted_price/-</p>
                                        <div class='product-detail'>
                                            <a href='home.php?add_to_cart=$product_id' class='add-to-cart'>Add to Cart</a>
                                            <a href='product_details.php?product_id=$product_id' class='view-more'>View More</a>
                                        </div>
                                    </div>
                                </div>";
                        }
                        echo "</div>";
                        get_footer();
                    }
                    else{
                        echo "<h2 class='no-found'>There is no product</h2>";
                    }   
                    $result->close();
                }    
            }
        }
        $con->close();
    }

    function get_product_details(){
        include 'connect.php';
        if(isset($_GET['product_id'])){
            $select_query = "SELECT `product_id`, `product_name`,`product_description`,`category_id`,`brand_id`,`product_image1`,`product_image2`,`product_image3`,`product_price` FROM `products` WHERE `product_id`=?";
            $result = $con->prepare($select_query);
            $result->bind_param('i',$product_id);
            $product_id = $_GET['product_id'];
            $result->execute();
            $result->bind_result($product_id, $product_name,$product_description,$category_id,$brand_id,$product_image1,$product_image2,$product_image3,$product_price);
            $result->store_result();
            if($result->num_rows > 0){
                echo "<div class='container'>";
                while($result->fetch()){
                    $formatted_price = number_format($product_price,2,'.',',');
                    echo "<div class='product-card'>
                            <img src='./product_images/$product_image1' alt='$product_name' class='product-image'>
                            <div class='product-info'>
                                <h2 class='product-title'>$product_name</h2>
                                <p class='product-description'>$product_description</p>
                                <p class='product-price'>Rs.$formatted_price/-</p>
                                <a href='home.php?add_to_cart=$product_id' class='add-to-cart'>Add to Cart</a>
                                <a href='home.php' class='view-more'>Go Home</a>
                            </div>
                        </div>
                        <div class='product-card'>
                            <img src='./product_images/$product_image2' alt='$product_name' class='image-product'>
                        </div>
                         <div class='product-card'>
                            <img src='./product_images/$product_image3' alt='$product_name' class='image-product'>
                        </div>";
                }
                echo "</div>";
            }
            else{
                header('Location:home.php');
                exit();
            }   
            $result->close();
        }
        $con->close();
    }   

    function get_categories(){
        include 'connect.php';
        $result = $con->prepare("SELECT category_id , category_name FROM `categories`");
        $result->execute();
        $result->bind_result($category_id,$category_name);
        $result->store_result();
        if($result->num_rows > 0){
            while($result->fetch()){
                echo "<li><a href='home.php?category=$category_id'>$category_name</a></li>";
            }
        }
        $result->close();
        $con->close();
    }

    function get_brands(){
        include 'connect.php';
        $result = $con->prepare("SELECT brand_id , brand_name FROM `brands`");
        $result->execute();
        $result->bind_result($brand_id,$brand_name);
        $result->store_result();
        if($result->num_rows > 0){
            while($result->fetch()){
                echo "<li><a href='home.php?brand=$brand_id'>$brand_name</a></li>";
            }
        }
        $result->close();
        $con->close();
    }
    
    function get_unique_category(){
        include 'connect.php';
        if(isset($_GET['category'])){
            $select_query = "SELECT `product_id`, `product_name`,`product_description`,`category_id`,`brand_id`,`product_image1`,`product_price` FROM `products` WHERE `category_id`=?";
            $result = $con->prepare($select_query);
            $result->bind_param('i',$category_id);
            $category_id = $_GET['category'];
            $result->execute();
            $result->bind_result($product_id, $product_name,$product_description,$category_id,$brand_id,$product_image1,$product_price);
            $result->store_result();
            if($result->num_rows > 0){
                echo "<div class='container'>";
                while($result->fetch()){
                    $formatted_price = number_format($product_price,2,'.',',');
                    echo "<div class='product-card'>
                            <img src='./product_images/$product_image1' alt='$product_name' class='product-image'>
                            <div class='product-info'>
                                <h2 class='product-title'>$product_name</h2>
                                <p class='product-description'>$product_description</p>
                                <p class='product-price'>Rs.$formatted_price/-</p>
                                <a href='home.php?add_to_cart=$product_id' class='add-to-cart'>Add to Cart</a>
                                <a href='product_details.php?product_id=$product_id' class='view-more'>View More</a>
                            </div>
                        </div>";
                }
                echo "</div>";
            }
            else{
                header('Location:home.php');
                exit();
            }  
            $result->close();     
        }
        $con->close();
    }

    function get_unique_brand(){
        include 'connect.php';
        if(isset($_GET['brand'])){
            $select_query = "SELECT `product_id`,`product_name`,`product_description`,`category_id`,`brand_id`,`product_image1`,`product_price` FROM `products` WHERE `brand_id`=?";
            $result = $con->prepare($select_query);
            $result->bind_param('i',$brand_id);
            $brand_id = $_GET['brand'];
            $result->execute();
            $result->bind_result($product_id, $product_name,$product_description,$category_id,$brand_id,$product_image1,$product_price);
            $result->store_result();
            if($result->num_rows > 0){
                echo "<div class='container'>";
                while($result->fetch()){
                    $formatted_price = number_format($product_price,2,'.',',');
                    echo "<div class='product-card'>
                            <img src='./product_images/$product_image1' alt='$product_name' class='product-image'>
                            <div class='product-info'>
                                <h2 class='product-title'>$product_name</h2>
                                <p class='product-description'>$product_description</p>
                                <p class='product-price'>Rs.$formatted_price/-</p>
                                <a href='home.php?add_to_cart=$product_id' class='add-to-cart'>Add to Cart</a>
                                <a href='product_details.php?product_id=$product_id' class='view-more'>View More</a>
                            </div>
                        </div>";
                }
                echo "</div>";
            }
            else{
                header('Location:home.php');
                exit();
            }   
            $result->close();    
        }
        $con->close();
    }

    function get_search_data(){
        if(isset($_GET['search_data'])){
            if(isset($_GET['search_name'])){
                if(!empty($_GET['search_name'])){
                    include 'connect.php';
                    $select_query = "SELECT `product_id`, `product_name`,`product_description`,`category_id`,`brand_id`,`product_image1`,`product_price` FROM `products` WHERE `product_name` LIKE ? OR `product_keywords` LIKE ? OR `product_description` LIKE ?";
                    $result = $con->prepare($select_query);
                    function testinput($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                    $result->bind_param('sss',$search_value,$search_value,$search_value);
                    $search_name = testinput($_GET['search_name']);
                    $search_value = "%$search_name%";
                    $result->execute();
                    $result->bind_result($product_id, $product_name,$product_description,$category_id,$brand_id,$product_image1,$product_price);
                    $result->store_result();
                    if($result->num_rows > 0){
                        echo "<div class='container'>";
                        while($result->fetch()){
                            $formatted_price = number_format($product_price,2,'.',',');
                            echo "<div class='product-card'>
                                    <img src='./product_images/$product_image1' alt='$product_name' class='product-image'>
                                    <div class='product-info'>
                                        <h2 class='product-title'>$product_name</h2>
                                        <p class='product-description'>$product_description</p>
                                        <p class='product-price'>Rs.$formatted_price/-</p>
                                        <a href='home.php?add_to_cart=$product_id' class='add-to-cart'>Add to Cart</a>
                                        <a href='product_details.php?product_id=$product_id' class='view-more'>View More</a>
                                    </div>
                                </div>";
                        }
                        echo "</div>";
                    }else{
                        echo "<h2 class='no-found'>No product found named \"$search_name\"</h2>";
                    }   
                    $result->close();   
                    $con->close();
                }else{
                    echo "<script>window.open('home.php','_self');</script>";
                } 
            }
        }
    }

    function add_to_cart(){
        include 'connect.php';
        if(isset($_GET['add_to_cart'])){
            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
                $product_id = $_GET['add_to_cart'];
                $exist_query = "SELECT * FROM `carts` WHERE `product_id`=? AND `user_id`=?";
                $answer = $con->prepare($exist_query);
                $answer->bind_param('ii',$product_id,$user_id);
                $answer->execute();
                $answer->store_result();
                if($answer->num_rows > 0){
                    echo "<script>alert('Product already present to cart...');</script>";
                    echo "<script>window.open('home.php','_self');</script>";
                } else{
                    $quantity = 1;
                    $insert_query = "INSERT INTO `carts` (`product_id`,`user_id`,`quantity`) VALUES(?,?,?)";
                    $result = $con->prepare($insert_query);
                    $result->bind_param('iii',$product_id,$user_id,$quantity);
                    if($result->execute()){
                        echo "<script>alert('Product inserted to cart successfully!');</script>";
                        echo "<script>window.open('home.php','_self');</script>";
                    }else{
                        echo "<script>window.open('home.php','_self');</script>";
                    }
                    $result->close();
                }
                $answer->close();
                $con->close();
            }else{
                echo "<script>window.open('login.php','_self');</script>";
            }
        }
    }
    
    function get_all_carts(){
        if(isset($_SESSION['user_id'])){
            include 'connect.php';
            $user_id = $_SESSION['user_id'];
            if(isset($_GET['add_to_cart'])){
                $select_query = "SELECT * FROM `carts` WHERE `user_id`=?";
                $result = $con->prepare($select_query);
                $result->bind_param('i',$user_id);
                $result->execute();
                $result->store_result();
            } else{
                $select_query = "SELECT * FROM `carts` WHERE `user_id`=?";
                $result = $con->prepare($select_query);
                $result->bind_param('i',$user_id);
                $result->execute();
                $result->store_result();
            }
            echo $result->num_rows;
            $result->close();
            $con->close();
        }
    }

    function get_total_price(){
        if(isset($_SESSION['user_id'])){
            include 'connect.php';
            $user_id = $_SESSION['user_id'];
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
                                    }else{
                                        echo "<script>window.open('home.php','_self');</script>";
                                    }
                                    $product_values->close();
                                }else{
                                    echo "<script>window.open('home.php','_self');</script>";
                                }
                                $total_price += $product_price * $product_quantity; 
                            }else{
                                echo "<script>window.open('home.php','_self');</script>";
                            }
                            $answer->close();
                        }
                    }
                }else{
                    echo "<script>window.open('home.php','_self');</script>";
                }
                $values->close();
            }else{
                echo "<script>window.open('home.php','_self');</script>";
            }
            echo number_format($total_price,2,'.',',');
            $result->close();
            $con->close();
        }
    }

    function get_total_product(){
        if(isset($_SESSION['user_id'])){
            include 'connect.php';
            $select_cart_query = "SELECT `product_id` FROM `carts` WHERE `user_id`=?";
            $result = $con->prepare($select_cart_query);
            if($result){
                $result->bind_param('i',$user_id);
                if($result->execute()){
                    $result->store_result();
                    $result->num_rows;
                }
                else{
                    echo "<script>window.open('home.php','_self');</script>";
                }
            }
            else{
                echo "<script>window.open('home.php','_self');</script>";
            }
            echo $result->num_rows;
            $result->close();
            $con->close();
        }
    }

    function get_cart_details(){
        include 'connect.php';
        $select_cart_query = "SELECT `user_id` FROM `carts` WHERE `user_id`=?";
        $cart_result = $con->prepare($select_cart_query);
        if($cart_result){
            $cart_result->bind_param('i',$user_id);
            if($cart_result->execute()){
                $cart_result->store_result();
                if($cart_result->num_rows > 0){
                    echo "<script>window.open('checkout.php','_self');</script>";
                }
                else{
                    echo "<script>window.open('home.php','_self');</script>";
                }
                $cart_result->close();
            }
            else{
                echo "<script>window.open('checkout.php','_self');</script>";
            }
        }
        else{
            echo "<script>window.open('home.php','_self');</script>";
        }
        $con->close();
    }

    function get_user_profile(){
        include 'connect.php';
        $user_id = $_SESSION['user_id'];
        $select_user_query = "SELECT `user_name`,`user_image` FROM `register` WHERE `user_id`=?";
        $user_result = $con->prepare($select_user_query);
        if($user_result){
            $user_result->bind_param('i',$user_id);
            if($user_result->execute()){
                $user_value = $user_result->get_result();
                if($user_value->num_rows > 0){
                    $row = $user_value->fetch_assoc();
                    $user_name = $row['user_name'];
                    $user_image = $row['user_image'];
                    echo "<div id='userModal'>
                            <aside class='sidebar-profile' id='userSidebar'>
                                <span id='userSidebarClose'>&times;</span>
                                <div class='profile-section'>
                                    <a href='profile.php'><img src='./user_images/$user_image' alt='User Profile Picture' class='profile-picture'></a>
                                    <h3 class='username'>$user_name</h3>
                                </div>
                                <div class='action-buttons'>
                                    <a href='profile.php?my_payments' class='action-button'>My Payments</a>
                                    <a href='profile.php?my_orders' class='action-button'>My Orders</a>
                                    <a href='profile.php?edit_account' class='action-button'>Edit Account</a>
                                    <a href='profile.php?delete_account' class='action-button delete-button'>Delete Account</a>".
                                    (isset($_SESSION['user_id']) ? "<a href='logout.php' class='logout-button'>Logout</a>" : "")."
                                </div>
                            </aside>
                        </div>";
                }
                else{
                    echo "<script>window.open('register.php','_self');</script>";
                }
            }
            else{
                echo "<script>window.open('home.php','_self');</script>";
            }
        } 
        else{
            echo "<script>window.open('home.php','_self');</script>";
        }
        $user_result->close();
        $con->close();
    }

    function get_order_pending_details(){
        if(!isset($_GET['my_orders'])){
            if(!isset($_GET['delete_account'])){
                if(!isset($_GET['edit_account'])){
                    if(!isset($_GET['my_payments'])){
                        if(!isset($_GET['order_id']))
                        if(isset($_SESSION['user_id'])){
                            include 'connect.php';
                            $user_id = $_SESSION['user_id'];
                            $order_status = "Pending...";
                            $select_pending_query = "SELECT `order_status` FROM `user_order` WHERE `user_id`=? AND `order_status`=?";
                            $pending_result = $con->prepare($select_pending_query);
                            if($pending_result){
                                $pending_result->bind_param('is',$user_id,$order_status);
                                if($pending_result->execute()){
                                    $pending_result->bind_result($order_status);
                                    $pending_result->store_result();
                                    $pending_rows = $pending_result->num_rows;
                                    if($pending_rows > 0){
                                        echo "<h2 class='pending-order'>You have $pending_rows Pending Orders</h2>
                                            <a href='profile.php?my_orders' class='order-details'>Order Details</a>";
                                    }
                                    else{
                                        echo "<h2 class='pending-order'>You have $pending_rows Pending Orders</h2>
                                            <a href='home.php' class='order-details'>Continue Shopping</a>";
                                    }
                                }
                            }
                            $pending_result->close();
                            $con->close();
                        }
                        else{
                            get_cart_details();
                        }
                    }
                }
            }
        }
    }

    function get_payment_details(){
        if(!isset($_GET['my_orders'])){
            if(!isset($_GET['delete_account'])){
                if(!isset($_GET['edit_account'])){
                    if(isset($_GET['my_payments'])){
                        if(empty($_GET['my_payments'])){
                            if(isset($_SESSION['user_id'])){
                                include 'connect.php';
                                $user_id = $_SESSION['user_id'];
                                $sr_no = 1;
                                $select_user_payment_query = "SELECT * FROM `payment` WHERE `user_id`=?";
                                $payment_result = $con->prepare($select_user_payment_query);
                                if($payment_result){
                                    $payment_result->bind_param('i',$user_id);
                                    if($payment_result->execute()){
                                        $payment_values = $payment_result->get_result();
                                        if($payment_values->num_rows > 0){
                                            echo "<table>
                                                    <thead>
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Order No.</th>
                                                            <th>Amount Paid</th>
                                                            <th>Invoice No.</th>
                                                            <th>Payment Method</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";
                                            while($payment_rows = $payment_values->fetch_assoc()){
                                                $order_id = $payment_rows['order_id'];
                                                $amount_paid = $payment_rows['amount_paid'];
                                                $amount_paid_format = number_format($amount_paid,2,'.',',');
                                                $invoice_number = $payment_rows['invoice_number'];
                                                $payment_method = $payment_rows['payment_method'];
                                                $payment_date = $payment_rows['date'];
                                                echo "<tr>
                                                        <td>$sr_no</td>
                                                        <td>$order_id</td>
                                                        <td>Rs.$amount_paid_format/-</td>
                                                        <td>$invoice_number</td>
                                                        <td>$payment_method</td>
                                                        <td>$payment_date</td>
                                                    </tr>";
                                            $sr_no++;
                                            }
                                            echo "</tbody>
                                            </table>";
                                        }
                                        else{
                                            echo "<h2 class='pending-order'>You have $payment_values->num_rows Payments</h2>
                                                <a href='profile.php?my_orders' class='order-details'>Order Details</a>";
                                        }
                                        $payment_values->close();
                                    }
                                }
                                $payment_result->close();
                                $con->close();
                            }
                            else{
                                get_cart_details();
                            }
                        }
                        else{
                            echo "<script>window.open('profile.php','_self');</script>";
                        }
                    }
                }
            }
        }
    }

    function get_user_order_details(){
        if(!isset($_GET['my_payments'])){
            if(!isset($_GET['delete_account'])){
                if(!isset($_GET['edit_account'])){
                    if(isset($_GET['my_orders'])){
                        if(empty($_GET['my_orders'])){
                            if(isset($_SESSION['user_id'])){
                                include 'connect.php';
                                $user_id = $_SESSION['user_id'];
                                $sr_no = 1;
                                $select_user_order_query = "SELECT * FROM `user_order` WHERE `user_id`=?";
                                $order_result = $con->prepare($select_user_order_query);
                                if($order_result){
                                    $order_result->bind_param('i',$user_id);
                                    if($order_result->execute()){
                                        $order_values = $order_result->get_result();
                                        if($order_values->num_rows > 0){
                                            echo "<table>
                                                    <thead>
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>Order No.</th>
                                                            <th>Amount Due</th>
                                                            <th>Invoice No.</th>
                                                            <th>Total Product</th>
                                                            <th class='status'>Completed/Pending</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";
                                            while($order_rows = $order_values->fetch_assoc()){
                                                $order_id = $order_rows['order_id'];
                                                $amount_due = $order_rows['amount_due'];
                                                $amount_due_format = number_format($amount_due,2,'.',',');
                                                $invoice_number = $order_rows['invoice_number'];
                                                $total_product = $order_rows['total_product'];
                                                $date = $order_rows['date'];
                                                $order_status = $order_rows['order_status'];
                                                echo "<tr>
                                                        <td>$sr_no</td>
                                                        <td>$order_id</td>
                                                        <td>Rs.$amount_due_format/-</td>
                                                        <td>$invoice_number</td>
                                                        <td>$total_product</td>
                                                        <td class='status'>$order_status</td>
                                                        <td>".($order_status==="Pending..." ? "<button class='confirm-button'><a href='profile.php?order_id=$order_id'>Confirm</a></button>" : "<button class='paid-button'>Paid</button>")."</td>
                                                        <td>$date</td>
                                                    </tr>";
                                            $sr_no++;
                                            }
                                            echo "</tbody>
                                            </table>";
                                        }
                                        else{
                                            echo "<h2 class='pending-order'>You have $order_values->num_rows Orders</h2>
                                                <a href='home.php' class='order-details'>Continue Shopping</a>";
                                        }
                                    }
                                }
                                $order_result->close();
                                $con->close();
                            }
                            else{
                                get_cart_details();
                            }
                        }
                        else{
                            echo "<script>window.open('profile.php','_self');</script>";
                        }
                    }
                }
            }
        }
    }

    function get_edit_account(){
        $user_name = $user_pass = $user_cpass = $user_image = $user_mobile_no = $user_address = "";
        $user_name_error = "";
        if(isset($_POST['update_account'])){
            include 'connect.php';
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
    
            if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
                $user_image = testinput($_FILES['user_image']['name']);
            }
            else{
                $user_image = "default.png";
            }
    
            if(!empty($_POST['user_mobile_no'])){
                $user_mobile_no = testinput($_POST['user_mobile_no']);
            }
            else{
                $user_mobile_no = (int) "";
            }
            
            if(!empty($_POST['user_address'])){
                $user_address = testinput($_POST['user_address']);
            }
            else{
                $user_address = "";
            }

            $user_id = $_POST['user_id'];
    
            if (empty($user_name_error)) {
                if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = 'user_images/';
                    if(!is_dir($upload_dir)){
                        mkdir($upload_dir,0755,true);
                    }
                    $upload_file = $upload_dir . basename($_FILES['user_image']['name']);
                    if (move_uploaded_file($_FILES['user_image']['tmp_name'], $upload_file)) {
                        $user_image = basename($_FILES['user_image']['name']);
                    } else {
                        $user_image = "default.png";
                    }
                } else {
                    $user_image = "default.png";
                }

                $update_query = "UPDATE `register` SET `user_name`=?,`user_image`=?,`user_address`=?,`user_phone`=? WHERE `user_id`=?";
                $answer = $con->prepare($update_query);
                if($answer){
                    $answer->bind_param('sssii',$user_name,$user_image,$user_address,$user_mobile_no,$user_id);
                    if($answer->execute()){
                        echo "<script>alert('Profile updated successfully!');</script>";
                        echo "<script>window.open('profile.php?edit_account','_self');</script>";
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
            else{
                $user_name_error = $user_name_error;
            }
            $con->close();
        }

        if(!isset($_GET['my_orders'])){
            if(!isset($_GET['delete_account'])){
                if(!isset($_GET['my_payments'])){
                    if(isset($_GET['edit_account'])){
                        if(empty($_GET['edit_account'])){
                            if(isset($_SESSION['user_id'])){
                                include 'connect.php';
                                $user_id = $_SESSION['user_id'];
                                $select_user_table = "SELECT `user_id`,`user_name`,`user_image`,`user_address`,`user_phone` FROM `register` WHERE `user_id`=?";
                                $result = $con->prepare($select_user_table);
                                if($result){
                                    $result->bind_param('i',$user_id);
                                    if($result->execute()){
                                        $values = $result->get_result();
                                        if($values->num_rows > 0){
                                            $rows = $values->fetch_assoc();   
                                            $user_id = $rows['user_id'];                                               
                                            $user_name = $rows['user_name'];
                                            $user_image = $rows['user_image'];
                                            $user_address = $rows['user_address'];
                                            $user_phone_no = $rows['user_phone'];
                                            if($user_phone_no === 0){
                                                $user_phone_no = "";
                                            }

                                            echo "<div class='form-container'>
                                            <h2>Edit Account</h2>
                                            <form action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='POST' enctype='multipart/form-data'>
                                                <div class='form-group'>
                                                    <label for='username'>Name</label>
                                                    <input type='text' id='username' name='username' value='".$user_name."' required>
                                                    ".(isset($user_name_error) ? "$user_name_error" : "")."
                                                </div>
                                                <div class='form-group'>
                                                    <label for='user_image'>Profile Image</label>
                                                    <input type='file' id='user_image' name='user_image' accept='image/*'>
                                                    <img src='./user_images/".$user_image."' class='user-image' alt='User Profile Picture'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='user_mobile_no'>Mobile Number</label>
                                                    <input type='tel' id='user_mobile_no' name='user_mobile_no' value='".$user_phone_no."' pattern='[0-9]{10}' title='Please enter a valid 10-digit mobile number'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='user_address'>Address</label>
                                                    <input type='text' id='user_address' name='user_address' value='".$user_address."'>
                                                </div>
                                                <input type='hidden' id='user_id' name='user_id' value='".$user_id."'>
                                                <div class='form-group'>
                                                    <button type='submit' name='update_account'>Edit Account</button>
                                                </div>
                                            </form>
                                        </div>";
                                        } 
                                        $values->close(); 
                                   }
                                } 
                                $result->close();
                                $con->close();
                            }
                            else{
                                get_cart_details();
                            }
                        }
                        else{
                            echo "<script>window.open('profile.php','_self');</script>";
                        }
                    }
                }
            }
        }
    }

    function get_confirm_payment(){
        if(isset($_POST['confirm_payment'])){
            if(!empty($_POST['invoice_number'])){
                if(!empty($_POST['amount_due'])){
                    include 'connect.php';
                    $amount_paid = $_POST['amount_due']; 
                    $invoice_number = $_POST['invoice_number'];
                    $payment_method = $_POST['payment_method'];
                    $user_order_no = $_POST['user_order_id'];
                    $user_no = $_POST['user_id'];
    
                    $insert_query = "INSERT INTO `payment` (`order_id`,`user_id`,`amount_paid`,`invoice_number`,`payment_method`) VALUES(?,?,?,?,?)";
                    $pay_result = $con->prepare($insert_query);
                    if($pay_result){
                        $pay_result->bind_param('iiiis',$user_order_no,$user_no,$amount_paid,$invoice_number,$payment_method);
                        if($pay_result->execute()){
                            $order_status = "Completed";
                            $update_order_table = "UPDATE `user_order` SET `order_status`=? WHERE `order_id`=?";
                            $update_result = $con->prepare($update_order_table);
                            if($update_result){
                                $update_result->bind_param('si',$order_status,$user_order_no);
                                if($update_result->execute()){
                                    $select_query = "SELECT `user_name`,`user_email` FROM `register` WHERE `user_id`=?";
                                    $query = $con->prepare($select_query);
                                    if($query){
                                        $query->bind_param('i',$user_no);
                                        if($query->execute()){
                                            $query->bind_result($user_name,$user_email);
                                            $query->fetch();

                                            $subject = "proTech";
                                            $body = "Dear $user_name, \nGreetings from proTech. \nCongratulations your Order is Confirmed. \nYou have paid Rs.". number_format($amount_paid,2,'.',',') ."/- and your Invoice Number is $invoice_number. \nThank you for the payment. \n\nRevisit http://localhost/project1/home.php";
                                            $sender = "From: shivlalkumarsharma30062003@rjcollege.edu.in";

                                            if(mail($user_email, $subject, $body, $sender)){
                                                echo "<script>alert('Your amount has been paid successfully!');</script>";
                                                echo "<script>window.open('profile.php?my_orders','_self');</script>";
                                            }else{
                                                echo "<script>window.open('profile.php?my_orders','_self');</script>";
                                            }
                                        }else{
                                            echo "<script>window.open('profile.php?my_orders','_self');</script>";
                                        }
                                    }else{
                                        echo "<script>window.open('profile.php?my_orders','_self');</script>";
                                    }
                                    $query->close();
                                }else{
                                    echo "<script>window.open('profile.php?my_orders','_self');</script>";
                                }
                            }else{
                                echo "<script>window.open('profile.php?my_orders','_self');</script>";
                            }
                            $update_result->close();
                        }else{
                            echo "<script>window.open('profile.php?my_orders','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('profile.php?my_orders','_self');</script>";
                    }
                    $pay_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('profile.php?my_orders','_self');</script>";
                }
            }else{
                echo "<script>window.open('profile.php?my_orders','_self');</script>";
            }
        }
    
        if(!isset($_GET['my_payments'])){
            if(!isset($_GET['delete_account'])){
                if(!isset($_GET['edit_account'])){
                    if(!isset($_GET['my_orders'])){
                        if(isset($_GET['order_id'])){
                            if(!empty($_GET['order_id'])){
                                if(isset($_SESSION['user_id'])){
                                    include 'connect.php';
                                    $userId = $_SESSION['user_id'];
                                    $select_user_details_query = "SELECT `user_address`,`user_phone` FROM `register` WHERE `user_id`=?";
                                    $select_result = $con->prepare($select_user_details_query);
                                    if($select_result){
                                        $select_result->bind_param('i',$userId);
                                        if($select_result->execute()){
                                            $select_result->bind_result($user_address,$user_phone_no);
                                            $select_result->store_result();
                                            if($select_result->num_rows > 0){
                                                $select_result->fetch();
                                                if($user_address === "" || $user_phone_no === 0){
                                                    echo "<script>alert('Fill all the details...');</script>";
                                                    echo "<script>window.open('profile.php?edit_account','_self');</script>";
                                                }
                                                elseif(strlen($user_address) < 3){
                                                    echo "<script>alert('Enter valid address...');</script>";
                                                    echo "<script>window.open('profile.php?edit_account','_self');</script>";
                                                }
                                                else{
                                                    $order_id = $_GET['order_id'];
                                                    $user_order_status = "Pending...";
                                                    $select_query = "SELECT `order_id`,`user_id`,`amount_due`,`invoice_number` FROM `user_order` WHERE `order_id`=? AND `order_status`=?";
                                                    $result = $con->prepare($select_query);
                                                    if($result){
                                                        $result->bind_param('is',$order_id,$user_order_status);
                                                        if($result->execute()){
                                                        $values = $result->get_result();
                                                            if($values->num_rows > 0){
                                                                $row = $values->fetch_assoc();
                                                                $amount_due = $row['amount_due'];
                                                                $invoice_no = $row['invoice_number'];
                                                                $user_order_id = $row['order_id'];
                                                                $user_id = $row['user_id'];
                                                                $amount_due_formatted = number_format($amount_due,2,'.',',');
                                                                echo "<div class='box'>
                                                                        <h2>Confirm Payment</h2>
                                                                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                                            <label for='invoice_number'>Invoice Number</label>
                                                                            <input type='text' id='invoice_number' name='invoice_number' value='$invoice_no' readonly>
                                
                                                                            <label for='amount_due'>Amount Due</label>
                                                                            <input type='text' id='amount_due' name='amount_due' value='Rs.$amount_due_formatted/-' readonly>
                                
                                                                            <label for='payment_method'>Payment Method</label>
                                                                            <select id='payment_method' name='payment_method' required>
                                                                                <option value='' disabled selected>Select a payment method</option>
                                                                                <option value='credit_card'>Credit Card</option>
                                                                                <option value='paypal'>PayPal</option>
                                                                                <option value='bank_transfer'>Bank Transfer</option>
                                                                                <option value='cash'>Cash</option>
                                                                            </select>
                                                                            <input type='hidden' name='amount_due' value='$amount_due'>
                                                                            <input type='hidden' name='user_order_id' value='$user_order_id'>
                                                                            <input type='hidden' name='user_id' value='$user_id'>
                                                                            <button type='submit' name='confirm_payment'>Pay <small>Rs.$amount_due_formatted/-</small></button>
                                                                        </form>
                                                                    </div>";
                                                            }
                                                            else{
                                                                echo "<script>window.open('profile.php?my_orders','_self');</script>";
                                                            }
                                                            $values->close();
                                                        }
                                                    }
                                                    $result->close();
                                                }
                                            }else{
                                                echo "<script>window.open('profile.php?my_orders','_self');</script>";
                                            }
                                        }else{
                                            echo "<script>window.open('profile.php?my_orders','_self');</script>";
                                        }
                                    }else{
                                        echo "<script>window.open('profile.php?my_orders','_self');</script>";
                                    }
                                    $select_result->close();
                                    $con->close();
                                }else{
                                    echo "<script>window.open('profile.php?my_orders','_self');</script>";
                                }
                            }else{
                                echo "<script>window.open('profile.php?my_orders','_self');</script>";
                            }
                        }
                    }
                }
            }
        }
    }

    function get_delete_account(){
        if(isset($_POST['delete_account'])){
            if(isset($_SESSION['user_id'])){
                include 'connect.php';
                $user_id = $_SESSION['user_id'];
                $delete_account_query = "DELETE FROM `register` WHERE `user_id`=?";
                $delete_result = $con->prepare($delete_account_query);
                if($delete_result){
                    $delete_result->bind_param('i',$user_id);
                    if($delete_result->execute()){
                        session_destroy();
                        $delete_cart = "DELETE FROM `carts` WHERE `user_id`=?";
                        $delete_cart_result = $con->prepare($delete_cart);
                        $delete_cart_result->bind_param('i',$user_id);
                        if($delete_cart_result->execute()){
                            echo "<script>alert('Account deleted successfully!');</script>";
                            echo "<script>window.open('home.php','_self');</script>";
                        }
                    }
                    else{
                        echo "<script>window.open('profile.php?delete_account','_self');</script>";
                    }
                }
                else{
                    echo "<script>window.open('profile.php?delete_account','_self');</script>";
                }
                $delete_result->close();
                $con->close();
            }
        }

        if(!isset($_GET['my_payments'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['edit_account'])){
                    if(isset($_GET['delete_account'])){
                        if(empty($_GET['delete_account'])){
                            if(isset($_SESSION['user_id'])){
                                echo "<div class='delete-container'>
                                        <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                            <button type='submit' name='delete_account' class='delete-account'>Delete Account</button>
                                        </form>
                                        <button class='not-delete-account'><a href='home.php'>Don't Delete Account</a></button>
                                      </div>";
                            }
                            else{
                                get_cart_details();
                            }
                        }
                    }
                }
            }
        }
    }
?>