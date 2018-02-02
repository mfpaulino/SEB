<?php
$sql = "SELECT info_req FROM adm_info_requeridas ORDER BY info_req";
$con_lista = $mysqli->query($sql);
$qtde = $con_lista->num_rows;

if($qtde == 0){
	$atributo_info_req="disabled";
}
?>
<div class="modal fade" id="modalExibirInfoReq" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header fundo">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Informações Requeridas Cadastradas</h4>
			</div>
			<div class="modal-body">
				<div class="box">
					<div id="area_printInfoReq" class="box-body no-padding">
						<table class="table table-striped">
							<?php
							$i = 1;
							while($row = $con_lista->fetch_assoc()){?>
								<tr>
									<td><?php echo "<b>".$i . " -</b> " . $row['info_req'];?></td>
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
				<button id="btnPrintInfoReq" class="btn btn-default" <?php echo $atributo_info_req;?> ><i class="fa fa-print"></i> Imprimir</button>
			</div>
		</div>
	</div>
</div>