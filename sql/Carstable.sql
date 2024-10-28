CREATE TABLE Cars (
    car_id INT AUTO_INCREMENT PRIMARY KEY,
    car_model VARCHAR(100) NOT NULL,
    rental_price DECIMAL(10, 2) NOT NULL
);

CREATE TABLE Customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT,
    customer_name VARCHAR(100) NOT NULL,
    contact_info VARCHAR(100) NOT NULL,
    rental_months INT NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES Cars(car_id) ON DELETE CASCADE
);

CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    address VARCHAR(100),
    age INT,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE Customers ADD COLUMN added_by INT, ADD COLUMN last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

ALTER TABLE Users ADD COLUMN email VARCHAR(255) NOT NULL UNIQUE;

DESCRIBE Users;


