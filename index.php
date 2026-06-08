<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#0b3d2e">
    <title>Sign In · EJN Rubber System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="assets/img/icon.png" type="image/png">
</head>

<body>
<?php
require_once __DIR__ . '/function/db.config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$con = ejn_create_connection(false);
if ($con) {
    include 'function/auto_login.php';
    mysqli_close($con);
}
?>

    <div class="login-page">
        <aside class="login-hero" aria-hidden="true">
            <div class="light light-1"></div>
            <div class="light light-2"></div>
            <div class="light light-3"></div>
            <div class="hero-overlay"></div>

            <div class="hero-content">
                <img src="assets/img/icon.png" alt="" class="hero-logo">
                <h1 class="hero-title">EJN Rubber System</h1>
                <p class="hero-tagline">Integrated operations for rubber, copra, and coffee — from field to export.</p>

                <ul class="hero-features">
                    <li><i class="fas fa-seedling"></i> Plantation &amp; processing</li>
                    <li><i class="fas fa-truck"></i> Purchasing &amp; inventory</li>
                    <li><i class="fas fa-ship"></i> Sales &amp; shipment</li>
                </ul>
            </div>
        </aside>

        <main class="login-main">
            <div class="login-card">
                <div class="brand-mobile">
                    <img src="assets/img/icon.png" alt="EJN" class="brand-icon">
                    <div>
                        <h2>EJN Rubber System</h2>
                        <p>Secure employee access</p>
                    </div>
                </div>

                <header class="form-header">
                    <h2>Welcome back</h2>
                    <p>Sign in with your assigned credentials</p>
                </header>

                <form method="POST" action="function/login.php" class="login-form" autocomplete="on">
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon" aria-hidden="true"></i>
                            <input class="form-input" type="text" id="username" name="username"
                                placeholder="Enter your username" autocomplete="username" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon" aria-hidden="true"></i>
                            <input class="form-input" type="password" id="password" name="password"
                                placeholder="Enter your password" autocomplete="current-password" required>
                            <button type="button" class="toggle-password" aria-label="Show password"
                                data-target="password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <span>Sign In</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>

                <footer class="login-footer">
                    &copy; <?php echo date('Y'); ?> AetherIO IT Solutions
                </footer>
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var input = document.getElementById(btn.dataset.target);
                var icon = btn.querySelector('i');
                var isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                icon.classList.toggle('fa-eye', !isHidden);
                icon.classList.toggle('fa-eye-slash', isHidden);
                btn.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
            });
        });
    </script>
</body>

</html>
