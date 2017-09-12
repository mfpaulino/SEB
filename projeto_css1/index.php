<?php
/***********************************************************************************************************
* local/script name: ./index.php                                                                           *
* Primeira tela do sistema                                                                                 *
* Inclui o form de login                                                                                   *
* Inclui o form de solicitacao de cadastro                                                                 *
* Inclui o form de recuperar senha                                                                         *
* Se o usuario estiver logado, redireciona para as paginas iniciais de usuario                             *
* Exibe na tela alertas diversos recebiso pelo script 'controllers/usuario/usuario_alertas_criar.inc.php'  *
* **********************************************************************************************************/
$inc 	= "sim";
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true); //será usada no botao de fechar dos alertas

require_once('config.inc.php');

session_start();

if(isset($_SESSION['obriga_troca_senha'])){
	include_once('views/usuario/form_senha_alterar.inc.php');
}
else if ($_SESSION['acesso'] == "nao_liberado"){

	header("Location:" . PAGINA_VISITANTE);
}
else if ($_SESSION['acesso'] == "liberado"){
	header("Location:" . PAGINA_INICIAL);
}
else if ($_SESSION['acesso'] == "lock"){
	header("Location:" . PAGINA_BLOQUEIO);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo TITULO;?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrapValidator.min.css" />
	<link rel="stylesheet" href="componentes/externos/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/dist/css/AdminLTE.css">
	<link rel="stylesheet" href="componentes/externos/dist/css/skins/skin-green.css">
	<link rel="stylesheet" href="componentes/internos/css/siaudi.css">
	<link rel="stylesheet" href="componentes/externos/bower_components/bootstrap-fileinput/css/fileinput.min.css">
	<!--<link rel="stylesheet" href="componentes/externos/bower_components/bootstrap-fileinput/themes/explorer/theme.css">-->
	<style>
		.main-header .navbar{
			margin-left: 0px;
		}
	</style>
</head>
<body class="skin-green login-page">
	<?php include_once('componentes/internos/php/cabecalho.inc.php');?>
	<div class="wrapper login">
		<header class="main-header ">
			<nav class="navbar navbar-static-top" role="navigation">
				<section class="content-header barra-top" >
					<h1>
						<strong>SISTEMA DE AUDITORIA DO EXÉRCITO</strong>
					</h1>
				</section>
			</nav>
		</header>
	</div>
	<div class="login-box">
		<div class="panel-body form-login">
			<?php include_once('views/usuario/form_usuario_acessar.inc.php');?>
		</div>
	</div>
	<?php

	if(isset($_GET['flag']) and ($_GET['flag'] == md5('usuario_cadastrar') or  $_GET['flag'] == md5('senha_alterar') or  $_GET['flag'] == md5('senha_recuperar') or $_GET['flag'] == md5('usuario_acessar') or $_GET['flag'] == md5('logout') or $_GET['flag'] == md5('acesso_indevido'))){
		include_once('controllers/usuario/usuario_alertas_criar.inc.php');
	}
	else {
		include_once('controllers/usuario/usuario_alertas_destruir.inc.php');
	}
	?>
	<!--inicio modalAlerta -->
	<?php include_once('views/usuario/view_usuario_alertas.inc.php');?>
	<?php if(isset($_SESSION['alterar_senha_logout'])){session_destroy();}//termina a sessao se alterar a senha?>
	<div class="container">
		<!--alterarModal-->
		<?php include_once('views/usuario/form_senha_recuperar.inc.php');?>
		<!--cadastroModal-->
		<?php include_once('views/usuario/form_usuario_cadastrar.inc.php');?>
	</div>
	<?php //include_once('componentes/internos/php/rodape.inc.php');?>
	<script src="componentes/externos/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrapValidator.min.js"></script>
	<script src="componentes/externos/dist/js/adminlte.min.js"></script>
	<script src="componentes/internos/js/auto_tab.js"></script>
	<script src="controllers/usuario/usuario_cadastrar.js"></script>
	<script src="controllers/usuario/senha_recuperar.js"></script>
	<script src="controllers/autenticacao/login.js"></script>
    <script src="componentes/externos/bower_components/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
    <script src="componentes/externos/bower_components/bootstrap-fileinput/js/locales/pt-BR.js" type="text/javascript"></script>
	<script>
		<!-- Redimensona o tamanho padrao do modal. Está no siaudi.css-->
		$(".modal-wide").on("show.bs.modal", function() {
		  var height = $(window).height() - 200;
		  $(this).find(".modal-body").css("max-height", height);
		});
	</script>
	<script>
		//script para receber a selecao da unidade de controle interno e atualizar o 2º select
		$(document).ready(function(){
			$("select[name=unidade_ci]").change(function(){
				$("select[name=codom]").html('<option value="">Carregando...</option>');
				$.post("listas/select_unidade.inc.php", {unidade_ci:$(this).val()},function(valor){$("select[name=codom]").html(valor);})
			})
		})
	</script>
	<script>
		//script para receber a selecao da unidade de controle interno e atualizar o 2º select
		$(document).ready(function(){
			$("select[name=codom]").change(function(){
				$("select[name=perfil]").html('<option value="">Carregando...</option>');
				$.post("listas/select_perfil.inc.php", {codom:$(this).val()},function(valor){$("select[name=perfil]").html(valor);})
			})
		})
	</script>
	<script>
		var btnCust = '';
		$("#avatar").fileinput({
			overwriteInitial: true,
			maxFileSize: 1500,
			showClose: false,
			showCaption: false,
			showBrowse: false,
			browseOnZoneClick: true,
			removeLabel: 'cancelar',
			removeIcon: '<i class="glyphicon glyphicon-remove-"></i>',
			removeTitle: 'Excluir imagem',
			elErrorContainer: '#kv-avatar-errors-2',
			msgErrorClass: 'alert alert-block alert-danger',
			defaultPreviewContent: '<img src="views/avatar/default_avatar.jpg" alt="Sua foto" title="Sua foto" style="width:160px"><h6 class="text-muted">Clique para adicionar<br />(Tam máx: 1500Kb)</h6>',
			layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
			allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>

	<?php
	if(isset($_SESSION['obriga_troca_senha'])) {?>
		<script>
			$(document).ready(function(){
				$('#modalTrocarSenha').modal('show');
			});
		</script>
	<?php } ?>
	<?php
	if ($msg <> ""){?>
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
