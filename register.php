<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ERDEM Marine</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">ERDEM MARINE</div>
    <ul class="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
</nav>

<section class="register-banner">
    <div class="register-form">
        <h2>Register</h2>
        <form action="register_kaydet.php" method="post">
            <input type="text" name="kullanici_adi" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="text" name="telefon" placeholder="Phone Number" required><br>
            <input type="password" name="sifre" placeholder="Password" required><br>
            <input type="submit" value="Register" class="btn">
        </form>
    </div>
</section>

</body>
</html>
