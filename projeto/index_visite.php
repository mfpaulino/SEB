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
		<link href="componentes/externos/bootstrap/css/bootstrapValidator.min.css" rel="stylesheet"/>
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

									<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalEditar" data-cpf="<?php echo $cpf; ?>" data-rg="<?php echo $rg_usuario; ?>"  data-id_posto="<?php echo $id_posto_usuario; ?>" data-posto="<?php echo $posto_usuario; ?>" data-nome_guerra="<?php echo $nome_guerra_usuario; ?>" data-nome="<?php echo $nome_usuario; ?>"  data-email="<?php echo $email_usuario; ?>" data-ritex="<?php echo $ritex_usuario; ?>" data-celular="<?php echo $celular_usuario; ?>" data-om="<?php echo $sigla_usuario; ?>">Editar</button>

									<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalTrocarOM" data-om="<?php echo $sigla_usuario; ?>">Trocar OM</button>

									<button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modalTrocarSenha">Alterar Senha</button>

									<?php $flag = md5("excluir_usuario");?>
									<a href="usuario/exclui_usuario.php?flag=<?php echo $flag; ?>"><button type="button" class="btn btn-xs btn-danger">Apagar</button></a>
								</td>
							</tr>
						</tbody>
					 </table>
						<?php if (isset($_GET['flag'])){include_once(__DIR__ .'/usuario/alertas.inc.php');}?>
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
									<form name="form_editar" id="form_editar" method="POST" action="usuario/altera_usuario.php" enctype="multipart/form-data">
										<div class="form-group">
											<label for="rg" class="control-label">*RG:</label>
											<input name="rg" id="rg" type="text" class="form-control" />
										</div>
										<div class="form-group">
											<label for="posto" class="control-label">*Posto/Grad:</label>
											<?php include_once('listas/postos_select.inc.php');?>
										</div>
										<div class="form-group">
											<label for="nome_guerra" class="control-label">*Nome de guerra:</label>
											<input name="nome_guerra" id="nome_guerra" type="text" class="form-control" />
										</div>
										<div class="form-group">
											<label for="nome" class="control-label">*Nome completo:</label>
											<input name="nome" id="nome" type="text" class="form-control"  />
										</div>
										<div class="form-group">
											<label for="email" class="control-label">*E-mail:</label>
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
											<input name="ritex_atual" type="hidden" value="<?php echo $ritex_usuario;?>" />
											<input name="celular_atual" type="hidden" value="<?php echo $celular_usuario;?>" />
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
									<form method="POST" action="usuario/altera_om.php" enctype="multipart/form-data">
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
											<input name="flag" type="hidden" value="<?php echo $codom_usuario;?>"/>
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
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="componentes/externos/jquery/jquery.min.js"></script>
		<script src="componentes/externos/jquery/jquery.mask.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="componentes/externos/bootstrap/js/bootstrap.min.js"></script>
		<script src="componentes/externos/bootstrap/js/bootstrapValidator.min.js"></script>

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
									message:'*preenchimento obrigatório'
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
									message: '*preenchimento obrigatório'
								}
							}
						},
						nome_guerra: {
							validators: {
								notEmpty: {
									message: '*preenchimento obrigatório'
								}
							}
						},
						nome: {
							validators: {
								notEmpty: {
									message: '*preenchimento obrigatório'
								}
							}
						},
						email: {
							validators: {
								notEmpty: {
									message: '*preenchimento obrigatório'
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
								}
							}
						},
						celular: {
							validators: {
								regexp: {
									regexp: /^[0-9\(\)\-]+$/,
									message: 'somente dígitos'
								}
							}
						}
					}
				})
			});
		</script>

<script type="text/javascript">
jQuery(function($){
   $("#celular").mask("(99)9999-9999?9");
   if($("#celular").length > 10){
		$("#celular").mask("(99)99999-999?9");
	} else {
		$("#celular").mask("(99)9999-9999?9");
	}
});
</script>
<!--
<script>
	jQuery(function($) {
    $.mask.definitions['~']='[+-]';
    //Inicio Mascara Telefone
	$('input[type=tel]').mask("(99) 9999-9999?9").ready(function(event) {
		var target, phone, element;
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;
		phone = target.value.replace(/\D/g, '');
		element = $(target);
		element.unmask();
		if(phone.length > 10) {
			element.mask("(99) 99999-999?9");
		} else {
			element.mask("(99) 9999-9999?9");
		}
	});
   });
   </script>-->
	</body>
</html>