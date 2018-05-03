<?php
if ($inc == "sim"){?>
	<div class="tab-content">
		<div class="tab-pane active" id="control-sidebar-settings-tab">
			<!--<h3 class="control-sidebar-heading">Administradores</h3>-->
			<div class="form-group">
				<br />
				<?php
				include_once(PATH.'/controllers/usuario/usuario_lista_admin.inc.php');
				while($row_admin = $con_admin->fetch_assoc()){
					$codom = $row_admin['codom'];
					$sql = "select sigla from cciex_om where codom = {$codom}";
					$con = $mysqli->query($sql);
					//$con = $mysqli1->query($sql);
					$row_om = $con->fetch_assoc();
					echo '- ' . $row_admin['posto'].' '.$row_admin['nome_guerra'].' ('.$row_om['sigla'].')<br />';
				}
				?>
			</div>
		</div>
	</div>
<?php
}
else {
	include_once('../../controllers/autenticacao/acesso_negado.php');//exibe msg de ACESSO NEGADO
}
?>