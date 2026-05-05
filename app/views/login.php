<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAUGNAT - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css?v=1.0">
</head>
<body>

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 align-items-center" style="max-width: 900px;">

            <div class="col-md-6 mb-5 mb-md-0 text-center text-md-start pe-md-5">
                <h1 class="display-3 fw-bold text-ustp-gold hover-glow" style="letter-spacing: -2px;">PAUGNAT</h1>
                <h2 class="h4 text-light opacity-75 mb-4 fw-light" style="letter-spacing: 2px;">SECURE PORTAL</h2>
                <p class="lead text-light opacity-75 fs-5 pb-3">Welcome back. Access your admin tools to manage events, leaderboards, and update live scores.</p>
                <div class="d-none d-md-block" style="width: 50px; height: 3px; background: var(--ustp-gold); opacity: 0.5;"></div>
            </div>

            <div class="col-md-6">
                <div class="card glass-card p-4 p-md-5">
                    <h3 class="fw-bold mb-4 text-center text-white">Login</h3>

                    <?php if (isset($error) && $error): ?>
                        <div class="alert alert-danger border-danger border-opacity-25 bg-danger bg-opacity-10 text-white rounded-3"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-4">
                            <input type="text" name="username" class="form-control bg-dark bg-opacity-50 text-white border-secondary py-3 px-4 rounded-pill" placeholder="Username" required>
                        </div>

                        <div class="mb-4">
                            <input type="password" name="password" class="form-control bg-dark bg-opacity-50 text-white border-secondary py-3 px-4 rounded-pill" placeholder="Password" required>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 fw-bold btn-modern py-3 mt-2 text-dark fs-5">Log In</button>
                    </form>

                    <div class="d-flex align-items-center my-4">
                        <hr class="flex-grow-1 border-secondary">
                        <span class="mx-3 text-secondary small text-uppercase">or</span>
                        <hr class="flex-grow-1 border-secondary">
                    </div>

                    <a href="../index.php" class="btn btn-outline-light w-100 btn-modern py-2 fw-bold text-uppercase small">Return to Home</a>
                </div>
            </div>

        </div>
    </div>

</body>
</html>