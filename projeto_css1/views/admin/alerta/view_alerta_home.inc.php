<?php
$tot_alertas = 0;
/****************************************************************************************/
$sql = "SELECT count(id_usuario) as pedidos_cadastro, MAX(usuarios.data_cad) as data_cad from usuarios, adm_perfis_administra pa where usuarios.status = 'Recebido' and pa.id_perfil_admin in ($lista_perfis_admin) and (pa.id_perfil = usuarios.id_perfil and pa.id_perfil_om = usuarios.id_perfil_om)";
$con = $mysqli->query($sql);
$rows = $con->fetch_assoc();

if ($rows['pedidos_cadastro'] > 0){
	$tot_alertas++;
}
/**********************************************************************************/
if($tot_alertas > 0){
	$status_alertas = "(Quantidade: ". $tot_alertas. ")";
}
else {
	$status_alertas = "(Nenhum alerta)";
}
?>
<div class="col-md-6">
	<div class="row">
		<div class="col-md-12">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="fa fa-warning"></i></span>
				<div class="info-box-content">
					<span class="info-box-number">Alertas do Sistema</span>
					<span class="info-box-text"><?php echo $status_alertas;?></span>
				</div>
			</div>
		</div>
	</div>
	<!-------------------------------------------- Pedidos de cadastro --------------------------------------------->
	<div class="row">
		<div class="col-md-12">
			<?php
			if ($rows['pedidos_cadastro'] > 0){?>
				<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Cadastro de Usuário</h4>
					<p>Há <?php echo $rows['pedidos_cadastro'];?> pedido(s) de novo(s) usuário(s) pendente(s)!</p>
					<i><small>(Pedido mais recente: <?php echo converter_data($rows['data_cad'],'BR',true);?>)</small></i>
				</div>
			<?php
			}
			?>
		</div>
	</div>
	<!--------------------------------------------------------------------------------------------------------------->
	<!--------------------------------------------------------------------------------------------------------------->
</div>