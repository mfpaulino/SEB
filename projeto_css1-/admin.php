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
				$active_admin = 'class="active"';
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
				}
				else {
					include_once('controllers/usuario/usuario_alertas_destruir.inc.php');
				}

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
				<!-- conteudo aqui -->
				<div class="row">
					<div class="col-md-6">
						<div class="box box-solid bg-olive collapsed-box">
							<div class="box-header">
								<i class="fa fa-globe"></i>
								<h3 class="box-title">Localidades</h3>
								<div class="pull-right box-tools">
									<div class="btn-group">
										<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><a href="#">Incluir Localidade</a></li>
											<li class="divider"></li>
											<li><a href="#">Imprimir</a></li>
										</ul>
									</div>
									<button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body no-padding" style="display:none;">
								<div id="calendar" style="width: 100%"></div>
							</div>
							<div class="box-footer text-black">
								<div class="row">
									<div class="col-sm-12">
										formulário aqui
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box box-solid bg-fuchsia collapsed-box">
							<div class="box-header">
								<i class="fa fa-money"></i>
								<h3 class="box-title">Valor Diárias</h3>
								<div class="pull-right box-tools">
									<div class="btn-group">
										<button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><a href="#">Incluir Diária</a></li>
											<li class="divider"></li>
											<li><a href="#">Imprimir</a></li>
										</ul>
									</div>
									<button type="button" class="btn btn-danger btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body no-padding" style="display:none;">
								<div id="calendar" style="width: 100%"></div>
							</div>
							<div class="box-footer text-black">
								<div class="row">
									<div class="col-sm-12">
										formulário aqui
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="box box-solid bg-orange collapsed-box">
							<div class="box-header">
								<i class="fa fa-globe"></i>
								<h3 class="box-title">Localidades</h3>
								<div class="pull-right box-tools">
									<div class="btn-group">
										<button type="button" class="btn bg-teal btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><a href="#">Incluir Localidade</a></li>
											<li class="divider"></li>
											<li><a href="#">Imprimir</a></li>
										</ul>
									</div>
									<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body no-padding" style="display:none;">
								<div id="calendar" style="width: 100%"></div>
							</div>
							<div class="box-footer text-black">
								<div class="row">
									<div class="col-sm-12">
										formulário aqui
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box box-solid bg-purple collapsed-box">
							<div class="box-header">
								<i class="fa fa-money"></i>
								<h3 class="box-title">Valor Diárias</h3>
								<div class="pull-right box-tools">
									<div class="btn-group">
										<button type="button" class="btn bg-blue btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><a href="#">Incluir Diária</a></li>
											<li class="divider"></li>
											<li><a href="#">Imprimir</a></li>
										</ul>
									</div>
									<button type="button" class="btn bg-blue btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn bg-blue btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body no-padding" style="display:none;">
								<div id="calendar" style="width: 100%"></div>
							</div>
							<div class="box-footer text-black">
								<div class="row">
									<div class="col-sm-12">
										formulário aqui
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="box box-solid bg-grey collapsed-box">
							<div class="box-header">
								<i class="fa fa-globe"></i>
								<h3 class="box-title">grey</h3>
								<div class="pull-right box-tools">
									<div class="btn-group">
										<button type="button" class="btn bg-yellow btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><a href="#">Incluir Localidade</a></li>
											<li class="divider"></li>
											<li><a href="#">Imprimir</a></li>
										</ul>
									</div>
									<button type="button" class="btn bg-yellow btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn bg-yellow btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body no-padding" style="display:none;">
							</div>
							<div class="box-footer text-black">
								<div class="row">
									<div class="col-sm-12">
										formulário aqui
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box box-solid bg-aqua collapsed-box">
							<div class="box-header">
								<i class="fa fa-money"></i>
								<h3 class="box-title">aqua</h3>
								<div class="pull-right box-tools">
									<div class="btn-group">
										<button type="button" class="btn bg-light-blue btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><a href="#">Incluir Diária</a></li>
											<li class="divider"></li>
											<li><a href="#">Imprimir</a></li>
										</ul>
									</div>
									<button type="button" class="btn bg-light-blue btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn bg-light-blue btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body no-padding" style="display:none;">
								<div id="calendar" style="width: 100%"></div>
							</div>
							<div class="box-footer text-black">
								<div class="row">
									<div class="col-sm-12">
										formulário aqui
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="box box-solid bg-navy collapsed-box">
							<div class="box-header">
								<i class="fa fa-globe"></i>
								<h3 class="box-title">Localidades</h3>
								<div class="pull-right box-tools">
									<div class="btn-group">
										<button type="button" class="btn bg-navy btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><a href="#">Incluir Localidade</a></li>
											<li class="divider"></li>
											<li><a href="#">Imprimir</a></li>
										</ul>
									</div>
									<button type="button" class="btn bg-navy btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn bg-navy btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body no-padding" style="display:none;">
								<div id="calendar" style="width: 100%"></div>
							</div>
							<div class="box-footer text-black">
								<div class="row">
									<div class="col-sm-12">
										formulário aqui
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box box-solid bg-black collapsed-box">
							<div class="box-header">
								<i class="fa fa-money"></i>
								<h3 class="box-title">Valor Diárias</h3>
								<div class="pull-right box-tools">
									<div class="btn-group">
										<button type="button" class="btn bg-light-blue btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
										<ul class="dropdown-menu pull-right" role="menu">
											<li><a href="#">Incluir Diária</a></li>
											<li class="divider"></li>
											<li><a href="#">Imprimir</a></li>
										</ul>
									</div>
									<button type="button" class="btn bg-light-blue btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
									<button type="button" class="btn bg-light-blue btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body no-padding" style="display:none;">
								<div id="calendar" style="width: 100%"></div>
							</div>
							<div class="box-footer text-black">
								<div class="row">
									<div class="col-sm-12">
										formulário aqui
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<?php include_once("views/admin/view_localidade.inc.php");?>
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
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/internos/js/status_menu_top.js"></script>
	<script src="componentes/internos/js/senha_alterar.js"></script>
	<script src="componentes/internos/js/usuario_alterar.js"></script>
	<script>
		//exibe o modal editar perfil
		$('#modalEditar').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var cpf = button.data('cpf') // Extract info from data-* attributes no script view_usuario_status.inc.php
			var rg = button.data('rg')
			var nome_guerra = button.data('nome_guerra')
			var nome = button.data('nome')
			var id_posto = button.data('id_posto')
			var posto = button.data('posto')
			var email = button.data('email')
			var ritex = button.data('ritex')
			var celular = button.data('celular')
			var unidade = button.data('unidade')
			var id_perfil = button.data('id_perfil')
			var perfil = button.data('perfil')
			var modal = $(this)

			modal.find('.modal-title').text('Editar Perfil')
			modal.find('#cpf').val(cpf)
			modal.find('#rg').val(rg)
			modal.find('#email').val(email)
			modal.find('#ritex').val(ritex)
			modal.find('#celular').val(celular)
			modal.find('#posto').val(id_posto)
			modal.find('#nome_guerra').val(nome_guerra)
			modal.find('#nome').val(nome)
			modal.find('#perfil').val(id_perfil)
		})
	</script>
	<script>
		//script para receber a selecao da unidade de controle interno e atualizar o 2º select
		$(document).ready(function(){
			$("select[name=unidade_ci]").change(function(){
				$("select[name=codom]").html('<option value="">Carregando...</option>');
				$.post("listas/select_unidade_usuario.inc.php", {unidade_ci:$(this).val()},function(valor){$("select[name=codom]").html(valor);})
			 })
		 })
	</script>
	<script>
		//exibe modal alterar unidade
		$('#modalTrocarUnidade').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var unidade = button.data('unidade')
			var modal = $(this)
			modal.find('.modal-title').text('Unidade atual: ' + unidade )
			modal.find('#unidade').val(unidade)
		})
	</script>
	<script>
		//verifica os dados ao confirmar alteracao de unidade
		$('[data-toggle="confirmation"]').confirmation({
			onConfirm: function() {
				$('#form_altera_unidade').bootstrapValidator({
					feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						unidade_ci: {
							validators: {
								notEmpty: {
									message:'preenchimento obrigatório'
								}
							}
						},
						codom: {
							validators: {
								notEmpty: {
									message:'preenchimento obrigatório'
								}
							}
						}
					}
				})
			}
		});
	</script>
	<script>
		//exibe os titles ao passar o mouse
		$(document).ready(function(){
			$('[data-tooltip="tooltip"]').tooltip();
		});
	</script>
	<script>
		//exibe a imagem do avatar
		var btnCust = '';
		$("#avatar-1").fileinput({
			overwriteInitial: true,
			maxFileSize: 1500,
			showClose: false,
			showCaption: false,
			showBrowse: false,
			browseOnZoneClick: false,
			removeLabel: '',
			removeIcon: '',
			removeTitle: '',
			elErrorContainer: '',
			msgErrorClass: '',
			defaultPreviewContent: '<img src="views/avatar/<?php echo $avatar_usuario;?>" style="width:160px">',
			layoutTemplates: {main2: '{preview}'},
			allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
	<script>
		//chama o script que avisa ao usuario_alterar.php que o avatar será excluído
		function chamarPhpAjax() {
		   $.ajax({
			  url:'controllers/usuario/usuario_excluir_avatar.php',
			  complete: function (response) {
				 alert('Confirme no botão enviar!');
			  }
		  });
		  return false;
		}
	</script>
	<script>
		//editar imagem do avatar
		var btnCust = '<button type="button" class="btn btn-secondary" title="Excluir imagem" ' +
			'onclick="return chamarPhpAjax();">' +
			'<i class="fa fa-trash"> </i>' +
			'</button>';
		$("#avatar").fileinput({
			overwriteInitial: true,
			maxFileSize: 1500,
			showClose: false,
			showCaption: false,
			showBrowse: false,
			browseOnZoneClick: true,
			elErrorContainer: '#kv-avatar-errors-2',
			msgErrorClass: 'alert alert-block alert-danger',
			defaultPreviewContent: '<img src="views/avatar/<?php echo $avatar_usuario;?>" alt="Sua Foto" style="width:160px"><h6 class="text-muted">clique para alterar<br />(Tam máx: 1500Kb)</h6>',
			layoutTemplates: {main2: '{preview} ' +  btnCust },
			allowedFileExtensions: ["jpg", "png", "gif"]
		});
	</script>
	<?php
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