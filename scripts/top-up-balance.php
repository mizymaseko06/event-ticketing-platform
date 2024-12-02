<?php
session_start();
include_once "../db/db_conn.php";

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $amount = $_POST['amount'];

    // Check if email and amount are valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && is_numeric($amount) && $amount > 0) {
        // Fetch the current balance of the user
        $stmt = $conn->prepare("SELECT balance FROM Users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($currentBalance);
        $stmt->fetch();
        $stmt->close();

        if ($currentBalance !== null) {
            // Update the balance by adding the top-up amount
            $newBalance = $currentBalance + $amount;
            $updateStmt = $conn->prepare("UPDATE Users SET balance = ? WHERE email = ?");
            $updateStmt->bind_param("ds", $newBalance, $email);
            $updateStmt->execute();
            $updateStmt->close();

            // Redirect back to the admin dashboard with success message
            header("Location: ../admin/dashboard.php?success=Balance updated successfully!");
            exit();
        } else {
            // Redirect back if email doesn't exist
            header("Location: ../admin/dashboard.php?error=User not found!");
            exit();
        }
    } else {
        // Redirect back if invalid input
        header("Location: ../admin/dashboard.php?error=Invalid input!");
        exit();
    }
}
