<?php
$sql = "SELECT id_usuario, cpf, rg, nome_guerra, nome, email, ritex, celular, avatar, dt_cad, usuarios.id_posto, p.posto, codom, usuarios.id_perfil, pe.perfil, ultimo_acesso, acesso_anterior, status from usuarios, postos p, adm_perfis pe where usuarios.status = 'recebido' and usuarios.id_posto = p.id_posto and usuarios.id_perfil = pe.id_perfil order by usuarios.id_posto";
$con_usuarios = $mysqli->query($sql); //alterar para recebido
?>
<div class="box">
	<table class="table table-striped">
		<tr class="text-bold">
			<td>Usuário</td>
			<td>Perfil</td>
			<td>Unidade</td>
			<td class="text-center">Ação</td>
		</tr>
	<?php
	while ($rows =  $con_usuarios->fetch_assoc()){
		$user_codom =  $rows['codom'];

		$sql = "select sigla, denominacao from cciex_om where codom = $user_codom";
		$con_om = $mysqli1->query($sql);
		$row_om = $con_om->fetch_assoc();

		/*** verifica se o perfil atual do usuario é válido para sua unidade atual(ele pode ter trocado de unidade)***/

		$unidade = strtolower(substr($row_om['sigla'], -5));//pega os 5 ultimos caracteres da sigla
		$unidade = ($unidade == 'cciex' or $unidade == 'icfex') ? $unidade : 'unidades';

		$sql_user_perfis = "SELECT perfis FROM adm_perfis_unidade WHERE unidade = '$unidade'";
		$con_user_perfis = $mysqli->query($sql_user_perfis);//verifica os perfis possiveis para a unidade do usuario

		$row_user_perfis = $con_user_perfis->fetch_assoc();
		$user_perfis = unserialize($row_user_perfis['perfis']);

		$user_perfis  = implode(',',$user_perfis);//separa os valores do array com uma virgula
		$user_perfis  = "'".$user_perfis."'";//coloca um ' no inicio e fim da string
		$user_perfis = str_replace(",","','",$user_perfis);//substitui a virgula por "','".

		$sql_user_perfil = "SELECT * FROM adm_perfis WHERE perfil in (".$user_perfis.") ORDER BY perfil";
		$con_user_perfil= $mysqli->query($sql_user_perfil);//cria a lista de perfis para o usuario
		$num_rows_user_perfil = $con_user_perfil->num_rows;


		$pos = strpos($user_perfis, $rows['perfil']);
		if ($pos === false){
			$btn_status_h = "disabled";
			$tooltip_h = "Primeiro altere o perfil do usuário";
		}
		else {
			$btn_status_h = "";
			$tooltip_h = "Habilitar";
		}
		/*** verifica se o usuário possui alguma entrada na tabela de logs ****/

		$sql_user_log = "SELECT id_log FROM logs WHERE cpf = $rows[cpf]";
		$resultado = $mysqli->query($sql_user_log);


		if($resultado->numrows > 0){
			$btn_status_e = "disabled";
		}
		else {
			$btn_status_e = "";
		}

		/****/
		?>
		<tr>
			<td><?php echo $rows['posto'] ." ". $rows['nome_guerra']; ?></td>
			<td><?php echo $rows['perfil']; ?></td>
			<td><?php echo $row_om['sigla'];?></td>
			<td class="text-center">
				<!--botao Perfil-->
				<button type="button" class="btn btn-xs btn-primary"
					data-tooltip="tooltip" title="Exibir Perfil"
					data-toggle="modal"
					data-target="#modalUserPerfil"
					data-id_usuario="<?php echo $rows['id_usuario'];?>"
					data-cpf="<?php echo $rows['cpf'];?>"
					data-rg="<?php echo $rows['rg'];?>"
					data-nome="<?php echo $rows['nome'];?>"
					data-email="<?php echo $rows['email'];?>"
					data-ritex="<?php echo $rows['ritex'];?>"
					data-celular="<?php echo $rows['celular'];?>"
					data-usuario="<?php echo $rows['posto'].' '.$rows['nome_guerra'];?>"
					data-id_perfil="<?php echo $rows['id_perfil'];?>"
					data-perfil="<?php echo $rows['perfil'];?>"
					data-unidade="<?php echo $row_om['sigla'];?>"
					data-avatar="<?php echo "views/avatar/".$rows['avatar'];?>"
					data-doc=<?php echo $row_om['sigla'];?>"
					>
					<i class="fa fa-search"></i>
				</button>
				<!--botao Habilitar-->
				<button form="formHabilitar" type="submit" <?php echo $btn_status_h;?> class="btn btn-xs btn-primary" data-tooltip="tooltip" title="<?php echo $tooltip_h;?>">
					<i class="fa fa-check"></i>
				</button>
				<!--botao Excluir-->
				<button form="formExcluir" type="submit" <?php echo $btn_status_e;?> class="btn btn-xs btn-primary"
					data-toggle="confirmation"
					data-placement="left"
					data-btn-ok-label="Continuar"
					data-btn-ok-icon="glyphicon glyphicon-share-alt"
					data-btn-ok-class="btn-success"
					data-btn-cancel-label="Parar"
					data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
					data-btn-cancel-class="btn-danger"
					data-title="Confirma exclusão do usuário?"
					data-content="">
					<i class="fa fa-trash"></i>
				</button>
				<form id="formHabilitar" action="controllers/admin/user/user_alterar.php" method = "POST">
					<input type="hidden" name="flag" value="habilitar" />
					<input type="hidden" name="id_usuario" value="<?php echo $rows['id_usuario'];?>" />
				</form>
				<form id="formExcluir" action="controllers/admin/user/user_alterar.php" method = "POST">
					<input type="hidden" name="flag" value="excluir" />
					<input type="hidden" name="id_usuario" value="<?php echo $rows['id_usuario'];?>" />
				</form>
			</td>
		</tr>
	<?php } ?>
	</table>
</div>