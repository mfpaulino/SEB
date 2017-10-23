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

		$sql = "select sigla, denominacao from cciex_om where codom = $user_codom";
		$con_om = $mysqli1->query($sql);
		$row_om = $con_om->fetch_assoc();
		?>
		<tr>
			<td><?php echo $rows['posto'] ." ". $rows['nome_guerra']; ?></td>
			<td><?php echo $rows['perfil']; ?></td>
			<td><?php echo $rows['status'];?></td>
			<td class="text-center">
				<!--botao Visualizar-->
				<button type="button" class="btn btn-xs btn-primary"
					data-tooltip="tooltip" title=""
					data-toggle="modal"
					data-target="#modalUserPerfil"
					data-cpf="<?php echo $rows['cpf'];?>"
					data-rg="<?php echo $rows['rg'];?>"
					data-nome="<?php echo $rows['nome'];?>"
					data-email="<?php echo $rows['email'];?>"
					data-ritex="<?php echo $rows['ritex'];?>"
					data-celular="<?php echo $rows['celular'];?>"
					data-usuario="<?php echo $rows['posto'].' '.$rows['nome_guerra'];?>"
					data-id_perfil="<?php echo $rows['id_perfil'];?>"
					data-unidade="<?php echo $row_om['sigla'];?>"
					data-avatar="<?php echo "views/avatar/".$rows['avatar'];?>"
					data-doc=<?php echo $row_om['sigla'];?>"
					>
					<i class="fa fa-search"></i>
				</button>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>