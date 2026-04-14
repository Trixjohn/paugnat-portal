<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAUGNAT Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="admin-dashboard">

<?php
require_once __DIR__ . '/../models/Database.php';
$conn = Database::getInstance()->getConnection();

$stats = [
    'colleges' => 0,
    'events' => 0,
    'messages' => 0,
    'top_college' => 'No data yet',
    'top_points' => 0
];

$conn->query("CREATE TABLE IF NOT EXISTS colleges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    points INT DEFAULT 0
)");

$conn->query("CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(100) NOT NULL,
    event_date DATE NOT NULL
)");

$conn->query("CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new','read') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$result = $conn->query("SELECT COUNT(*) AS count FROM colleges");
if ($result) {
    $stats['colleges'] = intval($result->fetch_assoc()['count']);
}

$result = $conn->query("SELECT COUNT(*) AS count FROM events");
if ($result) {
    $stats['events'] = intval($result->fetch_assoc()['count']);
}

$result = $conn->query("SELECT COUNT(*) AS count FROM messages");
if ($result) {
    $stats['messages'] = intval($result->fetch_assoc()['count']);
}

$result = $conn->query("SELECT name, points FROM colleges ORDER BY points DESC LIMIT 1");
if ($result && $result->num_rows === 1) {
    $top = $result->fetch_assoc();
    $stats['top_college'] = $top['name'];
    $stats['top_points'] = intval($top['points']);
}
?>

    <div class="container py-5 admin-dashboard-container">
        <div class="card card-custom dashboard-hero border-0 shadow-lg overflow-hidden mb-5">
            <div class="row g-0 align-items-center">
                <div class="col-lg-8 p-5">
                    <small class="text-uppercase text-warning fw-bold">Admin Dashboard</small>
                    <h1 class="display-5 fw-bold mb-3 text-ustp-gold">Welcome back, <?php echo htmlspecialchars($_SESSION["admin_username"]); ?></h1>
                    <p class="text-secondary mb-4 text-white">Manage  scores, events, and messages from one place with a modern admin interface.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="messages.php" class="btn btn-warning btn-modern">Review Messages</a>
                        <a href="logout.php" class="btn btn-outline-light btn-modern">Logout</a>
                    </div>
                </div>
                <div class="col-lg-4 dashboard-panel text-dark p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h3 class="fw-bold text-white">Top College</h3>
                            <p class="mb-0 text-white"><?php echo htmlspecialchars($stats['top_college']); ?></p>
                        </div>
                        <span class="badge bg-dark py-2 px-3 text-white"><?php echo intval($stats['top_points']); ?> pts</span>
                    </div>
                    <div class="d-flex gap-2 flex-column">
                        <div class="bg-white bg-opacity-10 rounded-4 p-3">
                            <p class="mb-1 text-uppercase small text-light opacity-75">Colleges</p>
                            <h4 class="mb-0 fw-bold text-white"><?php echo intval($stats['colleges']); ?></h4>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-4 p-3">
                            <p class="mb-1 text-uppercase small text-light opacity-75">Events</p>
                            <h4 class="mb-0 fw-bold text-white"><?php echo intval($stats['events']); ?></h4>
                        </div>
                        <div class="bg-white bg-opacity-10 rounded-4 p-3">
                            <p class="mb-1 text-uppercase small text-light opacity-75">Messages</p>
                            <h4 class="mb-0 fw-bold text-white"><?php echo intval($stats['messages']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-xl-6">
                <div class="card card-custom shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="fw-bold text-white">Update College Points</h3>
                            <p class="text-secondary mb-0 text-white">Select a college and update its score.</p>
                        </div>
                        <span class="badge bg-warning text-dark">Live</span>
                    </div>
                    <form id="pointsForm">
                        <div class="mb-3">
                            <label class="form-label text-white">College</label>
                            <select name="id" id="collegeId" class="form-select" required>
                                <option value="">Loading colleges...</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Points</label>
                            <input type="number" name="points" id="points" class="form-control" placeholder="Enter points to add or subtract" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Update Points</button>
                    </form>
                    <div id="pointsMessage" class="mt-3"></div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card card-custom shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h3 class="fw-bold text-white">Manage Events</h3>
                            <p class="text-secondary mb-0 text-white">Edit an existing event or create a new one.</p>
                        </div>
                        <span class="badge bg-dark text-white">Schedule</span>
                    </div>
                    <form id="eventForm">
                        <div class="mb-3">
                            <label class="form-label text-white">Select Event</label>
                            <select id="eventSelect" class="form-select">
                                <option value="">Create New Event</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Event Name</label>
                            <input type="text" name="event_name" id="eventName" class="form-control" placeholder="Enter event title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Event Date</label>
                            <input type="date" name="event_date" id="eventDate" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Save Event</button>
                    </form>
                    <div id="eventMessage" class="mt-3"></div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-lg-6">
                <div class="card card-custom shadow-sm p-4">
                    <h4 class="fw-bold mb-3 text-white">College Standings</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped text-white align-middle">
                            <thead>
                                <tr class="text-secondary small text-uppercase">
                                    <th>#</th>
                                    <th>College</th>
                                    <th>Points</th>
                                </tr>
                            </thead>
                            <tbody id="collegesTable"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card card-custom shadow-sm p-4">
                    <h4 class="fw-bold mb-3 text-white">Upcoming Events</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped text-white align-middle">
                            <thead>
                                <tr class="text-secondary small text-uppercase">
                                    <th>ID</th>
                                    <th>Event</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="eventsTable"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex flex-wrap gap-2">
            <a href="messages.php" class="btn btn-info text-dark btn-modern">Review Messages</a>
            <a href="../pages/events.php" class="btn btn-secondary btn-modern">View Public Events</a>
            <a href="../pages/leaderboards.php" class="btn btn-secondary btn-modern">View Public Leaderboards</a>
            <a href="../home.php" class="btn btn-outline-secondary btn-modern">Visit Public Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/admin.js"></script>
</body>
</html>
