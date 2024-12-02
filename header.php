<?php
session_start();
include "db/db_conn.php"; // Ensure this includes your database connection

// Check if the user is logged in
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];

    // Query the database to retrieve the user's balance
    $sql = "SELECT balance FROM users WHERE userID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $balance);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
} else {
    // Default balance if the user is not logged in
    $balance = 0;
}
?>

<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="public/images/ticket-logo_9850-381.png" class="img-fluid" style="max-height: 40px" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="events.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php#how-it-works">How It Works</a>
                    </li>
                </ul>

                <div class="d-flex flex-column flex-lg-row text-center">
                    <p class="nav-item white-text m-2">My tickets</p>
                    <p class="nav-item white-text m-2">E<?php echo number_format($balance, 2); ?></p>
                    <p class="nav-item white-text m-2"><a href="scripts/logout.php">Logout</a></p>
                </div>
            </div>
        </div>
    </nav>
</header>