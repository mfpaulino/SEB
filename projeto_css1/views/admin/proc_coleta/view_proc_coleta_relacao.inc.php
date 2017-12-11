<?php
$sql = "SELECT proc_coleta FROM adm_proc_coleta ORDER BY proc_coleta";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_proc_coleta="disabled";
}
?>
<div class="modal fade" id="modalExibirProcColeta" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Procedimentos de Coleta Cadastrados</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printProcAna" class="box-body no-padding">
						<table class="table table-striped">
							<?php
							$i = 1;
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td><?php echo "<b>".$i . " -</b> " . $row['proc_coleta'];?></td>
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
				<button id="btnPrintProcColeta" class="btn btn-default" <?php echo $atributo_proc_coleta;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>