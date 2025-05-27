<?php
$sayi1 = rand(1,10);
$sayi2 = rand(1,10);
$toplam = $sayi1 + $sayi2;
?>

<h2>Kayıt Ol</h2>
<form action="register_kaydet.php" method="post">
    <input type="text" name="kullanici_adi" placeholder="Kullanıcı Adı" required><br>
    <input type="email" name="email" placeholder="E-posta" required><br>
    <input type="text" name="telefon" placeholder="Telefon" required><br>
    <input type="password" name="sifre" placeholder="Şifre" required><br>

    <label><?php echo "$sayi1 + $sayi2 = ?"; ?></label>
    <input type="text" name="captcha" required>
    <input type="hidden" name="dogru" value="<?php echo $toplam; ?>">

    <input type="submit" value="Kayıt Ol" class="btn">
</form>
