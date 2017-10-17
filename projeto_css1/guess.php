<?php
/***********************************************************************************************************
* local/script name: ./index_visite.php                                                                    *
* Primeira tela de usuario logado, mas nao liberado                                                        *
* Inclui o form de alterar senha                                                                           *
* Inclui o form de visualizar dados                                                                        *
* Inclui o form de alterar dados                                                                           *
* Inclui o form de alterar Unidade                                                                         *
* Exibe na tela alertas diversos vindos do script 'controllers/usuario/usuario_alertas_criar.inc.php'      *
* **********************************************************************************************************/

$inc 	= "sim";
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica_visite.inc.php');

switch ($status_usuario){
	case ('recebido'):
		$status = "Aguardando liberação de acesso";
		break;

	case('desabilitado'):
		$status = "Usuário está desabilitado";
		break;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo TITULO;?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="componentes/externos/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-validator/css/bootstrapValidator.min.css" />
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-fileinput/css/fileinput.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/template/css/AdminLTE.css">
	<link rel="stylesheet" href="componentes/externos/template/css/skins/skin-green.css">
	<link rel="stylesheet" href="componentes/internos/css/siaudi.css">
</head>
<body class="hold-transition skin-green sidebar-mini">
	<?php include_once(PATH . '/componentes/internos/php/cabecalho.inc.php');?>
	<div class="wrapper">
		<header class="main-header">
			<a href="index2.html" class="logo">
				<span class="logo-mini"><b><-></b></span>
				<span class="logo-lg barra-top"><b>SIAUD</b>-EB</span>
			</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<section class="content-header barra-top" >
					<h1>
						<strong>SISTEMA DE AUDITORIA DO EXÉRCITO</strong>
					</h1>
				</section>
			</nav>
		</header>
		<!--Início Menu Lateral-->
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="views/avatar/<?php echo $avatar_usuario;?>" class="img-circle" alt="User Image">
					</div>
					<div id="status_sessao" class="pull-left info">
						<p><?php echo $posto_usuario . " " . $nome_guerra_usuario;?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<ul class="sidebar-menu" data-widget="tree">
					<li class="active"><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li><a href="#"><i class="fa fa-book"></i> Guia do Usuário</a></li>
					<?php $flag = md5("logout");?>
					<li><a href="controllers/autenticacao/logout.php?flag=<?php echo $flag;?>"><i class="fa fa-sign-out"></i> <span>Sair</span></a></li>
				</ul>
			</section>
		</aside>
		<!-- Fim Menu Lateral-->
		<div class="content-wrapper">
			<section class="content container-fluid">
				<div class="page-header">
					<h4 class="text-center">INFORMAÇÕES DO USUÁRIO</h4>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php include_once('views/usuario/view_usuario_status.inc.php');?>
						<?php
						if (isset($_GET['flag']) and ($_GET['flag'] == md5("usuario_alterar") or $_GET['flag'] == md5("senha_alterar") or $_GET['flag'] == md5("unidade_alterar") or $_GET['flag'] == md5("logout") )){

							include_once('controllers/usuario/usuario_alertas_criar.inc.php');
						}
						else {
							 include_once('controllers/usuario/usuario_alertas_destruir.inc.php');
						}

						include_once('views/usuario/view_usuario_perfil.inc.php');
						include_once('views/usuario/form_usuario_alterar.inc.php');
						include_once('views/usuario/form_unidade_alterar.inc.php');
						include_once('views/usuario/form_senha_alterar.inc.php');
						include_once('views/usuario/view_usuario_alerta_sessao.inc.php');
						include_once('views/usuario/view_usuario_fim_sessao.inc.php');
						include_once('views/usuario/view_usuario_alertas.inc.php');

						if(isset($_SESSION['alterar_senha_logout'])){
							session_destroy();//termina a sessao se alterar a senha
						}
						?>
						<small><span id="contador"></span></small>
					</div>
				</div>
			</section>
		</div>
		<?php include_once('componentes/internos/php/rodape.inc.php');?>
	</div>
	<script src="componentes/externos/jquery/dist/jquery.min.js"></script>
	<script src="componentes/externos/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
    <script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>
	<script src="componentes/internos/js/usuario_alterar.js"></script>
	<script src="componentes/internos/js/senha_alterar.js"></script>
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/internos/js/modal_editar_perfil.js"></script>
	<script src="componentes/internos/js/modal_editar_unidade.js"></script>
	<script>
		$(document).ready(function(){
			$('[data-tooltip="tooltip"]').tooltip();
		});
	</script>
	<?php
	include_once('componentes/internos/php/avatar.php');

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