<?php
$inc = "sim";
include_once('path.inc.php');

require_once(PATH .'/controllers/autenticacao/perfil.inc.php');

switch ($status_usuario){
	case ('recebido'):
		$status = "Aguardando liberação de acesso";
		break;

	case('desabilitado'):
		$status = "Usuário está desabilitado";
		break;
}
$p = 'Ten Cel';
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
		<li><a href="#" data-toggle="modal" data-target="#alteraModal"><i class="fa fa-lock"></i> <span>Alterar senha</span></a></li>
        <?php $flag = md5("logout");?>
        <li><a href="autenticacao/logout.php?flag=<?php echo $flag;?>"><i class="fa fa-sign-out"></i> <span>Sair do sistema</span></a></li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    <section class="content container-fluid">
<div class="page-header">
					<h1>Informações do Usuário</h1>
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
									<td><?php echo $_SESSION['cpf']; ?></td>
									<td><?php echo $status; ?></td>
									<td>
										<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalVisualizar<?php echo $cpf; ?>">Visualizar</button>

										<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalEditar" data-cpf="<?php echo $cpf; ?>" data-rg="<?php echo $rg_usuario; ?>"  data-id_posto="<?php echo $id_posto_usuario; ?>" data-posto="<?php echo $posto_usuario; ?>" data-nome_guerra="<?php echo $nome_guerra_usuario; ?>" data-nome="<?php echo $nome_usuario; ?>"  data-email="<?php echo $email_usuario; ?>" data-ritex="<?php echo $ritex_usuario; ?>" data-celular="<?php echo $celular_usuario; ?>" data-om="<?php echo $sigla_usuario; ?>">Editar</button>

										<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalTrocarOM" data-om="<?php echo $sigla_usuario; ?>">Trocar OM</button>

										<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalTrocarSenha">Alterar Senha</button>

										<?php $flag = md5("excluir_usuario");?>
										<a href="usuario/exclui_usuario.php?flag=<?php echo $flag; ?>"><button type="button" class="btn btn-xs btn-danger">Excluir </button></a>
									</td>
								</tr>
							</tbody>
						 </table>
						<?php if (isset($_GET['flag'])){include_once(__DIR__ .'/usuario/alertas.inc.php');}?>
						<!-- Inicio modalVisualizar-->
						<div class="modal modal-primary fade" id="modalVisualizar<?php echo $cpf; ?>" tabindex="-1" role="dialog" aria-labelledby="modalVisualizarLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title text-center" id="modalVisualizarLabel">Dados do usuário</h4>
									</div>
									<div class="modal-body">
										<p><b>RG:</b> <?php echo $rg_usuario; ?></p>
										<p><b>Posto/grad:</b> <?php echo $posto_usuario; ?></p>
										<p><b>Nome de guerra:</b> <?php echo $nome_guerra_usuario; ?></p>
										<p><b>Nome completo:</b> <?php echo $nome_usuario; ?></p>
										<p><b>E-mail:</b> <?php echo $email_usuario; ?></p>
										<p><b>Unidade:</b> <?php echo $sigla_usuario; ?></p>
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
										<form name="form_editar" id="form_editar" method="POST" action="usuario/altera_usuario.php" enctype="multipart/form-data">
											<div class="alert alert-success" style="display: none;"></div>
											<div class="form-group">
												<label for="rg" class="control-label">RG:</label>
												<input name="rg" id="rg" type="text" class="form-control" />
											</div>
											<div class="form-group">
												<label for="posto" class="control-label">Posto/Grad:</label>
												<?php include_once('listas/postos_select.inc.php');?>
											</div>
											<div class="form-group">
												<label for="nome_guerra" class="control-label">Nome de guerra:</label>
												<input name="nome_guerra" id="nome_guerra" type="text" class="form-control" />
											</div>
											<div class="form-group">
												<label for="nome" class="control-label">Nome completo:</label>
												<input name="nome" id="nome" type="text" class="form-control"  />
											</div>
											<div class="form-group">
												<label for="email" class="control-label">E-mail:</label>
												<input name="email" id="email" type="text" class="form-control" />
											</div>
											<div class="form-group">
												<label for="ritex" class="control-label">RITEx:</label>
												<input name="ritex" id="ritex" type="text" class="form-control" />
											</div>
											<div class="form-group">
												<label for="celular" class="control-label">Celular:</label>
												<input name="celular" id="celular" type="text" class="form-control" />
											</div>
											<div class="modal-footer">
												<input name="flag" type="hidden" />
												<input name="rg_atual" type="hidden" value="<?php echo $rg_usuario;?>" />
												<input name="posto_atual" type="hidden" value="<?php echo $posto_usuario;?>" />
												<input name="nome_guerra_atual" type="hidden" value="<?php echo $nome_guerra_usuario;?>" />
												<input name="nome_atual" type="hidden" value="<?php echo $nome_usuario;?>" />
												<input name="email_atual" type="hidden" value="<?php echo $email_usuario;?>" />
												<input name="codom_atual" type="hidden" value="<?php echo $codom_usuario;?>" />

												<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
												<button type="submit" class="btn btn-danger">Alterar</button>
											</div>
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
										<form name="form_altera_om" id="form_altera_om" method="POST" action="usuario/altera_om.php" enctype="multipart/form-data">
											<div class="form-group">
												<label for="unidade_ci" class="control-label">Unidade Controle Interno:</label>
												<?php include('listas/unidades_ci_select.inc.php');?>
											</div>
											<div class="form-group">
												<label for="codom" class="control-label">Unidade do usuário:</label>
												<select class="form-control" name="codom" id="codom" required>
													<option value="">Aguardando Unidade de Controle Interno...</option>
												</select>
											</div>
												<input name="flag" type="hidden" value="<?php $codom_usuario;?>"/>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
												<button type="submit" class="btn btn-danger"
													data-toggle="confirmation"
													data-placement="left"
													data-btn-ok-label="Continue"
													data-btn-ok-icon="glyphicon glyphicon-share-alt"
													data-btn-ok-class="btn-success"
													data-btn-cancel-label="Pare!"
													data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
													data-btn-cancel-class="btn-danger"
													data-title="Confirma alteração da Unidade?"
													data-content="">
													Alterar
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- inicio alterar_senha -->
						<div class="modal fade" data-backdrop="static" id="modalTrocarSenha" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Alteração de senha</h4>
									</div>
									<div class="modal-body">
										<form action="usuario/altera_senha.php" method="POST">
											<div class="form-group">
												<label for="codom" class="control-label">Senha:</label>
												<input class="form-control" type="password" name="senha_nova"  id="senha_nova"  autofocus required placeholder="nova senha" onpaste="return false;" />
											</div>
											<div class="form-group">
												<label for="codom" class="control-label">Confirme a senha:</label>
												<input class="form-control" type="password" name="senha_nova1" id="senha_nova1" required placeholder="confirmar senha" onpaste="return false;" />
											</div>
											<div class="modal-footer">
												<input type="hidden" name="flag" value="<?php echo $_SESSION['cpf'];?>"/>
												<input type="submit" />
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!--fim modalTrocarSenha -->
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
		//modal.find('#om').val(om)
		modal.find('#nome_guerra').val(nome_guerra)
		modal.find('#nome').val(nome)
	})
</script>
<script>
	//script para receber a selecao da unidade de controle interno e atualizar o 2º select
	$(document).ready(function(){
		$("select[name=unidade_ci]").change(function(){
			$("select[name=codom]").html('<option value="">Carregando...</option>');
			$.post("listas/om_select_usuario.inc.php", {unidade_ci:$(this).val()},function(valor){$("select[name=codom]").html(valor);})
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
	$(document).ready(function() {
		$('#form_editar').bootstrapValidator({
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				rg: {
					validators: {
						notEmpty: {
							message:'preenchimento obrigatório'
						},
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'somente dígitos'
						}
					}
				},
				posto: {
					validators: {
						notEmpty: {
							message: 'preenchimento obrigatório'
						}
					}
				},
				nome_guerra: {
					validators: {
						notEmpty: {
							message: 'preenchimento obrigatório'
						}
					}
				},
				nome: {
					validators: {
						notEmpty: {
							message: 'preenchimento obrigatório'
						}
					}
				},
				email: {
					validators: {
						notEmpty: {
							message: 'preenchimento obrigatório'
						},
						emailAddress: {
							message: 'E-mail válido'
						}
					}
				},
				ritex: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'somente dígitos'
						},
						stringLength: {
							min: 7,
							max: 7,
							message: 'RITEx inválido'
						}
					}
				},
				celular: {
					validators: {
						regexp: {
							regexp: /^[0-9]+$/,
							message: 'somente dígitos'
						},
						stringLength: {
							min: 10,
							max: 11,
							message: 'Celular inválido'
						}
					}
				}
			}
		})
	});
</script><!--
<script>
	$(document).ready(function() {
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
	});
</script>-->
<script>
	$('[data-toggle="confirmation"]').confirmation({
		onConfirm: function() {
			$('#form_altera_om').submit();
		}
	});
</script>
</body>
</html>