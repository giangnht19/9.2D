
-- Create the database
CREATE DATABASE IF NOT EXISTS hotel_db;

-- Use the database
USE hotel_db;

-- Create the reservations table
CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guest_name VARCHAR(100) NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    payment_status ENUM('Paid', 'Pending') NOT NULL
);
