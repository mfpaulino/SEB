<?php
$pagina = $_GET['pagina'];
if($_GET['flag'] == "a"){
	$flag = "11";
}
else {
	$flag = "22";
}
header(sprintf("Location:".$pagina."?flag=$flag"));
