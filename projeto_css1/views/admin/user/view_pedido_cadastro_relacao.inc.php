<?php
//$lista_perfis_admin: vem do script perfil.inc.php
//$condicao_codom: vem do script perfil.inc.php

$sql = "SELECT id_usuario, cpf, rg, nome_guerra, nome, email, ritex, celular, avatar, dt_cad, usuarios.id_posto, p.posto, codom, usuarios.id_perfil, pe.perfil, ultimo_acesso, acesso_anterior, status from usuarios, postos p, adm_perfis pe, adm_perfis_administra pa where usuarios.status = 'Recebido' and usuarios.id_posto = p.id_posto and usuarios.id_perfil = pe.id_perfil and pa.id_perfil_admin in ($lista_perfis_admin) and (pa.id_perfil = usuarios.id_perfil and pa.id_perfil_om = usuarios.id_perfil_om) $condicao_codom order by  usuarios.id_perfil_om, usuarios.codom, usuarios.id_posto";
$con_usuarios = $mysqli->query($sql);
$qtde = $con_usuarios->num_rows;

if($qtde == 0){
	$atributo_pedido_cadastro="disabled";
}
?>
<div class="modal fade" id="modalExibirPedidoCadastro" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Usuários (Pedidos de Cadastro)</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printPedidoCadastro" class="box-body no-padding ">
						<table class="table table-striped">
							<tr>
								<td><b>Unidade</b></td>
								<td><b>Usuário</b></td>
								<td><b>Perfil</b></td>
							</tr>
							<?php
							while ($rows =  $con_usuarios->fetch_assoc()){
								$user_codom =  $rows['codom'];

								$sql = "select sigla, denominacao from cciex_om where codom = $user_codom";
								$con_om = $mysqli1->query($sql);
								$row_om = $con_om->fetch_assoc();
								?>
								<tr>
									<td><?php echo $row_om['sigla']; ?></td>
									<td><?php echo $rows['posto'] ." ". $rows['nome_guerra']; ?></td>
									<td><?php echo $rows['perfil']; ?></td>
								</tr>
								<?php
							} ?>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnPrintPedidoCadastro" class="btn btn-default" <?php echo $atributo_pedido_cadastro;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>