<?php
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your MySQL password if any

// Connect to the MySQL server (no database specified yet)
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS ticketing_system";
if ($conn->query($sql) === FALSE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db("ticketing_system");

// Reuse $conn for further operations
