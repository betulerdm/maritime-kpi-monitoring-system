<?php
$sayi1 = rand(1,10);
$sayi2 = rand(1,10);
$toplam = $sayi1 + $sayi2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ERDEM Marine</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">IMZA MARINE</div>
    <ul class="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
</nav>

<section class="register-banner">
    <div class="register-form">
        <h2>Login</h2>
        <form action="login_kontrol.php" method="post">
            <input type="text" name="kullanici_adi" placeholder="Username" required><br>
            <input type="password" name="sifre" placeholder="Password" required><br>

            <label><?php echo "$sayi1 + $sayi2 = ?"; ?></label>
            <input type="text" name="captcha" required>
            <input type="hidden" name="dogru" value="<?php echo $toplam; ?>">

            <input type="submit" value="Login" class="btn">
        </form>
    </div>
</section>

</body>
</html>
