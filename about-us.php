<?php 
    include './functions/common_files.php';
    session_start();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php get_current_url(); ?></title>
    <link rel="icon" type="image/png" href="./all_images/logo.png" />
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/user_sidebar.css">
    <link rel="stylesheet" href="./css/about.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body>
   <?php 
        get_header(); 
        if(isset($_SESSION['user_id'])){
            get_user_profile();    
        }
    ?>

    <main>
        <section class="hero">
            <h1>About proTech</h1>
            <p>Your premier destination for mobile shopping.</p>
        </section>

        <section class="company-info">
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
            <p>For more information or any inquiries, feel free to <a href="contact.php">contact us</a>.</p>
        </section>
    </main>

    <?php get_footer(); ?>

    <script src="./js/sidebar.js"></script>
    <script src="./js/user-sidebar2.js"></script>
</body>
</html>
