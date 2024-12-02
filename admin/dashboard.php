<?php
session_start();

if (!isset($_SESSION['userID'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    exit();
}

include_once "../db/db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin-style.css">
    <style>

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler hamburger-menu" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="overview-tab" onclick="showSection('overview')">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="event-management-tab" onclick="showSection('event-management')">Event Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="top-up-tab" onclick="showSection('top-up')">Top Up User Balance</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../scripts/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <?php
        // Query to get total events
        $eventsQuery = "SELECT COUNT(*) AS total_events FROM Events";
        $stmt = $conn->prepare($eventsQuery);
        $stmt->execute();
        $stmt->bind_result($totalEvents);
        $stmt->fetch();
        $stmt->close();

        // Query to get total users
        $usersQuery = "SELECT COUNT(*) AS total_users FROM Users";
        $stmt = $conn->prepare($usersQuery);
        $stmt->execute();
        $stmt->bind_result($totalUsers);
        $stmt->fetch();
        $stmt->close();

        // Query to get total tickets sold
        $ticketsQuery = "SELECT COUNT(*) AS total_tickets_sold FROM Registrations";
        $stmt = $conn->prepare($ticketsQuery);
        $stmt->execute();
        $stmt->bind_result($totalTicketsSold);
        $stmt->fetch();
        $stmt->close();
        ?>


        <div id="overview-section" class="section">
            <h3 class="mb-4">Overview</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <h4>Total Events</h4>
                    <p id="total-events"><?php echo $totalEvents ?></p>
                </div>
                <div class="stat-card">
                    <h4>Total Users</h4>
                    <p id="total-users"><?php echo $totalUsers ?></p>
                </div>
                <div class="stat-card">
                    <h4>Total Tickets Sold</h4>
                    <p id="total-tickets-sold"><?php echo $totalTicketsSold ?></p>
                </div>
            </div>
        </div>

        <!-- Event Management Section -->
        <div id="event-management-section" class="section d-none">
            <h3 class="mb-4">Event Management</h3>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEventModal">Add Event</button>

            <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEventModalLabel">Add New Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="eventForm" method="POST" enctype="multipart/form-data" action="../scripts/add-event.php">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="eventImage" class="form-label">Event Image</label>
                                    <input type="file" class="form-control" id="eventImage" name="eventImage" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="eventName" class="form-label">Event Name</label>
                                    <input type="text" class="form-control" id="eventName" name="eventName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="eventDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="eventDescription" name="eventDescription" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="eventDate" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="eventDate" name="eventDate" required>
                                </div>
                                <div class="mb-3">
                                    <label for="eventTime" class="form-label">Time</label>
                                    <input type="time" class="form-control" id="eventTime" name="eventTime" required>
                                </div>
                                <div class="mb-3">
                                    <label for="eventLocation" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="eventLocation" name="eventLocation" required>
                                </div>
                                <div class="mb-3">
                                    <label for="eventPrice" class="form-label">Ticket Price</label>
                                    <input type="number" class="form-control" id="eventPrice" name="eventPrice" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ticketQty" class="form-label">Ticket Quantity</label>
                                    <input type="number" class="form-control" id="ticketQty" name="ticketQty" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Event</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Tickets Qty</th>
                            <th>Tickets Sold</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="events-table">
                        <?php
                        $sql = "SELECT eventID, eventName, date, location, ticketQty FROM Events";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                        ?> <tr>
                                    <td><?php echo htmlspecialchars($row['eventName']) ?></td>
                                    <td><?php echo htmlspecialchars($row['date']) ?></td>
                                    <td><?php echo htmlspecialchars($row['location']) ?></td>
                                    <td><?php echo htmlspecialchars($row['ticketQty']) ?></td>
                                    <td>0</td>

                                    <td>
                                        <form method='POST' action='../scripts/delete-event.php' style='display:inline;'>
                                            <input type='hidden' name='eventID' value='<?php echo htmlspecialchars($row['eventID']);  ?>'>
                                            <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6" class="text-center" style="font-size: 50px;">No events found</td>
                            </tr>


                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Up User Balance Section -->
        <div id="top-up-section" class="section d-none">
            <h3 class="mb-4">Top Up User Balance</h3>
            <form method="POST" action="../scripts/top-up-balance.php">
                <div class="mb-3">
                    <label for="email" class="form-label">User Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount to Add</label>
                    <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary">Top Up Balance</button>
            </form>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Show section based on tab click
        function showSection(section) {
            document.getElementById('overview-section').classList.add('d-none');
            document.getElementById('event-management-section').classList.add('d-none');
            document.getElementById('top-up-section').classList.add('d-none');
            if (section === 'overview') {
                document.getElementById('overview-section').classList.remove('d-none');
            } else if (section === 'event-management') {
                document.getElementById('event-management-section').classList.remove('d-none');
            } else if (section === 'top-up') {
                document.getElementById('top-up-section').classList.remove('d-none');
            }
        }
    </script>

</body>

</html>