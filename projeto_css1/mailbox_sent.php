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

  <link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="componentes/externos/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="componentes/externos/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="componentes/externos/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="componentes/externos/bower_components/bootstrap-fileinput/css/fileinput.min.css">
  <link rel="stylesheet" href="componentes/externos/dist/css/skins/skin-blue.css">
  <link rel="stylesheet" href="componentes/internos/css/siaudi.css">
  <link rel="stylesheet" href="componentes/externos/bower_components/iCheck/flat/blue.css">
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
				<?php include_once ('views/menu/menu_top.inc.php');?>
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
				<?php
				$active_correio = 'class="active"';
				include_once('views/menu/menu_left.inc.php');?>
				<!-- /.sidebar-menu -->
			</section>
			<!-- /.sidebar -->
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Correio
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
        <li class="active">Correio</li>
        <li class="active">Enviados</li>
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
		if (isset($_GET['flag']) and ($_GET['flag'] == md5("correio_cadastrar") or $_GET['flag'] == md5("correio_excluir") )){
			include_once('controllers/correio/correio_alertas_criar.inc.php');
		}
		else {
			include_once('controllers/correio/correio_alertas_destruir.inc.php');
		}
		?>
		<!-- Inicio modalAlertaCorreio-->
		<?php include_once('views/correio/view_correio_alertas.inc.php');?>
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
            <!-- /.box-body -->
          </div>
          </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Enviados</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?php if ($total_msg > 0) {?>
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button  class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button  class="btn btn-default btn-sm" title="Excluir"><i class="fa fa-trash-o"></i></button>
					<button class="btn btn-default btn-sm" title="Encaminhar"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                  <div class="pull-right">
                  <?php echo $pag."-".$total_pag."/".$total_msg;?>
                  <div class="btn-group">
					  <?php if ($pag > 1) {?>
                    <a href="?pagina=<?php echo $anterior;?>"  class="btn btn-default btn-sm" title="Página anterior"><i class="fa fa-chevron-left"></i></a>
                    <?php }
                    if ($pag < $total_pag) {?>
                    <a href="?pagina=<?php echo $proximo;?>"  class="btn btn-default btn-sm" title="Próxima página"><i class="fa fa-chevron-right"></i></a>
                    <?php } ?>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <?php } ?>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
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

						for($i = 0; $i < $qtde; $i++){

							$sql_destinatario = "SELECT id_usuario, codom, nome_guerra, p.posto, codom from usuarios, postos p where usuarios.id_usuario = '$lista_destinatario[$i]' and usuarios.id_posto = p.id_posto order by p.id_posto";
							$con_destinatario = $mysqli->query($sql_destinatario);
							$row_destinatario = $con_destinatario->fetch_assoc();

							$sql_sigla = "SELECT sigla FROM cciex_om WHERE codom = '$row_destinatario[codom]' limit 1";
							$con_sigla = $mysqli1->query($sql_sigla);
							$row_sigla = $con_sigla->fetch_assoc();

							$destinatario = $destinatario . "[".$row_destinatario['posto']." ". $row_destinatario['nome_guerra']." - ".$row_sigla['sigla']."] ";
							//$destinatario = mb_strimwidth($destinatario, 0, 75, "...");
						}
						echo "
						<tr>
						<td><input type='checkbox'></td>
						<td class='mailbox-name'><a href='mailbox_view.php?flag=$row_enviados[id_correio]&flag0=s&flag1=$destinatario'>$destinatario</a></td>
						<td class='mailbox-subject'>$row_enviados[assunto]</td>
						<td class='mailbox-date'>$data</td>
						</tr>"
						;
					}
					?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
				<?php if ($total_msg > 0) {?>
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button  class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button  class="btn btn-default btn-sm" title="Excluir"><i class="fa fa-trash-o"></i></button>
					<button  class="btn btn-default btn-sm" title="Encaminhar"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <div class="pull-right">
                  <?php echo $pag."-".$total_pag."/".$total_msg;?>
                  <div class="btn-group">
					<?php if ($pag > 1) {?>
                    <a href="?pagina=<?php echo $anterior;?>"  class="btn btn-default btn-sm" title="Página anterior"><i class="fa fa-chevron-left"></i></a>
                    <?php }
                    if ($pag < $total_pag) {?>
                    <a href="?pagina=<?php echo $proximo;?>"  class="btn btn-default btn-sm" title="Próxima página"><i class="fa fa-chevron-right"></i></a>
                    <?php } ?>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <?php }?>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
		<!-- /.content-wrapper -->
		<!-- Main Footer -->
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
	<!-- jQuery 3 -->
	<script src="componentes/externos/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrapValidator.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
	<!-- AdminLTE App -->
	<script src="componentes/externos/dist/js/adminlte.min.js"></script>
	<script src="controllers/usuario/senha_alterar.js"></script>
	<script src="componentes/internos/js/status_sessao.js"></script>
	<script src="componentes/externos/bower_components/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
	<script src="componentes/externos/bower_components/bootstrap-fileinput/js/locales/pt-BR.js" type="text/javascript"></script>
	<script src="componentes/externos/bower_components/iCheck/icheck.min.js"></script>
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
		var btnCust = '<button  class="btn btn-secondary" title="Excluir imagem" ' +
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
	<script>
		$(function () {
			//Enable iCheck plugin for checkboxes
			//iCheck for checkbox and radio inputs
			$('.mailbox-messages input[type="checkbox"]').iCheck({
				checkboxClass: 'icheckbox_flat-blue'
			});

			//Enable check and uncheck all functionality
			$(".checkbox-toggle").click(function () {
				var clicks = $(this).data('clicks');
				if (clicks) {
				//Uncheck all checkboxes
					$(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
					$(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
				}
				else {
					//Check all checkboxes
					$(".mailbox-messages input[type='checkbox']").iCheck("check");
					$(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
				}
				$(this).data("clicks", !clicks);
			});
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
	if ($msg_correio <> ""){?>
		<script>
			$(document).ready(function(){
				$('#modalAlertaCorreio').modal('show');
			});
		</script>
	<?php
	}
	?>
</body>
</html>