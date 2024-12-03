<?php
include_once 'db_conn.php';

$sql = "CREATE DATABASE IF NOT EXISTS ticketing_system";

// if (mysqli_query($conn, $sql)) {
//     echo "Database has either been created successfully or already exists";
// } else {
//     die("Error creating db" . mysqli_error($conn));
// }

$sql = "CREATE TABLE IF NOT EXISTS Users(
    userID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    balance DECIMAL(10, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// if (mysqli_query($conn, $sql)) {
//     echo "Table 'Users' created successfully.<br/>";
// } else {
//     echo "Error creating table 'Users' : " . mysqli_error($conn) . "<br/>";
// }
$sql = "CREATE TABLE IF NOT EXISTS Events (
    eventID INT AUTO_INCREMENT PRIMARY KEY,
    eventName VARCHAR(150) NOT NULL,
    description TEXT,
    ticketQty INT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) DEFAULT 'images/default_image.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// if (mysqli_query($conn, $sql)) {
//     echo "Table 'Events' created successfully.<br/>";
// } else {
//     echo "Error creating table 'Events' : " . mysqli_error($conn) . "<br/>";
// }

$sql = "CREATE TABLE IF NOT EXISTS Registrations(
    regID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    eventID INT NOT NULL,
    regDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES Users(userID),
    FOREIGN KEY (eventID) REFERENCES Events(eventID) ON DELETE CASCADE
)";

// if (mysqli_query($conn, $sql)) {
//     echo "Table 'Registrations' created successfully.<br/>";
// } else {
//     echo "Error creating table 'Registrations' : " . mysqli_error($conn) . "<br/>";
// }
