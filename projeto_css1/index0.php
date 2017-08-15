<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrapValidator.min.css" />
	<link rel="stylesheet" href="componentes/externos/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/dist/css/AdminLTE.css">
	<link rel="stylesheet" href="componentes/externos/dist/css/skins/skin-green.css">
	<link rel="stylesheet" href="componentes/internos/css/siaudi.css">
</head>
<body class="hold-transition login-page">
	<?php include_once('componentes/internos/php/cabecalho.inc.php');?>
	<div class="login-box">
		<div class="login-logo">
			<b>SIAUD-EB</b>
		</div>
		<div class="panel-body form-login">
			<form name="form_usuario_acessar" id="form_usuario_acessar" role="form" method="POST" action="controllers/autenticacao/login.php">
				<fieldset>
					<div class="form-group">
						<span class="barra-top"><b>ACESSO AO SISTEMA</b></span><hr>
					</div>
					<div class="form-group has-feedback">
						<input class="form-control" type="text" name="cpf" maxlength="11" placeholder="CPF" onKeyUp="return autoTab(this, 11, event);" />
						<i class="glyphicon glyphicon-user form-control-feedback"></i>
					</div>
					<div class="form-group has-feedback">
						<input class="form-control" type="password" name="senha" placeholder="Senha" />
						<i class="glyphicon glyphicon-lock form-control-feedback"></i>
					</div>
					<div class="form-group">
						<input type="hidden" name="flag" />
						<button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
					</div>
					<div class="form-group">
						<a  style="color:#ffffff" href="#" data-toggle="modal" data-target="#esqueciModal">> <b>Esqueci minha senha</b></a>
						<br />
						<a style="color:#ffffff" href="#" data-toggle="modal" data-target="#cadastroModal">> <b>Solicitar acesso ao sistema</b></a>
						<br />
						<hr>
						<a style="color:#ffffff" href="#" target="_blank">> <b>Guia do Usuário</b></a>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	<?php include_once('componentes/internos/php/rodape.inc.php');?>
	<script src="componentes/externos/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrapValidator.min.js"></script>
	<script src="componentes/externos/dist/js/adminlte.min.js"></script>
	<script src="componentes/internos/js/auto_tab.js"></script>
	<script src="controllers/usuario/usuario_cadastrar.js"></script>
	<script src="controllers/usuario/senha_recuperar.js"></script>
	<script src="controllers/autenticacao/login.js"></script>
	<script>
		//script para receber a selecao da unidade de controle interno e atualizar o 2º select
		$(document).ready(function(){
			$("select[name=unidade_ci]").change(function(){
				$("select[name=codom]").html('<option value="">Carregando...</option>');
				$.post("listas/select_om.inc.php", {unidade_ci:$(this).val()},function(valor){$("select[name=codom]").html(valor);})
			})
		})
	</script>
	<?php
	if ($msg <> ""){ ?>
		<script>
			$(document).ready(function(){
				$('#modalAlerta').modal('show');
			});
		</script>
	<?php
	}
	?>
</body>
</html>
