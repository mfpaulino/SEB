<form action="" method = "POST" >
<input type="text" name = "cpf" />
<input type="hidden" name="flag" />
<input type="submit" value="ok" />
</form>
<?php
if (isset($_POST['flag'])){
	$cpf = $_POST['cpf'];
	include_once('remote.php');
	if($msg_cpf == "ok"){
		echo "valido";
	}
	else {
		echo "invalido";
	}
}
else {
	echo "kd o cpf?";
}
?>