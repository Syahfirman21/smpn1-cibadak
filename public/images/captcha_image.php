<?php
session_start();

$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$captcha = '';

$length = 6; // Jumlah karakter CAPTCHA

for ($i = 0; $i < $length; $i++) {
    $captcha .= $characters[rand(0, strlen($characters) - 1)];
}

// Simpan nilai CAPTCHA dalam session untuk memverifikasinya nanti
$_SESSION['captcha'] = $captcha;

// Buat gambar CAPTCHA
$image = imagecreatetruecolor(150, 50);
$bgColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);

imagefilledrectangle($image, 0, 0, 149, 49, $bgColor);
imagettftext($image, 20, 0, 20, 40, $textColor, 'path-to-your-font.ttf', $captcha);

header('Content-type: image/png');
imagepng($image);
imagedestroy($image);
?>
