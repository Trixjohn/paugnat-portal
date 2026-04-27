<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - PAUGNAT 2027</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-md fixed-top fw-bold navbar-custom shadow-sm">
        <div class="container py-1">
            <a href="../home.php" class="navbar-brand text-dark hover-glow fs-4">PAUGNAT</a>
            <button class="navbar-toggler border-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <div class="navbar-nav gap-3 align-items-center mt-3 mt-md-0">
                    <a href="../home.php" class="nav-link text-dark hover-glow">Home</a>
                    <a href="about.php" class="nav-link text-dark hover-glow">About</a>
                    <a href="events.php" class="nav-link text-dark hover-glow">Events</a>
                    <a href="leaderboards.php" class="nav-link text-dark hover-glow">Leaderboards</a>
                    <a href="contact.php" class="nav-link text-dark hover-glow">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 justify-content-center pt-5">
        <div class="row">
            <div class="col-md-6">
                <h3 class="fw-bold">Get in Touch</h3>
                <p class="text-light">Have questions or feedback? We'd love to hear from you!</p>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Enter your message" required></textarea>
                    </div>
                    <button type="submit" class="btn bg-warning text-dark fw-bold">Send Message</button>
                </form>
            </div>
            <div class="col-md-6">
                <h3 class="fw-bold">Contact Information</h3>
                <p class="text-light">You can reach us at any of the following:</p>
                <ul class="list-unstyled ">
                    <li><i class="fas fa-envelope"></i> trixjohn1234@gmail.com</li>
                    <li><i class="fas fa-phone"></i> +63 9123 456 7890</li>
                    <li><i class="fas fa-map-marker-alt mt-3"></i> The University of Science and Technology of Southern Philippines (USTP) Main Campus is located in Barangay Lourdes, Alubijid, Misamis Oriental. Key campuses include the Cagayan de Oro campus on C.M. Recto Avenue, and locations in Jasaan and Claveria</li>
                </ul>
            </div>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/contact.js"></script>
</body>
</html>