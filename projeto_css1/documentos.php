<?php
/***********************************************************************************************************
* local/script name: ./template.php                                                                        *
* **********************************************************************************************************/
$inc = "sim";
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica.inc.php');//autentica e gera todos os dados de usuario

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo TITULO;?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="componentes/externos/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-validator/css/bootstrapValidator.min-.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-fileinput/css/fileinput.min.css">
	<link rel="stylesheet" href="componentes/externos/template/css/AdminLTE.css">
	<link rel="stylesheet" href="componentes/externos/template/css/skins/skin-blue.css">
	<link rel="stylesheet" href="componentes/internos/css/siaudi.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php include_once('componentes/internos/php/cabecalho.inc.php');?>
	<div class="wrapper">
		<header class="main-header">
			<a href="index.php" class="logo">
				<span class="logo-mini"><b>...</b></span>
				<span class="logo-lg barra-top"><b>SIAUD</b>-EB</span>
			</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<?php include ('views/menu/menu_top.inc.php');?>
				<span id="status_msg">
					<?php include ('views/menu/menu_top_msg.inc.php');?>
				</span>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<?php
				$active_auditoria = 'active';
				$active_documentos = 'active';
				include_once('views/menu/menu_left.inc.php');?>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1><small></small></h1>
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> Home</li>
					<li></li>
				</ol>
			</section>
			<section class="content container-fluid">

				<?php
				if (isset($_GET['flag']) and ($_GET['flag'] == md5("usuario_alterar") or $_GET['flag'] == md5("senha_alterar") or $_GET['flag'] == md5("om_alterar") or $_GET['flag'] == md5("logout") )){
					include_once('controllers/usuario/usuario_alertas_criar.inc.php');
				}/*
				else if (isset($_GET['flag']) and ($_GET['flag'] == md5("categoria_cadastrar") or $_GET['flag'] == md5("categoria_alterar") or $_GET['flag'] == md5("categoria_excluir") or $_GET['flag'] == md5("diaria_cadastrar") or $_GET['flag'] == md5("diaria_alterar") or $_GET['flag'] == md5("diaria_excluir") or $_GET['flag'] == md5("user_alterar") or $_GET['flag'] == md5("area_cadastrar") or $_GET['flag'] == md5("area_alterar") or $_GET['flag'] == md5("subarea_cadastrar") or $_GET['flag'] == md5("subarea_alterar"))){
					include_once('controllers/admin/admin_alertas_criar.inc.php');
				}*/
				else {
					include_once('controllers/usuario/usuario_alertas_destruir.inc.php');
					//include_once('controllers/admin/admin_alertas_destruir.inc.php');
				}

				include_once('views/usuario/view_usuario_perfil.inc.php');
				include_once('views/usuario/form_usuario_alterar.inc.php');
				include_once('views/usuario/form_senha_alterar.inc.php');
				include_once('views/usuario/form_unidade_alterar.inc.php');
				include_once('views/usuario/view_usuario_alerta_sessao.inc.php');
				include_once('views/usuario/view_usuario_fim_sessao.inc.php');

				include_once('views/usuario/view_usuario_alertas.inc.php');
				include_once('views/admin/view_admin_alertas.inc.php');

				if(isset($_SESSION['alterar_senha_logout']) or isset($_SESSION['alterar_codom'])){
					session_destroy();
				}
				?>
				<!-- conteudo aqui -->
				<div class="row">
					<div class="col-md-6">
						<?php include_once('views/auditoria/documentos/nt_aud/view_nt_aud.inc.php'); ?>
						<?php //include_once('views/admin/user/view_pedido_cadastro_lista.inc.php'); ?>
						<?php //include_once('views/admin/user/form_user_perfil.inc.php'); ?>
						<?php //include_once('views/admin/user/view_user_relacao.inc.php');?>
						<?php //include_once('views/admin/user/view_pedido_cadastro_relacao.inc.php');?>
					</div>
					<div class="col-md-6">
						<?php include_once('views/auditoria/documentos/parecer/view_parecer.inc.php'); ?>
						<?php //include_once('views/admin/categoria/form_categoria_cadastrar.inc.php');?>
						<?php //include_once('views/admin/categoria/form_categoria_alterar.inc.php');?>
						<?php //include_once('views/admin/categoria/view_categoria_relacao.inc.php');?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<?php include_once('views/auditoria/documentos/sol_aud/view_sol_aud.inc.php');?>
						<?php //include_once('views/admin/area/form_area_cadastrar.inc.php');?>
						<?php //include_once('views/admin/area/form_area_alterar.inc.php');?>
						<?php //include_once('views/admin/area/view_area_relacao.inc.php');?>
					</div>
					<div class="col-md-6">
						<?php include_once('views/auditoria/documentos/mtz_reci/view_mtz_reci.inc.php');?>
						<?php //include_once('views/admin/subarea/form_subarea_cadastrar.inc.php');?>
						<?php //include_once('views/admin/subarea/form_subarea_alterar.inc.php');?>
						<?php //include_once('views/admin/subarea/view_subarea_relacao.inc.php');?>
						<?php //include_once('views/admin/subarea/view_subarea_relacao1.inc.php');?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<?php include_once('views/auditoria/documentos/mtz_resp/view_mtz_resp.inc.php');?>
						<?php //include_once('views/admin/area/form_area_cadastrar.inc.php');?>
						<?php //include_once('views/admin/area/form_area_alterar.inc.php');?>
						<?php //include_once('views/admin/area/view_area_relacao.inc.php');?>
					</div>
					<div class="col-md-6">
						<?php include_once('views/auditoria/documentos/stakeholder/view_stakeholder.inc.php');?>
						<?php //include_once('views/admin/subarea/form_subarea_cadastrar.inc.php');?>
						<?php //include_once('views/admin/subarea/form_subarea_alterar.inc.php');?>
						<?php //include_once('views/admin/subarea/view_subarea_relacao.inc.php');?>
						<?php //include_once('views/admin/subarea/view_subarea_relacao1.inc.php');?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<?php include_once('views/auditoria/documentos/mtz_resp/view_mtz_resp.inc.php');?>
						<?php //include_once('views/admin/area/form_area_cadastrar.inc.php');?>
						<?php //include_once('views/admin/area/form_area_alterar.inc.php');?>
						<?php //include_once('views/admin/area/view_area_relacao.inc.php');?>
					</div>
					<div class="col-md-6">
						<?php include_once('views/auditoria/documentos/stakeholder/view_stakeholder.inc.php');?>
						<?php //include_once('views/admin/subarea/form_subarea_cadastrar.inc.php');?>
						<?php //include_once('views/admin/subarea/form_subarea_alterar.inc.php');?>
						<?php //include_once('views/admin/subarea/view_subarea_relacao.inc.php');?>
						<?php //include_once('views/admin/subarea/view_subarea_relacao1.inc.php');?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<?php include_once('views/auditoria/documentos/cert_aud/view_cert_aud.inc.php');?>
						<?php //include_once('views/admin/area/form_area_cadastrar.inc.php');?>
						<?php //include_once('views/admin/area/form_area_alterar.inc.php');?>
						<?php //include_once('views/admin/area/view_area_relacao.inc.php');?>
					</div>
					<div class="col-md-6">
						<?php include_once('views/auditoria/documentos/mtz_swot/view_mtz_swot.inc.php');?>
						<?php //include_once('views/admin/subarea/form_subarea_cadastrar.inc.php');?>
						<?php //include_once('views/admin/subarea/form_subarea_alterar.inc.php');?>
						<?php //include_once('views/admin/subarea/view_subarea_relacao.inc.php');?>
						<?php //include_once('views/admin/subarea/view_subarea_relacao1.inc.php');?>
					</div>
				</div>
				<!-- fim conteudo -->
			</section>
		</div>
		<aside class="control-sidebar control-sidebar-dark">
			<?php include_once('views/menu/menu_right.inc.php');?>
		</aside>
		<div class="control-sidebar-bg"></div>
		<?php include_once('componentes/internos/php/rodape.inc.php');?>
	</div>
	<script src="componentes/externos/jquery/dist/jquery.min.js"></script>
	<script src="componentes/externos/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-validator/js/bootstrapValidator.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>
	<script src="componentes/externos/jquery/plugins/maskMoney/dist/jquery.maskMoney.min.js"></script>
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/internos/js/status_menu_top.js"></script>
	<script src="componentes/internos/js/senha_alterar.js"></script>
	<script src="componentes/internos/js/usuario_alterar.js"></script>
	<script src="componentes/internos/js/modal_editar_perfil.js"></script>
	<script src="componentes/internos/js/modal_editar_unidade.js"></script>
	<script>
		//exibe os titles ao passar o mouse
		$(document).ready(function(){
			$('[data-tooltip="tooltip"]').tooltip();
		});
	</script>
	<?php
	include_once('componentes/internos/php/avatar.php');

	if ($msg <> ""){?>
		<script>
			//exibe o modal de alertas
			$(document).ready(function(){
				$('#modalAlerta').modal('show');
			});
		</script>
	<?php
	}
	?>
</body>
</html>