<?php
/***********************************************************************************************************
* local/script name: ./index_user.php                                                                      *
* Primeira tela de usuario logado e liberado                                                               *
* Inclui o form de alterar senha                                                                           *
* Inclui o form de visualizar dados                                                                        *
* Inclui o form de alterar dados                                                                           *
* Inclui o form de alterar Unidade                                                                         *
* Exibe na tela alertas diversos vindos do script 'controllers/usuario/usuario_alertas_criar.inc.php'      *
* **********************************************************************************************************/
$inc = "sim";
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica.inc.php');//autentica e gera todos os dados de usuario
include_once(PATH . '/controllers/admin/aviso/aviso_alterar_status.inc.php');//verifica a validade dos avisos publicados e inativa os vencidos.

				//include_once('includes.inc.php');
include_once(PATH . '/componentes/internos/php/funcoes.inc.php');

$pagina_lock = str_replace('user.php?flag='.md5(date('d-m-Y')),'',strtr(end(explode('/', $_SERVER['REQUEST_URI'])),'', true));

/*** redirecionamento ao sair da tela de bloqueio **/
if(isset($_GET['flag'])){//vem da tela de bloqueio

	switch ($_GET['flag']){

		case md5("mailbox_input.php"):
		  header("Location:mailbox_input.php");
		  break;

		case md5("mailbox_sent.php"):
		  header("Location:mailbox_sent.php");
		  break;

		case md5("mailbox_read.php"):
		  header("Location:mailbox_read.php");
		  break;

		case md5("mailbox_write.php"):
		  header("Location:mailbox_write.php");
		  break;

		case md5("admin.php"):
		  header("Location:admin.php");
		  break;

		case md5(PAGINA_INICIAL):
		  header("Location:".PAGINA_INICIAL);
		  break;
	}
	if(strpos($_GET['flag'],'mailbox_view') !== false){
		header("Location:".$pagina_lock);
	}
}
/*** fim redirecionamento **/
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
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-select/dist/css/bootstrap-select.css">
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
				$active_home = 'active';
				include_once('views/menu/menu_left.inc.php');?>
			</section>
		</aside>
		<div class="content-wrapper">
			<!--
			<section class="content-header">
				<h1>&nbsp;</h1>
				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-home"></i> Home</li>
					<li></li>
				</ol>
			</section>
			-->
			<section class="content container-fluid">
				<?php
				if (isset($_GET['flag']) and ($_GET['flag'] == md5("usuario_alterar") or $_GET['flag'] == md5("senha_alterar") or $_GET['flag'] == md5("om_alterar") or $_GET['flag'] == md5("habilitacao_cadastrar") or $_GET['flag'] == md5("habilitacao_alterar") or $_GET['flag'] == md5("logout") )){
					include_once('controllers/usuario/usuario_alertas_criar.inc.php');
				}
				else {
					include_once('controllers/usuario/usuario_alertas_destruir.inc.php');
				}

				include_once('controllers/admin/aviso/aviso_home.inc.php');//lista de avisos

				include_once('user_modais.inc.php');//modais do menu à direita

				if(isset($_SESSION['alterar_senha_logout']) or isset($_SESSION['alterar_codom'])){
					session_destroy();
				}
				?>
				<!-- conteudo aqui -->
				<!-- -->
				<div class="row">
					<?php
					$total_alertas = 3;

					if($total_alertas > 0){
						$status_alertas = "(Quantidade: ". $total_alertas. ")";
					}
					else {
						$status_alertas = "(Nenhum alerta)";
					}
					if($tot_avisos > 0){
						$status_avisos = "(Quantidade: ". $tot_avisos . ")";
					}
					else {
						$status_avisos = "(Nenhum aviso)";
					}
					?>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-yellow"><i class="fa fa-warning"></i></span>
							<div class="info-box-content">
								<span class="info-box-number">Alertas do Sistema</span>
								<span class="info-box-text"><?php echo $status_alertas;?></span>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="info-box">
							<span class="info-box-icon bg-red"><i class="fa fa-bell"></i></span>
							<div class="info-box-content">
								<span class="info-box-number">Avisos Administrativos</span>
								<span class="info-box-text"><?php echo $status_avisos;?></span>
							</div>
						</div>
					</div>
				</div>
				<!-- -->
				<!-- -->
				<div class="row">
					<div class="col-md-6">
						<?php if($total_alertas > 0){?>
						<div class="box box-default">
							<div class="box-body">
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4>Título do Alerta!</h4>
									<h5>(Data/Hora)</h5>
									<p>Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto.</p>
								</div>
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4>Título do Alerta!</h4>
									<h5>(Data/Hora)</h5>
									Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto.
								</div>
								<div class="alert alert-warning alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<h4>Título do Alerta!</h4>
									<h5>(Data/Hora)</h5>
									Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto. Qualquer texto.
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="col-md-6">
						<?php
						if($tot_avisos > 0){?>
							<div class="box box-default">
								<div class="box-body">
									<?php
									while($row_avisos = $con_avisos->fetch_assoc()){
										include('views/admin/aviso/view_aviso_home.inc.php');
									}
									?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
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
	<script src="componentes/externos/bootstrap/plugins/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/internos/js/status_menu_top.js"></script>
	<script src="componentes/internos/js/senha_alterar.js"></script>
	<script src="componentes/internos/js/usuario_alterar.js"></script>
	<script src="componentes/internos/js/modal_editar_perfil.js"></script>
	<script src="componentes/internos/js/modal_editar_unidade.js"></script>
	<script src="componentes/internos/js/habilitacao.js"></script>
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