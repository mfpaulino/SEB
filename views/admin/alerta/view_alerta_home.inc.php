<?php
include_once(PATH.'/controllers/admin/alerta/alerta_home.inc.php');
//as variaveis que nao sao criadas aqui, vêm do script acima
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
			if ($rows['pedidos_cadastro'] > 0){
				$alerta_usuario = $rows['pedidos_cadastro'] == 1 ? "pedido pendente!" : "pedidos pendentes!";
				?>
				<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Cadastro de Usuário</h4>
					<p>Há <?php echo $rows['pedidos_cadastro'] . " " . $alerta_usuario;?> </p>
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