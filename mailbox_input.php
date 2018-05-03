<?php
/***********************************************************************************************************
* local/script name: ./mailbox_input.php
* caixa de entrada
* **********************************************************************************************************/
$inc = "sim";
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica.inc.php');
include_once(PATH . '/componentes/internos/php/funcoes.inc.php');

$sql = "SELECT ce.id_correio, ce.assunto, ce.texto, ce.data, cr.lida, p.posto, u.nome_guerra, u.codom FROM correio_enviados ce, correio_recebidos cr, postos p, usuarios u WHERE cr.destinatario = '$id_usuario' and cr.pasta = 'entrada' and ce.id_correio = cr.id_correio and ce.remetente = u.cpf and p.id_posto = u.id_posto  ORDER BY ce.data desc";

/** paginacao **/
$total_reg = "10";//registros por pagina

$pag = $_GET['pagina'];
if (!$pag) {
	$pag = "1";
}
else {
	$pag = $pag;
}

$inicio = $pag - 1;
$inicio = $inicio * $total_reg;

$con_limite = $mysqli->query("$sql LIMIT $inicio,$total_reg");
$con_todos =  $mysqli->query($sql);

$total_msg = $con_todos->num_rows; // verifica o número total de registros
$total_pag = ceil($total_msg / $total_reg); // calcula e arredonda pra cima o número total de páginas

// agora vamos criar os botões "Anterior e próximo"
$anterior = $pag -1;
$proximo = $pag +1;

/** fim paginacao**/
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
					<li class="active">Entrada</li>
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
				if (isset($_GET['flag']) and ($_GET['flag'] == md5("correio_mover") or $_GET['flag'] == md5("correio_excluir") )){
					include_once('controllers/correio/correio_alertas_criar.inc.php');
				}
				else {
					include_once('controllers/correio/correio_alertas_destruir.inc.php');
				}

				include_once('views/correio/view_correio_alertas.inc.php');

				include_once('user_modais.inc.php');//modais do menu à direita

				if(isset($_SESSION['alterar_senha_logout']) or isset($_SESSION['alterar_codom'])){
					session_destroy();
				}
				?>
				<!------------------------
				| Your Page Content Here |
				-------------------------->
				<div class="row">
					<div class="col-md-3">
						<a href="mailbox_write.php" class="btn btn-primary btn-block margin-bottom" title="Nova Mensagem"><i class="fa fa-pencil"></i> Escrever</a>
						<div class="box box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">Pastas</h3>
							</div>
							<div class="box-body no-padding">
								<ul class="nav nav-pills nav-stacked">
									<li class="active disabled"><a href="mailbox_input.php"><i class="fa fa-inbox"></i> Entrada<span class="label label-danger pull-right"><?php echo $qtde_entrada;?></span></a></li>
									<li><a href="mailbox_read.php"><i class="fa fa-envelope-open-o"></i> Já lidos<span class="label label-primary pull-right"><?php echo $qtde_lidas;?></span></a></li>
									<li><a href="mailbox_sent.php"><i class="fa fa-send-o"></i> Enviados<span class="label label-success pull-right"><?php echo $qtde_enviadas;?></span></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Entrada</h3>
							</div>
							<div class="box-body no-padding">
								<?php if ($total_msg > 0) {?>
									<div class="mailbox-controls">
										<a href="<?php echo $pagina;?>"  class="btn btn-default btn-sm" title="Atualizar"><i class="fa fa-refresh"></i></a>
										<div class="pull-right">
											<?php echo $pag."-".$total_pag."/".$total_msg;?>
											<div class="btn-group">
												<?php if ($pag == 1) {?>
													<button class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-left"></i></button>
												<?php }
												if ($pag > 1) {?>
													<a href="?pagina=<?php echo $anterior;?>"  class="btn btn-default btn-sm" title="Página anterior"><i class="fa fa-chevron-left"></i></a>
												<?php }
												if ($pag < $total_pag) {?>
													<a href="?pagina=<?php echo $proximo;?>"  class="btn btn-default btn-sm" title="Próxima página"><i class="fa fa-chevron-right"></i></a>
												<?php }
												if ($pag == $total_pag) {?>
													<button class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-right"></i></button>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php } ?>
								<div class="table-responsive mailbox-messages">
									<table class="table table-hover table-striped">
									<tbody>
										<?php
										while($row_recebidos = $con_limite->fetch_assoc()){

											if ($row_recebidos['lida'] == 'nao'){
												$b="<b>";
												$b1="</b>";
												$fa_icon = "fa fa-envelope text-primary";
												//$cor = "style=color:blue;'";
												$aviso_leitura = "Correio ainda não lido";
											}
											else{
												$b="";
												$b1="";
												$fa_icon = "fa fa-envelope-open-o text-primary";
												//$cor = "style=color:green;'";
												$aviso_leitura = "Correio já lido";
											}

											$sql_sigla = "SELECT sigla FROM cciex_om WHERE codom = '$row_recebidos[codom]' limit 1";
											$con_sigla = $mysqli1->query($sql_sigla);
											$row_sigla = $con_sigla->fetch_assoc();

											if(date('d/m/Y') - 1 == date('d/m/Y', strtotime($row_recebidos['data']))){
												$data = "Ontem " . date('H:i',strtotime($row_recebidos['data']));
											}
											else if(date('d/m/Y') == date('d/m/Y', strtotime($row_recebidos['data']))){
												$data = "Hoje " . date('H:i',strtotime($row_recebidos['data']));
											}
											else{
												$data = date('d/m/Y H:i', strtotime($row_recebidos['data']));
											}

											$remetente = $row_recebidos['posto']." ". $row_recebidos['nome_guerra']." - ".$row_sigla['sigla'];
											echo "
											<tr>
												<td></td>
												<td>
													<a href='mailbox_view.php?flag=$row_recebidos[id_correio]&flag0=i&flag1=$remetente' title='$aviso_leitura'>
														<i class='$fa_icon' $cor ></i>
													</a></td>
												<td class='mailbox-name'>
													<a href='mailbox_view.php?flag=$row_recebidos[id_correio]&flag0=i&flag1=$remetente' title='$aviso_leitura'>$b$remetente$b1</a>
												</td>
												<td class='mailbox-subject'>
													<a href='mailbox_view.php?flag=$row_recebidos[id_correio]&flag0=i&flag1=$remetente' title='$aviso_leitura'>$b$row_recebidos[assunto]$b1</a>
												</td>
												<td class='mailbox-date'>
													<a href='mailbox_view.php?flag=$row_recebidos[id_correio]&flag0=i&flag1=$remetente' title='$aviso_leitura'>$b$data$b1</a>
												</td>
											</tr>"
											;
										}
										?>
									</tbody>
									</table>
								</div>
							</div>
							<div class="box-footer no-padding">
								<?php if ($total_msg > 0) {?>
									<div class="mailbox-controls">
										<a href="<?php echo $pagina;?>"  class="btn btn-default btn-sm" title="Atualizar"><i class="fa fa-refresh"></i></a>
										<div class="pull-right">
											<?php echo $pag."-".$total_pag."/".$total_msg;?>
											<div class="btn-group">
												<?php if ($pag == 1) {?>
													<button class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-left"></i></button>
												<?php }
												if ($pag > 1) {?>
													<a href="?pagina=<?php echo $anterior;?>"  class="btn btn-default btn-sm" title="Página anterior"><i class="fa fa-chevron-left"></i></a>
												<?php }
												if ($pag < $total_pag) {?>
													<a href="?pagina=<?php echo $proximo;?>"  class="btn btn-default btn-sm" title="Próxima página"><i class="fa fa-chevron-right"></i></a>
												<?php }
												if ($pag == $total_pag) {?>
													<button class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-right"></i></button>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
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
	<script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js"></script>
	<script src="componentes/externos/bootstrap/plugins/bootstrap-select/dist/js/bootstrap-select.js"></script>
    <script src="componentes/externos/bootstrap/plugins/jquery-maskedinput/dist/jquery.maskedinput.js"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>
	<script src="componentes/internos/js/senha_alterar.js"></script>
	<script src="componentes/internos/js/usuario_alterar.js"></script>
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
	if ($msg_correio <> ""){?>
		<script>
			//exibe o modal de alertas correio
			$(document).ready(function(){
				$('#modalAlertaCorreio').modal('show');
			});
		</script>
	<?php
	}
	?>
</body>
</html>