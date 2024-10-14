# Banking_Management_System_Atheian_Trust

## Overview

This project is a **[Banking Management system]**, built using PHP and MySQLi for database management, along with HTML and CSS for the front-end design. It demonstrates how to manage user accounts, handle transactions, and maintain database operations efficiently.

### Key Features

- **User Registration and Login:** Secure user authentication and account creation.
- **Employee & Admin Registration and Login:** Secure user authentication and account creation.
- **Database Management with MySQLi:** Efficient handling of database queries.
- **Transaction Management:** Allows users to perform transactions such as transfers, deposits, and withdrawals.
- **Admin Panel:** An interface for admin users to manage and oversee user activities.
- **Well-Designed UI:** Clean and responsive front-end using HTML and CSS.

## Technologies Used

- **PHP:** Server-side scripting for dynamic content and backend logic.
- **MySQLi:** Database management and queries.
- **HTML/CSS:** Front-end design and structure.


### MySQLi Database Setup

The following SQL code creates the necessary tables for the project. These tables handle users, transactions, and other system data.

## User Table

```sql
CREATE TABLE account_creation (
    account_number BIGINT(10) NOT NULL AUTO_INCREMENT,
    password VARCHAR(50) COLLATE utf8mb4_general_ci NOT NULL,
    nid BIGINT(20) NOT NULL,
    username VARCHAR(50) COLLATE utf8mb4_general_ci NOT NULL,
    DOB YEAR(4) NOT NULL,
    email VARCHAR(50) COLLATE utf8mb4_general_ci NOT NULL,
    registration_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    balance DECIMAL(15,2) NOT NULL,
    PRIMARY KEY (account_number)
);


```
## Admin Table

```sql
CREATE TABLE admin (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) COLLATE utf8mb4_general_ci NOT NULL,
    password VARCHAR(256) COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (id)
);


```
## Employee Table

```sql
CREATE TABLE employee_account (
    account_number BIGINT(10) NOT NULL AUTO_INCREMENT,
    password VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    nid BIGINT(20) NOT NULL,
    username VARCHAR(255) COLLATE utf8mb4_general_ci NOT NULL,
    DOB YEAR(4) NOT NULL,
    email VARCHAR(50) COLLATE utf8mb4_general_ci NOT NULL,
    registration_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    balance DECIMAL(15,2) NOT NULL,
    PRIMARY KEY (account_number)
);


```
## Transaction Table

```sql
CREATE TABLE transactions (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  transaction_type ENUM('deposit', 'withdrawal', 'transfer'),
  account_number VARCHAR(20),
  through ENUM('employee', 'user'),
  recipient_account VARCHAR(20),
  amount DECIMAL(15,2),
  date_time DATETIME DEFAULT CURRENT_TIMESTAMP()
);

```
## Bank Vault Table

```sql
CREATE TABLE vault (
  bank_name VARCHAR(256),
  bank_master_account INT(10),
  balance INT(10),
  registration_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()
);

```
## Installation and Setup

1. Clone the repository:
    ```bash
   https://github.com/TheOnlyNaimur/Banking_Management_System_Atheian_Trust.git
    ```
2. Navigate to the project directory:
   ```
   cd your-project
   ```
3. Set up the database:
   - Import the SQL file provided in the ```/db``` folder into your MySQL database.
   - Modify the ```/php/connection.php ```file to include your database credentials.

4. Run the project:
   - Use a local server like XAMPP or WAMP to host the project.
  - Place the project folder in your server's root directory and navigate to ```http://localhost/your-project```.

## Usage

**Registration:** Users can create an account via the registration page.
**Login:** Log in with a valid email and password.
**Dashboard:** Access the user dashboard to view account information and perform transactions.
**Admin Panel:** Admins can log in to manage users and monitor activities.

## License
This project is open-source and available under the MIT License.


**You can copy and paste this directly into your `README.md` file, and it will display the code and sections as described. Let me know if you need further adjustments!**



