<?php
//valida_cpf.inc.php
header('Content-type: application/json');//usado para validação pelo bootstrapValidator

$valid = true;

$cpf = $_POST['cpf'];

if(!is_numeric($cpf)){
  	$valid = false;
}
else{
	if(($cpf == '11111111111') || ($cpf == '22222222222') || ($cpf == '33333333333') || ($cpf == '44444444444') || ($cpf == '55555555555') || ($cpf == '66666666666') || ($cpf == '77777777777') || ($cpf == '88888888888') || ($cpf == '99999999999') || ($cpf == '00000000000')){
	   	$valid = false;
  	}
	else{
		//se todos os testes anteriores retonaram true, entao sera inciada a verificacao dos digitos
		//primeiro o script vai pegar os dois digitos verificadores (posicao 10 e 11)
		$dv_informado = substr($cpf, 9,2);

		for($i=0; $i<=8; $i++) {
			$digito[$i] = substr($cpf, $i,1);
		}

		//Agora sera calculado o valor do primeiro digito vrficador
		$posicao = 10;
		$soma = 0;

		for($i=0; $i<=8; $i++){
			$soma = $soma + $digito[$i] * $posicao;
			$posicao = $posicao - 1;
		}
		$digito[9] = $soma % 11;

		if($digito[9] < 2){
			$digito[9] = 0;
		}
		else{
			$digito[9] = 11 - $digito[9];
		}

		//Agora sera calculado o valor do segundo digito verificador
		$posicao = 11;
		$soma = 0;

		for ($i=0; $i<=9; $i++){
			$soma = $soma + $digito[$i] * $posicao;
			$posicao = $posicao - 1;
		}

		$digito[10] = $soma % 11;
		if ($digito[10] < 2){
			$digito[10] = 0;
		}
		else {
			$digito[10] = 11 - $digito[10];
		}

		//Nessa parte do script sera verificado se os dois digitos verificadores calculados sao iguais aos  digitos informados pelo usuario
		$dv = $digito[9] * 10 + $digito[10];
		if ($dv <> $dv_informado){
			$valid = false;
		}
		else{
			$msg_cpf = "ok";
		}
	}
}
echo json_encode(array('valid' => $valid,));//usado para validação pelo bootsrapValidator
?>