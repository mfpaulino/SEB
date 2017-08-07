<?php
//verifica_usuario.json.php
include_once('../componentes/internos/php/conexao.inc.php');

header('Content-type: application/json');//usado para validação pelo bootstrapValidator

if (isset($_POST['cpf'])){

	$valid_cpf = false;

	$cpf = $_POST['cpf'];

	$con_usuario = $mysqli->query("SELECT cpf FROM usuarios WHERE cpf = '$cpf'");

	if ($con_usuario->num_rows <> 0){
		$valid_cpf = true;
	}

	echo json_encode(array('valid' => $valid_cpf,));//usado para validação pelo bootsrapValidator
}
if (isset($_POST['email'])){

	$valid_email = true;

	$email = $_POST['email'];

	$con_email = $mysqli->query("SELECT email FROM usuarios WHERE email = '$email'");

	if ($con_email->num_rows > 0){
		$valid_email = false;
	}
	echo json_encode(array('valid' => $valid_email,));//usado para validação pelo bootsrapValidator
}
?>