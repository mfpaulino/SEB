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

$pagina_lock = str_replace('user.php?flag='.md5('mailbox_view').'_','',strtr(end(explode('/', $_SERVER['REQUEST_URI'])),'', true));

/*** redirecionamento ao sair da tela de bloqueio **/
if(isset($_GET['flag'])){

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
	}
	if(strpos($_GET['flag'],'view') !== false){
		header("Location:".$pagina_lock);
	}
}
/*** fim redirecionamento **/

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
				$active_home = 'class="active"';
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
				?>
				<!-- Inicio modalVisualizar-->
				<?php include_once('views/usuario/view_usuario_perfil.inc.php');?>
				<!-- Inicio modalEditar -->
				<?php include_once('views/usuario/form_usuario_alterar.inc.php');?>
				<!-- inicio alterar_senha -->
				<?php include_once('views/usuario/form_senha_alterar.inc.php');?>
				<!-- Inicio modalTrocarUnidade -->
				<?php include_once('views/usuario/form_unidade_alterar.inc.php');?>
				<!-- inicio alerta Sessao -->
				<?php include_once('views/usuario/view_usuario_alerta_sessao.inc.php');?>
				<!-- inicio alerta FimSessao -->
				<?php include_once('views/usuario/view_usuario_fim_sessao.inc.php');?>
				<!-- Inicio modalAlerta-->
				<?php include_once('views/usuario/view_usuario_alertas.inc.php');?>
				<?php if(isset($_SESSION['alterar_senha_logout']) or isset($_SESSION['alterar_codom'])){session_destroy();}//termina a sessao se alterar a senha?>
				<!--------------------------
				| Your Page Content Here |
				-------------------------->
			</section>
		</div>
		<?php include_once('componentes/internos/php/rodape.inc.php');?>
		<aside class="control-sidebar control-sidebar-dark">
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
				<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
				<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="control-sidebar-home-tab">
					<h3 class="control-sidebar-heading">Recent Activity</h3>
					<ul class="control-sidebar-menu">
						<li>
							<a href="javascript:;">
								<i class="menu-icon fa fa-birthday-cake bg-red"></i>
								<div class="menu-info">
									<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
									<p>Will be 23 on April 24th</p>
								</div>
							</a>
						</li>
					</ul>
					<h3 class="control-sidebar-heading">Tasks Progress</h3>
					<ul class="control-sidebar-menu">
						<li>
							<a href="javascript:;">
								<h4 class="control-sidebar-subheading">
									Custom Template Design
									<span class="pull-right-container">
										<span class="label label-danger pull-right">70%</span>
									</span>
								</h4>
								<div class="progress progress-xxs">
									<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
								</div>
							</a>
						</li>
					</ul>
				</div>
				<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
				<div class="tab-pane" id="control-sidebar-settings-tab">
					<form method="post">
						<h3 class="control-sidebar-heading">Perfil do Usuário</h3>
						<div class="form-group">
							<label class="control-sidebar-subheading">
								<a href="#" data-tooltip="tooltip" title="Exibir Perfil" data-toggle="modal" data-target="#modalVisualizar<?php echo $cpf; ?>">Exibir</a>
							</label>
							<label class="control-sidebar-subheading">
								<a href="#" data-toggle="modal" data-target="#modalEditar"
								data-tooltip="tooltip" title="Editar Perfil"
								data-toggle="modal"
								data-target="#modalEditar"
								data-cpf="<?php echo $cpf; ?>"
								data-rg="<?php echo $rg_usuario; ?>"
								data-id_posto="<?php echo $id_posto_usuario; ?>"
								data-posto="<?php echo $posto_usuario; ?>"
								data-nome_guerra="<?php echo $nome_guerra_usuario; ?>"
								data-nome="<?php echo $nome_usuario; ?>"
								data-email="<?php echo $email_usuario; ?>"
								data-ritex="<?php echo $ritex_usuario; ?>"
								data-celular="<?php echo $celular_usuario; ?>"
								data-id_perfil="<?php echo $id_perfil_usuario; ?>"
								data-perfil="<?php echo $perfil_usuario; ?>"
								data-unidade="<?php echo $sigla_usuario; ?>"
								data-avatar="<?php echo 'views/avatar/'.$avatar_usuario; ?>">
								Editar
								</a>
							</label>
							<label class="control-sidebar-subheading">
								<a href="#" data-tooltip="tooltip" title="O usuário deverá realizar novo login após alteração da senha!" data-toggle="modal" data-target="#modalTrocarSenha">Alterar senha</a>
							</label>
							<label class="control-sidebar-subheading">
								<a href="#" data-tooltip="tooltip" title="O usuário será desabilitado na Unidade atual e ficará aguardando habilitação na nova Unidade!" data-toggle="modal" data-target="#modalTrocarUnidade" data-unidade="<?php echo $sigla_usuario; ?>">
								Alterar Unidade
								</a>
							</label>
							<br />
							<p>
							O usuário poderá visualizar e/ou alterar as informações do seu perfil clicando nos links acima.
							</p>
						</div>
					</form>
				</div>
			</div>
		</aside>
		<div class="control-sidebar-bg"></div>
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