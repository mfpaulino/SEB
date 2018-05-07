<?php
/************* gerar uma lista com os id das auditorias dependendo do usuario que estiver logado (unidade/icfex/cciex) **/
$sql = "SELECT id_auditoria, unidades FROM plan_auditoria";
$con_auditorias = $mysqli->query($sql);

while ($rows =  $con_auditorias->fetch_assoc()){

	/****** relacao unidades **********************/
	$om = substr($rows['unidades'], 0, -1);//codom
	$lst_om = "";

	$con_om = $mysqli->query("SELECT sigla FROM cciex_om WHERE codom IN ($om)");
	//$con_om = $mysqli1->query("SELECT sigla FROM cciex_om WHERE codom IN ($om)");
	while($row_om = $con_om->fetch_assoc()){
		$lst_om = $lst_om . $row_om['sigla'].", ";//sigla_unidade
	}

	$lst_om = substr($lst_om, 0, -2);
	/*********** relação de unid contr interno *************/
	$con_uci = $mysqli->query("SELECT icfex FROM cciex_om WHERE codom IN ($om)");
	$lst_uci = "";

	while($row_uci = $con_uci->fetch_assoc()){

		$cod_uci = $row_uci['icfex'];//pega o cod da unid cont interno

		if($nr_ci == $cod_uci or $nr_ci == '0'){
			$lst_id = $lst_id . $rows['id_auditoria'] . ',';
		}
		elseif($nr_ci == ''){
			$om_array = explode(",", $om);
			if(in_array($codom_usuario, $om_array)){
				$lst_id = $lst_id . $rows['id_auditoria'] . ',';
			}
		}
	}
}
$lst_id = substr($lst_id, 0, -1);//elimino a última "," da string.
$lst_id = explode(",", $lst_id);
$lst_id = array_unique($lst_id);
$lst_id = implode(",", $lst_id);
/**********************************************************************************************************************************/

$sql = "SELECT plan_auditoria.*, id_tipo_evento FROM plan_auditoria, adm_tipo_evento WHERE tipo = tipo_evento AND id_auditoria IN ($lst_id) ORDER BY ano DESC, id_auditoria DESC";
$con_auditorias = $mysqli->query($sql);
?>
<div class="modal fade modal-wide" id="modalExibirAuditoria" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Auditorias Cadastradas</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printAuditoria" class="box-body no-padding">
						<table class="table table-striped">
							<tr>
								<thead>
									<th></th>
									<th>Ano</th>
									<th>Unid C I</th>
									<th>Unidade(s)</th>
									<th>Natureza</th>
									<th>Tipo</th>
									<th>Período</th>
									<th>Equipe</th>
									<th>NUP</th>
								</thead>
							</td>
							<?php
							$i = 1;
							while($rows = $con_auditorias->fetch_assoc()){
								/****** relacao unidades **********************/

								$om = substr($rows['unidades'], 0, -1);
								$lst_om = "";

								$con_om = $mysqli->query("SELECT sigla FROM cciex_om WHERE codom IN ($om)");
								//$con_om = $mysqli1->query("SELECT sigla FROM cciex_om WHERE codom IN ($om)");
								while($row_om = $con_om->fetch_assoc()){
									$lst_om = $lst_om . $row_om['sigla'].", ";
								}

								$lst_om = substr($lst_om, 0, -2);

								/*********** relação de unid contr interno *************/
								$con_uci = $mysqli->query("SELECT icfex FROM cciex_om WHERE codom IN ($om)");
								$lst_uci = "";

								while($row_uci = $con_uci->fetch_assoc()){

									$cod_uci = $row_uci['icfex'];//pega o cod da unid cont interno
									if($cod_uci == $nr_ci){
										$lst_id = $lst_id . $rows['id_auditoria'] . ',';
									}
									$uci = exibir_uci($cod_uci);//converte para a sigla
									$lst_uci = $lst_uci . $uci . ",";//cria uma string
								}

								$lst_uci = substr($lst_uci, 0, -1);//elimina a ultima "," da string
								$lst_uci = explode(',',$lst_uci);//converte para um array
								$lst_uci = array_unique($lst_uci);//elimina valores repetidos
								sort($lst_uci);//ordena
								$lst_uci = implode(", ", $lst_uci);//tansforma em string para exibição

								/********** chefe equipe **************************/
								$id_chefe = $rows['chefe'];
								$con_chefe = $mysqli->query("SELECT posto, nome_guerra FROM postos, usuarios WHERE postos.id_posto = usuarios.id_posto AND id_usuario = '$id_chefe'");
								$rows_chefe = $con_chefe->fetch_assoc();

								$chefe = $rows_chefe['posto'] . " " . $rows_chefe['nome_guerra'];

								/****** relação equipe **************************/
								$equipe = substr($rows['equipe'], 0, -1);
								$lst_equipe = "";

								$con_equipe = $mysqli->query("SELECT id_usuario, posto, nome_guerra FROM postos, usuarios WHERE postos.id_posto = usuarios.id_posto AND id_usuario IN ($equipe) ORDER BY postos.id_posto");

								while ($rows_equipe = $con_equipe->fetch_assoc()){
									if($id_chefe == $rows_equipe['id_usuario']){
										$var1 = '<span class="text-bold text-green">';
										$var2 = '</span>';
									}
									else {
										$var1 = '';
										$var2 = '';
									}
									$lst_equipe = $lst_equipe . $var1 . $rows_equipe['posto'] . " " . $rows_equipe['nome_guerra'] . $var2 . ", ";
								}
								$lst_equipe = substr($lst_equipe, 0, -2);
								/*****************************************************/

								$periodo = converter_data($rows['inicio']). " a " . converter_data($rows['fim']);
								?>
								<tr>
									<td><?php echo "<b>".$i . ".</b> ";?></td>
									<td><?php echo $rows['ano'];?></td>
									<td><?php echo $lst_uci;?></td>
									<td><?php echo $lst_om;?></td>
									<td><?php echo $rows['natureza'];?></td>
									<td><?php echo $rows['tipo'];?></td>
									<td><?php echo $periodo;?></td>
									<td><?php echo $lst_equipe;?></td>
									<td><?php echo $rows['nup'];?></td>
								</tr>
								<?php
							$i++;
							}
							?>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btnPrintAuditoria" class="btn btn-default" <?php echo $atributo_area;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>