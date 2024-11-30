<?php
include_once '../db/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $surname = mysqli_real_escape_string($conn, trim($_POST['surname']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = trim($_POST['password']);
    
    $checkEmail = "SELECT email FROM Users WHERE email = ?";
    $stmt = $conn->prepare($checkEmail);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        die("Email already registered. Please use a different email.");
    }
    $stmt->close();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $insertUser = "INSERT INTO Users (name, surname, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertUser);
    $stmt->bind_param("ssss", $name, $surname, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>alert('Sign Up Successful')</script>";
        header('Location: ../login.php');

    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
