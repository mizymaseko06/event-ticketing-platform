<?php
session_start();

if (!isset($_SESSION['userID'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

include_once "db/db_conn.php";

$sql = "SELECT eventID, eventName, date, time, location, price, image FROM events ORDER BY date ASC LIMIT 6";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <?php include "header.php"; ?>
    <main>
        <section id="hero">
            <div class="container" style="padding-top: 200px;">
                <div class="row">
                    <div class="col-10 col-md-10 col-lg-5">
                        <h1 class="fw-bolder" style="color: white;">DISCOVER EVENTS. BUY TICKETS. ENJOY THE EXPERIENCE!</h1>
                        <p class="lead" style="color: white;">Join the excitement! Browse upcoming events and reserve your spot today.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="featured">
            <div class="container">
                <h2 class="section-heading text-center">
                    Featured Events
                </h2>
                <div class="row justify-content-center">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="card col-10 col-md-5 col-lg-3 m-1 event-card">
                            <a href="event.php?id=<?php echo $row['eventID'] ?>" class="event-link">

                                <img src="<?php echo $row['image'] ?>" class="card-img-top">
                                <div class="card-body index-card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title fw-bolder"><?php echo htmlspecialchars($row['eventName']) ?></h5>
                                    <div class="details d-flex align-items-end justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div><i class="bi bi-calendar-event me-1"></i><span class="date" style="font-size: small;"><?php echo date("D, d M Y, H:i", strtotime($row['date'])); ?></span></div>
                                            <div><i class="bi bi-geo me-1"></i><span class="location" style="font-size: small;"><?php echo htmlspecialchars($row['location']); ?></span></div>
                                        </div>
                                        <span class="price fw-bold fs-5" style="color: orange">E<?php echo number_format($row['price'], 2); ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>

        </section>

        <section id="how-it-works">
            <div class="container">
                <h2 class="section-heading text-center">
                    How It Works
                </h2>

                <div class="row d-flex justify-content-center">

                    <div class="d-flex flex-row align-items-center col-7 mb-3">
                        <div class="image w-25">
                            <img src="public/images/rb_3598.png" class="img-fluid" alt="">
                        </div>
                        <div>
                            <h3>Find events</h3>
                            <p>Browse a variety of events tailored to your interests and location.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center col-7 mb-5">
                        <div class="image w-25">
                            <img src="public/images/rb_96.png" class="img-fluid" alt="">
                        </div>
                        <div>
                            <h3>Purchase tickets</h3>
                            <p>Reserve your spot by purchasing tickets with just a few clicks.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center col-7 mb-5">
                        <div class="image w-25">
                            <img src="public/images/rb_1749.png" class="img-fluid" alt="">
                        </div>
                        <div>
                            <h3>Get ready to go!</h3>
                            <p>Receive confirmation and all the info you need to make most of your event.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="myTicketsModal" tabindex="-1" aria-labelledby="myTicketsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myTicketsModalLabel">My Tickets</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    include_once "db/db_conn.php";

                    $userID = $_SESSION['userID']; // Retrieve the logged-in user ID
                    $query = "SELECT r.regID, e.eventName, e.date, e.time, e.location 
                          FROM Registrations r
                          INNER JOIN Events e ON r.eventID = e.eventID
                          WHERE r.userID = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo '<ul class="list-group">';
                        while ($row = $result->fetch_assoc()) {
                            echo '<li class="list-group-item">';
                            echo '<strong>Registration ID:</strong> ' . htmlspecialchars($row['regID']) . '<br>';
                            echo '<strong>Event Name:</strong> ' . htmlspecialchars($row['eventName']) . '<br>';
                            echo '<strong>Date:</strong> ' . htmlspecialchars($row['date']) . '<br>';
                            echo '<strong>Time:</strong> ' . htmlspecialchars($row['time']) . '<br>';
                            echo '<strong>Location:</strong> ' . htmlspecialchars($row['location']);
                            echo '</li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<p>No tickets found.</p>';
                    }

                    $stmt->close();
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>