<?php
$sql = "SELECT subarea FROM adm_subareas ORDER BY subarea";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_subarea="disabled";
}
?>
<div class="modal fade" id="modalListarSubarea" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Subáreas/Subprocessos Cadastrados</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printSubarea" class="box-body no-padding">
						<table class="table table-striped">
							<?php
							$i = 1;
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td class="text-justify"><?php echo "<b>".$i . " -</b> " . $row['subarea'];?></td>
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
				<button id="btnPrintSubarea" class="btn btn-default" <?php echo $atributo_subarea;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>