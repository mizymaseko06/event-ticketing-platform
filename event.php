<?php
session_start();

if (!isset($_SESSION['userID'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

include "db/db_conn.php";

// Get the user ID from session
$userID = $_SESSION['userID'];

// Check if event ID is passed in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $eventID = $_GET['id'];

    // Prepare SQL to fetch the event details
    $stmt = $conn->prepare("SELECT eventName, description, date, time, location, price, image FROM events WHERE eventID = ?");
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the event exists
    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        // Redirect to a 404 or error page if event not found
        header("Location: 404.php");
        exit();
    }
} else {
    // Redirect to a 404 or error page if no valid ID is provided
    header("Location: 404.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qty'])) {
    $qty = (int)$_POST['qty'];
    $totalPrice = $event['price'] * $qty;

    // Fetch user's balance from database
    $balanceStmt = $conn->prepare("SELECT balance FROM users WHERE userID = ?");
    $balanceStmt->bind_param("i", $userID);
    $balanceStmt->execute();
    $balanceResult = $balanceStmt->get_result();
    $userBalance = $balanceResult->fetch_assoc()['balance'];

    if ($userBalance >= $totalPrice) {
        // Proceed with the purchase
        for ($i = 0; $i < $qty; $i++) {
            $registerStmt = $conn->prepare("INSERT INTO registrations (userID, eventID) VALUES (?, ?)");
            $registerStmt->bind_param("ii", $userID, $eventID);
            $registerStmt->execute();
        }

        // Deduct the balance
        $newBalance = $userBalance - $totalPrice;
        $updateBalanceStmt = $conn->prepare("UPDATE users SET balance = ? WHERE userID = ?");
        $updateBalanceStmt->bind_param("di", $newBalance, $userID);
        $updateBalanceStmt->execute();

        // Redirect to a success page or show an alert
        echo "<script>alert('Purchase successful!');</script>";
        exit();
    } else {
        // Not enough balance, show an error
        echo "<script>alert('Insufficient balance. Please top-up your account.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Purchase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include "header.php"; ?>
    <main>
        <div class="container-fluid p-0" style="margin-top: 60px;">
            <img src="<?php echo htmlspecialchars($event['image']); ?>" class="img-fluid w-100" style="object-fit: cover; height: 50vh;" alt="">
        </div>
        <div class="container-sm detailed-event">
            <div class="row my-3">
                <h5 class="fw-bolder"><?php echo htmlspecialchars($event['eventName']); ?></h5>
                <div class="d-flex flex-column justify-content-between mt-3">
                    <div class="details d-flex align-items-end justify-content-between">
                        <div class="d-flex flex-column">
                            <div><i class="bi bi-calendar-event me-1"></i><span class="date" style="font-size: small;"><?php echo date("D, d M Y, H:i", strtotime($event['date'] . ' ' . $event['time'])); ?></span></div>
                            <div><i class="bi bi-geo me-1"></i><span class="location" style="font-size: small;"><?php echo htmlspecialchars($event['location']); ?></span></div>
                        </div>
                        <span class="price fw-bold fs-5" style="color: orange">E<?php echo number_format($event['price'], 2); ?></span>
                    </div>
                </div>
                <div class="description mt-3">
                    <h5>Description</h5>
                    <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
                </div>

                <!-- Ticket Quantity and Purchase Form -->
                <form action="event.php?id=<?php echo $eventID; ?>" method="POST">
                    <div class="quantities d-flex flex-column align-items-center">
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-secondary" id="decreaseQty">-</button>
                            <input type="number" id="ticketQty" name="qty" value="1" min="1" class="mx-2" style="width: 50px;">
                            <button type="button" class="btn btn-secondary" id="increaseQty">+</button>
                        </div>
                        <button type="submit" class="btn btn-primary mt-1" style="width: 100px">Buy</button>
                    </div>
                </form>

            </div>
        </div>

        <section id="similar-events">
            <div class="container">
                <h2 class="section-heading text-center">
                    Similar Events
                </h2>
                <div class="row justify-content-center">
                    <div class="row justify-content-center">
                        <?php
                        $similarSql = "SELECT eventID, eventName, date, time, location, price, image FROM events WHERE eventID != ? ORDER BY RAND() LIMIT 6";
                        $similarStmt = $conn->prepare($similarSql);
                        $similarStmt->bind_param("i", $eventID);
                        $similarStmt->execute();
                        $similarResult = $similarStmt->get_result();

                        while ($similar = $similarResult->fetch_assoc()) {
                        ?>
                            <div class="card col-10 col-md-5 col-lg-3 m-1">
                                <a href="event.php?id=<?php echo $similar['eventID']; ?>" class="event-link">
                                    <img src="<?php echo htmlspecialchars($similar['image']); ?>" class="card-img-top">
                                    <div class="card-body index-card-body d-flex flex-column justify-content-between">
                                        <h5 class="card-title fw-bolder"><?php echo htmlspecialchars($similar['eventName']); ?></h5>
                                        <div class="details d-flex align-items-end justify-content-between">
                                            <div class="d-flex flex-column">
                                                <div><i class="bi bi-calendar-event me-1"></i><span class="date" style="font-size: small;"><?php echo date("D, d M Y, H:i", strtotime($similar['date'] . ' ' . $similar['time'])); ?></span></div>
                                                <div><i class="bi bi-geo me-1"></i><span class="location" style="font-size: small;"><?php echo htmlspecialchars($similar['location']); ?></span></div>
                                            </div>
                                            <span class="price fw-bold fs-5" style="color: orange">E<?php echo number_format($similar['price'], 2); ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEu"></script>
    <script>
        // JavaScript to handle quantity changes
        document.getElementById('decreaseQty').addEventListener('click', function() {
            let qtyInput = document.getElementById('ticketQty');
            let currentQty = parseInt(qtyInput.value);
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
            }
        });

        document.getElementById('increaseQty').addEventListener('click', function() {
            let qtyInput = document.getElementById('ticketQty');
            let currentQty = parseInt(qtyInput.value);
            qtyInput.value = currentQty + 1;
        });
    </script>
</body>

</html>
