-<?php
include_once('componentes/internos/php/constantes.inc.php');
include_once('componentes/internos/php/cabecalho.inc.php');
session_start();
if($_SESSION['acesso'] == "nao_liberado"){
	header("Location: " . PAGINA_VISITANTE); //envio o usuário à página de usuario nao habilitado
}
elseif($_SESSION['acesso'] == "liberado"){
	header("Location: " . PAGINA_INICIAL); //envio o usuário à página de usuario habilitado
}
?>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistema de Auditoria Interna do Exército Brasileiro- SIAUDI</title>
    <link href="componentes/externos/bootstrap/css/bootstrap.css" rel="stylesheet">

</head>
<body>
<form action="autenticacao/login.php" method="POST">
	<input type="hidden" name="flag" />
	<input type="text" name="cpf" maxlength="11" required onKeyUp="return autoTab(this, 11, event);" />
	<input type="password" name="senha" required />
	<input type="submit">
</form>
<a href="#" data-toggle="modal" data-target="#senhaModal">Esqueci a senha</a>
<br />
<a href="#" data-toggle="modal" data-target="#cadastroModal">Não tenho cadastro</a>
<br />
<a href="#" data-toggle="modal" data-target="#alteraModal">Alterar senha</a>
<br />
<?php $inc = "sim"; include_once 'usuario/alertas.inc.php'; ?>
<div class="container">
	<?php require_once "usuario/form_cadastra.inc.php";?>
	<?php require_once "usuario/form_esqueci_senha.inc.php";?>
	<?php require_once "usuario/form_altera_senha.inc.php";?>
</div>
 <!-- jQuery --->
<script src="componentes/externos/jquery/jquery.min.js"></script>
<script src="componentes/externos/bootstrap/js/bootstrap.min.js"></script>
<script src="componentes/internos/js/auto_tab.js"></script>

		<script>
			//script para receber a selecao da unidade de controle interno e atualizar o 2º select
			$(document).ready(function(){
				$("select[name=unidade_ci]").change(function(){
					$("select[name=codom]").html('<option value="">Carregando...</option>');
					$.post("listas/om_select.inc.php", {unidade_ci:$(this).val()},function(valor){$("select[name=codom]").html(valor);})
				 })
			 })
		</script>
</body>
</html>