<?php include "valida_cookies.inc.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include "utf.inc.php";?>

		<title><?php include "texto_barra_navegador.inc.php";?></title>

		<link rel="stylesheet" type="text/css" href="<?php include "estilo.inc.php";?>" />
		<link rel="stylesheet" type="text/css" href="<?php include "estilo_menu.inc.php";?>"   />

		<script type="text/javascript" src="includes/js/jquery.min.js"></script>
		<script type="text/javascript" src="includes/js/script.js"></script>
	</head>
	<body>
		<?php include "perfil_cciex.inc.php"; ?>
		<div id="title"><div id="title1"><?php include "texto_menu.inc.php";?></div></div>
		<div id="main1">
			<?php
				include "menu_cciex.inc.php";
				$adm = 'sim';
				include "valida_perfil.inc.php";
			?>
		</div>
		<div id="container">
			<?php
			include "conecta_mysql.inc.php";
			include "perfil_usuario2.inc.php";
			require_once("includes/classes/PHPMailer/class.phpmailer.php");
			include_once("includes/scripts/email.php");

			$sql_select = "SELECT email FROM usuarios where usuario='$usuario2'";
			$sql_query = mysql_query($sql_select);
			$row_usuario = mysql_fetch_array($sql_query);
			$linhas=mysql_num_rows($sql_query);

			smtpmailer($row_usuario[0], "sisade@cciex.eb.mil.br", "SISADE",  "Teste de envio de email", "Enviado pelo SISADE.");

			if (!empty($error)) {
					//caso o email nao consiga ser enviado, o pedido vai para a tela do administrador do sisade.
					//A senha ja foi alterada, mas o administrador vai redefinir novamenente.

					echo "<script>alert('Erro: n&atilde;o foi poss&iacute;vel enviar o teste para o e-mail: <br /> $row_usuario[0]<br /><br />Entre em contado com a Inform&aacute;tica.',{voltar:\"nao\"}); </script>";
				}
				else {

					echo "<script>alert('Envio de e-mail realizado com sucesso!<br />Teste enviado para o e-mail: $row_usuario[0]',{voltar:\"nao\"}); </script>";
				}

			?>
		</div>
		<div id="fot"><div id="fotlinks1"> <?php include "links.inc.php";?> </div></div>
		<div id="fotlinks6"><div align="center"><?php include "texto_rodape.inc.php";?></div></div>
	</body>
</html>
