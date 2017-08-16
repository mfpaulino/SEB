<?php
session_start();

$codigoCaptcha = substr(md5(time()) ,0, 8);

$_SESSION['captcha'] = $codigoCaptcha;

$imagemCaptcha = imagecreatefrompng("../img/fundocaptch.png");

$fonteCaptcha = imageloadfont("../font/anonymous.gdf");

$corCaptcha = imagecolorallocate($imagemCaptcha, 0,150,200);

imagestring($imagemCaptcha, $fonteCaptcha, 15, 5, $codigoCaptcha, $corCaptcha);

imagepng($imagemCaptcha);

imagedestroy($imagemCaptcha);
?>