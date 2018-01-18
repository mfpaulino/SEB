<?php
/***********************************************************************************************************
* local/script name: ./template.php
* modelo com os itens obrigatórios para os demais scripts criados                                                                     *
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
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-validator/css/bootstrapValidator.min-.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-fileinput/css/fileinput.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-select/dist/css/bootstrap-select.css">
	<link rel="stylesheet" href="componentes/externos/template/css/AdminLTE.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/iCheck/all.css">
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
				$active_teste = 'active';
				include_once('views/menu/menu_left.inc.php');
				?>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>Template</h1>
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
					<li class="active">Template</li>
				</ol>
			</section>
			<section class="content container-fluid">

				<?php
				if (isset($_GET['flag']) and ($_GET['flag'] == md5("usuario_alterar") or $_GET['flag'] == md5("senha_alterar") or $_GET['flag'] == md5("om_alterar") or $_GET['flag'] == md5("habilitacao_cadastrar") or $_GET['flag'] == md5("habilitacao_alterar") or $_GET['flag'] == md5("logout") )){
					include_once('controllers/usuario/usuario_alertas_criar.inc.php');
				}
				else {
					include_once('controllers/usuario/usuario_alertas_destruir.inc.php');
				}

				include_once('user_modais.inc.php');

				if(isset($_SESSION['alterar_senha_logout']) or isset($_SESSION['alterar_codom'])){
					session_destroy();
				}

				if(isset($_SESSION['alterar_senha_logout']) or isset($_SESSION['alterar_codom'])){
					session_destroy();
				}
				?>
				<!-- conteudo aqui -->

				<div class="row">
					<?php
					$qtde_alerta = 0;
					$sql = "SELECT count(id_usuario) as pedidos_cadastro, MAX(usuarios.data_cad) as data_cad from usuarios, adm_perfis_administra pa where usuarios.status = 'Recebido' and pa.id_perfil_admin in ($lista_perfis_admin) and (pa.id_perfil = usuarios.id_perfil and pa.id_perfil_om = usuarios.id_perfil_om)";
					$con = $mysqli->query($sql);
					$rows = $con->fetch_assoc();
					if ($rows['pedidos_cadastro'] > 0){
						$qtde_alerta++;
						?>
						<div class="col-md-6">
							<div class="box box-default">
								<div class="box-body">
									<div class="alert alert-warning alert-dismissible">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<h4>Cadastro de Usuário</h4>
										<p>Há <?php echo $rows['pedidos_cadastro'];?> pedido(s) de novo(s) usuário(s) pendente(s)!</p>
										<i><small>(Pedido mais recente: <?php echo converter_data($rows['data_cad'],'BR',true);?>)</small></i>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
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
	<script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>
	<script src="componentes/externos/bootstrap/plugins/iCheck/icheck.min.js"></script>
	<script src="componentes/externos/jquery/plugins/maskMoney/dist/jquery.maskMoney.min.js"></script>
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/internos/js/status_menu_top.js"></script>
	<script src="componentes/internos/js/senha_alterar.js"></script>
	<script src="componentes/internos/js/usuario_alterar.js"></script>
	<script src="componentes/internos/js/modal_editar_perfil.js"></script>
	<script src="componentes/internos/js/modal_editar_unidade.js"></script>
	<script src="componentes/internos/js/habilitacao.js"></script>

	<script>
		//personalisando os checkbox
	$('input[type="checkbox"].icheck').iCheck({
		checkboxClass: 'icheckbox_square-blue'
	})
	</script>
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