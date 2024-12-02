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

    function get_admin_header(){
        echo "<div id='modal'>
                <div class='modal-content'>
                    <div class='sidebar' id='sidebar'>
                        <span id='closeSidebar'>&times;</span>
                        <li><a href='dashboard.php'>Dashboard</a></li>
                        <li><a href='dashboard.php?brands'>Brands</a>
                            <ul class='add-brand'>
                                <li><a href='dashboard.php?add_brand'>Add Brands</a></li>
                            </ul>
                        </li>
                        <li><a href='dashboard.php?categories'>Categories</a>
                            <ul class='add-category'>
                                <li><a href='dashboard.php?add_category'>Add Categories</a></li>
                            </ul>
                        </li>
                        <li><a href='dashboard.php?products'>Products</a>
                            <ul class='add-product'>
                                <li><a href='dashboard.php?add_products'>Add Products</a></li>
                            </ul>
                        </li>
                        <li><a href='dashboard.php?carts'><i class='fa-sharp fa-solid fa-cart-shopping'></i><sup>"; if(isset($_SESSION['admin_id'])){echo get_total_carts();}else{echo "0";} echo "</sup></a>
                            <ul class='add-cart'>
                                <li><a href='dashboard.php?add_carts'>Add Carts</a></li>
                            </ul>
                        </li>
                        <li><a href='dashboard.php?orders'>Orders</a>
                            <ul class='add-order'>
                                    <li><a href='dashboard.php?add_orders'>Add Orders</a></li>
                            </ul>
                        </li>
                        <li><a href='dashboard.php?payments'>Payments</a>
                            <ul class='add-payment'>
                                <li><a href='dashboard.php?add_payments'>Add Payments</a></li>
                            </ul>
                        </li>
                        <li><a href='dashboard.php?users'>Users</a>
                            <ul class='add-user'>
                                <li><a href='dashboard.php?add_users'>Add Users</a></li>
                            </ul>
                        </li>
                        <li><a href='dashboard.php?contacts'>Contacts</a>
                            <ul class='add-contact'>
                                <li><a href='dashboard.php?add_contacts'>Add Contacts</a></li>
                            </ul>
                        </li>
                        <li><a href='dashboard.php?admins'>Admins</a>
                            <ul class='add-admin'>
                                <li><a href='dashboard.php?add_admins'>Add Admins</a></li>
                            </ul>
                        </li>";
                        if(!isset($_SESSION['admin_id'])){
                            echo "<li><a href='admin_login.php' class='login-button'>Login</a></li>";
                        }
                        else{
                            echo "<li><a href='admin_logout.php' class='logout-button'>Logout</a></li>";
                        }
                    echo "</div>
                </div>
            </div>
            <div class='navbar'>
                <ul class='navbar-left'>
                    <span id='hamburger'><i class='fa-sharp fa-solid fa-bars' id='openSidebar'></i></span>
                    <a href='dashboard.php?about-us'><img src='../all_images/logo.png' alt='Company Logo' class='logo-image' title='About Us'></a>
                </ul>
                <ul class='navbar-center'>
                    <li class='dashboard'><a href='dashboard.php'>Dashboard</a></li>
                    <li class='brand'><a href='dashboard.php?brands'>Brands</a>
                        <ul class='add-brand'>
                            <li><a href='dashboard.php?add_brand'>Add Brands</a></li>
                        </ul>
                    </li>
                    <li class='category'><a href='dashboard.php?categories'>Categories</a>
                        <ul class='add-category'>
                            <li><a href='dashboard.php?add_category'>Add Categories</a></li>
                        </ul>
                    </li>
                    <li class='product'><a href='dashboard.php?products'>Products</a>
                        <ul class='add-product'>
                            <li><a href='dashboard.php?add_products'>Add Products</a></li>
                        </ul>
                    </li>
                    <li class='cart'><a href='dashboard.php?carts'><i class='fa-sharp fa-solid fa-cart-shopping'></i><sup>"; if(isset($_SESSION['admin_id'])){echo get_total_carts();}else{echo "0";} echo "</sup></a>
                        <ul class='add-cart'>
                            <li><a href='dashboard.php?add_carts'>Add Carts</a></li>
                        </ul>
                    </li>
                    <li class='order'><a href='dashboard.php?orders'>Orders</a>
                        <ul class='add-order'>
                                <li><a href='dashboard.php?add_orders'>Add Orders</a></li>
                        </ul>
                    </li>
                    <li class='payment'><a href='dashboard.php?payments'>Payments</a>
                        <ul class='add-payment'>
                            <li><a href='dashboard.php?add_payments'>Add Payments</a></li>
                        </ul>
                    </li>
                    <li class='user'><a href='dashboard.php?users'>Users</a>
                        <ul class='add-user'>
                            <li><a href='dashboard.php?add_users'>Add Users</a></li>
                        </ul>
                    </li>
                    <li class='contact'><a href='dashboard.php?contacts'>Contacts</a>
                        <ul class='add-contact'>
                            <li><a href='dashboard.php?add_contacts'>Add Contacts</a></li>
                        </ul>
                    </li>
                    <li class='admin'><a href='dashboard.php?admins'>Admins</a>
                        <ul class='add-admin'>
                            <li><a href='dashboard.php?add_admins'>Add Admins</a></li>
                        </ul>
                    </li>";
                    if(!isset($_SESSION['admin_id'])){
                        echo "<li class='login'><a href='admin_login.php' class='login-button'>Login</a></li>";
                    }
                    else{
                        echo "<li class='logout'><a href='admin_logout.php' class='logout-button'>Logout</a></li>";
                    }
           echo "</ul>";
                    if(isset($_SESSION['admin_id'])){
                        include '../connect.php';
                        $admin_id = $_SESSION['admin_id'];
                        $select_query = 'SELECT `admin_id`,`admin_image` FROM `admin_table` WHERE `admin_id`=?';
                        $result = $con->prepare($select_query);
                        if($result){
                            $result->bind_param('i',$admin_id);
                            if($result->execute()){
                                $result->bind_result($admin_id,$admin_image);
                                $result->store_result();
                                if($result->num_rows > 0){
                                    $result->fetch();
                                    echo "<ul class='navbar-right'>
                                            <a href='dashboard.php?update_admin_id=$admin_id'><img src='../admin_images/$admin_image' alt='Profile Page' class='profile-image' title='Edit Profile'></a>
                                          </ul>";
                                }
                            }
                        }
                        $result->close();
                        $con->close();
                    }
           echo "</div>";
    }

    function get_about_us(){
        if(isset($_GET['about-us'])){
            if(empty($_GET['about-us'])){
                if(isset($_SESSION['admin_id'])){
                    echo "<main>
                            <section class='hero'>
                                <h1>About proTech</h1>
                                <p>Your premier destination for mobile shopping.</p>
                            </section>

                            <section class='company-info'>
                                <h3>Welcome to proTech!</h3>
                                <p>At proTech, we are passionate about revolutionizing the mobile shopping experience. Established with a vision to deliver the most innovative and cutting-edge mobile technology, we have grown into a leading online store that caters to all your mobile needs. Our commitment is to provide customers with a seamless shopping experience, offering a wide array of high-quality products at competitive prices.</p>
                                
                                <h3>Our Mission</h3>
                                <p>Our mission is simple: to enhance your digital lifestyle with the latest advancements in mobile technology. We strive to bring you the best in smartphones, tablets, accessories, and more, ensuring that you stay ahead in an ever-evolving tech landscape. At proTech, we are dedicated to combining exceptional customer service with an extensive product range to meet and exceed your expectations.</p>
                                
                                <h3>Our Vision</h3>
                                <p>Our vision is to be the go-to destination for mobile enthusiasts and tech-savvy consumers worldwide. We aim to continuously innovate and adapt to the latest trends in technology, ensuring that our customers always have access to the most advanced products and services. By fostering a culture of excellence and integrity, we seek to build lasting relationships with our customers and partners.</p>
                                
                                <h3>Why Choose proTech?</h3>
                                <ul>
                                    <li><strong>Extensive Product Range:</strong> We offer a diverse selection of the latest mobile phones, tablets, smartwatches, and accessories from top brands.</li>
                                    <li><strong>Competitive Pricing:</strong> Our prices are designed to provide great value for money, with frequent promotions and discounts to make your shopping experience even better.</li>
                                    <li><strong>User-Friendly Experience:</strong> Our website is designed with you in mind, making it easy to find what you need and complete your purchase with just a few clicks.</li>
                                    <li><strong>Secure Transactions:</strong> We prioritize your security with robust encryption and secure payment gateways to protect your personal and financial information.</li>
                                    <li><strong>Exceptional Support:</strong> Our dedicated customer support team is here to assist you with any questions or concerns, ensuring a smooth and satisfactory experience.</li>
                                </ul>
                                
                                <h3>Our Values</h3>
                                <ul>
                                    <li><strong>Innovation:</strong> We embrace new technologies and continuously seek to improve our offerings.</li>
                                    <li><strong>Customer-Centricity:</strong> Our customers are at the heart of everything we do. We listen to your feedback and work to enhance your experience.</li>
                                    <li><strong>Integrity:</strong> We conduct our business with honesty and transparency, building trust through our actions and communication.</li>
                                    <li><strong>Excellence:</strong> We strive for excellence in every aspect of our business, from product quality to customer service.</li>
                                </ul>
                                
                                <p><strong>Join us at proTech and experience the future of mobile shopping today!</strong></p>
                                <p>For more information or any inquiries, feel free to <a href='dashboard.php?add_contacts'>contact us</a>.</p>
                            </section>
                        </main>";
                }else{
                    header('Location:admin_login.php');
                    exit();
                }
            }else{
                header('Location:dashboard.php');
                exit();
            }
        }
    }

    function add_brand(){
        if(isset($_POST['add_brand'])){
            include '../connect.php';
            $exist_query = "SELECT * FROM `brands` WHERE `brand_name`= ?";
            $answer = $con->prepare($exist_query);
            $answer->bind_param('s',$brand_name);
            function testinput($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $brand_name = testinput($_POST['brandName']);
            $answer->execute();
            $answer->store_result();
            if($answer->num_rows > 0){
                echo "<script>alert('Brand already exists...');</script>";
                echo "<script>window.open('dashboard.php?add_brand','_self');</script>";
            }else{
                $insert_query = "INSERT INTO `brands` (`brand_name`) VALUES(?)";
                $result = $con->prepare($insert_query);
                if($result){
                    $result->bind_param('s',$brand_name);
                    $brand_name = testinput($_POST['brandName']);
                    if($result->execute()){
                        echo "<script>alert('Brand inserted successfully!');</script>";
                        echo "<script>window.open('dashboard.php?add_brand','_self');</script>";
                    }else{
                        echo "<script>alert('Brand not inserted...');</script>";
                        echo "<script>window.open('dashboard.php?add_brand','_self');</script>";
                    }
                }else{
                    echo "<script>alert('Something went wrong');</script>";
                    echo "<script>window.open('dashboard.php?add_brand','_self');</script>";
                }
                $result->close();
            }
            $answer->close();
            $con->close();
        }
    
        if(!isset($_GET['add_category'])){
            if(!isset($_GET['add_product'])){
                if(!isset($_GET['add_user'])){
                    if(isset($_GET['add_brand'])){
                        if(empty($_GET['add_brand'])){
                            if(isset($_SESSION['admin_id'])){
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Insert New Brand</h2>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                <div class='form-group'>
                                                    <label for='brandName'>Brand Name</label>
                                                    <input type='text' id='brandName' name='brandName' required>
                                                </div>
                                                <div class='form-group'>
                                                    <button type='submit' name='add_brand'>Add Brand</button>
                                                </div>
                                            </form>
                                        </div>
                                       </div>";
                            }else{
                                echo "<script>window.open('admin_login.php','_self');</script>";
                            }
                        }else{
                            echo "<script>window.open('dashboard.php?add_brand','_self');</script>";
                        }
                    }
                }
            }
        }
    }

    function get_brands(){
        if(isset($_GET['delete_brand_id'])){
            if(!empty($_GET['delete_brand_id'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $delete_brand_id = (int) $_GET['delete_brand_id'];
                    $delete_query = "DELETE FROM `brands` WHERE `brand_id`=?";
                    $delete_result = $con->prepare($delete_query);
                    if($delete_result){
                        $delete_result->bind_param('i',$delete_brand_id);
                        if($delete_result->execute()){
                            header('Location:dashboard.php?brands');
                            exit();
                        }else{
                            header('Location:dashboard.php?brands');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?brands');
                        exit();
                    }
                    $delete_result->close();
                    $con->close();
                }
                else{
                    header('Location:admin_login.php');
                    exit();
                }
            }
            else{
                header('Location:dashboard.php?brands');
                exit();
            }
        }

        if(isset($_POST['update_brand'])){
            include '../connect.php';
            function testinput($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $brand_id = $_POST['brand_id'];
            $update_query = "UPDATE `brands` SET `brand_name`=? WHERE `brand_id`=?";
            $result = $con->prepare($update_query);
            if($result){
                $result->bind_param('si',$brand_name,$brand_id);
                $brand_name = testinput($_POST['brandName']);
                if($result->execute()){
                    echo "<script>alert('Brand updated successfully!');</script>";
                    echo "<script>window.open('dashboard.php?brands','_self');</script>";
                }else{
                    header('Location:dashboard.php?brands');
                    exit();
                }
            }else{
                header('Location:dashboard.php?brands');
                exit();
            }
            $result->close();
            $con->close();
        }

        if(isset($_GET['update_brand_id'])){
            if(!empty($_GET['update_brand_id'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $update_brand_id = (int) $_GET['update_brand_id'];
                    $select_brand_query = "SELECT `brand_id`,`brand_name` FROM `brands` WHERE `brand_id`=?";
                    $brand_result = $con->prepare($select_brand_query);
                    if($brand_result){
                        $brand_result->bind_param('i',$update_brand_id);
                        if($brand_result->execute()){
                            $brand_result->bind_result($brand_id,$brand_name);
                            $brand_result->store_result();
                            if($brand_result->num_rows > 0){
                                $brand_result->fetch();
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Update Brand</h2>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                <div class='form-group'>
                                                    <label for='brandName'>Brand Name</label>
                                                    <input type='text' id='brandName' name='brandName' value='$brand_name' required>
                                                    <input type='hidden' id='brand_id' name='brand_id' value='$brand_id' required>
                                                </div>
                                                <div class='form-group'>
                                                    <button type='submit' name='update_brand'>Update Brand</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                            }else{
                                header('Location:dashboard.php?brands');
                                exit();
                            }
                            $brand_result->free_result();
                        }else{
                            header('Location:dashboard.php?brands');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?brands');
                        exit();
                    }
                    $brand_result->close();
                    $con->close();
                }else{
                    header('Location:admin_login.php');
                    exit();
                }
            }else{
                header('Location:dashboard.php?brands');
                exit();
            }
        }

        if(isset($_GET['search_brand'])){
            if(isset($_GET['search_name'])){
                if(!empty($_GET['search_name'])){
                    include '../connect.php';
                    $search_name = $_GET['search_name'];
                    $select_query = "SELECT * FROM `brands` WHERE `brand_name` LIKE ? OR `brand_id` LIKE ?";
                    $result = $con->prepare($select_query);
                    if($result){
                        $search_data = "%$search_name%";
                        $result->bind_param('ss',$search_data,$search_data);
                        if($result->execute()){
                            $result->bind_result($brand_id,$brand_name,$brand_date);
                            $result->store_result();
                            if($result->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_brand'>
                                    </form>
                                    <table>
                                        <caption>Brand Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Brand ID</th>
                                                <th>Brand Name</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($result->fetch()){
                                    echo "<tr>
                                            <td>$brand_id</td>
                                            <td>$brand_name</td>
                                            <td class='date-time'>$brand_date</td>
                                            <td><button><a href='dashboard.php?delete_brand_id=$brand_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_brand_id=$brand_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                <table>";
                            }else{
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_brand'>
                                    </form>
                                    <h2 class='delete-footer'>No Brand Found Named \"$search_name\"</h2>";
                            }
                        }else{
                            header('Location:dashboard.php?brands');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?brands');
                        exit();
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:dashboard.php?brands');
                    exit();
                }
            }else{
                header('Location:dashboard.php?brands');
                exit();
            }
        }

        if(isset($_GET['brands'])){
            if(empty($_GET['brands'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $select_query = "SELECT * FROM `brands`";
                    $result = $con->prepare($select_query);
                    if($result){
                        if($result->execute()){
                            $result->bind_result($brand_id,$brand_name,$brand_date);
                            $result->store_result();
                            if($result->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_brand'>
                                    </form>
                                    <table>
                                        <caption>Brand Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Brand ID</th>
                                                <th>Brand Name</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($result->fetch()){
                                    echo "<tr>
                                            <td>$brand_id</td>
                                            <td>$brand_name</td>
                                            <td class='date-time'>$brand_date</td>
                                            <td><button><a href='dashboard.php?delete_brand_id=$brand_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_brand_id=$brand_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                <table>";
                            }else{
                                echo "<h2 class='delete-footer'>There is no brand</h2>";
                            }
                        }
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:admin_login.php');
                    exit();
                }
            }else{
                header('Location:dashboard.php');
                exit();
            }
        }
    }

    function add_category(){
        if(isset($_POST['add_category'])){
            include '../connect.php';
            $exist_query = "SELECT * FROM `categories` WHERE `category_name`= ?";
            $answer = $con->prepare($exist_query);
            $answer->bind_param('s',$category_name);
            function testinput($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $category_name = testinput($_POST['categoryName']);
            $answer->execute();
            $answer->store_result();
            if($answer->num_rows > 0){
                echo "<script>alert('Category already exists...');</script>";
                echo "<script>window.open('dashboard.php?add_category','_self');</script>";
            }else{
                $insert_query = "INSERT INTO `categories` (`category_name`) VALUES(?)";
                $result = $con->prepare($insert_query);
                if($result){
                    $result->bind_param('s',$category_name);
                    $category_name = testinput($_POST['categoryName']);
                    if($result->execute()){
                        echo "<script>alert('Category inserted successfully!');</script>";
                        echo "<script>window.open('dashboard.php?add_category','_self');</script>";
                    }else{
                        echo "<script>alert('Category not inserted...');</script>";
                        echo "<script>window.open('dashboard.php?add_category','_self');</script>";
                    }
                }else{
                    echo "<script>alert('Something went wrong');</script>";
                    echo "<script>window.open('dashboard.php?add_category','_self');</script>";
                }
                $result->close();
            }
            $answer->close();
            $con->close();
        }
        
        if(!isset($_GET['add_brand'])){
            if(!isset($_GET['add_product'])){
                if(!isset($_GET['add_user'])){
                    if(isset($_GET['add_category'])){
                        if(empty($_GET['add_category'])){
                            if(isset($_SESSION['admin_id'])){
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Insert New Category</h2>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                <div class='form-group'>
                                                    <label for='categoryName'>Category Name</label>
                                                    <input type='text' id='categoryName' name='categoryName' required>
                                                </div>
                                                <div class='form-group'>
                                                    <button type='submit' name='add_category'>Add Category</button>
                                                </div>
                                            </form>
                                        </div>
                                      </div>";
                            }else{
                                echo "<script>window.open('admin_login.php','_self');</script>";
                            }
                        }else{
                            echo "<script>window.open('dashboard.php?add_brand','_self');</script>";
                        }
                    }
                }
            }
        }
    }
    
    function get_categories(){
        if(isset($_GET['delete_category_id'])){
            if(!empty($_GET['delete_category_id'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $delete_category_id = (int) $_GET['delete_category_id'];
                    $delete_query = "DELETE FROM `categories` WHERE `category_id`=?";
                    $delete_result = $con->prepare($delete_query);
                    if($delete_result){
                        $delete_result->bind_param('i',$delete_category_id);
                        if($delete_result->execute()){
                            header('Location:dashboard.php?categories');
                            exit();
                        }else{
                            header('Location:dashboard.php?categories');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?brands');
                        exit();
                    }
                    $delete_result->close();
                    $con->close();
                }
                else{
                    header('Location:admin_login.php');
                    exit();
                }
            }
            else{
                header('Location:dashboard.php?categories');
                exit();
            }
        }

        if(isset($_POST['update_category'])){
            include '../connect.php';
            function testinput($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $category_id = $_POST['category_id'];
            $update_query = "UPDATE `categories` SET `category_name`=? WHERE `category_id`=?";
            $result = $con->prepare($update_query);
            if($result){
                $result->bind_param('si',$category_name,$category_id);
                $category_name = testinput($_POST['categoryName']);
                if($result->execute()){
                    echo "<script>alert('Category updated successfully!');</script>";
                    echo "<script>window.open('dashboard.php?categories','_self');</script>";
                }else{
                    header('Location:dashboard.php?categories');
                    exit();
                }
            }else{
                header('Location:dashboard.php?categories');
                exit();
            }
            $result->close();
            $con->close();
        }
        
        if(isset($_GET['update_category_id'])){
            if(!empty($_GET['update_category_id'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $update_category_id = (int) $_GET['update_category_id'];
                    $select_category_query = "SELECT `category_id`,`category_name` FROM `categories` WHERE `category_id`=?";
                    $category_result = $con->prepare($select_category_query);
                    if($category_result){
                        $category_result->bind_param('i',$update_category_id);
                        if($category_result->execute()){
                            $category_result->bind_result($category_id,$category_name);
                            $category_result->store_result();
                            if($category_result->num_rows > 0){
                                $category_result->fetch();
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Update category</h2>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                <div class='form-group'>
                                                    <label for='categoryName'>category Name</label>
                                                    <input type='text' id='categoryName' name='categoryName' value='$category_name' required>
                                                    <input type='hidden' id='category_id' name='category_id' value='$category_id' required>
                                                </div>
                                                <div class='form-group'>
                                                    <button type='submit' name='update_category'>Update category</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                            }else{
                                header('Location:dashboard.php?categories');
                                exit();
                            }
                            $category_result->free_result();
                        }else{
                            header('Location:dashboard.php?categories');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?categories');
                         exit();
                    }
                    $category_result->close();
                    $con->close();
                }else{
                    header('Location:admin_login.php');
                    exit();
                }
            }else{
                header('Location:dashboard.php?categories');
                exit();
            }
        }

        if(isset($_GET['search_category'])){
            if(isset($_GET['search_name'])){
                if(!empty($_GET['search_name'])){
                    include '../connect.php';
                    $search_name = $_GET['search_name'];
                    $select_query = "SELECT * FROM `categories` WHERE `category_name` LIKE ? OR `category_id` LIKE ?";
                    $result = $con->prepare($select_query);
                    if($result){
                        $search_data = "%$search_name%";
                        $result->bind_param('ss',$search_data,$search_data);
                        if($result->execute()){
                            $result->bind_result($category_id,$category_name,$category_date);
                            $result->store_result();
                            if($result->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_category'>
                                    </form>
                                    <table>
                                        <caption>Category Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Category ID</th>
                                                <th>Category Name</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($result->fetch()){
                                    echo "<tr>
                                            <td>$category_id</td>
                                            <td>$category_name</td>
                                            <td class='date-time'>$category_date</td>
                                            <td><button><a href='dashboard.php?delete_category_id=$category_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_category_id=$category_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }else{
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_category'>
                                    </form>
                                    <h2 class='delete-footer'>No Category Found Named \"$search_name\"</h2>";
                            }
                        }else{
                            header('Location:dashboard.php?categories');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?categories');
                        exit();
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:dashboard.php?categories');
                    exit();
                }
            }else{
                header('Location:dashboard.php?categories');
                exit();
            }
        }

        if(isset($_GET['categories'])){
            if(empty($_GET['categories'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $select_query = "SELECT * FROM `categories`";
                    $result = $con->prepare($select_query);
                    if($result){
                        if($result->execute()){
                            $result->bind_result($category_id,$category_name,$category_date);
                            $result->store_result();
                            if($result->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_category'>
                                    </form>
                                    <table>
                                        <caption>Category Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Category ID</th>
                                                <th>Category Name</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($result->fetch()){
                                    echo "<tr>
                                            <td>$category_id</td>
                                            <td>$category_name</td>
                                            <td class='date-time'>$category_date</td>
                                            <td><button><a href='dashboard.php?delete_category_id=$category_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_category_id=$category_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            } else{
                                echo "<h2 class='delete-footer'>There is no category</h2>";
                            }
                        }
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:admin_login.php');
                    exit();
                }
            }else{
                header('Location:dashboard.php');
                exit();
            }
        }
    }

    function add_products(){
        if(isset($_POST['add_product'])){
            include '../connect.php';
            $exist_query = "SELECT * FROM `products` WHERE `product_name`=? OR `product_image1`=? OR `product_image1`=? OR `product_image1`=?";
            $answer = $con->prepare($exist_query);
            $answer->bind_param('ssss',$product_name,$product_image1,$product_image2,$product_image3);
            $product_name = $_POST['product_name'];
            $product_image1 = $_FILES['product_image1']['name'];
            $product_image2 = $_FILES['product_image2']['name'];
            $product_image3 = $_FILES['product_image3']['name'];
            $answer->execute();
            $answer->store_result();
            if($answer->num_rows > 0){
                echo "<script>alert('Product Already Exists...');</script>";
                echo "<script>window.open('dashboard.php?add_products','_self');</script>";
            }else{
                $insert_query = "INSERT INTO `products` (`product_name`,`product_description`,`product_keywords`,`category_id`,`brand_id`,`product_image1`,`product_image2`,`product_image3`,`product_price`,`product_status`) VALUES(?,?,?,?,?,?,?,?,?,?)";
                $result = $con->prepare($insert_query);
                if($result){
                    $result->bind_param('sssiisssii',$product_name,$product_description,$product_keywords,$category_id,$brand_id,$product_image1,$product_image2,$product_image3,$product_price,$product_status);
                    function testinput($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
    
                    $uploadFolder = '../product_images/';
                    if(!is_dir($uploadFolder)){
                        mkdir($uploadFolder,0755,true);
                    }
    
                    function uploadFile($fileInputName,$uploadDir){
                        if(isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error']===UPLOAD_ERR_OK){
                            $tmp_name = $_FILES[$fileInputName]['tmp_name'];
                            $file_name = basename($_FILES[$fileInputName]['name']);
                            $file_path = $uploadDir . $file_name;
    
                            if(move_uploaded_file($tmp_name,$file_path)){
                                return $file_name;
                            }
                            else{
                                header('Location:dashboard.php?add_products');
                                exit();
                            }
    
                        }
                    }
                    $product_name = testinput($_POST['product_name']);
                    $product_description = testinput($_POST['product_description']);
                    $product_keywords = testinput($_POST['product_keywords']);
                    $category_id = $_POST['category'];
                    $brand_id = $_POST['brand'];
                    $product_image1 = uploadFile('product_image1',$uploadFolder);
                    $product_image2 = uploadFile('product_image2',$uploadFolder);
                    $product_image3 = uploadFile('product_image3',$uploadFolder);
                    $product_price = filter_var($_POST['product_price'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                    $product_status = 1;
                    if($result->execute()){
                        echo "<script>alert('New Product inserted succesfully!')</script>";
                        echo "<script>window.open('dashboard.php?add_products','_self');</script>";
                    }else{
                        header('Location:dashboard.php?add_products');
                        exit();
                    }
                }else{
                    header('Location:dashboard.php?add_products');
                    exit();
                }
                $result->close();
            }
            $answer->close();
            $con->close();
        }

        if(isset($_GET['add_products'])){
            if(empty($_GET['add_products'])){
                if(isset($_SESSION['admin_id'])){
                    echo "<div class='container'>
                            <div class='form-container'>
                                <h2>Add Product</h2>
                                <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post' enctype='multipart/form-data'>
                                    <div class='form-group'>
                                        <label for='product_name'>Product Name</label>
                                        <input type='text' id='product_name' name='product_name' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='product_description'>Product Description</label>
                                        <input type='text' id='product_description' name='product_description' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='product_keywords'>Product Keywords</label>
                                        <input type='text' id='product_keywords' name='product_keywords' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='category'>Category</label>
                                        <select id='category' name='category' required>
                                            <option value=''>Select a Category</option>";
                                                include '../connect.php';
                                                $result = $con->prepare("SELECT `category_id` , `category_name` FROM `categories`");
                                                $result->execute();
                                                $result->bind_result($category_id,$category_name);
                                                $result->store_result();
                                                if($result->num_rows > 0){
                                                    while($result->fetch()){
                                                        echo "<option value='$category_id'>$category_name</option>";
                                                    }
                                                }
                                                $result->close();
                                                $con->close();
                                    echo "</select>
                                    </div>
                                    <div class='form-group'>
                                        <label for='brand'>Brand</label>
                                        <select id='brand' name='brand' required>
                                            <option value=''>Select a Brand</option>";
                                                include '../connect.php';
                                                $result = $con->prepare("SELECT `brand_id` , `brand_name` FROM `brands`");
                                                $result->execute();
                                                $result->bind_result($brand_id,$brand_name);
                                                $result->store_result();
                                                if($result->num_rows > 0){
                                                    while($result->fetch()){
                                                        echo "<option value='$brand_id'>$brand_name</option>";
                                                    }
                                                }
                                                $result->close();
                                                $con->close();
                                echo "</select>
                                    </div>
                                    <div class='form-group'>
                                        <label for='product_image1'>Product Image1</label>
                                        <input type='file' id='product_image1' name='product_image1' accept='image/*' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='product_image2'>Product Image2</label>
                                        <input type='file' id='product_image2' name='product_image2' accept='image/*'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='product_image3'>Product Image3:</label>
                                        <input type='file' id='product_image3' name='product_image3' accept='image/*'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='product_price'>Product Price</label>
                                        <input type='number' id='product_price' name='product_price' required>
                                    </div>
                                    <div class='form-group'>
                                        <button type='submit' name='add_product'>Add Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>";       
                }else{
                    header('Location:admin_login.php');
                    exit();
                }
            }else{
                header('Location:dashboard.php');
                exit();
            }
        }
    }

    function get_products(){
        if(isset($_GET['delete_product_id'])){
            if(!empty($_GET['delete_product_id'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $delete_product_id = (int) $_GET['delete_product_id'];
                    $delete_query = "DELETE FROM `products` WHERE `product_id`=?";
                    $delete_result = $con->prepare($delete_query);
                    if($delete_result){
                        $delete_result->bind_param('i',$delete_product_id);
                        if($delete_result->execute()){
                            header('Location:dashboard.php?products');
                            exit();
                        }else{
                            header('Location:dashboard.php?products');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?products');
                        exit();
                    }
                    $delete_result->close();
                    $con->close();
                }else{
                    header('Location:admin_login.php');
                    exit();
                }
            }else{
                header('Location:dashboard.php?products');
                exit();
            }
        }

        if(isset($_POST['update_product'])){
            include '../connect.php';
            $product_id = $_POST['product_id'];
            $insert_query = "UPDATE `products` SET `product_name`=?,`product_description`=?,`product_keywords`=?,`category_id`=?,`brand_id`=?,`product_image1`=?,`product_image2`=?,`product_image3`=?,`product_price`=? WHERE `product_id`=?";
            $result = $con->prepare($insert_query);
            if($result){
                $result->bind_param('sssiisssii',$product_name,$product_description,$product_keywords,$category_id,$brand_id,$product_image1,$product_image2,$product_image3,$product_price,$product_id);
                function testinput($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
    
                $uploadFolder = '../product_images/';
                if(!is_dir($uploadFolder)){
                    mkdir($uploadFolder,0755,true);
                }
    
                function uploadFile($fileInputName,$uploadDir){
                    if(isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error']===UPLOAD_ERR_OK){
                        $tmp_name = $_FILES[$fileInputName]['tmp_name'];
                        $file_name = basename($_FILES[$fileInputName]['name']);
                        $file_path = $uploadDir . $file_name;
    
                        if(move_uploaded_file($tmp_name,$file_path)){
                            return $file_name;
                        }
                        else{
                            header('Location:dashboard.php?products');
                            exit();
                        }
    
                    }
                }
                $product_name = testinput($_POST['product_name']);
                $product_description = testinput($_POST['product_description']);
                $product_keywords = testinput($_POST['product_keywords']);
                $category_id = $_POST['category'];
                $brand_id = $_POST['brand'];
                $product_image1 = uploadFile('product_image1',$uploadFolder);
                $product_image2 = uploadFile('product_image2',$uploadFolder);
                $product_image3 = uploadFile('product_image3',$uploadFolder);
                $product_price = filter_var($_POST['product_price'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                if($result->execute()){
                    echo "<script>alert('Product updated succesfully!')</script>";
                    echo "<script>window.open('dashboard.php?products','_self');</script>";
                }
                else{
                    header('Location:dashboard.php?products');
                    exit();
                }
            }
            else{
                header('Location:dashboard.php?products');
                exit();
            }
            $result->close();
            $con->close();
        }

        if(isset($_GET['update_product_id'])){
            if(!empty($_GET['update_product_id'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $update_product_id = (int) $_GET['update_product_id'];
                    $select_query = "SELECT * FROM `products` WHERE `product_id`=?";
                    $select_result = $con->prepare($select_query);
                    if($select_result){
                        $select_result->bind_param('i',$update_product_id);
                        if($select_result->execute()){
                            $values = $select_result->get_result();
                            if($values->num_rows > 0){
                                $row = $values->fetch_assoc();
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Update Product</h2>
                                            <form action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='post' enctype='multipart/form-data'>
                                                <div class='form-group'>
                                                    <label for='product_name'>Product Name:</label>
                                                    <input type='text' id='product_name' name='product_name' value='".$row['product_name']."' required>
                                                </div>

                                                <div class='form-group'>
                                                    <label for='product_description'>Product Description:</label>
                                                    <input type='text' id='product_description' name='product_description' value='".$row['product_description']."' required>
                                                </div>

                                                <div class='form-group'>
                                                    <label for='product_keywords'>Product Keywords:</label>
                                                    <input type='text' id='product_keywords' name='product_keywords' value='".$row['product_keywords']."' required>
                                                </div>

                                                <div class='form-group'>
                                                    <label for='category'>Category:</label>
                                                    <select id='category' name='category' required>";
                                                        $category_id = $row['category_id'];
                                                        $select_categories = "SELECT `category_name` FROM `categories` WHERE `category_id`=?";
                                                        $category_result = $con->prepare($select_categories);
                                                        $category_result->bind_param('i',$category_id);
                                                        $category_result->execute();
                                                        $category_result->bind_result($category_name);
                                                        $category_result->store_result();
                                                        if($category_result->num_rows > 0){
                                                            $category_result->fetch();
                                                            echo "<option value='$category_id' selected>$category_name</option>";
                                                        }
                                                        $category_result->close();
                                                        $result = $con->prepare("SELECT category_id , category_name FROM `categories`");
                                                        $result->execute();
                                                        $result->bind_result($category_id,$category_name);
                                                        $result->store_result();
                                                        if($result->num_rows > 0){
                                                            while($result->fetch()){
                                                                echo "<option value='$category_id'>$category_name</option>";
                                                            }
                                                        }
                                                        $result->close();
                                            echo "</select>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='brand'>Brand:</label>
                                                    <select id='brand' name='brand' required>";
                                                            $brand_id = $row['brand_id'];
                                                            $select_brands = "SELECT `brand_name` FROM `brands` WHERE `brand_id`=?";
                                                            $brand_result = $con->prepare($select_brands);
                                                            $brand_result->bind_param('i',$brand_id);
                                                            $brand_result->execute();
                                                            $brand_result->bind_result($brand_name);
                                                            $brand_result->store_result();
                                                            if($brand_result->num_rows > 0){
                                                                $brand_result->fetch();
                                                                echo "<option value='$brand_id' selected>$brand_name</option>";
                                                            }
                                                            $brand_result->close();
                                                            $result = $con->prepare("SELECT brand_id , brand_name FROM `brands`");
                                                            $result->execute();
                                                            $result->bind_result($brand_id,$brand_name);
                                                            $result->store_result();
                                                            if($result->num_rows > 0){
                                                                while($result->fetch()){
                                                                    echo "<option value='$brand_id'>$brand_name</option>";
                                                                }
                                                            }
                                                            $result->close();
                                            echo "</select>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='product_image1'>Product Image 1:</label>
                                                    <input type='file' id='product_image1' name='product_image1' accept='image/*' required>
                                                    <img src='../product_images/".$row['product_image1']."' alt='". $row['product_name']."'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='product_image2'>Product Image 2:</label>
                                                    <input type='file' id='product_image2' name='product_image2' accept='image/*' required>
                                                    <img src='../product_images/". $row['product_image2']."' alt='". $row['product_name']."'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='product_image3'>Product Image 3:</label>
                                                    <input type='file' id='product_image3' name='product_image3' accept='image/*' required>
                                                    <img src='../product_images/". $row['product_image3']."' alt='". $row['product_name']."'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='product_price'>Product Price:</label>
                                                    <input type='number' id='product_price' name='product_price' value='". $row['product_price']."' step='0.01' required>
                                                </div>
                                                <input type='hidden' name='product_id' value='".$row['product_id']."'>
                                                <div class='form-group'>
                                                    <button type='submit' name='update_product'>Update Product</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                            }
                            $values->close();
                        }
                    }
                    $select_result->close();
                    $con->close();
                }else{
                    header('Location:admin_login.php');
                    exit();
                }
            }else{
                header('Location:dashboard.php?products');
                exit();
            }
        }

        if(isset($_GET['search_product'])){
            if(isset($_GET['search_name'])){
                if(!empty($_GET['search_name'])){
                    include '../connect.php';
                    $search_name = $_GET['search_name'];
                    $select_query = "SELECT * FROM `products` WHERE `product_name` LIKE ? OR `product_description` LIKE ? OR `product_keywords` LIKE ? OR `product_price` LIKE ? OR `product_id` LIKE ?";
                    $result = $con->prepare($select_query);
                    if($result){
                        $search_data = "%$search_name%";
                        $result->bind_param('sssss',$search_data,$search_data,$search_data,$search_data,$search_data);
                        if($result->execute()){
                            $result->bind_result($product_id,$product_name,$product_description,$product_keywords,$category_id,$brand_id,$product_image1,$product_image2,$product_image3,$product_price,$product_status,$product_date);
                            $result->store_result();
                            if($result->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_product'>
                                    </form>
                                    <table>
                                        <caption>Product Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Product Name</th>
                                                <th>Product Description</th>
                                                <th>Product Keywords</th>
                                                <th>Category Id</th>
                                                <th>Brand Id</th>
                                                <th>Product Image1</th>
                                                <th>Product Image2</th>
                                                <th>Product Image3</th>
                                                <th>Product Price</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($result->fetch()){
                                    $product_price = number_format($product_price,2,'.',',');
                                    echo "<tr>
                                    <td>$product_id</td>
                                    <td>$product_name</td>
                                    <td>$product_description</td>
                                    <td><p>$product_keywords</p></td>
                                    <td>$category_id</td>
                                    <td>$brand_id</td>
                                    <td><img src='../product_images/$product_image1' alt='$product_name' class='product-image'></td>
                                    <td><img src='../product_images/$product_image2' alt='$product_name' class='product-image'></td>
                                    <td><img src='../product_images/$product_image3' alt='$product_name' class='product-image'></td>
                                    <td>Rs.$product_price/-</td>
                                    <td class='date-time'>$product_date</td>
                                    <td><button><a href='dashboard.php?delete_product_id=$product_id' class='delete-button'>Delete</a></button>
                                        <button><a href='dashboard.php?update_product_id=$product_id' class='update-button'>Update</a></button>    
                                    </td>
                                </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }else{
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_product'>
                                    </form>
                                    <h2 class='delete-footer'>No Product Found Named \"$search_name\"</h2>";
                            }
                        }else{
                            header('Location:dashboard.php?products');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?products');
                        exit();
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:dashboard.php?products');
                    exit();
                }
            }else{
                header('Location:dashboard.php?products');
                exit();
            }
        }
        
        if(isset($_GET['products'])){
            if(empty($_GET['products'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $select_query = "SELECT * FROM `products`";
                    $result = $con->prepare($select_query);
                    if($result){
                        if($result->execute()){
                            $result->bind_result($product_id,$product_name,$product_description,$product_keywords,$category_id,$brand_id,$product_image1,$product_image2,$product_image3,$product_price,$product_status,$product_date);
                            $result->store_result();
                            if($result->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_product'>
                                    </form>
                                    <table>
                                        <caption>Product Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Product Name</th>
                                                <th>Product Description</th>
                                                <th>Product Keywords</th>
                                                <th>Category Id</th>
                                                <th>Brand Id</th>
                                                <th>Product Image1</th>
                                                <th>Product Image2</th>
                                                <th>Product Image3</th>
                                                <th>Product Price</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($result->fetch()){
                                    $product_price = number_format($product_price,2,'.',',');
                                    echo "<tr>
                                    <td>$product_id</td>
                                    <td>$product_name</td>
                                    <td>$product_description</td>
                                    <td><p>$product_keywords</p></td>
                                    <td>$category_id</td>
                                    <td>$brand_id</td>
                                    <td><img src='../product_images/$product_image1' alt='$product_name' class='product-image'></td>
                                    <td><img src='../product_images/$product_image2' alt='$product_name' class='product-image'></td>
                                    <td><img src='../product_images/$product_image3' alt='$product_name' class='product-image'></td>
                                    <td>Rs.$product_price/-</td>
                                    <td class='date-time'>$product_date</td>
                                    <td><button><a href='dashboard.php?delete_product_id=$product_id' class='delete-button'>Delete</a></button>
                                        <button><a href='dashboard.php?update_product_id=$product_id' class='update-button'>Update</a></button>    
                                    </td>
                                </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }
                            else{
                                echo "<h2 class='delete-footer'>There is no product</h2>";
                            }
                        }
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:dashboard.php?products');
                    exit();
                }
            }else{
                header('Location:dashboard.php');
                exit();
            }
        }
    }
    

    function add_order(){
        if(isset($_POST['add_order'])){
            if(isset($_SESSION['admin_id'])){
                include '../connect.php';
                $user_id = (int) $_POST['user_id'];
                $amount_due = (int) $_POST['amount_due'];
                $invoice_number = (int) $_POST['invoice_no'];
                $total_product = (int) $_POST['total_product'];
                $order_status = (string) $_POST['order_status'];
                if(!empty($user_id) && !empty($amount_due) && !empty($invoice_number) && !empty($total_product) && !empty($order_status)){
                    $select_order_query = "SELECT `invoice_number` FROM `user_order` WHERE `invoice_number`=?";
                    $select_result = $con->prepare($select_order_query);
                    if($select_result){
                        $select_result->bind_param('i',$invoice_number);
                        if($select_result->execute()){
                            $select_result->bind_result($invoice_number);
                            $select_result->store_result();
                            if($select_result->num_rows > 0){
                                echo "<script>alert('Order Already Exists...');</script>";
                                echo "<script>window.open('dashboard.php?add_orders','_self');</script>";
                            }else{
                                $insert_order = "INSERT INTO `user_order` (`user_id`,`amount_due`,`invoice_number`,`total_product`,`order_status`) VALUES(?,?,?,?,?)";
                                $order_result = $con->prepare($insert_order);
                                if($order_result){
                                    $order_result->bind_param('iiiis',$user_id,$amount_due,$invoice_number,$total_product,$order_status);
                                    if($order_result->execute()){
                                        echo "<script>alert('Order inserted successfully!');</script>";
                                        echo "<script>window.open('dashboard.php?add_orders','_self');</script>";
                                    }else{
                                        echo "<script>window.open('dashboard.php?add_orders','_self');</script>";
                                    }
                                }else{
                                    echo "<script>window.open('dashboard.php?add_orders','_self');</script>";
                                }
                                $order_result->close();
                            }
                        }else{
                            echo "<script>window.open('dashboard.php?add_orders','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?add_orders','_self');</script>";
                    }
                    $select_result->close();
                }
                $con->close();
            }else{
                echo "<script>window.open('admin_login','_self');</script>";
            }
        }

        if(!isset($_GET['add_brand'])){
            if(!isset($_GET['add_category'])){
                if(!isset($_GET['orders'])){
                    if(isset($_GET['add_orders'])){
                        if(empty($_GET['add_orders'])){
                            if(isset($_SESSION['admin_id'])){
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Insert New Order</h2>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                <div class='form-group'>
                                                    <label for='user_id'>User Id</label>
                                                    <input type='number' id='user_id' name='user_id' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='amount_due'>Amount Due</label>
                                                    <input type='number' id='amount_due' name='amount_due' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='invoice_no'>Invoice Number</label>
                                                    <input type='number' id='invoice_no' name='invoice_no' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='total_product'>Total Product</label>
                                                    <input type='number' id='total_product' name='total_product' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='order_status'>Order Status</label>
                                                    <input type='text' id='order_status' name='order_status' required>
                                                </div>
                                                <div class='form-group'>
                                                    <button type='submit' name='add_order'>Add Order</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                            }
                        }else{
                            echo "<script>window.open('dashboard.php','_self');</script>";
                        }
                    }
                }
            }
        }
    }

    function get_user_orders(){
        if(isset($_GET['delete_order_id'])){
            if(!empty($_GET['delete_order_id'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $delete_order_id = (int) $_GET['delete_order_id'];
                    $delete_order = "DELETE FROM `user_order` WHERE `order_id`=?";
                    $delete_result = $con->prepare($delete_order);
                    if($delete_result){
                        $delete_result->bind_param('i',$delete_order_id);
                        if($delete_result->execute()){
                            echo "<script>window.open('dashboard.php?orders','_self');</script>";
                        }else{
                            echo "<script>window.open('dashboard.php?orders','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?orders','_self');</script>";
                    }
                    $delete_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('dashboard.php?orders','_self');</script>";
            }
        }

        if(isset($_POST['update_order'])){
            if(isset($_SESSION['admin_id'])){
                include '../connect.php';
                $order_id = (int) $_POST['order_id'];
                $user_id = (int) $_POST['user_id'];
                $amount_due = (int) $_POST['amount_due'];
                $invoice_number = (int) $_POST['invoice_number'];
                $total_product = (int) $_POST['total_product'];
                $order_status = (string) $_POST['order_status'];
                if(!empty($order_id) && !empty($user_id) && !empty($amount_due) && !empty($invoice_number) && !empty($total_product) && !empty($order_status)){
                    $update_order = "UPDATE `user_order` SET `user_id`=?,`amount_due`=?,`invoice_number`=?,`total_product`=?,`order_status`=? WHERE `order_id`=?";
                    $update_result = $con->prepare($update_order);
                    if($update_result){
                        $update_result->bind_param('iiiisi',$user_id,$amount_due,$invoice_number,$total_product,$order_status,$order_id);
                        if($update_result->execute()){
                            echo "<script>alert('Order updated successfully!');</script>";
                            echo "<script>window.open('dashboard.php?orders','_self');</script>";
                        }else{
                            echo "<script>window.open('dashboard.php?orders','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?orders','_self');</script>";
                    }
                }else{
                    echo "<script>window.open('dashboard.php?orders','_self');</script>";
                }
                $update_result->close();
                $con->close();
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_GET['update_order_id'])){
            if(!empty($_GET['update_order_id'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $update_order_id = (int) $_GET['update_order_id'];
                    $select_orders = "SELECT * FROM `user_order` WHERE `order_id`=?";
                    $select_result = $con->prepare($select_orders);
                    if($select_result){
                        $select_result->bind_param('i',$update_order_id);
                        if($select_result->execute()){
                            $values = $select_result->get_result();
                            if($values->num_rows > 0){
                                $row = $values->fetch_assoc();
                                $order_id = $row['order_id'];
                                $user_id = $row['user_id'];
                                $amount_due = $row['amount_due'];
                                $invoice_no = $row['invoice_number'];
                                $total_product = $row['total_product'];
                                $order_status = $row['order_status'];
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Update Order</h2>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                <div class='form-group'>
                                                    <label for='user_id'>User Id</label>
                                                    <input type='number' id='user_id' name='user_id' value='".$user_id."' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='amount_due'>Amount Due</label>
                                                    <input type='number' id='amount_due' name='amount_due' value='".$amount_due."' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='invoice_no'>Invoice Number</label>
                                                    <input type='number' id='invoice_no' name='invoice_number' value='".$invoice_no."' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='total_product'>Total Product</label>
                                                    <input type='number' id='total_product' name='total_product' value='".$total_product."' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='order_status'>Order Status</label>
                                                    <input type='text' id='order_status' name='order_status' value='".$order_status."' required>
                                                </div>
                                                <input type='hidden' id='order_id' name='order_id' value='".$order_id."'>
                                                <div class='form-group'>
                                                    <button type='submit' name='update_order'>Update Order</button>
                                                </div>
                                            </form>
                                        </div>
                                       </div>";
                            }else{
                                echo "<script>window.open('dashboard.php?orders','_self');</script>";
                            }
                            $values->close();
                        }else{
                            echo "<script>window.open('dashboard.php?orders','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?orders','_self');</script>";
                    }
                    $select_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('admin_login','_self');</script>";
                }
            }else{
                echo "<script>window.open('dashboard.php?orders','_self');</script>";
            }
        }

        if(isset($_GET['search_order'])){
            if(isset($_GET['search_name'])){
                if(!empty($_GET['search_name'])){
                    include '../connect.php';
                    $search_name = $_GET['search_name'];
                    $select_query = "SELECT * FROM `user_order` WHERE `order_id` LIKE ? OR `user_id` LIKE ? OR `invoice_number` LIKE ? OR `total_product` LIKE ? OR `order_status` LIKE ? OR `amount_due` LIKE ?";
                    $result = $con->prepare($select_query);
                    if($result){
                        $search_data = "%$search_name%";
                        $result->bind_param('ssssss',$search_data,$search_data,$search_data,$search_data,$search_data,$search_data);
                        if($result->execute()){
                            $values = $result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_order'>
                                    </form>
                                    <table>
                                        <caption>Order Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>User Id</th>
                                                <th>Amount Due</th>
                                                <th>Invoice Number</th>
                                                <th>Total Product</th>
                                                <th>Order Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $order_id = $rows['order_id'];
                                    $user_id = $rows['user_id'];
                                    $amount_due = number_format($rows['amount_due'],2,'.',',');
                                    $invoice_no = $rows['invoice_number'];
                                    $total_product = $rows['total_product'];
                                    $order_status = $rows['order_status'];
                                    $order_date = $rows['date'];
                                    echo "<tr>
                                    <td>$order_id</td>
                                    <td>$user_id</td>
                                    <td>Rs.$amount_due/-</td>
                                    <td>$invoice_no</td>
                                    <td>$total_product</td>
                                    <td>$order_status</td>
                                    <td class='date-time'>$order_date</td>
                                    <td><button><a href='dashboard.php?delete_order_id=$order_id' class='delete-button'>Delete</a></button>
                                        <button><a href='dashboard.php?update_order_id=$order_id' class='update-button'>Update</a></button>    
                                    </td>
                                  </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }else{
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_order'>
                                    </form>
                                    <h2 class='delete-footer'>No Order Found Named \"$search_name\"</h2>";
                            }
                        }else{
                            header('Location:dashboard.php?orders');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?orders');
                        exit();
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:dashboard.php?orders');
                    exit();
                }
            }else{
                header('Location:dashboard.php?orders');
                exit();
            }
        }
        
        if(isset($_GET['orders'])){
            if(empty($_GET['orders'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $select_orders = "SELECT * FROM `user_order`";
                    $order_result = $con->prepare($select_orders);
                    if($order_result){
                        if($order_result->execute()){
                            $order_values = $order_result->get_result();
                            if($order_values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_order'>
                                    </form>
                                    <table>
                                        <caption>Order Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>User Id</th>
                                                <th>Amount Due</th>
                                                <th>Invoice Number</th>
                                                <th>Total Product</th>
                                                <th>Order Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $order_values->fetch_assoc()){
                                    $order_id = $rows['order_id'];
                                    $user_id = $rows['user_id'];
                                    $amount_due = number_format($rows['amount_due'],2,'.',',');
                                    $invoice_no = $rows['invoice_number'];
                                    $total_product = $rows['total_product'];
                                    $order_status = $rows['order_status'];
                                    $order_date = $rows['date'];
                                    echo "<tr>
                                    <td>$order_id</td>
                                    <td>$user_id</td>
                                    <td>Rs.$amount_due/-</td>
                                    <td>$invoice_no</td>
                                    <td>$total_product</td>
                                    <td>$order_status</td>
                                    <td class='date-time'>$order_date</td>
                                    <td><button><a href='dashboard.php?delete_order_id=$order_id' class='delete-button'>Delete</a></button>
                                        <button><a href='dashboard.php?update_order_id=$order_id' class='update-button'>Update</a></button>    
                                    </td>
                                  </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }else{
                                echo "<h2 style='margin:20px auto;text-align: center;'>There is no Order</h2>";
                            }
                        }
                    }
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('dashboard.php?orders','_self');</script>";
            }
        }
    }

    function add_user(){
        if(isset($_POST['add_user'])){
            if(isset($_SESSION['admin_id'])){
                include '../connect.php';
                $user_name =  $_POST['user_name'];
                $user_email =  $_POST['email'];
                $user_pass =  $_POST['password'];
                $user_cpass =  $_POST['cpassword'];
                $user_image = "default.png";
                $user_address = "";
                $user_phone = (int) "";
                $user_token = bin2hex(random_bytes(20));
                $user_status = "active";
                $user_hash_pass = password_hash($user_pass,PASSWORD_BCRYPT);
                if(!empty($user_name) && !empty($user_email) && !empty($user_pass) && !empty($user_cpass)){
                    $select_user_query = "SELECT `user_email`,`status` FROM `register` WHERE `user_email`=? AND `status`=?";
                    $select_result = $con->prepare($select_user_query);
                    if($select_result){
                        $select_result->bind_param('ss',$user_email,$user_status);
                        if($select_result->execute()){
                            $select_result->store_result();
                            if($select_result->num_rows > 0){
                                echo "<script>alert('Email Already Exists...');</script>";
                                echo "<script>window.open('dashboard.php?add_users','_self');</script>";
                            }elseif($user_pass !== $user_cpass){
                                echo "<script>alert('Incorrect confirm password...');</script>";
                                echo "<script>window.open('dashboard.php?add_users','_self');</script>";
                            }else{
                                $insert_user_query = "INSERT INTO `register` (`user_name`,`user_image`,`user_address`,`user_phone`,`user_email`,`user_password`,`token`,`status`) VALUES(?,?,?,?,?,?,?,?)";
                                $insert_result = $con->prepare($insert_user_query);
                                if($insert_result){
                                    $insert_result->bind_param('sssissss',$user_name,$user_image,$user_address,$user_phone,$user_email,$user_hash_pass,$user_token,$user_status);
                                    if($insert_result->execute()){
                                        echo "<script>alert('User Inserted Successfully!');</script>";
                                        echo "<script>window.open('dashboard.php?add_users','_self');</script>";
                                    }else{
                                        echo "<script>window.open('dashboard.php?add_users','_self');</script>";
                                    }
                                }else{
                                    echo "<script>window.open('dashboard.php?add_users','_self');</script>";
                                }
                                $insert_result->close();
                            }
                        }else{
                            echo "<script>window.open('dashboard.php?add_users','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?add_users','_self');</script>";
                    }
                    $select_result->close();
                }else{
                    echo "<script>window.open('dashboard.php?add_users','_self');</script>";
                }
                $con->close();
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_GET['add_users'])){
            if(isset($_SESSION['admin_id'])){
                if(empty($_GET['add_users'])){
                    echo "<div class='container'>
                            <div class='form-container'>
                                <h2>Add User</h2>
                                <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                    <div class='form-group'>
                                        <label for='user_name'>Name</label>
                                        <input type='text' id='user_name' name='user_name' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='email'>Email</label>
                                        <input type='email' id='email' name='email' onKeyUp='check1(this.value)' required>
                                        <p class='error'></p>
                                    </div>
                                    <div class='form-group'>
                                        <label for='password'>Password</label>
                                        <input type='password' id='password' name='password' onKeyUp='check2(this.value)' required>
                                        <i class='fa-sharp fa-solid fa-eye-slash' id='eye-close' onClick='toggle()'></i>
                                        <p class='error'></p>
                                    </div>
                                    <div class='form-group'>
                                        <label for='cpassword'>Confirm Password</label>
                                        <input type='password' id='cpassword' name='cpassword' onKeyUp='check3(this.value)' required>
                                        <p class='error'></p>
                                    </div>
                                    <div class='form-group'>
                                        <button type='submit' name='add_user'>Add User</button>
                                    </div>
                                </form>
                            </div>
                        </div>";
                }else{
                    echo "<script>window.open('dashboard.php?add_users','_self');</script>";
                }
            }
        }
    }
    
    function get_users(){
        if(isset($_GET['delete_user_id'])){
            if(isset($_SESSION['admin_id'])){
                if(!empty($_GET['delete_user_id'])){
                    include '../connect.php';
                    $delete_user_id = (int) $_GET['delete_user_id'];
                    $delete_user_query = "DELETE FROM `register` WHERE `user_id`=?";
                    $delete_result = $con->prepare($delete_user_query);
                    if($delete_result){
                        $delete_result->bind_param('i',$delete_user_id);
                        if($delete_result->execute()){
                            echo "<script>window.open('dashboard.php?users','_self');</script>";
                        }else{
                            echo "<script>window.open('dashboard.php?users','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?users','_self');</script>";
                    }
                    $delete_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('dashboard.php?users','_self');</script>";
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_POST['update_user'])){
            if(isset($_SESSION['admin_id'])){
                $user_name = $user_email =  $user_pass = $user_image = $user_mobile_no = $user_address = $user_status = "";
                $user_name_error = $user_email_error = $user_pass_error = $user_status_error = "";
                function testinput($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                if(!empty($_POST['user_name'])){
                    $user_name = testinput($_POST['user_name']);
                }else{
                    $user_name_error = "<p>Username must be required</p>";
                }
                if(!empty($_POST['email'])){
                    $user_email = testinput($_POST['email']);
                }else{
                    $user_email_error = "<p>Email must be required</p>";
                }
                if(!empty($_POST['password'])){
                    $user_pass = testinput($_POST['password']);
                }else{
                    $user_pass_error = "<p>Password must be required</p>";
                }
                if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
                    $user_image = testinput($_FILES['user_image']['name']);
                }else{
                    $user_image = "default.png";
                }
                if(!empty($_POST['user_phone'])){
                    $user_mobile_no = testinput($_POST['user_phone']);
                }else{
                    $user_mobile_no = (int) "";
                }
                if(!empty($_POST['user_address'])){
                    $user_address = testinput($_POST['user_address']);
                }else{
                    $user_address = "";
                }
                if(!empty($_POST['user_status'])){
                    $user_status = testinput($_POST['user_status']);
                }else{
                    $user_status = "<p>Status must be required</p>";
                }
                $user_id = $_POST['user_id'];
                $user_hash_pass = password_hash($user_pass,PASSWORD_BCRYPT);
                if (empty($user_name_error) && empty($user_email_error) && empty($user_pass_error) && empty($user_status_error)) {
                    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
                        $upload_dir = '../user_images/';
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
                    include '../connect.php';
                    $update_query = "UPDATE `register` SET `user_name`=?,`user_image`=?,`user_address`=?,`user_phone`=?, `user_email`=?,`user_password`=?,`status`=? WHERE `user_id`=?";
                    $answer = $con->prepare($update_query);
                    if($answer){
                        $answer->bind_param('sssisssi',$user_name,$user_image,$user_address,$user_mobile_no,$user_email,$user_hash_pass,$user_status,$user_id);
                        if($answer->execute()){
                            echo "<script>alert('User updated successfully!');</script>";
                            echo "<script>window.open('dashboard.php?users','_self');</script>";
                        }else{
                            echo "<script>window.open('dashboard.php?users','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?users','_self');</script>";
                    }
                    $answer->close();
                    $con->close();
                }
            }
            else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_GET['update_user_id'])){
            if(isset($_SESSION['admin_id'])){
                if(!empty($_GET['update_user_id'])){
                    include '../connect.php';
                    $update_user_id = (int) $_GET['update_user_id'];
                    $select_user_query = "SELECT * FROM `register` WHERE `user_id`=?";
                    $select_result = $con->prepare($select_user_query);
                    if($select_result){
                        $select_result->bind_param('i',$update_user_id);
                        if($select_result->execute()){
                            $values = $select_result->get_result();
                            if($values->num_rows > 0){
                                $row = $values->fetch_assoc();
                                $user_id = $row['user_id'];
                                $user_name = $row['user_name'];
                                $user_image = $row['user_image'];
                                $user_address = $row['user_address'];
                                $user_phone = $row['user_phone'];
                                if($user_phone === 0){
                                    $user_phone = "";
                                }
                                $user_email = $row['user_email'];
                                $user_pass= $row['user_password'];
                                $current_status= $row['status'];
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Update User</h2>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post' enctype='multipart/form-data'>
                                                <div class='form-group'>
                                                    <label for='user_name'>Name</label>
                                                    <input type='text' id='user_name' name='user_name' value='".$user_name."' required>
                                                    ".(isset($user_name_error) ? $user_name_error : "")."
                                                </div>
                                                <div class='form-group'>
                                                    <label for='user_image'>Image</label>
                                                    <input type='file' id='user_image' name='user_image'>
                                                    <img src='../user_images/$user_image' alt='$user_image' class='user-image'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='user_address'>Address</label>
                                                    <input type='text' id='user_address' name='user_address' value='".$user_address."'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='user_phone'>Phone No.</label>
                                                    <input type='number' id='user_phone' name='user_phone' value='".$user_phone."'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='email'>Email</label>
                                                    <input type='email' id='email' name='email' value='".$user_email."' required>
                                                    ".(isset($user_email_error) ? $user_email_error : "")."
                                                </div>
                                                <div class='form-group'>
                                                    <label for='password'>Password</label>
                                                    <input type='password' id='password' name='password' value='".$user_pass."' required>
                                                    ".(isset($user_pass_error) ? $user_pass_error : "")."
                                                </div>
                                                <div class='form-group'>
                                                    <label for='user_status'>Password</label>
                                                    <input type='text' id='password' name='user_status' value='".$current_status."' required>
                                                    ".(isset($user_status_error) ? $user_status_error : "")."
                                                </div>
                                                <input type='hidden' id='user_id' name='user_id' value='".$user_id."'>
                                                <div class='form-group'>
                                                    <button type='submit' name='update_user'>Update User</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                            } else{
                                echo "<script>window.open('dashboard.php?users','_self');</script>";
                            }
                        }else{
                            echo "<script>window.open('dashboard.php?users','_self');</script>";
                        }
                        $values->close();
                    }else{
                        echo "<script>window.open('dashboard.php?users','_self');</script>";
                    }
                    $select_result->close();
                    $con->close();
                } else{
                    echo "<script>window.open('dashboard.php?users','_self');</script>";
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_GET['search_user'])){
            if(isset($_GET['search_name'])){
                if(!empty($_GET['search_name'])){
                    include '../connect.php';
                    $search_name = $_GET['search_name'];
                    $select_query = "SELECT * FROM `register` WHERE `user_id` LIKE ? OR `user_name` LIKE ? OR `user_address` LIKE ? OR `user_phone` LIKE ? OR `status` LIKE ? OR `user_email` LIKE ?";
                    $result = $con->prepare($select_query);
                    if($result){
                        $search_data = "%$search_name%";
                        $result->bind_param('ssssss',$search_data,$search_data,$search_data,$search_data,$search_data,$search_data);
                        if($result->execute()){
                            $values = $result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_user'>
                                    </form>
                                    <table>
                                        <caption>User Records</caption>
                                        <thead>
                                            <tr>
                                                <th>User Id</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Address</th>
                                                <th>Phone No.</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $user_id = $rows['user_id'];
                                    $user_name = $rows['user_name'];
                                    $user_image = $rows['user_image'];
                                    $user_address = $rows['user_address'];
                                    if($user_address === ""){
                                        $user_address = "None";
                                    }
                                    $user_phone = $rows['user_phone'];
                                    if($user_phone === 0){
                                        $user_phone = "None";
                                    }
                                    $user_email = $rows['user_email'];
                                    $user_pass= $rows['user_password'];
                                    $user_status= $rows['status'];
                                    $user_date = $rows['time'];
                                    echo "<tr>
                                            <td>$user_id</td>
                                            <td>$user_name</td>
                                            <td><img src='../user_images/$user_image' alt='$user_image' class='user-image'></td>
                                            <td>$user_address</td>
                                            <td>$user_phone</td>
                                            <td>$user_email</td>
                                            <td>$user_status</td>
                                            <td class='date-time'>$user_date</td>
                                            <td><button><a href='dashboard.php?delete_user_id=$user_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_user_id=$user_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }else{
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_user'>
                                    </form>
                                    <h2 class='delete-footer'>No User Found Named \"$search_name\"</h2>";
                            }
                        }else{
                            header('Location:dashboard.php?users');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?users');
                        exit();
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:dashboard.php?users');
                    exit();
                }
            }else{
                header('Location:dashboard.php?users');
                exit();
            }
        }

        if(isset($_GET['users'])){
            if(empty($_GET['users'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $select_users = "SELECT * FROM `register`";
                    $select_result = $con->prepare($select_users);
                    if($select_result){
                        if($select_result->execute()){
                            $values = $select_result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_user'>
                                    </form>
                                    <table>
                                        <caption>User Records</caption>
                                        <thead>
                                            <tr>
                                                <th>User Id</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Address</th>
                                                <th>Phone No.</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $user_id = $rows['user_id'];
                                    $user_name = $rows['user_name'];
                                    $user_image = $rows['user_image'];
                                    $user_address = $rows['user_address'];
                                    if($user_address === ""){
                                        $user_address = "None";
                                    }
                                    $user_phone = $rows['user_phone'];
                                    if($user_phone === 0){
                                        $user_phone = "None";
                                    }
                                    $user_email = $rows['user_email'];
                                    $user_pass= $rows['user_password'];
                                    $user_status= $rows['status'];
                                    $user_date = $rows['time'];
                                    echo "<tr>
                                            <td>$user_id</td>
                                            <td>$user_name</td>
                                            <td><img src='../user_images/$user_image' alt='$user_image' class='user-image'></td>
                                            <td>$user_address</td>
                                            <td>$user_phone</td>
                                            <td>$user_email</td>
                                            <td>$user_status</td>
                                            <td class='date-time'>$user_date</td>
                                            <td><button><a href='dashboard.php?delete_user_id=$user_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_user_id=$user_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }else{
                                echo "<h2 style='margin:20px auto;text-align: center;'>There is no User</h2>";
                            }
                            $values->close();
                        }else{
                            echo "<script>window.open('dashboard.php','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php','_self');</script>";
                    }
                    $select_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('dashboard.php','_self');</script>";
            }
        }
    }

    function add_payment(){
        if(isset($_POST['add_payment'])){
            if(isset($_SESSION['admin_id'])){
                include '../connect.php';
                $user_id = $_POST['user_id'];
                $order_id = $_POST['order_id'];
                $invoice_no = $_POST['invoice_number'];
                $amount_paid = $_POST['amount_due'];
                $payment_method = $_POST['payment_method'];
                $select_payment_query = "SELECT `invoice_number` FROM `payment` WHERE `invoice_number`=?";
                $select_result = $con->prepare($select_payment_query);
                if($select_result){
                    $select_result->bind_param('i',$invoice_no);
                    if($select_result->execute()){
                        $select_result->store_result();
                        if($select_result->num_rows > 0){
                            echo "<script>alert('Payment Already Exists...');</script>";
                            echo "<script>window.open('dashboard.php?add_payments','_self');</script>";
                        }else{
                            $insert_payment_query = "INSERT INTO `payment` (`order_id`,`user_id`,`invoice_number`,`amount_paid`,`payment_method`) VALUES(?,?,?,?,?)";
                            $insert_result = $con->prepare($insert_payment_query);
                            if($insert_result){
                                $insert_result->bind_param('iiiis',$order_id,$user_id,$invoice_no,$amount_paid,$payment_method);
                                if($insert_result->execute()){
                                    echo "<script>alert('Payment added successfully!');</script>";
                                    echo "<script>window.open('dashboard.php?add_payments','_self');</script>";
                                }else{
                                    echo "<script>window.open('dashboard.php?add_payments','_self');</script>";
                                }
                            }else{
                                echo "<script>window.open('dashboard.php?add_payments','_self');</script>";
                            }
                            $insert_result->close();
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?add_payments','_self');</script>";
                    }
                }else{
                    echo "<script>window.open('dashboard.php?add_payments','_self');</script>";
                }
                $select_result->close();
                $con->close();
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }
        
        if(isset($_GET['add_payments'])){
            if(empty($_GET['add_payments'])){
                if(isset($_SESSION['admin_id'])){
                    echo "<div class='container'>
                            <div class='form-container'>
                                <h2>Add Payment</h2>
                                <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                    <div class='form-group'>
                                        <label for='order_id'>Order Id</label>
                                        <input type='number' id='order_id' min='1' name='order_id' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='user_id'>User Id</label>
                                        <input type='number' id='user_id' min='1' name='user_id' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='invoice_number'>Invoice Number</label>
                                        <input type='number' id='invoice_number' min='1' name='invoice_number' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='amount_due'>Amount Due</label>
                                        <input type='number' id='amount_due' min='9999' name='amount_due' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='payment_method'>Payment Method</label>
                                        <select id='payment_method' name='payment_method' required>
                                            <option value='' disabled selected>Select a payment method</option>
                                            <option value='credit_card'>Credit Card</option>
                                            <option value='paypal'>PayPal</option>
                                            <option value='bank_transfer'>Bank Transfer</option>
                                            <option value='cash'>Cash</option>
                                        </select>
                                    </div>
                                    <div class='form-group'>
                                        <button type='submit' name='add_payment'>Add Payment</button>
                                    </div>
                                </form>
                            </div>
                          </div>";
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('dashboard.php','_self');</script>";
            }
        }
    }

    function get_payments(){
        if(isset($_GET['delete_payment_id'])){
            if(!empty($_GET['delete_payment_id'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $delete_payment_id = (int) $_GET['delete_payment_id'];
                    $delete_payment_query = "DELETE FROM `payment` WHERE `payment_id`=?";
                    $delete_result = $con->prepare($delete_payment_query);
                    if($delete_result){
                        $delete_result->bind_param('i',$delete_payment_id);
                        if($delete_result->execute()){
                            echo "<script>window.open('dashboard.php?payments','_self');</script>";
                        }else{
                            echo "<script>window.open('dashboard.php?payments','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?payments','_self');</script>";
                    }
                    $delete_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('dashboard.php?payments','_self');</script>";
            }
        }

        if(isset($_POST['update_payment'])){
            if(isset($_SESSION['admin_id'])){
                include '../connect.php';
                $payment_id = $_POST['payment_id'];
                $order_id = $_POST['order_id'];
                $user_id = $_POST['user_id'];
                $invoice_number = $_POST['invoice_number'];
                $amount_paid = $_POST['amount_due'];
                $payment_method = $_POST['payment_method'];
                if(!empty($payment_id) && !empty($order_id) && !empty($user_id) && !empty($invoice_number) && !empty($amount_paid) && !empty($payment_method)){
                    $update_payment_query = "UPDATE `payment` SET `order_id`=?,`user_id`=?,`invoice_number`=?,`amount_paid`=?,`payment_method`=? WHERE `payment_id`=?";
                    $update_result = $con->prepare($update_payment_query);
                    if($update_result){
                        $update_result->bind_param('iiiisi',$order_id,$user_id,$invoice_number,$amount_paid,$payment_method,$payment_id);
                        if($update_result->execute()){
                            echo "<script>alert('Payment updated successfully!');</script>";
                            echo "<script>window.open('dashboard.php?payments','_self');</script>";
                        }else{
                            echo "<script>window.open('dashboard.php?payments','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?payments','_self');</script>";
                    }
                    $update_result->close();
                }else{
                    echo "<script>window.open('dashboard.php?payments','_self');</script>";
                }
                $con->close();
            }
        }

        if(isset($_GET['update_payment_id'])){
            if(!empty($_GET['update_payment_id'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $update_payment_id = (int) $_GET['update_payment_id'];
                    $update_payment_query = "SELECT * FROM `payment` WHERE `payment_id`=?";
                    $update_result = $con->prepare($update_payment_query);
                    if($update_result){
                        $update_result->bind_param('i',$update_payment_id);
                        if($update_result->execute()){
                            $values = $update_result->get_result();
                            if($values->num_rows > 0){
                                $rows = $values->fetch_assoc();
                                $payment_id = $rows['payment_id'];
                                $order_id = $rows['order_id'];
                                $user_id = $rows['user_id'];
                                $invoice_number = $rows['invoice_number'];
                                $amount_paid = $rows['amount_paid'];
                                $payment_method = $rows['payment_method'];
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Update Payment</h2>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                <div class='form-group'>
                                                    <label for='order_id'>Order Id</label>
                                                    <input type='number' id='order_id' min='1' value='$order_id' name='order_id' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='user_id'>User Id</label>
                                                    <input type='number' id='user_id' min='1' value='$user_id' name='user_id' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='invoice_number'>Invoice Number</label>
                                                    <input type='number' id='invoice_number' min='1' value='$invoice_number' name='invoice_number' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='amount_due'>Amount Due</label>
                                                    <input type='number' id='amount_due' min='9999' value='$amount_paid' name='amount_due' required>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='payment_method'>Payment Method</label>
                                                    <select id='payment_method' name='payment_method' required>
                                                        <option value='$payment_method' selected>$payment_method</option>
                                                        <option value='credit_card'>Credit Card</option>
                                                        <option value='paypal'>PayPal</option>
                                                        <option value='bank_transfer'>Bank Transfer</option>
                                                        <option value='cash'>Cash</option>
                                                    </select>
                                                </div>
                                                <input type='hidden' name='payment_id' value='$payment_id'>
                                                <div class='form-group'>
                                                    <button type='submit' name='update_payment'>Update Payment</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                            }else{
                                echo "<script>window.open('dashboard.php?payments','_self');</script>";
                            }
                            $values->close();
                        }else{
                            echo "<script>window.open('dashboard.php','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php','_self');</script>";
                    }
                    $update_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('dashboard.php?payments','_self');</script>";
            }
        }

        if(isset($_GET['search_payment'])){
            if(isset($_GET['search_name'])){
                if(!empty($_GET['search_name'])){
                    include '../connect.php';
                    $search_name = $_GET['search_name'];
                    $select_query = "SELECT * FROM `payment` WHERE `payment_id` LIKE ? OR `invoice_number` LIKE ? OR `user_id` LIKE ? OR `order_id` LIKE ? OR `amount_paid` LIKE ? OR `payment_method` LIKE ?";
                    $result = $con->prepare($select_query);
                    if($result){
                        $search_data = "%$search_name%";
                        $result->bind_param('ssssss',$search_data,$search_data,$search_data,$search_data,$search_data,$search_data);
                        if($result->execute()){
                            $values = $result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_payment'>
                                    </form>
                                    <table>
                                        <caption>Payment Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Payment Id</th>
                                                <th>Order Id</th>
                                                <th>User Id</th>
                                                <th>Invoice Number</th>
                                                <th>Amount Paid</th>
                                                <th>Payment Method</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $payment_id = $rows['payment_id'];
                                    $order_id = $rows['order_id'];
                                    $user_id = $rows['user_id'];
                                    $invoice_number = $rows['invoice_number'];
                                    $amount_paid = number_format($rows['amount_paid'],2,'.',',');
                                    $payment_method = $rows['payment_method'];
                                    $payment_date = $rows['date'];
                                    echo "<tr>
                                            <td>$payment_id</td>
                                            <td>$order_id</td>
                                            <td>$user_id</td>
                                            <td>$invoice_number</td>
                                            <td>Rs.$amount_paid/-</td>
                                            <td>$payment_method</td>
                                            <td class='date-time'>$payment_date</td>
                                            <td><button><a href='dashboard.php?delete_payment_id=$payment_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_payment_id=$payment_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                    </table>";
                            }else{
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_payment'>
                                    </form>
                                    <h2 class='delete-footer'>No Payment Found Named \"$search_name\"</h2>";
                            }
                        }else{
                            header('Location:dashboard.php?payments');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?payments');
                        exit();
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:dashboard.php?payments');
                    exit();
                }
            }else{
                header('Location:dashboard.php?payments');
                exit();
            }
        }

        if(isset($_GET['payments'])){
            if(empty($_GET['payments'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $select_payment_query = "SELECT * FROM `payment`";
                    $select_result = $con->prepare($select_payment_query);
                    if($select_result){
                        if($select_result->execute()){
                            $values = $select_result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_payment'>
                                    </form>
                                    <table>
                                        <caption>Payment Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Payment Id</th>
                                                <th>Order Id</th>
                                                <th>User Id</th>
                                                <th>Invoice Number</th>
                                                <th>Amount Paid</th>
                                                <th>Payment Method</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $payment_id = $rows['payment_id'];
                                    $order_id = $rows['order_id'];
                                    $user_id = $rows['user_id'];
                                    $invoice_number = $rows['invoice_number'];
                                    $amount_paid = number_format($rows['amount_paid'],2,'.',',');
                                    $payment_method = $rows['payment_method'];
                                    $payment_date = $rows['date'];
                                    echo "<tr>
                                            <td>$payment_id</td>
                                            <td>$order_id</td>
                                            <td>$user_id</td>
                                            <td>$invoice_number</td>
                                            <td>Rs.$amount_paid/-</td>
                                            <td>$payment_method</td>
                                            <td class='date-time'>$payment_date</td>
                                            <td><button><a href='dashboard.php?delete_payment_id=$payment_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_payment_id=$payment_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                    </table>";
                            }else{
                                echo "<h2 style='margin:20px auto;text-align: center;'>There is no Payment</h2>";
                            }
                            $values->close();
                        }else{
                            echo "<script>window.open('dashboard.php','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php','_self');</script>";
                    }
                    $select_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('dashboard.php','_self');</script>";
            }
        }
    }

    function add_admins(){
        if(isset($_POST['add_admin'])){
            if(isset($_SESSION['admin_id'])){
                include '../connect.php';
                $admin_name =  $_POST['admin_name'];
                $admin_email =  $_POST['email'];
                $admin_pass =  $_POST['password'];
                $admin_cpass =  $_POST['cpassword'];
                $admin_image = "default.png";
                $admin_address = "";
                $admin_phone = (int) "";
                $token = bin2hex(random_bytes(20));
                $admin_status = "active";
                $admin_hash_pass = password_hash($admin_pass,PASSWORD_BCRYPT);
                if(!empty($admin_name) && !empty($admin_email) && !empty($admin_pass) && !empty($admin_cpass)){
                    $select_admin_query = "SELECT `admin_email`,`status` FROM `admin_table` WHERE `admin_email`=? AND `status`=?";
                    $select_result = $con->prepare($select_admin_query);
                    if($select_result){
                        $select_result->bind_param('ss',$admin_email,$admin_status);
                        if($select_result->execute()){
                            $select_result->store_result();
                            if($select_result->num_rows > 0){
                                echo "<script>alert('Email Already Exists...');</script>";
                                echo "<script>window.open('dashboard.php?add_admins','_self');</script>";
                            }elseif($admin_pass !== $admin_cpass){
                                echo "<script>alert('Incorrect confirm password...');</script>";
                                echo "<script>window.open('dashboard.php?add_admins','_self');</script>";
                            }else{
                                $insert_admin_query = "INSERT INTO `admin_table` (`admin_name`,`admin_image`,`admin_address`,`admin_phone`,`admin_email`,`admin_password`,`token`,`status`) VALUES(?,?,?,?,?,?,?,?)";
                                $insert_result = $con->prepare($insert_admin_query);
                                if($insert_result){
                                    $insert_result->bind_param('sssissss',$admin_name,$admin_image,$admin_address,$admin_phone,$admin_email,$admin_hash_pass,$token,$admin_status);
                                    if($insert_result->execute()){
                                        echo "<script>alert('Admin Inserted Successfully!');</script>";
                                        echo "<script>window.open('dashboard.php?add_admins','_self');</script>";
                                    }else{
                                        echo "<script>window.open('dashboard.php?add_admins','_self');</script>";
                                    }
                                }else{
                                    echo "<script>window.open('dashboard.php?add_admins','_self');</script>";
                                }
                                $insert_result->close();
                            }
                        }else{
                            echo "<script>window.open('dashboard.php?add_admins','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?add_admins','_self');</script>";
                    }
                    $select_result->close();
                }else{
                    echo "<script>window.open('dashboard.php?add_admins','_self');</script>";
                }
                $con->close();
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_GET['add_admins'])){
            if(empty($_GET['add_admins'])){
                if(isset($_SESSION['admin_id'])){
                    echo "<div class='container'>
                            <div class='form-container'>
                                <h2>Add Admin</h2>
                                <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                    <div class='form-group'>
                                        <label for='admin_name'>Name</label>
                                        <input type='text' id='admin_name' name='admin_name' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='email'>Email</label>
                                        <input type='email' id='email' name='email' onKeyUp='check1(this.value)' required>
                                        <p class='error'></p>
                                    </div>
                                    <div class='form-group'>
                                        <label for='password'>Password</label>
                                        <input type='password' id='password' name='password' onKeyUp='check2(this.value)' required>
                                        <i class='fa-sharp fa-solid fa-eye-slash' id='eye-close' onClick='toggle()'></i>
                                        <p class='error'></p>
                                    </div>
                                    <div class='form-group'>
                                        <label for='cpassword'>Confirm Password</label>
                                        <input type='password' id='cpassword' name='cpassword' onKeyUp='check3(this.value)' required>
                                        <p class='error'></p>
                                    </div>
                                    <div class='form-group'>
                                        <button type='submit' name='add_admin'>Add Admin</button>
                                    </div>
                                </form>
                            </div>
                        </div>";
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('dashboard.php','_self');</script>";
            }
        }
    }

    function get_admins(){
        if(isset($_GET['delete_admin_id'])){
            if(isset($_SESSION['admin_id'])){
                if(!empty($_GET['delete_admin_id'])){
                    include '../connect.php';
                    $delete_admin_id = (int) $_GET['delete_admin_id'];
                    $delete_admin_query = "DELETE FROM `admin_table` WHERE `admin_id`=?";
                    $delete_result = $con->prepare($delete_admin_query);
                    if($delete_result){
                        $delete_result->bind_param('i',$delete_admin_id);
                        if($delete_result->execute()){
                            echo "<script>window.open('dashboard.php?admins','_self');</script>";
                        }else{
                            echo "<script>window.open('dashboard.php?admins','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?admins','_self');</script>";
                    }
                    $delete_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('dashboard.php?admins','_self');</script>";
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_POST['update_admin'])){
            if(isset($_SESSION['admin_id'])){
                $admin_name = $admin_email =  $admin_pass = $admin_image = $admin_mobile_no = $admin_address = $admin_status = "";
                $admin_name_error = $admin_email_error = $admin_pass_error = $admin_status_error = "";
                function testinput($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                if(!empty($_POST['admin_name'])){
                    $admin_name = testinput($_POST['admin_name']);
                }else{
                    $admin_name_error = "<p>Admin Name must be required</p>";
                }
                if(!empty($_POST['email'])){
                    $admin_email = testinput($_POST['email']);
                }else{
                    $admin_email_error = "<p>Email must be required</p>";
                }
                if(!empty($_POST['password'])){
                    $admin_pass = testinput($_POST['password']);
                }else{
                    $admin_pass_error = "<p>Password must be required</p>";
                }
                if(!empty($_POST['status'])){
                    $admin_status = testinput($_POST['status']);
                }else{
                    $admin_status_error = "<p>Status must be required</p>";
                }
                if (isset($_FILES['admin_image']) && $_FILES['admin_image']['error'] === UPLOAD_ERR_OK) {
                    $admin_image = testinput($_FILES['admin_image']['name']);
                }else{
                    $admin_image = "default.png";
                }
                if(!empty($_POST['admin_phone'])){
                    $admin_mobile_no = testinput($_POST['admin_phone']);
                }else{
                    $admin_mobile_no = (int) "";
                }
                if(!empty($_POST['admin_address'])){
                    $admin_address = testinput($_POST['admin_address']);
                }else{
                    $admin_address = "";
                }
                $admin_id = $_POST['admin_id'];
                $admin_hash_pass = password_hash($admin_pass,PASSWORD_BCRYPT);
                if (empty($admin_name_error) && empty($admin_email_error) && empty($admin_pass_error)) {
                    if (isset($_FILES['admin_image']) && $_FILES['admin_image']['error'] === UPLOAD_ERR_OK) {
                        $upload_dir = '../admin_images/';
                        if(!is_dir($upload_dir)){
                            mkdir($upload_dir,0755,true);
                        }
                        $upload_file = $upload_dir . basename($_FILES['admin_image']['name']);
                        if (move_uploaded_file($_FILES['admin_image']['tmp_name'], $upload_file)) {
                            $admin_image = basename($_FILES['admin_image']['name']);
                        } else {
                            $admin_image = "default.png";
                        }
                    } else {
                        $admin_image = "default.png";
                    }
                    include '../connect.php';
                    $update_query = "UPDATE `admin_table` SET `admin_name`=?,`admin_image`=?,`admin_address`=?,`admin_phone`=?, `admin_email`=?,`admin_password`=?,`status`=? WHERE `admin_id`=?";
                    $answer = $con->prepare($update_query);
                    if($answer){
                        $answer->bind_param('sssisssi',$admin_name,$admin_image,$admin_address,$admin_mobile_no,$admin_email,$admin_hash_pass,$admin_status,$admin_id);
                        if($answer->execute()){
                            echo "<script>alert('Admin updated successfully!');</script>";
                            echo "<script>window.open('dashboard.php?admins','_self');</script>";
                        } else{
                            echo "<script>window.open('dashboard.php?admins','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?admins','_self');</script>";
                    }
                    $answer->close();
                    $con->close();
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_GET['update_admin_id'])){
            if(isset($_SESSION['admin_id'])){
                if(!empty($_GET['update_admin_id'])){
                    include '../connect.php';
                    $update_admin_id = (int) $_GET['update_admin_id'];
                    $select_admin_query = "SELECT * FROM `admin_table` WHERE `admin_id`=?";
                    $select_result = $con->prepare($select_admin_query);
                    if($select_result){
                        $select_result->bind_param('i',$update_admin_id);
                        if($select_result->execute()){
                            $values = $select_result->get_result();
                            if($values->num_rows > 0){
                                $row = $values->fetch_assoc();
                                $admin_id = $row['admin_id'];
                                $admin_name = $row['admin_name'];
                                $admin_image = $row['admin_image'];
                                $admin_address = $row['admin_address'];
                                $admin_phone = $row['admin_phone'];
                                if($admin_phone === 0){
                                    $admin_phone = "";
                                }
                                $admin_email = $row['admin_email'];
                                $admin_pass= $row['admin_password'];
                                $status= $row['status'];
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Update Admin</h2>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post' enctype='multipart/form-data'>
                                                <div class='form-group'>
                                                    <label for='admin_name'>Name</label>
                                                    <input type='text' id='admin_name' name='admin_name' value='".$admin_name."' required>
                                                    ".(isset($admin_name_error) ? $admin_name_error : "")."
                                                </div>
                                                <div class='form-group'>
                                                    <label for='admin_image'>Image</label>
                                                    <input type='file' id='admin_image' name='admin_image'>
                                                    <img src='../admin_images/$admin_image' alt='$admin_image' class='user-image'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='admin_address'>Address</label>
                                                    <input type='text' id='admin_address' name='admin_address' value='".$admin_address."'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='admin_phone'>Phone No.</label>
                                                    <input type='number' id='admin_phone' name='admin_phone' value='".$admin_phone."'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='email'>Email</label>
                                                    <input type='email' id='email' name='email' value='".$admin_email."' required>
                                                    ".(isset($admin_email_error) ? $admin_email_error : "")."
                                                </div>
                                                <div class='form-group'>
                                                    <label for='password'>Password</label>
                                                    <input type='password' id='password' name='password' value='".$admin_pass."' required>
                                                    ".(isset($admin_pass_error) ? $admin_pass_error : "")."
                                                </div>
                                                <div class='form-group'>
                                                    <label for='status'>Status</label>
                                                    <input type='text' id='status' name='status' value='".$status."' required>
                                                    ".(isset($admin_status_error) ? $admin_status_error : "")."
                                                </div>
                                                <input type='hidden' id='admin_id' name='admin_id' value='".$admin_id."'>
                                                <div class='form-group'>
                                                    <button type='submit' name='update_admin'>Update Admin</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                            } else{
                                echo "<script>window.open('dashboard.php?admins','_self');</script>";
                            }
                        }else{
                            echo "<script>window.open('dashboard.php?admins','_self');</script>";
                        }
                        $values->close();
                    }else{
                        echo "<script>window.open('dashboard.php?admins','_self');</script>";
                    }
                    $select_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('dashboard.php?admins','_self');</script>";
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_GET['search_admin'])){
            if(isset($_GET['search_name'])){
                if(!empty($_GET['search_name'])){
                    include '../connect.php';
                    $search_name = $_GET['search_name'];
                    $select_query = "SELECT * FROM `admin_table` WHERE `admin_id` LIKE ? OR `status` LIKE ? OR `admin_name` LIKE ? OR `admin_email` LIKE ? OR `admin_phone` LIKE ? OR `admin_address` LIKE ?";
                    $result = $con->prepare($select_query);
                    if($result){
                        $search_data = "%$search_name%";
                        $result->bind_param('ssssss',$search_data,$search_data,$search_data,$search_data,$search_data,$search_data);
                        if($result->execute()){
                            $values = $result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_admin'>
                                    </form>
                                    <table>
                                        <caption>Admin Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Admin Id</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Address</th>
                                                <th>Phone No.</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $admin_id = $rows['admin_id'];
                                    $admin_name = $rows['admin_name'];
                                    $admin_image = $rows['admin_image'];
                                    $admin_address = $rows['admin_address'];
                                    if($admin_address === ""){
                                        $admin_address = "None";
                                    }
                                    $admin_phone = $rows['admin_phone'];
                                    if($admin_phone === 0){
                                        $admin_phone = "None";
                                    }
                                    $admin_email = $rows['admin_email'];
                                    $admin_status= $rows['status'];
                                    $admin_date = $rows['date'];
                                    echo "<tr>
                                            <td>$admin_id</td>
                                            <td>$admin_name</td>
                                            <td><img src='../admin_images/$admin_image' alt='$admin_image' class='user-image'></td>
                                            <td>$admin_address</td>
                                            <td>$admin_phone</td>
                                            <td>$admin_email</td>
                                            <td>$admin_status</td>
                                            <td class='date-time'>$admin_date</td>
                                            <td><button><a href='dashboard.php?delete_admin_id=$admin_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_admin_id=$admin_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }else{
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_admin'>
                                    </form>
                                    <h2 class='delete-footer'>No Admin Found Named \"$search_name\"</h2>";
                            }
                        }else{
                            header('Location:dashboard.php?admins');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?admins');
                        exit();
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:dashboard.php?admins');
                    exit();
                }
            }else{
                header('Location:dashboard.php?admins');
                exit();
            }
        }

        if(isset($_GET['admins'])){
            if(empty($_GET['admins'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $select_admins = "SELECT * FROM `admin_table`";
                    $select_result = $con->prepare($select_admins);
                    if($select_result){
                        if($select_result->execute()){
                            $values = $select_result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_admin'>
                                    </form>
                                    <table>
                                        <caption>Admin Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Admin Id</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Address</th>
                                                <th>Phone No.</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $admin_id = $rows['admin_id'];
                                    $admin_name = $rows['admin_name'];
                                    $admin_image = $rows['admin_image'];
                                    $admin_address = $rows['admin_address'];
                                    if($admin_address === ""){
                                        $admin_address = "None";
                                    }
                                    $admin_phone = $rows['admin_phone'];
                                    if($admin_phone === 0){
                                        $admin_phone = "None";
                                    }
                                    $admin_email = $rows['admin_email'];
                                    $admin_status= $rows['status'];
                                    $admin_date = $rows['date'];
                                    echo "<tr>
                                            <td>$admin_id</td>
                                            <td>$admin_name</td>
                                            <td><img src='../admin_images/$admin_image' alt='$admin_image' class='user-image'></td>
                                            <td>$admin_address</td>
                                            <td>$admin_phone</td>
                                            <td>$admin_email</td>
                                            <td>$admin_status</td>
                                            <td class='date-time'>$admin_date</td>
                                            <td><button><a href='dashboard.php?delete_admin_id=$admin_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_admin_id=$admin_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }else{
                                echo "<h2 style='margin:20px auto;text-align: center;'>There is no Admin</h2>";
                            }
                            $values->close();
                        }else{
                            echo "<script>window.open('dashboard.php','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php','_self');</script>";
                    }
                    $select_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('dashboard.php','_self');</script>";
            }
        }
    }

    function add_contacts(){
        if(isset($_POST['add_contact'])){
            if(isset($_SESSION['admin_id'])){
                $user_email = $user_name = $user_message = $user_id = "";
                $user_name_error = $user_message_error = $user_email_error = $user_id_error = "";
                function testinput($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                if(!empty($_POST['user_id'])){
                    $user_id = testinput($_POST['user_id']);
                }else{
                    $user_id_error = "<p>User Id must be required</p>";
                }
                if(!empty($_POST['name'])){
                    $user_name = testinput($_POST['name']);
                }else{
                    $user_name_error = "<p>Name must be required</p>";
                }
                if(!empty($_POST['email'])){
                    $user_email = testinput($_POST['email']);
                }else{
                    $user_email_error = "<p>Email must be required</p>";
                }
                if(!empty($_POST['message'])){
                    $user_message = testinput($_POST['message']);
                }else{
                    $user_message_error = "<p>Message must be required</p>";
                }
                if(empty($user_id_error) && empty($user_name_error) && empty($user_email_error) && empty($user_message_error)){
                    include '../connect.php';
                    $select_query = "SELECT `user_id`,`user_name`,`user_email`,`user_message` FROM `contact` WHERE `user_id`=? && `user_name`=? && `user_email`=? && `user_message`=?";
                    $answer = $con->prepare($select_query);
                    if($answer){
                        $answer->bind_param('isss',$user_id,$user_name,$user_email,$user_message);
                        if($answer->execute()){
                            $answer->store_result();
                            if($answer->num_rows > 0){
                                echo "<script>alert('Message has already been sent successfully!');</script>";
                                echo "<script>window.open('dashboard.php?add_contacts','_self');</script>";
                            }else{
                                $insert_query = "INSERT INTO `contact` (`user_id`,`user_name`,`user_email`,`user_message`) VALUES(?,?,?,?)";
                                $result = $con->prepare($insert_query);
                                if($result){
                                    $result->bind_param('isss',$user_id,$user_name,$user_email,$user_message);
                                    if($result->execute()){
                                        echo "<script>alert('Message has been sent successfully!');</script>";
                                        echo "<script>window.open('dashboard.php?add_contacts','_self');</script>";
                                    }else{
                                        echo "<script>window.open('dashboard.php?add_contacts','_self');</script>";
                                    }
                                }else{
                                    echo "<script>window.open('dashboard.php?add_contacts','_self');</script>";
                                }
                                $result->close();
                            }
                        }else{
                            echo "<script>window.open('dashboard.php?add_contacts','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?add_contacts','_self');</script>";
                    }
                    $answer->close();
                    $con->close();
                }else{
                    $user_id_error = $user_id_error;
                    $user_email_error = $user_email_error;
                    $user_name_error = $user_name_error;
                    $user_message_error = $user_message_error;
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }
        
        if(isset($_GET['add_contacts'])){
            if(isset($_SESSION['admin_id'])){
                if(empty($_GET['add_contacts'])){
                    echo "<div class='container'>
                        <div class='form-container'>
                            <h2>Add Contact</h2>
                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                <div class='form-group'>
                                    <label for='user_id'>User Id</label>
                                    <input type='number' id='user_id' min='1' name='user_id' required>
                                    ".(isset($user_id_error) ? $user_id_error : "")."
                                </div>
                                <div class='form-group'>
                                    <label for='name'>Name</label>
                                    <input type='text' id='name' name='name' required>
                                    ".(isset($user_name_error) ? $user_name_error : "")."
                                </div>
                                <div class='form-group'>
                                    <label for='email'>Email</label>
                                    <input type='email' id='email' name='email' required>
                                    ".(isset($user_email_error) ? $user_email_error : "")."
                                </div>
                                <div class='form-group'>
                                    <label for='message'>Message</label>
                                    <textarea name='message' id='message' rows='4' style='width:100%;resize:vertical;padding:10px;border: 1px solid #ddd;
    border-radius: 4px;' required></textarea>
                                    ".(isset($admin_message_error) ? $admin_message_error : "")."
                                </div>
                                <div class='form-group'>
                                    <button type='submit' name='add_contact'>Add Contact</button>
                                </div>
                            </form>
                        </div>
                    </div>";
                }else{
                    echo "<script>window.open('dashboard.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }
    }
    
    function get_contacts(){
        if(isset($_GET['delete_contact_id'])){
            if(isset($_SESSION['admin_id'])){
                if(!empty($_GET['delete_contact_id'])){
                    include '../connect.php';
                    $delete_contact_id = (int) $_GET['delete_contact_id'];
                    $delete_contact_query = "DELETE FROM `contact` WHERE `contact_id`=?";
                    $delete_result = $con->prepare($delete_contact_query);
                    if($delete_result){
                        $delete_result->bind_param('i',$delete_contact_id);
                        if($delete_result->execute()){
                            echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                        }else{
                            echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                    }
                    $delete_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_POST['update_contact'])){
            if(isset($_SESSION['admin_id'])){
                $user_email = $user_name = $user_message = $user_id = "";
                $user_name_error = $user_message_error = $user_email_error = $user_id_error = "";
                function testinput($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                if(!empty($_POST['user_id'])){
                    $user_id = testinput($_POST['user_id']);
                }else{
                    $user_id_error = "<p>User Id must be required</p>";
                }
                if(!empty($_POST['name'])){
                    $user_name = testinput($_POST['name']);
                }else{
                    $user_name_error = "<p>Name must be required</p>";
                }
                if(!empty($_POST['email'])){
                    $user_email = testinput($_POST['email']);
                }else{
                    $user_email_error = "<p>Email must be required</p>";
                }
                if(!empty($_POST['message'])){
                    $user_message = testinput($_POST['message']);
                }else{
                    $user_message_error = "<p>Message must be required</p>";
                }
                $contact_id = (int) $_POST['contact_id'];
                if(empty($user_id_error) && empty($user_name_error) && empty($user_email_error) && empty($user_message_error)){
                    include '../connect.php';
                    $update_query = "UPDATE `contact` SET `user_id`=?,`user_name`=?,`user_email`=?,`user_message`=? WHERE `contact_id`=?";
                    $result = $con->prepare($update_query);
                    if($result){
                        $result->bind_param('isssi',$user_id,$user_name,$user_email,$user_message,$contact_id);
                        if($result->execute()){
                            echo "<script>alert('Message has been updated successfully!');</script>";
                            echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                        }else{
                            echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                    }
                    $result->close();
                    $con->close();
                }else{
                    $user_id_error = $user_id_error;
                    $user_email_error = $user_email_error;
                    $user_name_error = $user_name_error;
                    $user_message_error = $user_message_error;
                }
            } else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_GET['update_contact_id'])){
            if(isset($_SESSION['admin_id'])){
                if(!empty($_GET['update_contact_id'])){
                    include '../connect.php';
                    $update_contact_id = (int) $_GET['update_contact_id'];
                    $select_contact_query = "SELECT * FROM `contact` WHERE `contact_id`=?";
                    $select_result = $con->prepare($select_contact_query);
                    if($select_result){
                        $select_result->bind_param('i',$update_contact_id);
                        if($select_result->execute()){
                            $values = $select_result->get_result();
                            if($values->num_rows > 0){
                                $row = $values->fetch_assoc();
                                $contact_id = $row['contact_id'];
                                $user_id = $row['user_id'];
                                $user_name = $row['user_name'];
                                $user_email = $row['user_email'];
                                $user_message = $row['user_message'];
                                echo "<div class='container'>
                                        <div class='form-container'>
                                            <h2>Update Contact</h2>
                                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                                <div class='form-group'>
                                                    <label for='user_id'>User Id</label>
                                                    <input type='number' id='user_id' min='1' name='user_id' value='$user_id' required>
                                                    ".(isset($user_id_error) ? $user_id_error : "")."
                                                </div>
                                                <div class='form-group'>
                                                    <label for='name'>Name</label>
                                                    <input type='text' id='name' name='name' value='$user_name' required>
                                                    ".(isset($user_name_error) ? $user_name_error : "")."
                                                </div>
                                                <div class='form-group'>
                                                    <label for='email'>Email</label>
                                                    <input type='email' id='email' name='email' value='$user_email' required>
                                                    ".(isset($user_email_error) ? $user_email_error : "")."
                                                </div>
                                                <div class='form-group'>
                                                    <label for='message'>Message</label>
                                                    <textarea name='message' id='message' rows='4' style='width:100%;resize:vertical;padding:10px;border: 1px solid #ddd;
                    border-radius: 4px;' required>$user_message</textarea>
                                                    ".(isset($admin_message_error) ? $admin_message_error : "")."
                                                </div>
                                                <input type='hidden' name='contact_id' value='$contact_id'>
                                                <div class='form-group'>
                                                    <button type='submit' name='update_contact'>Update Contact</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>";
                            }else{
                                echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                            }
                        }else{
                            echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                        }
                        $values->close();
                    }else{
                        echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                    }
                    $select_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('dashboard.php?contacts','_self');</script>";
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }

        if(isset($_GET['search_contact'])){
            if(isset($_GET['search_name'])){
                if(!empty($_GET['search_name'])){
                    include '../connect.php';
                    $search_name = $_GET['search_name'];
                    $select_query = "SELECT * FROM `contact` WHERE `user_id` LIKE ? OR `contact_id` LIKE ? OR `user_name` LIKE ? OR `user_email` LIKE ? OR `user_message` LIKE ?";
                    $result = $con->prepare($select_query);
                    if($result){
                        $search_data = "%$search_name%";
                        $result->bind_param('sssss',$search_data,$search_data,$search_data,$search_data,$search_data);
                        if($result->execute()){
                            $values = $result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_contact'>
                                    </form>
                                    <table>
                                        <caption>Contact Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Contact Id</th>
                                                <th>User Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $contact_id = $rows['contact_id'];
                                    $user_id = $rows['user_id'];
                                    $user_name = $rows['user_name'];
                                    $user_email = $rows['user_email'];
                                    $user_message = $rows['user_message'];
                                    $user_date = $rows['date'];
                                    echo "<tr>
                                            <td>$contact_id</td>
                                            <td>$user_id</td>
                                            <td>$user_name</td>
                                            <td>$user_email</td>
                                            <td>$user_message</td>
                                            <td class='date-time'>$user_date</td>
                                            <td><button><a href='dashboard.php?delete_contact_id=$contact_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_contact_id=$contact_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }else{
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_contact'>
                                    </form>
                                    <h2 class='delete-footer'>No Contact Found Named \"$search_name\"</h2>";
                            }
                        }else{
                            header('Location:dashboard.php?contacts');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?contacts');
                        exit();
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:dashboard.php?contacts');
                    exit();
                }
            }else{
                header('Location:dashboard.php?contacts');
                exit();
            }
        }

        if(isset($_GET['contacts'])){
            if(empty($_GET['contacts'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $select_contacts = "SELECT * FROM `contact`";
                    $select_result = $con->prepare($select_contacts);
                    if($select_result){
                        if($select_result->execute()){
                            $values = $select_result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_contact'>
                                    </form>
                                    <table>
                                        <caption>Contact Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Contact Id</th>
                                                <th>User Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $contact_id = $rows['contact_id'];
                                    $user_id = $rows['user_id'];
                                    $user_name = $rows['user_name'];
                                    $user_email = $rows['user_email'];
                                    $user_message = $rows['user_message'];
                                    $user_date = $rows['date'];
                                    echo "<tr>
                                            <td>$contact_id</td>
                                            <td>$user_id</td>
                                            <td>$user_name</td>
                                            <td>$user_email</td>
                                            <td>$user_message</td>
                                            <td class='date-time'>$user_date</td>
                                            <td><button><a href='dashboard.php?delete_contact_id=$contact_id' class='delete-button'>Delete</a></button>
                                                <button><a href='dashboard.php?update_contact_id=$contact_id' class='update-button'>Update</a></button>    
                                            </td>
                                        </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            }else{
                                echo "<h2 style='margin:20px auto;text-align: center;'>There is no Contact</h2>";
                            }
                            $values->close();
                        }else{
                            echo "<script>window.open('dashboard.php','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php','_self');</script>";
                    }
                    $select_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            } else{
                echo "<script>window.open('dashboard.php','_self');</script>";
            }
        }
    }

    function add_carts(){
        if(isset($_POST['add_to_cart'])){
            if(isset($_SESSION['admin_id'])){
                $product_id = $user_id = $quantity = "";
                $product_id_error = $user_id_error = $quantity_error = "";
                function testinput($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                if(!empty($_POST['product_id'])){
                    $product_id = testinput($_POST['product_id']);
                }else{
                    $product_id_error = "<p>Product Id must be required</p>";
                }
                if(!empty($_POST['user_id'])){
                    $user_id = testinput($_POST['user_id']);
                }else{
                    $user_id_error = "<p>User Id must be required</p>";
                }
                if(!empty($_POST['quantity'])){
                    $quantity = testinput($_POST['quantity']);
                }else{
                    $quantity_error = "<p>Quantity must be required</p>";
                }
                if(empty($user_id_error) && empty($product_id_error) && empty($quantity_error)){
                    include '../connect.php';
                    $select_query = "SELECT `product_id`,`user_id`,`quantity` FROM `carts` WHERE `product_id`=? && `user_id`=? && `quantity`=?";
                    $answer = $con->prepare($select_query);
                    if($answer){
                        $answer->bind_param('iii',$product_id,$user_id,$quantity);
                        if($answer->execute()){
                            $answer->store_result();
                            if($answer->num_rows > 0){
                                echo "<script>alert('Product already present in cart...');</script>";
                                echo "<script>window.open('dashboard.php?add_carts','_self');</script>";
                            }else{
                                $insert_query = "INSERT INTO `carts` (`product_id`,`user_id`,`quantity`) VALUES(?,?,?)";
                                $result = $con->prepare($insert_query);
                                if($result){
                                    $result->bind_param('iii',$product_id,$user_id,$quantity);
                                    if($result->execute()){
                                        echo "<script>alert('Product has been added to cart successfully!');</script>";
                                        echo "<script>window.open('dashboard.php?add_carts','_self');</script>";
                                    }else{
                                        echo "<script>window.open('dashboard.php?add_carts','_self');</script>";
                                    }
                                }else{
                                    echo "<script>window.open('dashboard.php?add_carts','_self');</script>";
                                }
                                $result->close();
                            }
                        }else{
                            echo "<script>window.open('dashboard.php?add_carts','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php?add_carts','_self');</script>";
                    }
                    $answer->close();
                    $con->close();
                }else{
                    $product_id_error = $product_id_error;
                    $user_id_error = $user_id_error;
                    $quantity_error = $quantity_error;
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }
        
        if(isset($_GET['add_carts'])){
            if(isset($_SESSION['admin_id'])){
                if(empty($_GET['add_carts'])){
                    echo "<div class='container'>
                        <div class='form-container'>
                            <h2>Add Cart</h2>
                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                                <div class='form-group'>
                                    <label for='product_id'>Product Id</label>
                                    <input type='number' id='product_id' min='1' name='product_id' required>
                                    ".(isset($product_id_error) ? $product_id_error : "")."
                                </div>
                                <div class='form-group'>
                                    <label for='user_id'>User Id</label>
                                    <input type='number' id='user_id' min='1' name='user_id' required>
                                    ".(isset($user_id_error) ? $user_id_error : "")."
                                </div>
                                <div class='form-group'>
                                    <label for='quantity'>Quantity</label>
                                    <input type='number' id='quantity' min='1' name='quantity' required>
                                    ".(isset($quantity_error) ? $quantity_error : "")."
                                </div>
            
                                <div class='form-group'>
                                    <button type='submit' name='add_to_cart'>Add to Cart</button>
                                </div>
                            </form>
                        </div>
                    </div>";
                }else{
                    echo "<script>window.open('dashboard.php','_self');</script>";
                }
            }else{
                echo "<script>window.open('admin_login.php','_self');</script>";
            }
        }
    }

    function get_carts(){
        if(isset($_GET['search_cart'])){
            if(isset($_GET['search_name'])){
                if(!empty($_GET['search_name'])){
                    include '../connect.php';
                    $total_price = 0;
                    $search_name = $_GET['search_name'];
                    $select_query = "SELECT * FROM `carts` WHERE `user_id` LIKE ? OR `product_id` LIKE ? OR `quantity` LIKE ?";
                    $result = $con->prepare($select_query);
                    if($result){
                        $search_data = "%$search_name%";
                        $result->bind_param('sss',$search_data,$search_data,$search_data);
                        if($result->execute()){
                            $values = $result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_cart'>
                                    </form>
                                    <table>
                                        <caption>Cart Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Product Id</th>
                                                <th>User Id</th>
                                                <th>Quantity</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $product_id = $rows['product_id'];
                                    $user_id = $rows['user_id'];
                                    $quantity = $rows['quantity'];
                                    $cart_date = $rows['date'];

                                    $select_product_query = "SELECT `product_price` FROM `products` WHERE `product_id`=?";
                                    $select_product_result = $con->prepare($select_product_query);
                                    if($select_product_result){
                                        $select_product_result->bind_param('i',$product_id);
                                        if($select_product_result->execute()){
                                            $select_product_result->bind_result($product_price);
                                            $select_product_result->store_result();
                                            $select_product_result->fetch();
                                            $total_price += $product_price * $quantity;
                                            echo "<tr>
                                                    <td>$product_id</td>
                                                    <td>$user_id</td>
                                                    <td>$quantity</td>
                                                    <td class='date-time'>$cart_date</td>
                                                </tr>";
                                        }
                                        else{
                                            echo "<script>window.open('dashboard.php','_self');</script>";
                                        }
                                    }
                                    else{
                                        echo "<script>window.open('dashboard.php','_self');</script>";
                                    }
                                    $select_product_result->close();
                                }
                                echo "</tbody>
                                </table>
                                <button class='total-price'>Total Cart Price Rs.".number_format($total_price,2,'.',',')."/-</button>";
                            }else{
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' value='$search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_cart'>
                                    </form>
                                    <h2 class='delete-footer'>No Cart Found Named \"$search_name\"</h2>";
                            }
                        }else{
                            header('Location:dashboard.php?carts');
                            exit();
                        }
                    }else{
                        header('Location:dashboard.php?carts');
                        exit();
                    }
                    $result->close();
                    $con->close();
                }else{
                    header('Location:dashboard.php?carts');
                    exit();
                }
            }else{
                header('Location:dashboard.php?carts');
                exit();
            }
        }

        if(isset($_GET['carts'])){
            if(empty($_GET['carts'])){
                if(isset($_SESSION['admin_id'])){
                    include '../connect.php';
                    $total_price = 0;
                    $select_carts = "SELECT * FROM `carts`";
                    $select_result = $con->prepare($select_carts);
                    if($select_result){
                        if($select_result->execute()){
                            $values = $select_result->get_result();
                            if($values->num_rows > 0){
                                echo "<form class='search' action='". htmlspecialchars($_SERVER['PHP_SELF'])."' method='get'>
                                        <input type='text' name='search_name' placeholder='Search...' required>
                                        <input type='submit' value='Search' name='search_cart'>
                                    </form>
                                    <table>
                                        <caption>Cart Records</caption>
                                        <thead>
                                            <tr>
                                                <th>Product Id</th>
                                                <th>User Id</th>
                                                <th>Quantity</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                while($rows = $values->fetch_assoc()){
                                    $product_id = $rows['product_id'];
                                    $user_id = $rows['user_id'];
                                    $quantity = $rows['quantity'];
                                    $cart_date = $rows['date'];

                                    $select_product_query = "SELECT `product_price` FROM `products` WHERE `product_id`=?";
                                    $select_product_result = $con->prepare($select_product_query);
                                    if($select_product_result){
                                        $select_product_result->bind_param('i',$product_id);
                                        if($select_product_result->execute()){
                                            $select_product_result->bind_result($product_price);
                                            $select_product_result->store_result();
                                            $select_product_result->fetch();
                                            $total_price += $product_price * $quantity;
                                            echo "<tr>
                                                    <td>$product_id</td>
                                                    <td>$user_id</td>
                                                    <td>$quantity</td>
                                                    <td class='date-time'>$cart_date</td>
                                                </tr>";
                                        }
                                        else{
                                            echo "<script>window.open('dashboard.php','_self');</script>";
                                        }
                                    }
                                    else{
                                        echo "<script>window.open('dashboard.php','_self');</script>";
                                    }
                                    $select_product_result->close();
                                }
                                echo "</tbody>
                                </table>
                                <button class='total-price'>Total Cart Price Rs.".number_format($total_price,2,'.',',')."/-</button>";
                            }else{
                                echo "<h2 style='margin:20px auto;text-align: center;'>There is no Cart</h2>";
                            }
                            $values->close();
                        }else{
                            echo "<script>window.open('dashboard.php','_self');</script>";
                        }
                    }else{
                        echo "<script>window.open('dashboard.php','_self');</script>";
                    }
                    $select_result->close();
                    $con->close();
                }else{
                    echo "<script>window.open('admin_login.php','_self');</script>";
                }
            } else{
                echo "<script>window.open('dashboard.php','_self');</script>";
            }
        }
    }

    function get_total_users(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $select_users = "SELECT `user_name` FROM `register`";
            $select_result = $con->prepare($select_users);
            if($select_result){
                if($select_result->execute()){
                    $select_result->store_result();
                    return number_format($select_result->num_rows);
                }
            }
        }else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_total_orders(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $select_orders = "SELECT `amount_due` FROM `user_order`";
            $select_result = $con->prepare($select_orders);
            if($select_result){
                if($select_result->execute()){
                    $select_result->store_result();
                    return number_format($select_result->num_rows);
                }
            }
        }else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_total_carts(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $select_carts = "SELECT * FROM `carts`";
            $select_result = $con->prepare($select_carts);
            if($select_result){
                if($select_result->execute()){
                    $select_result->store_result();
                    return number_format($select_result->num_rows);
                }
            }
        }else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_total_cart_price(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $total_price = 0;
            $select_carts = "SELECT * FROM `carts`";
            $select_result = $con->prepare($select_carts);
            if($select_result){
                if($select_result->execute()){
                    $values = $select_result->get_result();
                    if($values->num_rows > 0){
                        while($rows = $values->fetch_assoc()){
                            $product_id = $rows['product_id'];
                            $quantity = $rows['quantity'];
                            $select_product_query = "SELECT `product_price` FROM `products` WHERE `product_id`=?";
                            $select_product_result = $con->prepare($select_product_query);
                            if($select_product_result){
                                $select_product_result->bind_param('i',$product_id);
                                if($select_product_result->execute()){
                                    $select_product_result->bind_result($product_price);
                                    $select_product_result->store_result();
                                    $select_product_result->fetch();
                                    $total_price += $product_price * $quantity;
                                }
                            }
                            $select_product_result->close();
                        }
                        return "Rs.".number_format($total_price,2,'.',',')."/-";
                    }
                    $values->close();
                }
            }
            $select_result->close();
            $con->close();
        }else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_total_orders_pending(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $order_pending = "Pending...";
            $select_orders = "SELECT `order_status` FROM `user_order` WHERE `order_status`=?";
            $select_result = $con->prepare($select_orders);
            if($select_result){
                $select_result->bind_param('s',$order_pending);
                if($select_result->execute()){
                    $select_result->store_result();
                    return number_format($select_result->num_rows);
                }
            }
        }else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_total_orders_completed(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $order_completed = "Completed";
            $select_orders = "SELECT `order_status` FROM `user_order` WHERE `order_status`=?";
            $select_result = $con->prepare($select_orders);
            if($select_result){
                $select_result->bind_param('s',$order_completed);
                if($select_result->execute()){
                    $select_result->store_result();
                    return number_format($select_result->num_rows);
                }
            }
        }else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_total_payments(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $total_payments = 0;
            $select_payments = "SELECT `amount_paid` FROM `payment`";
            $select_result = $con->prepare($select_payments);
            if($select_result){
                if($select_result->execute()){
                    $select_result->bind_result($amount_paid);
                    $select_result->store_result();
                    if($select_result->num_rows > 0){
                        while($select_result->fetch()){
                            $total_payments += $amount_paid; 
                        }
                        return number_format($total_payments,2,'.',',');
                    }else{
                        return $total_payments = 0;
                    }
                }
            }
        }
    }

    function get_total_contacts(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $select_contacts = "SELECT `user_name` FROM `contact`";
            $select_result = $con->prepare($select_contacts);
            if($select_result){
                if($select_result->execute()){
                    $select_result->store_result();
                    return number_format($select_result->num_rows);
                }
            }
        }else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_total_products(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $select_products = "SELECT `product_name` FROM `products`";
            $select_result = $con->prepare($select_products);
            if($select_result){
                if($select_result->execute()){
                    $select_result->store_result();
                    return number_format($select_result->num_rows);
                }
            }
        }else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_total_brands(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $select_brands = "SELECT `brand_name` FROM `brands`";
            $select_result = $con->prepare($select_brands);
            if($select_result){
                if($select_result->execute()){
                    $select_result->store_result();
                    return number_format($select_result->num_rows);
                }
            }
        }else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_total_categories(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $select_categories = "SELECT `category_name` FROM `categories`";
            $select_result = $con->prepare($select_categories);
            if($select_result){
                if($select_result->execute()){
                    $select_result->store_result();
                    return number_format($select_result->num_rows);
                }
            }
        }else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_total_admins(){
        if(isset($_SESSION['admin_id'])){
            include '../connect.php';
            $select_admins = "SELECT `admin_name` FROM `admin_table`";
            $select_result = $con->prepare($select_admins);
            if($select_result){
                if($select_result->execute()){
                    $select_result->store_result();
                    return number_format($select_result->num_rows);
                }
            }
        } else{
            echo "<script>window.open('admin_login.php','_self');</script>";
        }
    }

    function get_dashboard(){
        if(!isset($_GET['orders'])){
        if(!isset($_GET['users'])){
        if(!isset($_GET['add_brand'])){
        if(!isset($_GET['brands'])){
        if(!isset($_GET['delete_brand_id'])){
        if(!isset($_GET['update_brand_id'])){
        if(!isset($_GET['add_category'])){
        if(!isset($_GET['categories'])){
        if(!isset($_GET['update_category_id'])){
        if(!isset($_GET['delete_category_id'])){
        if(!isset($_GET['add_products'])){
        if(!isset($_GET['products'])){
        if(!isset($_GET['update_product_id'])){
        if(!isset($_GET['delete_product_id'])){
        if(!isset($_GET['add_orders'])){
        if(!isset($_GET['add_users'])){
        if(!isset($_GET['delete_user_id'])){
        if(!isset($_GET['update_user_id'])){
        if(!isset($_GET['delete_order_id'])){
        if(!isset($_GET['update_order_id'])){
        if(!isset($_GET['update_payment_id'])){
        if(!isset($_GET['delete_payment_id'])){
        if(!isset($_GET['payments'])){
        if(!isset($_GET['add_payments'])){
        if(!isset($_GET['add_admins'])){
        if(!isset($_GET['delete_admin_id'])){
        if(!isset($_GET['update_admin_id'])){
        if(!isset($_GET['admins'])){
        if(!isset($_GET['add_contacts'])){
        if(!isset($_GET['update_contact_id'])){
        if(!isset($_GET['delete_contact_id'])){
        if(!isset($_GET['contacts'])){
        if(!isset($_GET['add_carts'])){
        if(!isset($_GET['carts'])){
        if(!isset($_GET['search_brand'])){
        if(!isset($_GET['search_category'])){
        if(!isset($_GET['search_product'])){
        if(!isset($_GET['search_order'])){
        if(!isset($_GET['search_payment'])){
        if(!isset($_GET['search_user'])){
        if(!isset($_GET['search_contact'])){
        if(!isset($_GET['search_admin'])){
        if(!isset($_GET['search_cart'])){
        if(!isset($_GET['about-us'])){
        if(isset($_SESSION['admin_id'])){
            echo "<div class='admin-dashboard'>
                    <div class='section'>
                        <h2>Users</h2>
                        <div class='card'>
                            <h3>Total Users: ".get_total_users()."</h3>
                        </div>
                    </div>
                    <div class='section'>
                        <h2>Carts</h2>
                        <div class='card'>
                            <h3>Total Carts: ".get_total_carts()."</h3>
                            <h3>Total Cart Price: ".get_total_cart_price()."</h3>
                        </div>
                    </div>
                    <div class='section'>
                        <h2>Orders</h2>
                        <div class='card'>
                            <h3>Total Orders: ".get_total_orders()."</h3>
                            <ul>
                                <li>Pending Orders: ".get_total_orders_pending()."</li>
                                <li>Completed Orders: ".get_total_orders_completed()."</li>
                            </ul>
                        </div>
                    </div>
                    <div class='section'>
                        <h2>Payments</h2>
                        <div class='card'>
                            <h3>Total Payments: Rs.".get_total_payments()."/-</h3>
                        </div>
                    </div>
                    <div class='section'>
                        <h2>Contacts</h2>
                        <div class='card'>
                            <h3>Total Contacts: ".get_total_contacts()."</h3>
                        </div>
                    </div>
                    <div class='section'>
                        <h2>Products</h2>
                        <div class='card'>
                            <h3>Total Products: ".get_total_products()."</h3>
                        </div>
                    </div>
                    <div class='section'>
                        <h2>Categories</h2>
                        <div class='card'>
                            <h3>Total Categories: ".get_total_categories()."</h3>
                        </div>
                    </div>
                    <div class='section'>
                        <h2>Brands</h2>
                        <div class='card'>
                            <h3>Total Brands: ".get_total_brands()."</h3>
                        </div>
                    </div>
                    <div class='section'>
                        <h2>Admins</h2>
                        <div class='card'>
                            <h3>Total Admins: ".get_total_admins()."</h3>
                        </div>
                    </div>
                </div>";
    }}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}
?>