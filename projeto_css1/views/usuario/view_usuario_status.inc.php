<?php
/*** verifica se o usuário possui alguma entrada na tabela de logs ***
 * caso sim, desabilita o botao excluiir ***/

$sql_user_log = "SELECT id_log FROM logs WHERE cpf = '$cpf'";
$resultado = $mysqli->query($sql_user_log);

if($resultado->num_rows > 0){
	$btn_status = "disabled";
}
else {
	$btn_status = "";
}
/****/
?>
<table class="table">
	<thead>
		<tr>
			<th>CPF</th>
			<th>UNIDADE</th>
			<th>STATUS</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $cpf; ?></td>
			<td><?php echo $sigla_usuario; ?></td>
			<td><?php echo $status; ?>
			<td>
				<!--botao Visualizar-->
				<button type="button" class="btn btn-xs btn-primary"
					data-tooltip="tooltip" title="Exibir Perfil"
					data-toggle="modal"
					data-target="#modalVisualizar<?php echo $cpf; ?>">
					<i class="fa fa-search"></i> Perfil
				</button>
				<!--botao Alterar Dados-->
				<button type="button" class="btn btn-xs btn-warning"
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
					<i class="fa fa-pencil"></i> Perfil
				</button>
				<!--botao Alterar Unidade-->
				<button type="button" class="btn btn-xs btn-warning"
					data-tooltip="tooltip" title="Alterar Unidade"
					data-toggle="modal"
					data-target="#modalTrocarUnidade"
					data-unidade="<?php echo $sigla_usuario; ?>">
					<i class="fa fa-pencil"></i> Unidade
				</button>
				<!--botao Alterar Senha-->
				<button type="button" class="btn btn-xs btn-warning"
					data-tooltip="tooltip" title="Alterar Senha"
					data-toggle="modal"
					data-target="#modalTrocarSenha">
					<i class="fa fa-pencil"></i> Senha
				</button>
				<!--botao Excluir cadastro-->
				<button form="formExcluir" type="submit" <?php echo $btn_status;?> class="btn btn-xs btn-danger" data-toggle="confirmation"
					data-placement="left"
					data-btn-ok-label="Continuar"
					data-btn-ok-icon="glyphicon glyphicon-share-alt"
					data-btn-ok-class="btn-success"
					data-btn-cancel-label="Parar"
					data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
					data-btn-cancel-class="btn-danger"
					data-tooltip="tooltip"
					data-title="Exclusão de cadastro"
					data-content="Confirma?">
					<i class="fa fa-trash"></i> Perfil
				</button>
				<form id="formExcluir" action="controllers/usuario/usuario_excluir.php" method = "POST">
					<input type="hidden" name="flag" />
				</form>
			</td>
		</tr>
	</tbody>
</table>