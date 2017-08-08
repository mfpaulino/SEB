<?php
session_start();
$_SESSION['a'] = '1';
$_SESSION['b'] = '2';


$a = $_SESSION['a'];
$b = $_SESSION['b'];
echo $a. "<br />";
echo $b. "<br />";
?>
<a href="index3.php">index3.php</a>