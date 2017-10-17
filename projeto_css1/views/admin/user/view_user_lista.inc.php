<?php
$sql = "SELECT id_usuario, cpf, rg, nome_guerra, nome, email, ritex, celular, avatar, dt_cad, usuarios.id_posto, p.posto, codom, usuarios.id_perfil, pe.perfil, ultimo_acesso, acesso_anterior, status from usuarios, postos p, adm_perfis pe where usuarios.id_posto = p.id_posto and usuarios.id_perfil = pe.id_perfil order by usuarios.id_posto";
$con_usuarios = $mysqli->query($sql);
$mysqli->close();
?>
<div class="box">
	<table class="table table-striped">
		<tr class="text-bold">
			<td>Usuário</td>
			<td>Perfil</td>
			<td>Status</td>
			<td class="text-center">Ação</td>
		</tr>
	<?php
	while ($rows =  $con_usuarios->fetch_assoc()){

		$user_codom =  $rows['codom'];

		$sql = "select sigla, denominacao from cciex_om where codom = '$user_codom'";
		$con_om = $mysqli1->query($sql);
		$row_om = $con_om->fetch_assoc();

		$user_sigla = $row_om['sigla'];

		$user_cpf = $rows['cpf'];
		$user_rg = $rows['rg'];
		$user_nome_guerra = $rows['nome_guerra'];
		$user_nome = $rows['nome'];
		$user_email = $rows['email'];
		$user_ritex = $rows['ritex'];
		$user_celular = $rows['celular'];
		$user_posto = $rows['posto'];
		$user_perfil = $rows['perfil'];
		$user_status = $rows['status'];
		?>
		<tr>
			<td><?php echo "$user_posto $user_nome_guerra"; ?></td>
			<td><?php echo $user_perfil; ?></td>
			<td><?php echo $user_status; ?></td>
			<td class="text-center">
				<!--botao Visualizar-->
				<button type="button" class="btn btn-xs btn-primary"
					data-tooltip="tooltip" title="Exibir Perfil"
					data-toggle="modal"
					data-target="#modalUserVisualizar<?php echo $user_cpf; ?>">
					<i class="fa fa-search"></i>
				</button>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>