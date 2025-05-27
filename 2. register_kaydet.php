if($_POST['captcha'] != $_POST['dogru']){
   echo "Doğrulama hatalı! Lütfen Captcha'yı doğru giriniz.";
   exit;
}
