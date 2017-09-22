<?php
define('GUSER', 'informatica@cciex.eb.mil.br');
define('GPWD', 'CCIExInfor');

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = '';//ssl
	$mail->Host = 'correio.cciex.eb.mil.br';//smtp.gmail.com
	$mail->Port = 587;  		// 465
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $de_nome);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	$mail->IsHTML(true);

	if(!$mail->Send()) {
		$error= "erro";
		return false;
	}
}
?>