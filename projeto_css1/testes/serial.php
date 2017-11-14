<?php
$value = "Admin,Aud,Coord,Ger,Super,";
$value = substr($value, 0,-1);

$value = explode(",",$value);
$value_s = serialize($value);
echo $value_s;

// get everything after last newline
//$text = "Line 1\nLine 2\nLine 3";
//$last = substr(strrchr($text, 10), 1 );
/*
$value ='a:5:{i:0;s:13:"Administrador";i:1;s:16:"Auditor/Analista";i:2;s:11:"Coordenador";i:3;s:7:"Gerente";i:4;s:10:"Supervisor";}';

echo $var[1];
echo "<br />";
$var_s = serialize($var);
$var_u = unserialize($var_s);
echo $var_s;
echo "<br />";
echo $var_s[1];
*/
?>