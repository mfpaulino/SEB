<?php
/***********************************************************************************************************
* local/script name: ./mailbox.php
* **********************************************************************************************************/
$inc = "sim";
$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);

include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica.inc.php');

$sql_destinatario = "SELECT id_usuario, nome_guerra, p.posto, codom from usuarios, postos p where usuarios.cpf <> '$cpf' and usuarios.status = 'habilitado' and usuarios.id_posto = p.id_posto order by p.id_posto, codom";
$con_destinatario = $mysqli->query($sql_destinatario);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo TITULO;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="componentes/externos/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="componentes/externos/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="componentes/externos/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="componentes/externos/bower_components/bootstrap-fileinput/css/fileinput.min.css">
  <link rel="stylesheet" href="componentes/externos/dist/css/skins/skin-blue.css">
  <link rel="stylesheet" href="componentes/internos/css/siaudi.css">
  <link rel="stylesheet" href="componentes/externos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">
  <link rel="stylesheet" href="componentes/externos/plugins/bootstrap-chosen/bootstrap-chosen.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<?php include_once('componentes/internos/php/cabecalho.inc.php');?>
	<div class="wrapper">
<!-- Main Header -->
		<header class="main-header">
			<!-- Logo -->
			<a href="index.php" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>...</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg barra-top"><b>SIAUD</b>-EB</span>
			</a>
			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->
						<li class="dropdown messages-menu">
							<!-- Menu toggle button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="label label-primary">44</span></a>
							<ul class="dropdown-menu">
								<li class="header">You have 4 messages</li>
								<li>
									<!-- inner menu: contains the messages -->
									<ul class="menu">
										<!-- start message -->
										<li>
											<a href="#">
												<div class="pull-left">
													<!-- User Image -->
													<img src="componentes/externos/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
												</div>
												<!-- Message title and timestamp -->
												<h4>
													Support Team
													<small><i class="fa fa-clock"></i> 5 mins</small>
												</h4>
												<!-- The message -->
												<p>Why not buy a new awesome theme?</p>
											</a>
										</li>
										<!-- end message -->
									</ul>
									<!-- /.menu -->
								</li>
								<li class="footer"><a href="#">See All Messages</a></li>
							</ul>
						</li>
						<!-- /.messages-menu -->
						<!-- Notifications Menu -->
						<li class="dropdown notifications-menu">
							<!-- Menu toggle button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="label label-warning">10</span></a>
							<ul class="dropdown-menu">
								<li class="header">You have 10 notifications</li>
								<li>
									<!-- Inner Menu: contains the notifications -->
									<ul class="menu">
										<li>
											<!-- start notification -->
											<a href="#">
											  <i class="fa fa-users text-aqua"></i> 5 new members joined today
											</a>
											<!-- end notification -->
										</li>
									</ul>
								</li>
								<li class="footer"><a href="#">View all</a></li>
							</ul>
						</li>
						<!-- Tasks Menu -->
						<li class="dropdown tasks-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag"></i><span class="label label-danger">9</span></a>
							<ul class="dropdown-menu">
								<li class="header">You have 9 tasks</li>
								<li>
									<!-- Inner menu: contains the tasks -->
									<ul class="menu">
										<li>
											<!-- Task item -->
											<a href="#">
												<!-- Task title and progress text -->
												<h3>Design some buttons<small class="pull-right">20%</small></h3>
												<!-- The progress bar -->
												<div class="progress xs">
													<!-- Change the css width attribute to simulate progress -->
													<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
														<span class="sr-only">20% Complete</span>
													</div>
												</div>
											</a>
											<!-- end task item -->
										</li>
									</ul>
								</li>
								<li class="footer"><a href="#">View all tasks</a></li>
							</ul>
						</li>
						<!-- User Account Menu -->
						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<!-- The user image in the navbar-->
								<img src="views/avatar/<?php echo $avatar_usuario;?>" class="user-image" alt="User Image">
								<!-- hidden-xs hides the username on small devices so only the image appears. -->
								<span class="hidden-xs"><b><?php echo $posto_usuario . " " . $nome_guerra_usuario;?></b></span>
							</a>
							<ul class="dropdown-menu">
								<!-- The user image in the menu -->
								<li class="user-header">
									<img src="views/avatar/<?php echo $avatar_usuario;?>" class="img-circle" alt="User Image">
									<p>
										<?php echo $perfil_usuario . " - " . $sigla_usuario;?>
										<small>Acesso anterior: <?php echo $acesso_anterior_usuario;?></small>
									</p>
								</li>
								<!-- Menu Body-->
								<li class="user-body">
									<div class="pull-left">
										<a href="<?php echo PAGINA_BLOQUEIO;?>"><button type="button" class="btn btn-warning btn-flat">Bloquear tela</button></a>
									</div>
									<div class="pull-right">
										<?php $flag = md5("logout");?>
										<a href="controllers/autenticacao/logout.php?flag=<?php echo $flag;?>"><button type="button" class="btn btn-danger btn-flat">Fazer logout</button></a>
									</div>
								</li>
							</ul>
						</li>
						<!-- Control Sidebar Toggle Button -->
						<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
					</ul>
				</div>
			</nav>
		</header>
  <!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="views/avatar/<?php echo $avatar_usuario;?>" class="img-circle" alt="User Image">
					</div>
					<div id="status_sessao" class="pull-left info">
						<p><?php echo $posto_usuario . " " . $nome_guerra_usuario;?></p>
						<!-- Status-->
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<!-- search form (Optional) -->
				<!-- /.search form -->
				<!-- Sidebar Menu -->
				<ul class="sidebar-menu" data-widget="tree">
					<!-- Optionally, you can add icons to the links -->
					<li><a href="index.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
					<li><a href="#"><i class="fa fa-gears"></i> <span>Administração</span></a></li>
					<li class="treeview active">
						<a href="mailbox.html">
							<i class="fa fa-envelope"></i> <span>Correio</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-search"></i> <span>Auditoria</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="#"><i class="fa fa-map"></i> Planejamento</span></a></li>
							<li><a href="#"><i class="fa fa-edit"></i> Execução</a></li>
							<li><a href="#"><i class="fa fa-tv"></i> Monitoramento</a></li>
							<li><a href="#"><i class="fa fa-book"></i> Documentos</a></li>
						</ul>
					</li>
				</u>
				<!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
		</aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escrever Mensagem
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="mailbox_input.php">Correio</a></li>
        <li class="active">Escrever</li>
      </ol>
    </section>

    <!-- Main content -->
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
      <div class="row">
        <div class="col-md-3">
          <a href="mailbox.html" class="btn btn-primary btn-block margin-bottom disabled"><i class="fa fa-pencil"></i> Escrever</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Pastas</h3>

             <!-- <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>-->
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="mailbox_input.php"><i class="fa fa-inbox"></i> Entrada<span class="label label-danger pull-right"><?php echo $qtde_entrada;?></span></a></li>
                <li><a href="mailbox_read.php"><i class="fa fa-envelope-open-o"></i> Já lidas<span class="label label-primary pull-right"><?php echo $qtde_lidas;?></span></a></li>
                <li><a href="mailbox_sent.php"><i class="fa fa-send-o"></i> Enviadas<span class="label label-success pull-right"><?php echo $qtde_enviadas;?></span></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nova Mensagem</h3>
            </div>
            <!-- /.box-header -->
            <form name="form_write_msg" method = "POST" action = "controllers/correio/correio_cadastrar.php">
            <div class="box-body">

              <div class="form-group">
                <select name="destinatario[]" id="destinatario" class="form-control chosen-select" multiple data-placeholder = " Para:" >
					<?php
					while($row = $con_destinatario->fetch_assoc()){

						$sql_sigla = "select sigla from cciex_om where codom = '$row[codom]' limit 1";
						$con_sigla = $mysqli1->query($sql_sigla);
						$row_sigla = $con_sigla->fetch_assoc();?>

						<option value="<?php echo $row['id_usuario'];?>"><?php echo $row['posto'] . " " . $row['nome_guerra'] . " - " . $row_sigla['sigla'];?></option>
						<?php } ?>
			    </select>
              </div>
              <div class="form-group">
                <input name="assunto" class="form-control" placeholder="Assunto:">
              </div>
              <div class="form-group">
                    <textarea name="texto" id="compose-textarea" class="form-control" style="height: 300px">
                    </textarea>
              </div>
              <!--
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
              -->
            </div>
			<!-- Hidden input -->
			<input name="flag" type="hidden" />
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-success"><i class="fa fa-envelope-o"></i> Enviar</button>
                <a href="mailbox_write.php"><button class="btn btn-danger"><i class="fa fa-trash"></i>  Cancelar</button></a>
              </div>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
          </form>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --><!-- Main Footer -->
		<?php include_once('componentes/internos/php/rodape.inc.php');?>

  <!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Create the tabs -->
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
				<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
				<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Home tab content -->
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
					<!-- /.control-sidebar-menu -->
				</div>
				<!-- /.tab-pane -->
				<!-- Stats tab content -->
				<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
				<!-- /.tab-pane -->
				<!-- Settings tab content -->
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
					<!-- /.form-group -->
					</form>
				</div>
				<!-- /.tab-pane -->
			</div>
		</aside>
		<!-- /.control-sidebar -->
		<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
</div>
	<!-- ./wrapper -->
	<script src="componentes/externos/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/dist/js/adminlte.min.js"></script>
	<script src="controllers/usuario/senha_alterar.js"></script>
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/externos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
	<script src="componentes/externos/plugins/bootstrap-chosen/bootstrap-chosen.js"></script>
	<script src="componentes/externos/bower_components/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
	<script src="componentes/externos/bower_components/bootstrap-fileinput/js/locales/pt-BR.js" type="text/javascript"></script>
	<script type="text/javascript">
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
	<script type="text/javascript">
		$('#modalTrocarUnidade').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
			var unidade = button.data('unidade')
			var modal = $(this)
			modal.find('.modal-title').text('Unidade atual: ' + unidade )
			modal.find('#unidade').val(unidade)
		})
	</script>
	<script>
		$('[data-toggle="confirmation"]').confirmation({
			onConfirm: function() {
				$('#form_altera_om').bootstrapValidator({
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
		$(document).ready(function(){
			$('[data-tooltip="tooltip"]').tooltip();
		});
	</script>
	<script>
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
		function chamarPhpAjax() {//chama o script que avisa ao usuario_alterar.php que o avatar será excluído
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
			$(document).ready(function(){
				$('#modalAlerta').modal('show');
			});
		</script>
	<?php
	}
	?>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>
<script>
      var config = {'.chosen-select': {}}
		for (var selector in config) {$(selector).chosen(config[selector]);}
</script>
</body>
</html>
