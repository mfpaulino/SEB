<?php
/***********************************************************************************************************
* local/script name: ./ mailbox_view.php.php
* ler email
* **********************************************************************************************************/
$inc = "sim";
$pagina = strtr(end(explode('/', $_SERVER['REQUEST_URI'])),'', true);

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica.inc.php');
include_once(PATH . '/componentes/internos/php/funcoes.inc.php');

if(isset($_GET['flag'])){

	$id_correio = $_GET['flag'];
	$input_sent = $_GET['flag0'];

	if(strpos($_GET['flag1'],'?flag=') !== false){//se flag1=destiatario?flag=md5(usuario_alterar) veio da tela de editar perfil do usuario

		$de_para_tmp = str_replace('?flag=', '&flag=', $_GET['flag1']);//trocando o ?flag por &flag
		$de_para_tmp = explode('&flag=', $de_para_tmp);//divide o flag1 em duas partes
		$de_para = $de_para_tmp[0];//pega a parte do destinatario

		$pagina = "mailbox_view.php?flag=".$id_correio."&flag0=".$input_sent."&flag1=".$de_para;

		$_GET['flag'] = $de_para_tmp[1];//md5('usuario_alterar') para a tela de alertas
	}
	else{
		$de_para = $_GET['flag1'];
	}

	if($input_sent == "i" or $input_sent == "l"){//cx entrada ou ja_lidos

		$sql_msg = "SELECT ce.id_correio, ce.assunto, ce.texto, ce.remetente, ce.data, p.posto, u.nome_guerra, u.codom FROM correio_enviados ce, correio_recebidos cr, postos p, usuarios u WHERE ce.id_correio = cr.id_correio and p.id_posto = u.id_posto and ce.remetente = u.cpf  and ce.id_correio = '$id_correio'";
		$con_msg = $mysqli->query($sql_msg);
		$row_msg = $con_msg->fetch_assoc();

		$sql_sigla = "SELECT sigla FROM cciex_om WHERE codom = $row_msg[codom]";
		$con_sigla = $mysqli1->query($sql_sigla);
		$row_sigla = $con_sigla->fetch_assoc();
	}
	else{//cx enviados
		$sql_msg = "SELECT id_correio, assunto, texto, data FROM correio_enviados WHERE id_correio = '$id_correio'";
		$con_msg = $mysqli->query($sql_msg);
		$row_msg = $con_msg->fetch_assoc();
	}

	if($input_sent == 'i'){
		$sql_lida = "update correio_recebidos set lida = 'sim' where id_correio = $id_correio and destinatario = '$id_usuario'";
		$mysqli->query($sql_lida);

		$active_i = "class = active";
	}
	else if($input_sent == 's'){
		$active_s = "class = active";
	}
	else if($input_sent == 'l'){
		$active_l = "class = active";
	}
?>
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
					<li class="active">Ler</li>
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
				<!--------------------------
				| Inicio conteúdo         |
				-------------------------->
				<div class="row">
					<div class="col-md-3">
						<a href="mailbox_write.php" class="btn btn-primary btn-block margin-bottom"><i class="fa fa-pencil"></i> Escrever</a>
						<div class="box box-solid">
							<div class="box-header with-border">
								<h3 class="box-title">Pastas</h3>
							</div>
							<div class="box-body no-padding">
								<ul class="nav nav-pills nav-stacked">
									<li <?php echo $active_i;?>><a href="mailbox_input.php"><i class="fa fa-inbox"></i> Entrada<span class="label label-danger pull-right"><?php echo $qtde_entrada;?></span></a></li>
									<li <?php echo $active_l;?>><a href="mailbox_read.php"><i class="fa fa-envelope-open-o"></i> Já lidos<span class="label label-primary pull-right"><?php echo $qtde_lidas;?></span></a></li>
									<li <?php echo $active_s;?>><a href="mailbox_sent.php"><i class="fa fa-send-o"></i> Enviados<span class="label label-success pull-right"><?php echo $qtde_enviadas;?></span></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="box box-primary">
							<div class="box-header with-border">
							  <h3 class="box-title">Ler Mensagem</h3>
							</div>
							<div id="area_print">
								<div class="box-body no-padding">
									<div class="mailbox-read-info">
										<h3><?php echo $row_msg['assunto'];?></h3>
										<h5>
											<?php
											if ($input_sent == 'i' or $input_sent == 'l'){?>
												De:
											<?php
											}
											else if ($input_sent == 's'){?>
												Para:
											<?php
											}
											echo $de_para;
											?>
											<span class="mailbox-read-time pull-right">
												<?php
												if(date('d/m/Y') - 1 == date('d/m/Y', strtotime($row_msg['data']))){
													$data = "Ontem " . date('H:i',strtotime($row_msg['data']));
												}
												else if(date('d/m/Y') == date('d/m/Y', strtotime($row_msg['data']))){
													$data = "Hoje " . date('H:i',strtotime($row_msg['data']));
												}
												else{
													$data = date('d/m/Y H:i', strtotime($row_msg['data']));
												}
												echo $data;
												?>
											</span>
										</h5>
									</div>
									<div class="mailbox-read-message">
										<?php echo $row_msg['texto'];?>
									</div>
								</div>
							</div>
							<div class="box-footer">
								<div class="pull-right">
									<?php
									if($input_sent == 'i' or $input_sent == 'l'){?>
										<button type="submit" class="btn btn-default" form="formResponder"><i class="fa fa-reply"></i> Responder</button>
									<?php
									}
									?>
									<button type="submit" class="btn btn-default" form="formEncaminhar"><i class="fa fa-share"></i> Encaminhar</button>
								</div>
								<?php
								if($input_sent == 'i'){?>
									<a href="controllers/correio/correio_mover.php?flag=<?php echo $id_correio;?>" class="btn btn-default"><i class="fa fa-envelope-open-o"></i> Mover para Já lidos</a>
								<?php
								}
								?>
								<a class="btn btn-default"
								data-toggle="confirmation"
								data-placement="left"
								data-btn-ok-label="Continuar"
								data-btn-ok-icon="glyphicon glyphicon-share-alt"
								data-btn-ok-class="btn-success"
								data-btn-cancel-label="Parar"
								data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
								data-btn-cancel-class="btn-danger"
								data-title="Confirma exclusão da mensagem?"
								data-content="" href="controllers/correio/correio_excluir.php?flag=<?php echo $id_correio;?>&flag0=<?php echo $input_sent;?>">
								<i class="fa fa-trash-o"></i> Excluir
								</a>
								<button id="btnPrint" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>
								<form name="formResponder" id="formResponder" method="POST" action="mailbox_write.php">
									<input type="hidden" name="flag" value="resp" />
									<input type="hidden" name="assunto" value="<?php echo 'RE: '.$row_msg['assunto'];?>" />
									<input type="hidden" name="texto" value="<?php echo $row_msg['texto'];?>" />
									<input type="hidden" name="destinatario" value="<?php echo $de_para;?>" />
									<input type="hidden" name="cpf_destinatario" value="<?php echo $row_msg['remetente'];?>" />
								</form>
								<form name="formEncaminhar" id="formEncaminhar" method="POST" action="mailbox_write.php">
									<input type="hidden" name="flag" value="enc" />
									<input type="hidden" name="assunto" value="<?php echo 'ENC: '.$row_msg['assunto'];?>" />
									<input type="hidden" name="texto" value="<?php echo $row_msg['texto'];?>" />
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--------------------------
				| Final conteúdo         |
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
	?>
	<script>
		//exibe text editor
		$(function () {
			$("#compose-textarea").wysihtml5();
		});
	</script>
	<script>
		//imprimir email
		document.getElementById('btnPrint').onclick = function() {
			var conteudo = document.getElementById('area_print').innerHTML;
			var	tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
			tela_impressao.document.write(conteudo);
			tela_impressao.window.print();
			tela_impressao.window.close();
		};
	</script>
</body>
</html>
<?php
}
else {
	include_once(PATH . '/controllers/autenticacao/'.ACESSO_NEGADO);
}
?>