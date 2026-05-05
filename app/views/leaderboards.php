<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboards - PAUGNAT 2027</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css?v=1.0">
    <style>
        /* Make list group items glass-like */
        #leaderboard .list-group-item {
            background: rgba(15, 23, 42, 0.4);
            border-color: rgba(255, 255, 255, 0.1);
            color: white;
            backdrop-filter: blur(8px);
            margin-bottom: 8px;
            border-radius: 0.75rem !important;
            border-width: 1px;
            transition: transform 0.2s ease, background 0.3s ease;
        }
        #leaderboard .list-group-item:hover {
            transform: scale(1.02);
            background: rgba(15, 23, 42, 0.8);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-md fixed-top fw-bold navbar-custom shadow-sm">
        <div class="container py-1">
            <a href="../index.php" class="navbar-brand text-dark hover-glow fs-4">PAUGNAT</a>
            <button class="navbar-toggler border-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <div class="navbar-nav gap-3 align-items-center mt-3 mt-md-0">
                    <a href="../index.php" class="nav-link text-dark hover-glow">Home</a>
                    <a href="about.php" class="nav-link text-dark hover-glow">About</a>
                    <a href="events.php" class="nav-link text-dark hover-glow">Events</a>
                    <a href="leaderboards.php" class="nav-link text-dark hover-glow">Leaderboards</a>
                    <a href="contact.php" class="nav-link text-dark hover-glow">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center mb-5">

        <h2 class="text-center mb-5 fw-bold text-ustp-gold mt-5 pt-5" style="letter-spacing: 2px;">TOP COLLEGES</h2>

        <div class="w-100" style="max-width: 600px;">
            <ul class="list-group list-group-flush shadow-lg" id="leaderboard"></ul>
            <div id="leaderboardMessage" class="text-center text-light opacity-75 mt-3"></div>
        </div>

        <div class="mt-5 pt-4 w-100 pb-5" style="max-width: 700px;">
            <div class="card glass-card border-warning border-opacity-25 rounded-5 mt-3">
                <div class="card-body text-center p-4 p-md-5">
                    <h4 class="card-title fw-bold mb-4 text-ustp-gold fs-3">
                        Keep the Momentum Going!
                    </h4>
                    <p class="card-text mb-0 text-light opacity-75 fw-medium fs-5" style="line-height: 1.7;">
                        Congratulations to all the colleges for their outstanding performances!
                        Let's keep the spirit alive and continue to support each other as we aim
                        for even greater heights. Together, we make 
                        <strong class="text-white fw-bold glow-hover">PAUGNAT 2027</strong> an unforgettable experience!
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/leaderboards.js?v=2"></script>
</body>
</html>