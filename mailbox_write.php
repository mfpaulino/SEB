<?php
/***********************************************************************************************************
* local/script name: ./mailbox_write.php
* escrever email
* **********************************************************************************************************/
$inc = "sim";
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica.inc.php');
include_once(PATH . '/componentes/internos/php/funcoes.inc.php');

$sql_destinatario = "SELECT id_usuario, nome_guerra, p.posto, codom from usuarios, postos p where usuarios.cpf <> '$cpf' and usuarios.status = 'habilitado' and usuarios.id_posto = p.id_posto order by p.id_posto, codom";
$con_destinatario = $mysqli->query($sql_destinatario);

if(isset($_POST['cpf_destinatario'])){
	$con_destinatario = $mysqli->query("SELECT id_usuario FROM usuarios WHERE cpf = '$_POST[cpf_destinatario]'");
	$row_destinatario = $con_destinatario->fetch_assoc();
}
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
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-validator/css/bootstrapValidator.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
	<link rel="stylesheet" href="componentes/externos/bootstrap/plugins/bootstrap-select/dist/css/bootstrap-select.css">
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
				$active_correio = 'class="active"';
				include_once('views/menu/menu_left.inc.php');
				?>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>Correio</h1>
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
					<li class="active">Correio</li>
					<li class="active">Escrever</li>
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

				include_once('user_modais.inc.php');//modais do menu à direita

				if(isset($_SESSION['alterar_senha_logout']) or isset($_SESSION['alterar_codom'])){
					session_destroy();
				}
				?>
				<!-------------------------
				| Inicio Conteúdo         |
				-------------------------->
				<div class="row">
					<div class="col-md-3">
						<a href="mailbox.html" class="btn btn-primary btn-block margin-bottom disabled"><i class="fa fa-pencil"></i> Escrever</a>
						<div class="box box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">Pastas</h3>
							</div>
							<div class="box-body no-padding">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="mailbox_input.php"><i class="fa fa-inbox"></i> Entrada<span class="label label-danger pull-right"><?php echo $qtde_entrada;?></span></a></li>
									<li><a href="mailbox_read.php"><i class="fa fa-envelope-open-o"></i> Já lidas<span class="label label-primary pull-right"><?php echo $qtde_lidas;?></span></a></li>
									<li><a href="mailbox_sent.php"><i class="fa fa-send-o"></i> Enviadas<span class="label label-success pull-right"><?php echo $qtde_enviadas;?></span></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="box box-primary">
							<div class="box-header with-border">
								<?php
								if(isset($_POST['flag'] ) and $_POST['flag'] == 'resp'){?>
									<h3 class="box-title">Responder Mensagem</h3>
								<?php
								}
								else if (isset($_POST['flag'] ) and $_POST['flag'] == 'enc'){?>
									<h3 class="box-title">Encaminhar Mensagem</h3>
								<?php
								}
								else {?>
									<h3 class="box-title">Nova Mensagem</h3>

								<?php
								}
								?>
							</div>
							<form name="form_correio_cadastrar" id="form_correio_cadastrar" method = "POST" action = "controllers/correio/correio_cadastrar.php">
								<div class="box-body">
									<div class="form-group">
										<?php
										if(isset($_POST['destinatario'])){?>
											<input class="form-control" disabled value="<?php echo $_POST['destinatario'];?>">
											<input type="hidden" name="destinatario[]" value = "<?php echo $row_destinatario['id_usuario'];?>" />
										<?php
										}
										else {?>
											<select name="destinatario[]" id="destinatario" class="form-control" multiple="multiple" data-placeholder = " Para:">
												<?php
												while($row = $con_destinatario->fetch_assoc()){
													$sql_sigla = "select sigla from cciex_om where codom = '$row[codom]' limit 1";
													$con_sigla = $mysqli1->query($sql_sigla);
													$row_sigla = $con_sigla->fetch_assoc();?>
													<option value="<?php echo $row['id_usuario'];?>"><?php echo $row['posto'] . " " . $row['nome_guerra'] . " - " . $row_sigla['sigla'];?></option>
												<?php
												}
												?>
											</select>
										<?php
										}
										?>
									</div>
									<div class="form-group">
										<input name="assunto" class="form-control" placeholder="Assunto:" value="<?php echo $_POST['assunto'];?>" autofocus />
									</div>
									<div class="form-group">
										<textarea name="texto" id="texto" placeholder="Digite a mensagem..." class="textarea form-control" style="height: 300px"><?php echo $_POST['texto'];?></textarea>
									</div>
								</div>
								<input name="flag" type="hidden" />
								<div class="box-footer">
									<div class="pull-right">
										<button type="submit" class="btn btn-success"><i class="fa fa-send-o"></i> Enviar</button>
										<a href="mailbox_input.php" class="btn btn-danger"><i class="fa fa-close"></i>  Cancelar</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-------------------------
				| Final Conteúdo          |
				-------------------------->
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
	<script src="componentes/externos/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>
	<script src="componentes/internos/js/senha_alterar.js"></script>
	<script src="componentes/internos/js/usuario_alterar.js"></script>
	<script src="componentes/internos/js/correio_cadastrar.js"></script>
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/internos/js/status_menu_top.js"></script>
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
	<script type="text/javascript">
		$(document).ready(function() {
			$('#destinatario').multiselect({
				inheritClass: true,
				includeSelectAllOption: true,
				enableFiltering: true,
				selectAllJustVisible: true, //ao clicar em todos, seleciona todos os visiveis pelo filtro. Se false, seleciona todos independente do filtro
			});
		});
	</script>
</body>
</html>