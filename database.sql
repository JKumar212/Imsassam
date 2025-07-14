-- Create database if not exists
CREATE DATABASE IF NOT EXISTS ims_db;
USE ims_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  phone VARCHAR(10) UNIQUE,
  email VARCHAR(100),
  password VARCHAR(255),
  subscription_expiry DATE
);

-- Stock table (per user)
CREATE TABLE IF NOT EXISTS stock (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  item_name VARCHAR(100),
  quantity INT,
  price DECIMAL(10,2)
);

-- Invoices table
CREATE TABLE IF NOT EXISTS invoices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  customer_name VARCHAR(100),
  items TEXT,
  total_amount DECIMAL(10,2),
  invoice_date DATE
);

-- Demo user
INSERT INTO users (name, phone, email, password, subscription_expiry)
VALUES ('Demo User', '9876543210', 'demo@gmail.com', 'demo123', CURDATE() + INTERVAL 30 DAY);
