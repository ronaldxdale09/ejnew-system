<!-- Fantacy Design -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
<style>
.logo {
    width: 150px;
    margin-bottom: 20px;

}
</style>

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Login </title>
 
</head>
<link rel="stylesheet" href="css/login.css">

<body>
    <div class="main">
        <div style="text-align: center; padding: 20px;">
            <img src="assets/img/icon.png" alt="Logo" class="logo">
        </div>
        <form method='POST' action='function/login.php'>
            <input class="un" type="text" name='username' placeholder="Username">
            <input class="pass" type="password" name='password' placeholder="Password">
            <button type='submit' class="submit">Login</button>
        </form>
    </div>
</body>

</html>