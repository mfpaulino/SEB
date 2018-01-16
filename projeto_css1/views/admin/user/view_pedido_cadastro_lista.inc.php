<?php
$sql = "SELECT id_usuario, cpf, rg, nome_guerra, nome, email, ritex, celular, avatar, dt_cad, usuarios.id_posto, p.posto, codom, usuarios.id_perfil, pe.perfil, ultimo_acesso, acesso_anterior, status from usuarios, postos p, adm_perfis pe where usuarios.status = 'Recebido' and usuarios.id_posto = p.id_posto and usuarios.id_perfil = pe.id_perfil and perfil_om = '$perfil_om' order by usuarios.id_posto";
$con_usuarios = $mysqli->query($sql);

?>
<div class="box box-solid bg-green collapsed-box">
	<div class="box-header">
		<i class="fa fa-user"></i>
		<h3 class="box-title">Usuários (Solicitações)</h3>
		<div class="pull-right box-tools">
			<div class="btn-group">
				<button type="button" title="Exibir Menu" class="btn bg-green-gradient btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down fa-lg"></i></button>
				<ul class="dropdown-menu pull-right" role="menu">
					<li><a href="#" data-toggle="modal" data-target="#modalExibirPedidoCadastro">Impressão</a></li>
				</ul>
			</div>
			<button type="button" title="Expandir/Encolher" class="btn bg-green-gradient btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
			<button type="button" title="Ocultar" class="btn bg-green-gradient btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-footer text-black" style="border:1px solid black;">
		<div class="col-sm-12">
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

				$unidade = substr($row_om['sigla'], -5);//pega os 5 ultimos caracteres da sigla
				$unidade = ($unidade == 'CCIEx' or $unidade == 'ICFEx') ? $unidade : 'Unidade';

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
				/*** verifica se o usuário possui alguma entrada na tabela de logs ****
				**** caso tenha, desabilita o botao de excluir */

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
					<td width="13%" class="text-center">
						<!--botao Perfil-->
						<button type="button" class="btn btn-xs btn-primary"
							data-tooltip="tooltip"
							data-title="Exibir Perfil"
							data-placement="left"
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
							>
							<i class="fa fa-search"></i>
						</button>
						<!--botao Habilitar-->
						<button form="formHabilitar<?php echo $rows['id_usuario'];?>" type="submit" <?php echo $btn_status_h;?> class="btn btn-xs btn-primary"
							data-tooltip="tooltip"
							data-title="<?php echo $tooltip_h;?>"
							data-placement="left"
							>
							<i class="fa fa-check"></i>
						</button>
						<!--botao Excluir-->
						<button form="formExcluir<?php echo $rows['id_usuario'];?>" type="submit" <?php echo $btn_status_e;?> class="btn btn-xs btn-primary"
							data-tooltip="tooltip"
							data-toggle="confirmation"
							data-placement="left"
							data-btn-ok-label="Continuar"
							data-btn-ok-icon="glyphicon glyphicon-share-alt"
							data-btn-ok-class="btn-success"
							data-btn-cancel-label="Parar"
							data-btn-cancel-icon="glyphicon glyphicon-ban-circle"
							data-btn-cancel-class="btn-danger"
							data-title="Excluir Usuário"
							data-content="Confirma?">
							<i class="fa fa-trash"></i>
						</button>
						<form id="formHabilitar<?php echo $rows['id_usuario'];?>" action="controllers/admin/user/user_alterar.php" method = "POST">
							<input type="hidden" name="flag" value="habilitar" />
							<input type="hidden" name="id_usuario" value="<?php echo $rows['id_usuario'];?>" />
						</form>
						<form id="formExcluir<?php echo $rows['id_usuario'];?>" action="controllers/admin/user/user_alterar.php" method = "POST">
							<input type="hidden" name="flag" value="excluir" />
							<input type="hidden" name="id_usuario" value="<?php echo $rows['id_usuario'];?>" />
							<!--<input type="hidden" name="cpf" value="<?php echo $rows['cpf'];?>" />-->
						</form>
					</td>
				</tr>
			<?php } ?>
			</table>
		</div>
	</div>
</div>