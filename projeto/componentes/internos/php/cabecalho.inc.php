<?php
//cabecalho.inc.php

//if (!isset($inc)){$flag = md5("acesso_indevido"); header("Location: ../../../autenticacao/logout.php?flag=$flag");}

include_once('constantes.inc.php');

echo '<link rel="stylesheet" href="'.HOME.'componentes/internos/css/cabecalho.css" type="text/css" />';

$txt1 = "centro de controle interno do exército";
$txt2 = "Centro General Serzedello Corrêa";
$txt3 = "SISTEMA DE AUDITORIA INTERNA DO EXÉRCITO BRASILEIRO - SIAUDI/EB";

echo "<div id='header'>\n";
echo "<div id='header-imagem'>\n";
echo "<div id='header-logo'></div>\n";
echo "<div class='header-mascara'></div>\n";
echo "<div class='header-txt1'>$txt1</div>\n";
echo "<div class='header-txt2'>$txt2</div>\n";
echo "</div>\n";
echo "</div>\n";
echo "<div id = 'header-bottom'>\n";
echo "$txt3\n";
echo "</div>\n";
?>