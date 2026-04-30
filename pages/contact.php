<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact the PAUGNAT 2027 organizers — send us a message and we'll get back to you.">
    <title>Contact - PAUGNAT 2027</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css?v=1.1">
</head>
<body>

    <nav class="navbar navbar-expand-md fixed-top fw-bold navbar-custom shadow-sm">
        <div class="container py-1">
            <a href="../home.php" class="navbar-brand text-dark hover-glow fs-4">PAUGNAT</a>
            <button class="navbar-toggler border-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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

    <div class="container mt-5 pt-5 pb-5 min-vh-100 d-flex flex-column justify-content-center">

        <h1 class="text-center fw-bold mb-5 mt-4 text-ustp-gold" style="letter-spacing: 2px;">GET IN TOUCH</h1>

        <div class="row g-4 justify-content-center w-100 mx-auto" style="max-width: 900px;">

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card glass-card text-white p-2 h-100">
                    <div class="card-body p-4">
                        <h2 class="fw-bold mb-1 fs-4">Send a Message</h2>
                        <p class="text-light opacity-75 mb-4">Have questions or feedback? We'd love to hear from you!</p>

                        <form id="contactForm" novalidate>
                            <div class="mb-3">
                                <label for="contactName" class="form-label fw-bold text-light">Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="contactName"
                                    class="form-control bg-dark bg-opacity-50 text-white border-secondary"
                                    placeholder="Enter your full name"
                                    required
                                    minlength="2"
                                >
                                <div class="invalid-feedback">Please enter your name (at least 2 characters).</div>
                            </div>

                            <div class="mb-3">
                                <label for="contactEmail" class="form-label fw-bold text-light">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="contactEmail"
                                    class="form-control bg-dark bg-opacity-50 text-white border-secondary"
                                    placeholder="Enter your email address"
                                    required
                                >
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>

                            <div class="mb-4">
                                <label for="contactMessage" class="form-label fw-bold text-light">Message</label>
                                <textarea
                                    name="message"
                                    id="contactMessage"
                                    class="form-control bg-dark bg-opacity-50 text-white border-secondary"
                                    rows="4"
                                    placeholder="Enter your message..."
                                    required
                                    minlength="10"
                                ></textarea>
                                <div class="invalid-feedback">Please enter a message (at least 10 characters).</div>
                            </div>

                            <button type="submit" id="contactSubmitBtn" class="btn btn-warning w-100 btn-modern fw-bold py-2 text-dark">
                                Send Message
                            </button>
                        </form>

                        <div id="contactFormMessage" class="mt-3"></div>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-5">
                <div class="card glass-card text-white p-2 h-100">
                    <div class="card-body p-4">
                        <h2 class="fw-bold mb-4 fs-4">Contact Information</h2>
                        <p class="text-light opacity-75 mb-4">You can reach us through any of the following:</p>

                        <ul class="list-unstyled d-flex flex-column gap-4">
                            <li class="d-flex align-items-start gap-3">
                                <span class="fs-3 mt-1">📧</span>
                                <div>
                                    <p class="fw-bold mb-1 text-ustp-gold">Email</p>
                                    <p class="text-light opacity-75 mb-0">trixjohn1234@gmail.com</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <span class="fs-3 mt-1">📞</span>
                                <div>
                                    <p class="fw-bold mb-1 text-ustp-gold">Phone</p>
                                    <p class="text-light opacity-75 mb-0">+63 951 422 7164</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <span class="fs-3 mt-1">📍</span>
                                <div>
                                    <p class="fw-bold mb-1 text-ustp-gold">Address</p>
                                    <p class="text-light opacity-75 mb-0" style="line-height: 1.7;">
                                        Major Campus (Cagayan de Oro): Located at C.M. Recto Avenue, Lapasan, Cagayan de Oro City.
                                    </p>
                                </div>
                            </li>
                        </ul>
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
    <script src="../js/contact.js?v=1.1"></script>
</body>
</html>