<?php
//cript.inc.php
function encripta($salt,$texto_claro){
	//GERAR UM SALT ENCRIPTADO EM MD5
	$salt = md5($salt);

	//PRIMEIRA ENCRIPTAÇÃO ENCRIPTANDO COM crypt
	$texto_cript = crypt($texto_claro,$salt);

	// SEGUNDA ENCRIPTAÇÃO COM sha512 (128 bits)
	$texto_cript = hash('sha512',$texto_cript);

	//AGORA RETORNO O VALOR FINAL ENCRIPTADO
	return $texto_cript;
}
//echo  encripta($salt,$texto_claro);
?>
