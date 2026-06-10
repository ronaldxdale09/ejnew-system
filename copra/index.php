
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EJN Copra — Sign In</title>
    <link rel="icon" href="assets/img/icon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/copra-theme.css">
    <style>
        body { font-family: 'DM Sans', sans-serif; margin: 0; }
    </style>
</head>
<body>
    <div class="copra-login-page">
        <div class="copra-login-card">
            <div class="copra-login-card__brand">
                <img src="assets/img/logo.png" alt="EJN Copra">
                <h1>EJN Copra</h1>
                <p>Purchasing system sign in</p>
            </div>
            <form method="POST" action="function/login.php">
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-uppercase text-muted" for="username">Username</label>
                    <input class="form-control" type="text" id="username" name="username" placeholder="Enter username" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-semibold text-uppercase text-muted" for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Enter password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" style="background:#6b4f2a;border-color:#6b4f2a;">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>
