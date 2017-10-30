<?php
/***********************************************************************************************************
* local/script name: ./mailbox_sent.php
* caixa enviados
* **********************************************************************************************************/
$inc = "sim";
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica.inc.php');

/**********************************************************************************************
verifica se tem alguma msg excluida que nao possui correspondente na tabela de recebidos.
caso tenha, exclui definitivamente da tabela de enviados*/

$con_del = $mysqli->query("DELETE FROM correio_enviados WHERE excluida = 'sim' AND id_correio NOT IN (SELECT id_correio FROM correio_recebidos)");

/**********************fim*********************************************************/

$sql = "SELECT id_correio, assunto, texto, destinatario, data FROM correio_enviados WHERE remetente = '$cpf' and excluida = 'nao' ORDER BY data desc";

/** paginacao **/
$total_reg = "10";//registros por pagina

$pag=$_GET['pagina'];
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

/** fim paginacao **/
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
				include_once('views/menu/menu_left.inc.php');?>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>Correio </h1>
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
					<li class="active">Correio</li>
					<li class="active">Enviados</li>
				</ol>
			</section>
			<section class="content container-fluid">
				<?php
				if (isset($_GET['flag']) and ($_GET['flag'] == md5("usuario_alterar") or $_GET['flag'] == md5("senha_alterar") or $_GET['flag'] == md5("om_alterar") or $_GET['flag'] == md5("logout") )){
					include_once('controllers/usuario/usuario_alertas_criar.inc.php');
				}
				else {
					include_once('controllers/usuario/usuario_alertas_destruir.inc.php');
				}
				if (isset($_GET['flag']) and ($_GET['flag'] == md5("correio_cadastrar") or $_GET['flag'] == md5("correio_excluir") )){
					include_once('controllers/correio/correio_alertas_criar.inc.php');
				}
				else {
					include_once('controllers/correio/correio_alertas_destruir.inc.php');
				}

				include_once('views/correio/view_correio_alertas.inc.php');
				include_once('views/usuario/view_usuario_perfil.inc.php');
				include_once('views/usuario/form_usuario_alterar.inc.php');
				include_once('views/usuario/form_senha_alterar.inc.php');
				include_once('views/usuario/form_unidade_alterar.inc.php');
				include_once('views/usuario/view_usuario_alerta_sessao.inc.php');
				include_once('views/usuario/view_usuario_fim_sessao.inc.php');
				include_once('views/usuario/view_usuario_alertas.inc.php');

				if(isset($_SESSION['alterar_senha_logout']) or isset($_SESSION['alterar_codom'])){
					session_destroy();
				}
				?>
				<!--------------------------
				| Inicio conteúdo          |
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
									<li><a href="mailbox_input.php"><i class="fa fa-inbox"></i> Entrada<span class="label label-danger pull-right"><?php echo $qtde_entrada;?></span></a></li>
									<li><a href="mailbox_read.php"><i class="fa fa-envelope-open-o"></i> Já lidos<span class="label label-primary pull-right"><?php echo $qtde_lidas;?></span></a></li>
									<li class="active disabled"><a href="mailbox_sent.php"><i class="fa fa-send-o"></i> Enviados<span class="label label-success pull-right"><?php echo $qtde_enviadas;?></span></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Enviados</h3>
							</div>
							<div class="box-body no-padding">
							<?php
							if ($total_msg > 0) {?>
								<div class="mailbox-controls">
									<button  class="btn btn-default btn-sm checkbox-toggle" title="Selecionar todas"><i class="fa fa-square-o"></i></button>
									<button type="submit" form="form_excluir_lote"  class="btn btn-default btn-sm"
										data-toggle="confirmation"
										data-placement="top"
										data-btn-ok-label="Continuar"
										data-btn-ok-icon="glyphicon glyphicon-share-alt"
										data-btn-ok-class="btn-success"
										data-btn-cancel-label="Parar"
										data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
										data-btn-cancel-class="btn-danger"
										data-title="Confirma exclusão?"
										data-content="">
										<i class="fa fa-trash"></i>
									</button>
									<a href="<?php echo $pagina;?>"  class="btn btn-default btn-sm" title="Atualizar"><i class="fa fa-refresh"></i></a>
									&nbsp;&nbsp;&nbsp;<b>Legenda:</b>&nbsp;
									<i class="fa fa-check-circle text-success"></i> Foi lido por todos os destinatários
									&nbsp;
									<i class="fa fa-info-circle text-danger"></i> Ainda não foi lido por todos os destinatários (Passe o mouse sobre o ícone para mais informações)
									<div class="pull-right">
										<?php echo $pag."-".$total_pag."/".$total_msg;?>
										<div class="btn-group">
											<?php
											if ($pag == 1) {?>
												<button class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-left"></i></button>
											<?php
											}
											?>
											<?php
											if ($pag > 1) {?>
												<a href="?pagina=<?php echo $anterior;?>"  class="btn btn-default btn-sm" title="Página anterior"><i class="fa fa-chevron-left"></i></a>
											<?php
											}
											if ($pag < $total_pag) {?>
												<a href="?pagina=<?php echo $proximo;?>"  class="btn btn-default btn-sm" title="Próxima página"><i class="fa fa-chevron-right"></i></a>
											<?php
											}
											?>
											<?php
											if ($pag == $total_pag) {?>
												<button class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-right"></i></button>
											<?php
											}
											?>
										</div>
									</div>
								</div>
							<?php
							}
							?>
							<div class="table-responsive mailbox-messages">
								<table class="table table-hover table-striped">
								<tbody>
									<form name='form_excluir_lote' id='form_excluir_lote' method='post' action='controllers/correio/correio_excluir_lote.php'>
									<?php
									while($row_enviados = $con_limite->fetch_assoc()){

										if(date('d/m/Y') - 1 == date('d/m/Y', strtotime($row_enviados['data']))){
											$data = "Ontem " . date('H:i',strtotime($row_enviados['data']));
										}
										else if(date('d/m/Y') == date('d/m/Y', strtotime($row_enviados['data']))){
											$data = "Hoje " . date('H:i',strtotime($row_enviados['data']));
										}
										else{
											$data = date('d/m/Y H:i', strtotime($row_enviados['data']));
										}

										$qtde = substr_count($row_enviados['destinatario'], ";");
										$lista_destinatario = explode(";", $row_enviados['destinatario']);

										$destinatario = "";
										$qtde_lidos = 0;
										$lidos = "";

										for($i = 0; $i < $qtde; $i++){

											$sql_destinatario = "SELECT id_usuario, codom, nome_guerra, p.posto from usuarios, postos p where usuarios.id_usuario = '$lista_destinatario[$i]' and usuarios.id_posto = p.id_posto order by p.id_posto";
											$con_destinatario = $mysqli->query($sql_destinatario);
											$row_destinatario = $con_destinatario->fetch_assoc();

											$sql_sigla = "SELECT sigla FROM cciex_om WHERE codom = '$row_destinatario[codom]' limit 1";
											$con_sigla = $mysqli1->query($sql_sigla);
											$row_sigla = $con_sigla->fetch_assoc();

											$destinatario = $destinatario . "[".$row_destinatario['posto']." ". $row_destinatario['nome_guerra']." - ".$row_sigla['sigla']."] ";

											/**** exibe um tooltip mouseover no destinatario, informando quem já leu o correio*****/
											$sql_lidos = "SELECT u.id_usuario, r.destinatario, u.codom, u.nome_guerra, p.posto, r.lida FROM correio_recebidos r, correio_enviados e, usuarios u, postos p where r.id_correio = '$row_enviados[id_correio]' and r.lida = 'nao' and u.id_usuario = r.destinatario and r.destinatario = '$lista_destinatario[$i]' and u.id_posto = p.id_posto";
											$con_lidos = $mysqli->query($sql_lidos);
											$row_lidos = $con_lidos->fetch_assoc();

											$qtde_lidos = $qtde_lidos + $con_lidos->num_rows;

											$sql_sigla_lidos = "SELECT sigla FROM cciex_om WHERE codom = '$row_lidos[codom]' limit 1";
											$con_sigla_lidos = $mysqli1->query($sql_sigla_lidos);
											$row_sigla_lidos = $con_sigla_lidos->fetch_assoc();

											if($qtde_lidos == 0){
												$lidos = "";
												$fa_icon = "fa fa-check-circle text-success";
												$b="";
												$b1="";
												//$cor = "style=color:green;'";
												$aviso_leitura = "Este correio foi lido por todos os destinatários.";
											}
											else {
												$lidos = str_replace("[  - ]","",$lidos . "[".$row_lidos['posto']." ". $row_lidos['nome_guerra']." - ".$row_sigla_lidos['sigla']."] ");
												$fa_icon="fa fa-info-circle text-danger";
												$b="<b>";
												$b1="</b>";
												//$cor = "style=color:orange;'";
												$aviso_leitura = "Quem ainda não leu: ".$lidos;
											}
											/**********************************/
										}
										echo "
										<tr>
											<td>
												<input type='checkbox' name='id_correio[]' value = '$row_enviados[id_correio]' />
												<input type='hidden' name='input_sent' value='s' />
												<input type='hidden' name='pagina' value='$pagina' />
												<input type='hidden' name='flag' />
											</td>
											<td>
												<a href='mailbox_view.php?flag=$row_enviados[id_correio]&flag0=s&flag1=$destinatario' title='$aviso_leitura'>
													<i class='$fa_icon' $cor></i>
												</a>
											</td>
											<td class='mailbox-name'>
												<a href='mailbox_view.php?flag=$row_enviados[id_correio]&flag0=s&flag1=$destinatario' title='$aviso_leitura' >$destinatario</a>
											</td>
											<td class='mailbox-subject'>
												<a href='mailbox_view.php?flag=$row_enviados[id_correio]&flag0=s&flag1=$destinatario' title='$aviso_leitura' >$row_enviados[assunto]</a>
											</td>
											<td class='mailbox-date'>
												<a href='mailbox_view.php?flag=$row_enviados[id_correio]&flag0=s&flag1=$destinatario' title='$aviso_leitura' >$data</a>
											</td>
										</tr>"
										;
									}
									?>
									</form>
								</tbody>
								</table>
							</div>
						</div>
						<div class="box-footer no-padding">
							<?php
							if ($total_msg > 0) {?>
								<div class="mailbox-controls">
									<button  class="btn btn-default btn-sm checkbox-toggle" title="Selecionar todas"><i class="fa fa-square-o"></i></button>
									<button  type="submit" form="form_excluir_lote" class="btn btn-default btn-sm"
										data-toggle="confirmation"
										data-placement="bottom"
										data-btn-ok-label="Continuar"
										data-btn-ok-icon="glyphicon glyphicon-share-alt"
										data-btn-ok-class="btn-success"
										data-btn-cancel-label="Parar"
										data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
										data-btn-cancel-class="btn-danger"
										data-title="Confirma exclusão?"
										data-content="">
										<i class="fa fa-trash"></i>
									</button>
									<a href="<?php echo $pagina;?>"  class="btn btn-default btn-sm" title="Atualizar"><i class="fa fa-refresh"></i></a>
									&nbsp;&nbsp;&nbsp;<b>Legenda:</b>&nbsp;
									<i class="fa fa-check-circle text-success"></i> Foi lido por todos os destinatários
									&nbsp;
									<i class="fa fa-info-circle text-danger"></i> Ainda não foi lido por todos os destinatários (Passe o mouse sobre o ícone para mais informações)
									<div class="pull-right">
										<?php echo $pag."-".$total_pag."/".$total_msg;?>
										<div class="btn-group">
											<?php
											if ($pag == 1) {?>
												<button class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-left"></i></button>
											<?php
											}
											?>
											<?php
											if ($pag > 1) {?>
												<a href="?pagina=<?php echo $anterior;?>"  class="btn btn-default btn-sm" title="Página anterior"><i class="fa fa-chevron-left"></i></a>
											<?php
											}
											if ($pag < $total_pag) {?>
												<a href="?pagina=<?php echo $proximo;?>"  class="btn btn-default btn-sm" title="Próxima página"><i class="fa fa-chevron-right"></i></a>
											<?php
											}
											?>
											<?php
											if ($pag == $total_pag) {?>
												<button class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-right"></i></button>
											<?php
											}
											?>
										</div>
									</div>
								</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
				<!--------------------------
				| Final conteúdo          |
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
	<script src="componentes/externos/bootstrap/plugins/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
	<script src="componentes/externos/bootstrap/plugins/iCheck/icheck.min.js"></script>
	<script src="componentes/externos/template/js/adminlte.min.js"></script>
	<script src="componentes/internos/js/senha_alterar.js"></script>
	<script src="componentes/internos/js/usuario_alterar.js"></script>
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/internos/js/status_menu_top.js"></script>
	<script src="componentes/internos/js/modal_editar_perfil.js"></script>
	<script src="componentes/internos/js/modal_editar_unidade.js"></script>
	<script>
		//exibe os titles ao passar o mouse
		$(document).ready(function(){
			$('[data-tooltip="tooltip"]').tooltip();
		});
	</script>
	<script>
		$(function () {
			//seleciona todos checkbox, habilita/desabilita o botao de exclusao
			$(".checkbox-toggle").click(function () {
				var clicks = $(this).data('clicks');
				if (clicks) {
					//Uncheck all checkboxes
					$(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
					$(".fa", ".checkbox-toggle").removeClass("fa-check-square-o").addClass('fa-square-o');
				}
				else {
					//Check all checkboxes
					$(".mailbox-messages input[type='checkbox']").iCheck("check");
					$(".fa", ".checkbox-toggle").removeClass("fa-square-o").addClass('fa-check-square-o');
				}
				$(this).data("clicks", !clicks);
			});
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
