<?php
include_once "../db/db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventName = mysqli_real_escape_string($conn, $_POST['eventName']);
    $eventDescription = mysqli_real_escape_string($conn, $_POST['eventDescription']);
    $eventDate = mysqli_real_escape_string($conn, $_POST['eventDate']);
    $eventTime = mysqli_real_escape_string($conn, $_POST['eventTime']);
    $eventLocation = mysqli_real_escape_string($conn, $_POST['eventLocation']);
    $eventPrice = mysqli_real_escape_string($conn, $_POST['eventPrice']);

    // Handle optional file upload
    $imagePath = 'images/default_image.jpg'; // Default image
    if (isset($_FILES['eventImage']) && $_FILES['eventImage']['error'] === UPLOAD_ERR_OK) {
        $imageDir = 'uploads/';
        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0777, true); // Create directory if it doesn't exist
        }
        $imageName = time() . '_' . basename($_FILES['eventImage']['name']);
        $imagePath = $imageDir . $imageName;

        if (!move_uploaded_file($_FILES['eventImage']['tmp_name'], $imagePath)) {
            $imagePath = 'images/default_image.jpg'; // Fallback to default if upload fails
        }
    }

    // Insert data into Events table
    $sql = "INSERT INTO Events (eventName, description, date, time, location, price, image, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $eventName, $eventDescription, $eventDate, $eventTime, $eventLocation, $eventPrice, $imagePath);

    if ($stmt->execute()) {
        echo "<script>alert('Event added successfully!'); window.location.href = '../admin/dashboard.php';</script>";
    } else {
        echo "<script>alert('Failed to add event. Please try again.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
