<?php
session_start();
$inc = "sim";
include_once('config.inc.php');
include_once(PATH . '/controllers/autenticacao/autentica_visite.inc.php');

$pagina = strtr(end(explode('/', $_SERVER['PHP_SELF'])),'?', true);

switch ($status_usuario){
	case ('recebido'):
		$status = "Aguardando liberação de acesso";
		break;

	case('desabilitado'):
		$status = "Usuário está desabilitado";
		break;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SIAUDI</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="componentes/externos/bower_components/bootstrap/dist/css/bootstrapValidator.min.css" />
	<link rel="stylesheet" href="componentes/externos/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="componentes/externos/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="componentes/externos/dist/css/AdminLTE.css">
	<link rel="stylesheet" href="componentes/externos/dist/css/skins/skin-green.css">
	<link rel="stylesheet" href="componentes/internos/css/siaudi.css">
</head>
<body class="hold-transition skin-green sidebar-mini">
	<?php include_once(PATH . '/componentes/internos/php/cabecalho.inc.php');?>
	<div class="wrapper">
		<header class="main-header">
			<a href="index2.html" class="logo">
				<span class="logo-mini"><b><-></b></span>
				<span class="logo-lg barra-top"><b>SIAUDI</b>/EB</span>
			</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<section class="content-header barra-top" >
					<h1>
						<strong>SISTEMA DE AUDITORIA INTERNA DO EXÉRCITO</strong>
						<small></small>
					</h1>
				</section>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar form-login">
				<ul class="sidebar-menu" data-widget="tree">
					<li><a href="#"><i class="fa fa-file"></i> <span>Guia do Usuário</span></a></li>
					<li><a href="#" data-toggle="modal" data-target="#modalTrocarSenha"><i class="fa fa-lock"></i> <span>Alterar senha</span></a></li>
					<?php $flag = md5("logout");?>
					<li><a href="controllers/autenticacao/logout.php?flag=<?php echo $flag;?>"><i class="fa fa-sign-out"></i> <span>Sair do sistema</span></a></li>
				</ul>
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content container-fluid">
				<div class="page-header">
					<h3>Informações de usuário: <u><?php echo $posto_usuario . " " . $nome_guerra_usuario;?></u></h3>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table">
							<thead>
								<tr>
									<th>CPF</th>
									<th>STATUS</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $cpf; ?></td>
									<td><?php echo $status; ?>
									<td>
										<button type="button" class="btn btn-xs btn-primary"
											data-toggle="modal"
											data-target="#modalVisualizar<?php echo $cpf; ?>">
											Visualizar
										</button>

										<button type="button" class="btn btn-xs btn-warning"
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
											data-om="<?php echo $sigla_usuario; ?>">
											Alterar dados
										</button>

										<button type="button" class="btn btn-xs btn-warning"
											data-toggle="modal"
											data-target="#modalTrocarOM"
											data-om="<?php echo $sigla_usuario; ?>">
											Alterar Unidade
										</button>

										<?php $flag = md5("usuario_excluir");?>
										<a href="controllers/usuario/usuario_excluir.php?flag=<?php echo $flag; ?>">

										<button type="button" class="btn btn-xs btn-danger" data-toggle="confirmation"
											data-placement="left"
											data-btn-ok-label="Continuar"
											data-btn-ok-icon="glyphicon glyphicon-share-alt"
											data-btn-ok-class="btn-success"
											data-btn-cancel-label="Parar"
											data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
											data-btn-cancel-class="btn-danger"
											data-title="Confirma exclusão do cadastro?"
											data-content="">
											Excluir Cadastro
										</button>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
						<?php
						if (isset($_GET['flag']) and ($_GET['flag'] == md5("usuario_alterar") or $_GET['flag'] == md5("senha_alterar") or $_GET['flag'] == md5("om_alterar") or $_GET['flag'] == md5("logout") )){
							include_once('controllers/usuario/usuario_alertas_criar.inc.php');
						}
						else {
							include_once('controllers/usuario/usuario_alertas_destruir.inc.php');
						}
						?>
						<!-- Inicio modalVisualizar-->
						<div class="modal modal-primary fade" id="modalVisualizar<?php echo $cpf; ?>" tabindex="-1" role="dialog" aria-labelledby="modalVisualizarLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title text-center" id="modalVisualizarLabel">Dados do usuário</h4>
									</div>
									<div class="modal-body">
										<p><b>Unidade:</b> <?php echo $sigla_usuario; ?></p>
										<p><b>CPF:</b> <?php echo $cpf; ?></p>
										<p><b>RG:</b> <?php echo $rg_usuario; ?></p>
										<p><b>Posto/grad:</b> <?php echo $posto_usuario; ?></p>
										<p><b>Nome de guerra:</b> <?php echo $nome_guerra_usuario; ?></p>
										<p><b>Nome completo:</b> <?php echo $nome_usuario; ?></p>
										<p><b>E-mail:</b> <?php echo $email_usuario; ?></p>
										<p><b>RITEx:</b> <?php echo $ritex_usuario; ?></p>
										<p><b>Celular:</b> <?php echo $celular_usuario; ?></p>
									</div>
								</div>
							</div>
						</div>
						<!-- Inicio modalEditar -->
						<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="modalEditarLabel"></h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" name="form_usuario_alterar" id="form_usuario_alterar" method="POST" action="controllers/usuario/usuario_alterar.php" enctype="multipart/form-data">

											<fieldset>
												<!-- Text input-->
												<div class="form-group">
													<label for="rg" class="col-md-4 control-label">*RG:</label>
													<div class="col-md-6">
													<input name="rg" id="rg" type="text" class="form-control" />
													</div>
												</div>

												<!-- Select input-->
												<div class="form-group">
													<label for="posto" class="col-md-4 control-label">*Posto/Grad:</label>
													<div class="col-md-6">
													<?php include_once('listas/select_posto.inc.php');?>
													</div>
												</div>

												<!-- Text input-->
												<div class="form-group">
													<label for="nome_guerra" class="col-md-4 control-label">*Nome de guerra:</label>
													<div class="col-md-6">
													<input name="nome_guerra" id="nome_guerra" type="text" class="form-control" />
													</div>
												</div>

												<!-- Text input-->
												<div class="form-group">
													<label for="nome" class="col-md-4 control-label">*Nome completo:</label>
													<div class="col-md-6">
													<input name="nome" id="nome" type="text" class="form-control"  />
													</div>
												</div>

												<!-- Text input-->
												<div class="form-group">
													<label for="email" class="col-md-4 control-label">*E-mail:</label>
													<div class="col-md-6">
													<input name="email" id="email" type="text" class="form-control" />
													</div>
												</div>

												<!-- Text input-->
												<div class="form-group">
													<label for="ritex" class="col-md-4 control-label">RITEx:</label>
													<div class="col-md-6">
													<input name="ritex" id="ritex" type="text" class="form-control" />
													</div>
												</div>

												<!-- Text input-->
												<div class="form-group">
													<label for="celular" class="col-md-4 control-label">Celular:</label>
													<div class="col-md-6">
													<input name="celular" id="celular" type="text" class="form-control" />
													</div>
												</div>

												<!-- Hidden input -->
												<input name="flag" type="hidden" />
												<input type="hidden" name="flag1" value="<?php echo $pagina;?>" />

												<div class="modal-footer">
													<label class="col-md-4 control-label"></label>
													<div class="col-md-8">
														<button type="submit" class="btn btn-success">Enviar</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													</div>
												</div>
											</fieldset>
										</form>
									</div>
								</div>
							</div>
						</div>
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
						<!-- inicio alterar_senha -->
						<?php include_once('views/usuario/form_senha_alterar.inc.php'); ?>
						<!--inicio modalAlerta -->
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
										echo $msg6."<br />".$msg0."<br />".$msg1."<br />".$msg2."<br />".$msg3."<br />".$msg4."<br />".$msg5."<br />".$msg7."<br />".$msg8."<br />".$msg9."<br />".$msg10;

										if($lista_erro_validacao){
											foreach ($lista_erro_validacao as $msg_lista){
												echo $msg_lista[0] = "<p>" . $msg_lista[0] . "</p>";
											}
										}
										?>
									</div>
									<div class="modal-footer">
										<a href="<?php echo $pagina;?>"><button type="button" class="btn btn-<?php echo $botao;?>">Fechar</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php include_once('componentes/internos/php/rodape.inc.php');?>
	</div>
	<script src="componentes/externos/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap/dist/js/bootstrapValidator.min.js"></script>
	<script src="componentes/externos/bower_components/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
	<script src="componentes/externos/dist/js/adminlte.min.js"></script>
	<script src="controllers/usuario/usuario_alterar.js"></script>
	<script src="controllers/usuario/senha_alterar.js"></script>
	<script type="text/javascript">
		$('#modalEditar').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var cpf = button.data('cpf') // Extract info from data-* attributes
			var rg = button.data('rg')
			var nome_guerra = button.data('nome_guerra')
			var nome = button.data('nome')
			var id_posto = button.data('id_posto')
			var posto = button.data('posto')
			var email = button.data('email')
			var ritex = button.data('ritex')
			var celular = button.data('celular')
			var om = button.data('om')
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			modal.find('.modal-title').text('Usuário: ' + posto + ' ' + nome_guerra + ' - ' + om )
			modal.find('#cpf').val(cpf)
			modal.find('#rg').val(rg)
			modal.find('#email').val(email)
			modal.find('#ritex').val(ritex)
			modal.find('#celular').val(celular)
			modal.find('#posto').val(id_posto)
			modal.find('#nome_guerra').val(nome_guerra)
			modal.find('#nome').val(nome)
		})
	</script>
	<script>
		//script para receber a selecao da unidade de controle interno e atualizar o 2º select
		$(document).ready(function(){
			$("select[name=unidade_ci]").change(function(){
				$("select[name=codom]").html('<option value="">Carregando...</option>');
				$.post("listas/select_om_usuario.inc.php", {unidade_ci:$(this).val()},function(valor){$("select[name=codom]").html(valor);})
			 })
		 })
	</script>
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