<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIAUDI</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrapValidator.min.css" />
  <link rel="stylesheet" href="componentes/externos/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="componentes/externos/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="componentes/externos/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="componentes/externos/dist/css/skins/skin-green.css">
  <link rel="stylesheet" href="componentes/internos/css/siaudi.css">
</head>
<body onLoad="setTimeout('enblur()', 500)" class="hold-transition skin-green sidebar-mini">
<?php include_once('componentes/internos/php/cabecalho.inc.php');?>
<div class="wrapper">
  <header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini"><b><-></b></span>
      <span class="logo-lg barra-top"><b>SIAUDI</b>/EB</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">

    <section class="content-header barra-top" >
      <h1>
        <strong>SISTEMA DE AUDITORIA INTERNA DO EXÉRCITO</strong>
        <small></small>
      </h1>
    </section>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
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
    </section>
  </aside>
  <div class="content-wrapper">
    <section class="content container-fluid">
      <!--------------------------
        | Your Page Content Here |
        -------------------------->

		<?php
			$inc="sim";
			if(isset($_GET['flag']) and ($_GET['flag'] == md5('usuario_cadastrar') or  $_GET['flag'] == md5('senha_recuperar') or $_GET['flag'] == md5('usuario_acessar'))){

				include_once('controllers/usuario/usuario_alertas_criar.inc.php');
			}
			else {
				include_once('controllers/usuario/usuario_alertas_destruir.inc.php');
			}
			?>
		<!--modal alert -->
		<!--inicio modalAlerta -->
				<div class="modal modal-<?php echo $botao;?> fade" id="modalAlerta"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
								<h4 class="modal-title" id="modalAlertaLabel">AVISO DO SISTEMA</h4>
							</div>
							<div class="modal-body">
								<?php
								echo "<b>";
								echo $msg6.$msg0.$msg1.$msg2.$msg3.$msg4.$msg5;

								if($lista_erro_validacao){
								foreach ($lista_erro_validacao as $msg_lista){
								echo $msg_lista[0] = "<p>" . $msg_lista[0] . "</p>";
								}
								}
								echo "</b>";
								?>
							</div>
							<div class="modal-footer">
								<a href="index<?php echo $visite;?>.php"><button type="button" class="btn btn-<?php echo $botao;?>">Fechar</button></a>
							</div>
							</div>
						</div>
					</div>
				</div>

    </section>
  </div>
  <?php include_once('componentes/internos/php/rodape.inc.php');?>
  <div class="control-sidebar-bg"></div>
</div>
<div class="container">
	<?php require_once "views/usuario/form_senha_recuperar.inc.php";?>
	<?php require_once "views/usuario/form_usuario_cadastrar.inc.php";?>
</div>
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
}?>
</body>
</html>