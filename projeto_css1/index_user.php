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
include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica.inc.php');
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
  <link rel="stylesheet" href="componentes/externos/dist/css/skins/skin-green.css">
  <link rel="stylesheet" href="componentes/internos/css/siaudi-.css">
</head>
<body class="hold-transition skin-green sidebar-mini">
<?php include_once('componentes/internos/php/cabecalho.inc.php');?>
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>...</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg barra-top"><b>SIAUD</b>-EB</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">44</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                        <img src="componentes/externos/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="componentes/externos/dist/img/cap_paulino.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Cap Paulino</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="componentes/externos/dist/img/cap_paulino.jpg" class="img-circle" alt="User Image">

                <p>
                  Cap Paulino - Administrador
                  <small>Usuário desde Jul. 2017</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-2 text-center">
                    <a href="#"></a>
                  </div>
                  <div class="col-xs-8 text-center btn btn-warning btn-flat">
                    <a href="#" data-toggle="modal" data-target="#modalTrocarSenha">Trocar senha</a>
                  </div>
                  <div class="col-xs-2 text-center">
                    <a href="#"></a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" data-toggle="modal" data-target="#modalTrocarOM" data-om="<?php echo $sigla_usuario; ?>" class="btn btn-primary btn-flat">Trocar OM</a>
                </div>
                <div class="pull-right">
					<?php $flag = md5("logout");?>
                  <a href="controllers/autenticacao/logout.php?flag=<?php echo $flag;?>" class="btn btn-danger btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
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
          <img src="componentes/externos/dist/img/cap_paulino.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Cap Paulino</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SISTEMA DE AUDITORIA DO EXÉRCITO
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
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
		<!-- inicio alterar_senha -->
		<?php include_once('views/usuario/form_senha_alterar.inc.php');?>
		<!-- Incio modalAlerta -->
		<div class="modal modal-<?php echo $botao;?> fade" id="modalAlerta"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
						<h4 class="modal-title" id="modalAlertaLabel">AVISO DO SISTEMA</h4>
					</div>
					<div class="modal-body">
						<?php
						echo "<b>";
						for($i = 0; $i < 15; $i++){
							if(${"msg{$i}"} <> ""){
								echo ${"msg{$i}"}."<br />";
							}
						}
						if($lista_erro_validacao){
							foreach ($lista_erro_validacao as $msg_lista){
								echo $msg_lista[0] = "<p>" . $msg_lista[0] . "</p>";
							}
						}
						echo "</b>";
						?>
					</div>
					<div class="modal-footer">
						<a href="<?php echo $pagina;?>"><button type="button" class="btn btn-<?php echo $botao;?>">Fechar</button></a>
					</div>
				</div>
			</div>
		</div>
		<!-- fim modalalerta-->
		<!-- Inicio modalTrocarOM -->
		<div class="modal fade" id="modalTrocarOM" tabindex="-1" role="dialog" aria-labelledby="modalTrocarOMLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="modalTrocarOMLabel"></h4>
					</div>
					<div class="modal-body">
						<form name="form_altera_om" id="form_altera_om" method="POST" action="controllers/usuario/usuario_alterar.php" enctype="multipart/form-data" >
							<div class="form-group">
								<label for="unidade_ci" class="control-label">*Unidade Controle Interno:</label>
								<?php include('listas/select_unid_ci.inc.php');?>
							</div>
							<div class="form-group">
								<label for="codom" class="control-label">*Unidade usuário:</label>
								<select class="form-control" name="codom" id="codom">
									<option value="">Aguardando Unidade de Controle Interno...</option>
								</select>
							</div>
							<div class="modal-footer">
								<input name="flag" type="hidden" value="<?php $codom_usuario;?>"/>
								<button type="submit" class="btn btn-success"
									data-toggle="confirmation"
									data-placement="left"
									data-btn-ok-label="Continuar"
									data-btn-ok-icon="glyphicon glyphicon-share-alt"
									data-btn-ok-class="btn-success"
									data-btn-cancel-label="Parar"
									data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
									data-btn-cancel-class="btn-danger"
									data-title="Confirma alteração da Unidade?"
									data-content="">
								Enviar
								</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
								<input type="hidden" name="flag1" value="<?php echo $pagina;?>" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
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
        <!-- /.control-sidebar-menu -->

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
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <?php include_once('componentes/internos/php/rodape.inc.php');?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="componentes/externos/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrapValidator.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
<!-- AdminLTE App -->
<script src="componentes/externos/dist/js/adminlte.min.js"></script>
<script src="controllers/usuario/senha_alterar.js"></script>

	<script type="text/javascript">
		$('#modalTrocarOM').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var om = button.data('om')
			var modal = $(this)
			modal.find('.modal-title').text('Unidade atual: ' + om )
			modal.find('#om').val(om)
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
</body>
</html>