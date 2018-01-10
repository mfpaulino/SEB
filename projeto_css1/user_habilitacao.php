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
				include_once('views/menu/menu_left.inc.php');?>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>Habilitações</h1>
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
					<li class="active">Habilitações</li>
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

				$sql = "SELECT h.*, a.area from usuarios_habilitacao h, adm_areas a where h.cpf = '$cpf' and h.id_area = a.id_area order by a.area, h.tipo, h.descricao";
				$con_habilitacao = $mysqli->query($sql);
				?>
				<!-- conteudo aqui -->
				<div class="row">
					<div class="col-md-12">
						<?php
						if($con_habilitacao->num_rows <> 0){?>
							<div class="box box-solid">
								<!--<div>-->
									<table border="0" class="table table-hover">
										<tr class="text-bold text-uppercase bg-light-blue">
											<td>Área</td>
											<td>Tipo</td>
											<td>Descrição</td>
											<td class="text-center">Carga-horária</td>
											<td class="text-center text-strong">Conclusão</td>
											<td class="text-center">Ação</td>
										</tr>
									<?php
									while ($rows =  $con_habilitacao->fetch_assoc()){?>
										<tr>
											<td><?php echo $rows['area']; ?></td>
											<td width="10%"><?php echo $rows['tipo']; ?></td>
											<td><?php echo $rows['descricao']; ?></td>
											<td width="10%" class="text-center"><?php echo $rows['carga_horaria']; ?></td>
											<td width="10%" class="text-center"><?php echo $rows['ano_conclusao']; ?></td>
											<td width="10%" class="text-center">
												<!--botao Aviso-->
												<button type="button" class="btn btn-xs btn-primary"
													data-tooltip="tooltip"
													data-title="Editar"
													data-placement="left"
													data-toggle="modal"
													data-target="#modalAlterarHabilitacao"
													data-id_habilitacao="<?php echo $rows['id_habilitacao'];?>"
													data-area="<?php echo $rows['area'];?>"
													data-id_area="<?php echo $rows['id_area'];?>"
													data-tipo="<?php echo $rows['tipo'];?>"
													data-descricao="<?php echo $rows['descricao'];?>"
													data-carga_horaria="<?php echo $rows['carga_horaria'];?>"
													data-ano_conclusao="<?php echo $rows['ano_conclusao'];?>"
													>
													<i class="fa fa-pencil"></i>
												</button>
												<!--botao Excluir-->
												<button form="formExcluir<?php echo $rows['id_habilitacao'];?>" type="submit" class="btn btn-xs btn-primary"
													data-tooltip="tooltip"
													data-toggle="confirmation"
													data-placement="left"
													data-btn-ok-label="Continuar"
													data-btn-ok-icon="glyphicon glyphicon-share-alt"
													data-btn-ok-class="btn-success"
													data-btn-cancel-label="Parar"
													data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
													data-btn-cancel-class="btn-danger"
													data-title="Excluir"
													data-content="Confirma?">
													<i class="fa fa-trash"></i>
												</button>
												<form id="formExcluir<?php echo $rows['id_habilitacao'];?>" action="controllers/usuario/habilitacao_alterar.php" method = "POST">
													<input type="hidden" name="flag" value="excluir" />
													<input type="hidden" name="flag1" value="<?php echo $pagina;?>" />
													<input type="hidden" name="id_habilitacao" value="<?php echo $rows['id_habilitacao'];?>" />
												</form>
											</td>
										</tr>
									<?php
									}
									?>
									</table>
								<!--</div>-->
							</div>
						<?php
						}
						else {?>
							<div class="info-box">
								<span class="info-box-icon bg-yellow"><i class="fa fa-warning"></i></span>
								<div class="info-box-content">
									<span class="info-box-number">Nenhuma habilitação cadastrada</span>
									<span class="info-box-text"><?php echo $status_alertas;?></span>
								</div>
							</div>
						<?php
						}?>
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
	<script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>
	<script src="componentes/externos/jquery/plugins/maskMoney/dist/jquery.maskMoney.min.js"></script>
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