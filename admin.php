<?php
/***********************************************************************************************************
* local/script name: ./admin.php
* tela para administração do sistema                                                                     *
* Exibe na tela alertas diversos vindos do script 'controllers/admin/admin_alertas_criar.inc.php'
* $lista_permissoes vem do perfil.inc.php     *
* **********************************************************************************************************/
$inc = "sim";
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica.inc.php');//autentica e gera todos os dados de usuario
include_once(PATH . '/componentes/internos/php/funcoes.inc.php');
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
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-select/dist/css/bootstrap-select.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-fileinput/css/fileinput.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/iCheck/all.css">
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
				$active_admin = 'active';
				include_once('views/menu/menu_left.inc.php');
				?>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>Administração</h1>
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
					<li class="active">Administração</li>
				</ol>
			</section>
			<section class="content container-fluid">
				<?php
				if (isset($_GET['flag']) and ($_GET['flag'] == md5("usuario_alterar") or $_GET['flag'] == md5("senha_alterar") or $_GET['flag'] == md5("om_alterar") or $_GET['flag'] == md5("habilitacao_cadastrar") or $_GET['flag'] == md5("habilitacao_alterar") or $_GET['flag'] == md5("logout") )){
					include_once('controllers/usuario/usuario_alertas_criar.inc.php');
				}
				else if (isset($_GET['flag']) and ($_GET['flag'] == md5("categoria_cadastrar") or $_GET['flag'] == md5("categoria_alterar") or $_GET['flag'] == md5("categoria_excluir") or $_GET['flag'] == md5("diaria_cadastrar") or $_GET['flag'] == md5("diaria_alterar") or $_GET['flag'] == md5("diaria_excluir") or $_GET['flag'] == md5("user_alterar") or $_GET['flag'] == md5("area_cadastrar") or $_GET['flag'] == md5("area_alterar") or $_GET['flag'] == md5("area_vincular") or $_GET['flag'] == md5("subarea_cadastrar") or $_GET['flag'] == md5("subarea_alterar") or $_GET['flag'] == md5("subarea_vincular") or $_GET['flag'] == md5("questao_cadastrar") or $_GET['flag'] == md5("questao_alterar") or $_GET['flag'] == md5("questao_vincular") or $_GET['flag'] == md5("info_req_cadastrar") or $_GET['flag'] == md5("info_req_alterar") or $_GET['flag'] == md5("info_req_vincular") or $_GET['flag'] == md5("poss_achado_cadastrar") or $_GET['flag'] == md5("poss_achado_alterar") or $_GET['flag'] == md5("poss_achado_vincular") or $_GET['flag'] == md5("proc_ana_cadastrar") or $_GET['flag'] == md5("proc_ana_alterar") or $_GET['flag'] == md5("proc_ana_vincular") or $_GET['flag'] == md5("proc_coleta_cadastrar") or $_GET['flag'] == md5("proc_coleta_alterar") or $_GET['flag'] == md5("proc_coleta_vincular") or $_GET['flag'] == md5("fonte_info_cadastrar") or $_GET['flag'] == md5("fonte_info_alterar") or $_GET['flag'] == md5("fonte_info_vincular") or $_GET['flag'] == md5("tipo_evento_cadastrar") or $_GET['flag'] == md5("tipo_evento_alterar") or $_GET['flag'] == md5("aviso_cadastrar") or $_GET['flag'] == md5("aviso_alterar") or $_GET['flag'] == md5("perfil_administrar") or $_GET['flag'] == md5("permissao_administrar") )){
					include_once('controllers/admin/admin_alertas_criar.inc.php');
				}
				else {
					include_once('controllers/usuario/usuario_alertas_destruir.inc.php');
					include_once('controllers/admin/admin_alertas_destruir.inc.php');
				}

				include_once('views/admin/view_admin_alertas.inc.php');
				include_once('user_modais.inc.php');//modais do menu à direita

				if(isset($_SESSION['alterar_senha_logout']) or isset($_SESSION['alterar_codom'])){
					session_destroy();
				}
				?>
				<!-- conteudo aqui -->
				<?php
				if (in_array("adm_usuarios", $lista_permissoes)){?>
					<div class="row">
						<!-- pedidos de cadastro de usuarios -->
						<div class="col-md-6">
							<?php include_once('views/admin/user/view_pedido_cadastro_lista.inc.php'); ?>
							<?php include_once('views/admin/user/view_pedido_cadastro_relacao.inc.php');?>
						</div>
						<!-- usuarios cadastrados -->
						<div class="col-md-6">
							<?php include_once('views/admin/user/view_user_lista.inc.php'); ?>
							<?php include_once('views/admin/user/form_user_perfil.inc.php'); ?>
							<?php include_once('views/admin/user/view_user_habilitacao.inc.php'); ?>
							<?php include_once('views/admin/user/view_user_relacao.inc.php');?>
						</div>
					</div>
				<?php
				} ?>
				<div class="row">
					<?php
					if (in_array("adm_avisos", $lista_permissoes)){?>
						<!-- avisos administrativos-->
						<div class="col-md-6">
							<?php include_once('views/admin/aviso/view_aviso.inc.php'); ?>
							<?php include_once('views/admin/aviso/form_aviso_cadastrar.inc.php');?>
							<?php include_once('views/admin/aviso/form_aviso_alterar.inc.php');?>
							<?php include_once('views/admin/aviso/view_aviso_relacao.inc.php');?>
						</div>
					<?php
					}
					if (in_array("adm_perfis", $lista_permissoes)){?>
						<!-- administra perfis -->
						<div class="col-md-3">
							<?php include_once('views/admin/perfil/view_perfis_administra.inc.php');?>
							<?php include_once('views/admin/perfil/form_perfis_administra.inc.php');?>
						</div>
					<?php
					}
					if(in_array("adm_permissoes", $lista_permissoes)){?>
						<!-- administra permissoes -->
						<div class="col-md-3">
							<?php include_once('views/admin/permissao/view_permissoes_administra.inc.php');?>
							<?php include_once('views/admin/permissao/form_permissoes_administra0.inc.php');?>
							<?php include_once('views/admin/permissao/form_permissoes_administra1.inc.php');?>
						</div>
						<?php
					} ?>
				</div>
				<div class="row">
				<?php
				if (in_array("adm_categorias", $lista_permissoes)){?>
					<!-- categoria/localidades para diarias -->
					<div class="col-md-3">
						<?php include_once('views/admin/categoria/view_categoria.inc.php');?>
						<?php include_once('views/admin/categoria/form_categoria_cadastrar.inc.php');?>
						<?php include_once('views/admin/categoria/form_categoria_alterar.inc.php');?>
						<?php include_once('views/admin/categoria/view_categoria_relacao.inc.php');?>
					</div>
				<?php
				}
				if (in_array("adm_diarias", $lista_permissoes)){?>
					<!-- diarias -->
					<div class="col-md-3">
						<?php include_once('views/admin/diaria/view_diaria.inc.php');?>
						<?php include_once('views/admin/diaria/form_diaria_cadastrar.inc.php');?>
						<?php include_once('views/admin/diaria/form_diaria_alterar.inc.php');?>
						<?php include_once('views/admin/diaria/view_diaria_relacao.inc.php');?>
					</div>
				<?php
				}
				if (in_array("adm_tipo_evento", $lista_permissoes)){?>
					<!-- Tipos de Eventos -->
					<div class="col-md-3">
						<?php include_once('views/admin/tipo_evento/view_tipo_evento.inc.php');?>
						<?php include_once('views/admin/tipo_evento/form_tipo_evento_cadastrar.inc.php');?>
						<?php include_once('views/admin/tipo_evento/form_tipo_evento_alterar.inc.php');?>
						<?php include_once('views/admin/tipo_evento/view_tipo_evento_relacao.inc.php');?>
					</div>
				<?php
				} ?>
				</div>
				<div class="row">
				<?php
				if (in_array("adm_areas", $lista_permissoes)){?>
					<!-- areas/processos -->
					<div class="col-md-3">
						<?php include_once('views/admin/area/view_area.inc.php');?>
						<?php include_once('views/admin/area/form_area_cadastrar.inc.php');?>
						<?php include_once('views/admin/area/form_area_alterar.inc.php');?>
						<?php include_once('views/admin/area/form_area_vincular_subarea.inc.php');?>
						<?php include_once('views/admin/area/view_area_relacao.inc.php');?>
					</div>
				<?php
				}
				if (in_array("adm_subareas", $lista_permissoes)){?>
					<!-- subareas/subprocessos -->
					<div class="col-md-3">
						<?php include_once('views/admin/subarea/view_subarea.inc.php');?>
						<?php include_once('views/admin/subarea/form_subarea_cadastrar.inc.php');?>
						<?php include_once('views/admin/subarea/form_subarea_alterar.inc.php');?>
						<?php include_once('views/admin/subarea/form_subarea_vincular.inc.php');?>
						<?php include_once('views/admin/subarea/view_subarea_relacao.inc.php');?>
					</div>
				<?php
				}
				if (in_array("adm_questoes", $lista_permissoes)){?>
					<!-- questoes de auditoria -->
					<div class="col-md-3">
						<?php include_once('views/admin/questao/view_questao.inc.php');?>
						<?php include_once('views/admin/questao/form_questao_cadastrar.inc.php');?>
						<?php include_once('views/admin/questao/form_questao_alterar.inc.php');?>
						<?php include_once('views/admin/questao/form_questao_vincular.inc.php');?>
						<?php include_once('views/admin/questao/view_questao_relacao.inc.php');?>
					</div>
				<?php
				} ?>
				</div>
				<div class="row">
				<?php
				if (in_array("adm_info_requeridas", $lista_permissoes)){?>
					<!-- informações requeridas -->
					<div class="col-md-3">
						<?php include_once('views/admin/info_req/view_info_req.inc.php');?>
						<?php include_once('views/admin/info_req/form_info_req_cadastrar.inc.php');?>
						<?php include_once('views/admin/info_req/form_info_req_alterar.inc.php');?>
						<?php include_once('views/admin/info_req/form_info_req_vincular.inc.php');?>
						<?php include_once('views/admin/info_req/view_info_req_relacao.inc.php');?>
					</div>
				<?php
				}
				if (in_array("adm_fontes_informacao", $lista_permissoes)){?>
					<!-- fontes de informação -->
					<div class="col-md-3">
						<?php include_once('views/admin/fonte_info/view_fonte_info.inc.php');?>
						<?php include_once('views/admin/fonte_info/form_fonte_info_cadastrar.inc.php');?>
						<?php include_once('views/admin/fonte_info/form_fonte_info_alterar.inc.php');?>
						<?php include_once('views/admin/fonte_info/form_fonte_info_vincular_info_req.inc.php');?>
						<?php include_once('views/admin/fonte_info/view_fonte_info_relacao.inc.php');?>
					</div>
				<?php
				}
				if (in_array("adm_proc_coleta", $lista_permissoes)){?>
					<!-- procedimento de coleta de dados -->
					<div class="col-md-3">
						<?php include_once('views/admin/proc_coleta/view_proc_coleta.inc.php');?>
						<?php include_once('views/admin/proc_coleta/form_proc_coleta_cadastrar.inc.php');?>
						<?php include_once('views/admin/proc_coleta/form_proc_coleta_alterar.inc.php');?>
						<?php include_once('views/admin/proc_coleta/form_proc_coleta_vincular_questao.inc.php');?>
						<?php include_once('views/admin/proc_coleta/view_proc_coleta_relacao.inc.php');?>
					</div>
				<?php
				}
				if (in_array("adm_proc_analise", $lista_permissoes)){?>
					<!-- procedimentos de análise de dados -->
					<div class="col-md-3">
						<?php include_once('views/admin/proc_ana/view_proc_ana.inc.php');?>
						<?php include_once('views/admin/proc_ana/form_proc_ana_cadastrar.inc.php');?>
						<?php include_once('views/admin/proc_ana/form_proc_ana_alterar.inc.php');?>
						<?php include_once('views/admin/proc_ana/form_proc_ana_vincular_questao.inc.php');?>
						<?php include_once('views/admin/proc_ana/view_proc_ana_relacao.inc.php');?>
					</div>
				<?php
				} ?>
				</div>
				<?php
				if (in_array("adm_poss_achados", $lista_permissoes)){?>
					<div class="row">
						<!-- possíveis achados -->
						<div class="col-md-3">
							<?php include_once('views/admin/poss_achado/view_poss_achado.inc.php');?>
							<?php include_once('views/admin/poss_achado/form_poss_achado_cadastrar.inc.php');?>
							<?php include_once('views/admin/poss_achado/form_poss_achado_alterar.inc.php');?>
							<?php include_once('views/admin/poss_achado/form_poss_achado_vincular_questao.inc.php');?>
							<?php include_once('views/admin/poss_achado/view_poss_achado_relacao.inc.php');?>
						</div>
					</div>
				<?php
				} ?>
				<?php
				if (in_array("adm_rel_vinc", $lista_permissoes)){?>
					<div class="row">
						<!-- relatorio de vinculações -->
						<div class="col-md-12">
							<?php include_once('relatorios/admin/vinculacoes_rel.inc.php');?>
						</div>
					</div>
				<?php
				} ?>
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
	<script src="componentes/externos/bootstrap/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-validator/js/bootstrapValidator.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="componentes/externos/bootstrap/plugins/jquery-mask/jquery.maskedinput.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
	<script src="componentes/externos/bootstrap/plugins/iCheck/icheck.min.js"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>
	<script src="componentes/externos/jquery/plugins/maskMoney/dist/jquery.maskMoney.min.js"></script>
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/internos/js/status_menu_top.js"></script>
	<script src="componentes/internos/js/senha_alterar.js"></script>
	<script src="componentes/internos/js/usuario_alterar.js"></script>
	<script src="componentes/internos/js/habilitacao.js"></script>
	<script src="componentes/internos/js/modal_editar_perfil.js"></script>
	<script src="componentes/internos/js/modal_editar_unidade.js"></script>
	<script src="componentes/internos/js/admin/area.js"></script>
	<script src="componentes/internos/js/admin/aviso.js"></script>
	<script src="componentes/internos/js/admin/categoria.js"></script>
	<script src="componentes/internos/js/admin/diaria.js"></script>
	<script src="componentes/internos/js/admin/fonte_info.js"></script>
	<script src="componentes/internos/js/admin/info_req.js"></script>
	<script src="componentes/internos/js/admin/poss_achado.js"></script>
	<script src="componentes/internos/js/admin/proc_ana.js"></script>
	<script src="componentes/internos/js/admin/proc_coleta.js"></script>
	<script src="componentes/internos/js/admin/questao.js"></script>
	<script src="componentes/internos/js/admin/subarea.js"></script>
	<script src="componentes/internos/js/admin/tipo_evento.js"></script>
	<script src="componentes/internos/js/admin/user.js"></script>
	<script src="componentes/internos/js/admin/perfil_administra.js"></script>
	<script src="componentes/internos/js/admin/permissao_administra.js"></script>
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