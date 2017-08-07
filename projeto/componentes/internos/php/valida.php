<?php
include_once 'data-validator.class.php';

$validate = new Data_Validator();

$nome  = "Pet44";
$email = "peterdomain.com";
$cpf = "09172517840";

$validate->set('nome', $nome)->is_required()->min_length(5)//Validado
         ->set('email', $email)->is_email() //Validado
         ->set('cpf', $cpf)->is_cpf(); //Validado

if ($validate->validate()){
	echo 'Tudo certo';
}
else{
	$todos_erros = $validate->get_errors(); //Captura os erros de todos os campos
	$erros_nome = $validate->get_errors('nome'); //Captura apenas os erros do campo 'nome'
	foreach ($validate->get_errors() as $erro){
		echo '<p>' . $erro[0] . '</p>';
	}
}
?>