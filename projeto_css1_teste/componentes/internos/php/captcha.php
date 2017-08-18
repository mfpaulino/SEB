<?php
session_start();

$codigoCaptcha = substr(md5(time()) ,0, 1);//recebe os 8 primeiros caracteres do timestemp criptografado

$_SESSION['captcha'] = $codigoCaptcha; //cria a variavel global

$imagemCaptcha = imagecreatefrompng("../img/fundocaptch.png"); //cria a variável com a imagem de fundo

$fonteCaptcha = imageloadfont("../font/anonymous.gdf"); //cria a variável com o tipo de fonte

$corCaptcha = imagecolorallocate($imagemCaptcha, 0,150,200);//cria a variável com a cor da fonte

imagestring($imagemCaptcha, $fonteCaptcha, 15, 5, $codigoCaptcha, $corCaptcha);//concatena as 4 variáveis

imagepng($imagemCaptcha); //coloca a imagem na memoria

imagedestroy($imagemCaptcha);//retira a imagem da memoria
?>