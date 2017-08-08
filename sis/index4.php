<?php
session_start();
$a = $_SESSION['a'];
$b = $_SESSION['b'];
echo $a. "<br />";
echo $b. "<br />";
unset($_SESSION['a']);
?>
<a href="index3.php">index3.php</a>