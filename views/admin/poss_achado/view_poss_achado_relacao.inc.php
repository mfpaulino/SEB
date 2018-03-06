<?php
$sql = "SELECT poss_achado FROM adm_poss_achados ORDER BY poss_achado";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_poss_achado="disabled";
}
?>
<div class="modal fade" id="modalExibirPossAchado" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Possíveis Achados Cadastrados</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printPossAchado" class="box-body no-padding">
						<table class="table table-striped">
							<?php
							$i = 1;
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td class="text-justify"><?php echo "<b>".$i . " -</b> " . $row['poss_achado'];?></td>
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
				<button id="btnPrintPossAchado" class="btn btn-default" <?php echo $atributo_poss_achado;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>