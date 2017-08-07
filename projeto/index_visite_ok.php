<?php
//index_visite.php

include_once(__DIR__ .'/componentes/internos/php/constantes.inc.php');
include_once(__DIR__ .'/componentes/internos/php/cabecalho.inc.php');
include_once(__DIR__ .'/componentes/internos/php/conexao.inc.php');
include_once(__DIR__ .'/autenticacao/perfil.inc.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo TITULO; ?></title>
		<link href="componentes/externos/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<h1>Informações do Usuário</h1>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th><?php $flag = md5("logout")?><a href="autenticacao/logout.php?flag=<?php echo $flag;?>">Sair</a></th>
								<th>CPF</th>
								<th>STATUS</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>-----</td>
								<td><?php echo $cpf; ?></td>
								<td><?php echo "Aguardando liberação de acesso."; ?></td>
								<td>
									<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalVisualizar<?php echo $cpf; ?>">Visualizar</button>

									<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalEditar" data-cpf="<?php echo $cpf; ?>" data-identidade="<?php echo $identidade_usuario; ?>"  data-id_posto="<?php echo $id_posto_usuario; ?>" data-posto="<?php echo $posto_usuario; ?>" data-nome_guerra="<?php echo $nome_guerra_usuario; ?>" data-nome_completo="<?php echo $nome_completo_usuario; ?>"  data-email="<?php echo $email_usuario; ?>" data-om="<?php echo $sigla_usuario; ?>">Editar</button>

									<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalTrocarOM" data-cpf="<?php echo $cpf; ?>" data-identidade="<?php echo $identidade_usuario; ?>"  data-id_posto="<?php echo $id_posto_usuario; ?>" data-posto="<?php echo $posto_usuario; ?>" data-nome_guerra="<?php echo $nome_guerra_usuario; ?>" data-nome_completo="<?php echo $nome_completo_usuario; ?>"  data-email="<?php echo $email_usuario; ?>" data-om="<?php echo $sigla_usuario; ?>">Trocar OM</button>

									<a href="usuario/processa_apagar.php?id=<?php echo $cpf; ?>"><button type="button" class="btn btn-xs btn-danger">Apagar</button></a>
								</td>
							</tr>
								<!-- Inicio modalVisualizar -->
								<div class="modal fade" id="modalVisualizar<?php echo $cpf; ?>" tabindex="-1" role="dialog" aria-labelledby="modalVisualizarLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title text-center" id="modalVisualizarLabel"><?php echo $nome_usuario; ?></h4>
											</div>
											<div class="modal-body">
												<p>CPF: <?php echo $cpf; ?></p>
												<p>Nome: <?php echo $nome_usuario; ?></p>
												<p>E-mail: <?php echo $email_usuario; ?></p>
												<p>OM: <?php echo $sigla_usuario; ?></p>
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
												<form name="form_editar" id="form_editar" method="POST" action="usuario/altera.php" enctype="multipart/form-data">
													<div class="form-group">
														<label for="cpf" class="control-label">CPF:</label>
														<input name="cpf" id="cpf" type="text" class="form-control" />
													</div>
													<div class="form-group">
														<label for="identidade" class="control-label">Identidade:</label>
														<input name="identidade" id="identidade" type="text" class="form-control" />
													</div>
													<div class="form-group">
														<label for="posto" class="control-label">Posto/grad:</label>
														<?php include_once('listas/postos_select.inc.php');?>
													</div>
													<div class="form-group">
														<label for="nome_guerra" class="control-label">Nome de guerra:</label>
														<input name="nome_guerra" id="identidade" type="text" class="form-control" />
													</div>
													<div class="form-group">
														<label for="nome_completo" class="control-label">Nome completo:</label>
														<input name="nome_completo" id="nome_completo" type="text" class="form-control" required />
													</div>
													<div class="form-group">
														<label for="email" class="control-label">E-mail:</label>
														<input name="email" id="email" type="text" class="form-control" required />
													</div>
													<div class="modal-footer">
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
												<form method="POST" action="usuario/altera.php" enctype="multipart/form-data">
													<div class="form-group">
														<label for="unidade_ci" class="control-label">Unidade Controle Interno:</label>
														<?php include('listas/unidades_ci_select.inc.php');?>
													</div>
													<div class="form-group">
														<label for="om" class="control-label">Unidade do usuário:</label>
														<select class="form-control" name="om" id="om" required>
															<option value="">Aguardando Unidade de Controle Interno...</option>
														</select>
													</div>
														<input name="cpf" type="hidden" id="cpf">
														<input name="identidade" type="hidden" id="identidade">
														<input name="nome_guerra" type="hidden" id="nome_guerra">
														<input name="nome_completo" type="hidden"id="nome_completo">
														<input name="email" type="hidden" id="email" />
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
														<button type="submit" class="btn btn-danger">Alterar</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
						</tbody>
					 </table>
				</div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="componentes/externos/jquery/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="componentes/externos/bootstrap/js/bootstrap.min.js"></script>
		<script src="componentes/externos/bootstrap/js/validator.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#form_editar').formValidation({
					framework: 'bootstrap',
					excluded: ':disabled',
					icon: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						identidade: {
							validators: {
								notEmpty: {
									message: 'Campo obrigatório'
								}
							}
						},
						nome_guerra: {
							validators: {
								notEmpty: {
									message: 'Campo obrigatório'
								}
							}
						}
					}
				});
			});
		</script>
		<script type="text/javascript">
			$('#modalEditar').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var cpf = button.data('cpf') // Extract info from data-* attributes
				var identidade = button.data('identidade')
				var nome_guerra = button.data('nome_guerra')
				var nome_completo = button.data('nome_completo')
				var id_posto = button.data('id_posto')
				var posto = button.data('posto')
				var email = button.data('email')
				var om = button.data('om')
				var modal = $(this)
				modal.find('.modal-title').text('Usuário: ' + posto + ' ' + nome_guerra + ' - ' + om )
				modal.find('#cpf').val(cpf)
				modal.find('#identidade').val(identidade)
				modal.find('#email').val(email)
				modal.find('#posto').val(id_posto)
				modal.find('#nome_guerra').val(nome_guerra)
				modal.find('#nome_completo').val(nome_completo)
			})
		</script>
		<script>
			//script para receber a selecao da unidade de controle interno e atualizar o 2º select
			$(document).ready(function(){
				$("select[name=unidade_ci]").change(function(){
					$("select[name=om]").html('<option value="">Carregando...</option>');
					$.post("listas/om_select.inc.php", {unidade_ci:$(this).val()},function(valor){$("select[name=om]").html(valor);})
				 })
			 })
		</script>
		<script type="text/javascript">
			$('#modalTrocarOM').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var cpf = button.data('cpf') // Extract info from data-* attributes
				var identidade = button.data('identidade')
				var nome_guerra = button.data('nome_guerra')
				var nome_completo = button.data('nome_completo')
				var id_posto = button.data('id_posto')
				var posto = button.data('posto')
				var email = button.data('email')
				var om = button.data('om')
				var modal = $(this)
				modal.find('.modal-title').text('Unidade atual: ' + om )
				modal.find('#cpf').val(cpf)
				modal.find('#identidade').val(identidade)
				modal.find('#email').val(email)
				modal.find('#posto').val(id_posto)
				modal.find('#om').val(om)
				modal.find('#nome_guerra').val(nome_guerra)
				modal.find('#nome_completo').val(nome_completo)
			})
		</script>
	</body>
</html>