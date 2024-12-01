<?php
include_once "../db/db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eventID'])) {
    $eventID = intval($_POST['eventID']);

    $sql = "DELETE FROM Events WHERE eventID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eventID);

    if ($stmt->execute()) {
        echo "<script>alert('Event deleted successfully!'); window.location.href = '../admin/dashboard.php';</script>";
    } else {
        echo "<script>alert('Failed to delete event. Please try again.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
