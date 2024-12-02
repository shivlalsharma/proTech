# proTech - Online Mobile Shopping Platform

**proTech** is an online mobile shopping platform designed to provide a seamless experience for both users and admins. The platform allows users to browse products, manage their accounts, and make payments, while providing admins with a powerful dashboard to manage various aspects of the store.

## Features

### User Side:

- **Home Page**: Displays all the product cards with easy navigation.
- **Product Page**: Users can view detailed information about each product.
- **Cart Page**: Users can add and remove products from the shopping cart.
- **Orders Page**: View past and current orders.
- **Payments Page**: Securely make payments for products.
- **Account Management**: Users can edit their account details and delete their account.
- **Login**: Secure user login to access the platform.
- **Register**: Users can create a new account and receive an email for verification.
- **Forgot Password**: Users can reset their password by receiving a reset link via email.

### Admin Dashboard:

- **User Management**: Add, edit, or delete users.
- **Product Management**: Add, edit, or delete products.
- **Contact Management**: Manage customer inquiries and feedback.
- **Brand and Category Management**: Add, update, or delete brands and categories.
- **Order Management**: View, update, or delete orders.
- **Payment Management**: View and manage payments.
- **Cart Overview**: View the number of carts and the total cart amount.
- **Admin Management**: Manage admin users and permissions.
- **Login**: Secure admin login to access the dashboard.
- **Forgot Password**: Admins can reset their password by receiving a reset link via email.

### Additional Features:

- **Email Notifications**:
  - **Password Reset**: Users and admins receive an email with a reset link if their email is valid.
  - **Email Verification**: New users receive an email to verify their email address upon registration.

## Technologies Used

- **PHP**: Server-side scripting to handle backend logic.
- **HTML/CSS**: For creating the structure and style of the web pages.
- **JavaScript**: For dynamic content and interactivity.

## Installation

### Prerequisites

Ensure you have the following installed:
- Apache server (XAMPP)
- PHP
- MySQL
- Code editor (e.g., VSCode)

### Clone the repository
```bash
git clone https://github.com/shivlalsharma/proTech.git
cd proTech
```
### Set up the Database:

1. **Access phpMyAdmin**: Open `http://localhost/phpmyadmin/` in your browser.
2. **Create a new database**: Create a new database (e.g., `proTech`).
3. **Import the database schema** (if available) to create the tables.
4. **Update database connection settings** in `connect.php`:
```php
$servername = "localhost";
$username = "root";
$password = "";  // Default MySQL password
$dbname = "proTech";  // Name of your database
```

### Configure Server:

1. Ensure **Apache** and **MySQL** servers are running in **XAMPP**.
2. Place the project folder (`proTech`) in the `htdocs` directory of XAMPP.


### Access the Application:

1. Open your browser and go to `http://localhost/proTech`.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Author

Created and deployed by **Shivlal Sharma**.  
- **GitHub**: [Shivlal Sharma's GitHub](https://github.com/shivlalsharma)
- **LinkedIn**: [Shivlal Sharma's LinkedIn](https://www.linkedin.com/in/shivlal-sharma-56ba5a284/)