# Patel Brothers Catering Website

A full-stack web application for a food catering business, built with PHP and MySQL.

## Features

- User Authentication (Register/Login)
- Menu Display with Categories
- Online Order Placement
- Contact Form
- Responsive Design
- Admin Dashboard (Future Enhancement)

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- phpMyAdmin (for database management)

## Installation

1. Clone the repository to your web server directory:
   ```
   git clone https://github.com/yourusername/patel-brothers.git
   ```

2. Create a new MySQL database using phpMyAdmin:
   - Open phpMyAdmin
   - Create a new database named `patel_brothers`
   - Import the `database.sql` file to create the required tables

3. Configure the database connection:
   - Open `config/database.php`
   - Update the database credentials if needed:
     ```php
     define('DB_SERVER', 'localhost');
     define('DB_USERNAME', 'your_username');
     define('DB_PASSWORD', 'your_password');
     define('DB_NAME', 'patel_brothers');
     ```

4. Set up the web server:
   - Point your web server's document root to the project directory
   - Ensure PHP has write permissions for file uploads (if needed)

5. Access the website:
   - Open your web browser
   - Navigate to `http://localhost/patel-brothers`

## Database Structure

The application uses the following tables:

- `users`: Stores user account information
- `menu`: Contains food items and their details
- `orders`: Stores order information
- `order_items`: Contains items within each order
- `messages`: Stores contact form submissions

## Security Features

- Password hashing using PHP's built-in functions
- Prepared statements to prevent SQL injection
- Input validation and sanitization
- Session management for user authentication

## Contributing

1. Fork the repository
2. Create a new branch for your feature
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Author

Shrey Patel
Roll No: 22BBS0027

## Acknowledgments

- Bootstrap for the frontend framework
- Font Awesome for icons
- jQuery for JavaScript functionality 