<?php
$sql = "SELECT proc_ana FROM adm_proc_analise ORDER BY proc_ana";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_proc_ana="disabled";
}
?>
<div class="modal fade" id="modalExibirProcAna" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Procedimentos de Análise de Dados Cadastrados</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printProcAna" class="box-body no-padding">
						<table class="table table-striped">
							<?php
							$i = 1;
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td class="text-justify"><?php echo "<b>".$i . " -</b> " . $row['proc_ana'];?></td>
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
				<button id="btnPrintProcAna" class="btn btn-default" <?php echo $atributo_proc_ana;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>