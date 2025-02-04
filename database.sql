CREATE DATABASE banking_system;

USE banking_system;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each user
    username VARCHAR(50) NOT NULL,          -- Username with a max length of 50
    email VARCHAR(100) NOT NULL UNIQUE,     -- Email with a max length of 100, must be unique
    phone_no VARCHAR(15) NOT NULL,          -- Phone number with a max length of 15
    password VARCHAR(255) NOT NULL,         -- Password (hashed), max length 255
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp for when the record was created
);

-- Create admin table
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(50) NOT NULL
);

-- Insert admin records
INSERT INTO admin (username, password) VALUES
('Shashank', '123'),
('Rudra', '456'),
('Aditi', 'aditi12'),
('Saumya', 'saumya12');

-- Create account table
CREATE TABLE account (
    account_number INT AUTO_INCREMENT PRIMARY KEY, -- Primary key, auto-increment starting at 1000
    name VARCHAR(100) NOT NULL,                    -- Account holder's name
    father_name VARCHAR(200) NOT NULL,             -- Father's name
    gender ENUM('Male', 'Female', 'Other') NOT NULL, -- Gender with predefined options
    phone VARCHAR(15) NOT NULL,                    -- Phone number
    dob DATE NOT NULL,                             -- Date of birth
    occupation VARCHAR(50),                        -- Occupation
    pancard VARCHAR(10) UNIQUE,                    -- PAN card number (unique identifier)
    aadhar VARCHAR(12) NOT NULL,                   -- Aadhaar card number
    address TEXT,                                  -- Address
    marital_status ENUM('Single', 'Married', 'Divorced', 'Widowed'), -- Marital status
    username VARCHAR(100) NOT NULL,                -- Ye column ka name rakha tha (bank_username)  aur login file mai  call kr diya tha(username)!!!! Kyuu Bhaiiii.....🧐 yha ghar ka naam aur bahar ka naam wala concept nhi chlta 😂 (Dhang se kr le bhai😥)
    password VARCHAR(50) NOT NULL,            -- isko login.php mai password name se call krke yha bank_password save kr diya 🤦🏻‍♀️ Banking password
    email VARCHAR(100) NOT NULL,                   -- Email
    money DECIMAL(15, 2),                         -- (money_ kyu likha tha ?..... column call to money naam se ki h login.php mai) #sastenashe🥴😵
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp for when the record was created
) AUTO_INCREMENT=1000; -- Start auto-increment from 1000

-- Create daybook_table
CREATE TABLE daybook_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_number INT NOT NULL, -- Match the type of account.account_number
    transaction_type ENUM('credit', 'debit') NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_number) REFERENCES account(account_number)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);
