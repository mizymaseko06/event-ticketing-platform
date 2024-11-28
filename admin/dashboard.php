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
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Overview Section -->
        <div id="overview-section" class="section">
            <h3 class="mb-4">Overview</h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <h4>Total Events</h4>
                    <p id="total-events">0</p>
                </div>
                <div class="stat-card">
                    <h4>Total Users</h4>
                    <p id="total-users">0</p>
                </div>
                <div class="stat-card">
                    <h4>Total Tickets Sold</h4>
                    <p id="total-tickets-sold">0</p>
                </div>
                <div class="stat-card">
                    <h4>Revenue Summary</h4>
                    <p id="revenue-summary">$0</p>
                </div>
            </div>
        </div>

        <!-- Event Management Section -->
        <div id="event-management-section" class="section d-none">
            <h3 class="mb-4">Event Management</h3>
            <button class="btn btn-primary mb-3" onclick="addEvent()">Add Event</button>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Tickets Sold</th>
                            <th>Tickets Left</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="events-table">
                        <!-- Rows populated dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Show section based on tab click
        function showSection(section) {
            document.getElementById('overview-section').classList.add('d-none');
            document.getElementById('event-management-section').classList.add('d-none');
            if (section === 'overview') {
                document.getElementById('overview-section').classList.remove('d-none');
            } else if (section === 'event-management') {
                document.getElementById('event-management-section').classList.remove('d-none');
            }
        }

        // Add Event Functionality Placeholder
        function addEvent() {
            alert('Add event functionality goes here.');
        }

        // Example Dynamic Data Fetching (Simulated)
        window.onload = function() {
            // Simulate fetching statistics
            document.getElementById('total-events').innerText = 10;
            document.getElementById('total-users').innerText = 500;
            document.getElementById('total-tickets-sold').innerText = 1000;
            document.getElementById('revenue-summary').innerText = "$50,000";

            // Simulate fetching event data
            const events = [{
                    name: "Music Festival",
                    date: "2024-11-30",
                    location: "City Park",
                    sold: 200,
                    left: 50
                },
                {
                    name: "Tech Conference",
                    date: "2024-12-15",
                    location: "Tech Hub",
                    sold: 150,
                    left: 20
                },
            ];

            const eventsTable = document.getElementById('events-table');
            events.forEach(event => {
                const row = `<tr>
                    <td>${event.name}</td>
                    <td>${event.date}</td>
                    <td>${event.location}</td>
                    <td>${event.sold}</td>
                    <td>${event.left}</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>`;
                eventsTable.innerHTML += row;
            });
        }
    </script>
</body>

</html>