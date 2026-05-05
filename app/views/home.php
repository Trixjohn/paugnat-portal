<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAUGNAT 2027 - University of Science and Technology of Southern Philippines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?v=1.0">
</head>
<body>

    <nav class="navbar navbar-expand-md fixed-top fw-bold navbar-custom shadow-sm">
        <div class="container py-1">
            <a href="index.php" class="navbar-brand text-dark fs-4">PAUGNAT</a>
            <button class="navbar-toggler border-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <div class="navbar-nav gap-3 align-items-center mt-3 mt-md-0">
                    <a href="index.php" class="nav-link text-dark hover-glow">Home</a>
                    <a href="pages/about.php" class="nav-link text-dark hover-glow">About</a>
                    <a href="pages/events.php" class="nav-link text-dark hover-glow">Events</a>
                    <a href="pages/leaderboards.php" class="nav-link text-dark hover-glow">Leaderboards</a>
                    <a href="pages/contact.php" class="nav-link text-dark hover-glow">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center mt-3">
        <div class="text-center mb-5 pt-5 mt-5">
            <h1 class="display-1 fw-bold text-ustp-gold mb-3 hover-glow" style="letter-spacing: -2px;">PAUGNAT</h1>
            <h2 class="h3 fw-light text-light mb-4" style="letter-spacing: 4px;">2 0 2 7</h2>
            <p class="lead text-light opacity-75 mb-5 mx-auto" style="max-width: 650px; line-height: 1.8;">
                The University of Science and Technology of Southern Philippines Annual Games and Tournament
            </p>
        </div>

        <div class="row g-4 w-100" style="max-width: 900px;">
            <div class="col-md-6">
                <div class="card glass-card text-white h-100 p-2">
                    <div class="card-body text-center p-4">
                        <div class="display-4 mb-3 text-ustp-gold">🏆</div>
                        <h3 class="card-title fw-bold mb-3">Championship Events</h3>
                        <p class="card-text text-light opacity-75 mb-4">
                            Discover all the exciting, high-stakes events happening this year.
                        </p>
                        <a href="pages/events.php" class="btn btn-warning fw-bold btn-modern px-4 py-2 mt-auto">Discover Events</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card glass-card text-white h-100 p-2">
                    <div class="card-body text-center p-4">
                        <div class="display-4 mb-3 text-ustp-gold">📊</div>
                        <h3 class="card-title fw-bold mb-3">Live Leaderboards</h3>
                        <p class="card-text text-light opacity-75 mb-4">
                            Check out the real-time standings and current college rankings.
                        </p>
                        <a href="pages/leaderboards.php" class="btn btn-warning fw-bold btn-modern px-4 py-2 mt-auto">View Rankings</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 w-100 mb-5" style="max-width: 800px;">
            <div class="card glass-card border-warning border-opacity-25 rounded-5 mt-4">
                <div class="card-body text-center p-4 p-md-5">
                    <h4 class="card-title fw-bold mb-3 text-ustp-gold fs-2">
                        Welcome Trailblazers!
                    </h4>
                    <p class="card-text text-light opacity-75 mb-5 fs-5" style="line-height: 1.7;">
                        Get ready for the most thrilling and competitive PAUGNAT yet!
                        Join thousands of students in celebrating sportsmanship, teamwork, and excellence
                        across multiple electrifying events.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="pages/about.php" class="btn btn-warning fw-bold btn-modern px-5 py-2 text-dark">Learn More</a>
                        <a href="pages/contact.php" class="btn btn-outline-light fw-bold btn-modern px-4 py-2">Get in Touch</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-black bg-opacity-75 text-light py-4 mt-auto border-top border-dark">
        <div class="container text-center">
            <p class="mt-2 mb-0 small opacity-50">&copy; 2027 PAUGNAT | USTP</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>